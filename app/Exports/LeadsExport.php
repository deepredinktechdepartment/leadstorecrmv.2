<?php

namespace App\Exports;
use Carbon\Carbon;
use App\Models\Lead;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Support\Facades\Crypt;

class LeadsExport implements FromCollection, WithHeadings, WithMapping
{
    protected array $filters;

    public function __construct(array $filters)
    {
        $this->filters = $filters;
    }

    /**
     * @return Collection
     */
    public function collection(): Collection
    {
        // Apply filters to the query


return Lead::query()
    ->when($this->filters['start_date'] ?? null, function($query, $startDate) {
        // Include the start date from 00:00:00
        $query->where('lead_last_update_date', '>=', Carbon::parse($startDate)->startOfDay());
    })
    ->when($this->filters['end_date'] ?? null, function($query, $endDate) {
        // Include the end date until 23:59:59
        $query->where('lead_last_update_date', '<=', Carbon::parse($endDate)->endOfDay());
    })
    ->when($this->filters['utm_source'] ?? null, function($query, $utmSource) {
        $query->where('utm_source', $utmSource);
    })
    ->when($this->filters['utm_medium'] ?? null, function($query, $utmMedium) {
        $query->where('utm_medium', $utmMedium);
    })
    ->when($this->filters['utm_campaign'] ?? null, function($query, $utmCampaign) {
        $query->where('utm_campaign', $utmCampaign);
    })
    ->when($this->filters['projectID'] ?? null, function($query, $projectID) {
        $projectID= Crypt::decrypt($projectID);
        $query->where('client_id', $projectID);
    })

    ->get();


    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'Name',
            'Email',
            'Country code',
            'Phone',
            'UTM Source',
            'UTM Medium',
            'UTM Campaign',
            'UTM Term',
            'UTM Content',
            'Lead Created At',
        ];
    }

    /**
     * @param Lead $lead
     * @return array
     */
    public function map($lead): array
    {
        return [
            $lead->firstname,
            $lead->email,
            $lead->phone_country_code,
            $lead->phone,
            $lead->utm_source,
            $lead->utm_medium,
            $lead->utm_term,
            $lead->utm_campaign,
            $lead->utm_content,
            $lead->lead_last_update_date,
        ];
    }
}
