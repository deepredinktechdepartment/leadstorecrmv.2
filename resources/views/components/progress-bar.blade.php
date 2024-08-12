{{-- resources/views/components/progress-bar.blade.php --}}

@php
    // Calculate progress percentage
    $progressPercentage = $monthlyTarget > 0 ? ($currentMonthLeadsCount / $monthlyTarget) * 100 : 0;

    // Determine progress bar color
    $progressColor = 'bg-primary'; // Default color
    if ($progressPercentage >= 80) {
        $progressColor = 'bg-success'; // Green for good performance
    } elseif ($progressPercentage >= 50) {
        $progressColor = 'bg-warning'; // Amber for average performance
    } else {
        $progressColor = 'bg-danger'; // Red for poor performance
    }
@endphp

<div class="progress mt-3">
    <div class="progress-bar {{ $progressColor }}" role="progressbar" style="width: {{ $progressPercentage }}%;" aria-valuenow="{{ $progressPercentage }}" aria-valuemin="0" aria-valuemax="100">
        {{ round($progressPercentage) }}%
    </div>
</div>
