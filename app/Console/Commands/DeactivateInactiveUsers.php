<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Carbon\Carbon;

class DeactivateInactiveUsers extends Command
{
    protected $signature = 'users:deactivate-inactive';
    protected $description = 'Deactivate users who have not logged in for the last 15 days';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {

        //* * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1

        $inactiveDate = Carbon::now()->subDays(15);

        User::where('last_login_at', '<', $inactiveDate)
            ->update(['active' => false]);

        $this->info('Inactive users have been deactivated.');
    }
}
