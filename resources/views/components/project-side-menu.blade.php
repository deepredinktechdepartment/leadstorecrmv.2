<div class="lead_adds_side_bar py-4">
   {{-- <small> <a href="{{ URL::to('clients') }}" class="btn btn-primary text-white">Back to projects</a></small> --}}


    <ul class="setting_menu">
        <li>
            <a href="{{ route('projectLeads', ['projectID' => Crypt::encrypt($client->id)]) }}"
               class="{{ Route::is('projectLeads') ? 'active' : '' }}">
                Dashboard
            </a>
        </li>
        <li class="heading">External CRM</li>
        <li>
            <a href="{{ route('external.crm', ['clientID' => Crypt::encrypt($client->id)]) }}"
               class="{{ Route::is('external.crm') ? 'active' : '' }}">
                ExternalCRM
            </a>
        </li>

        <li class="heading">Social</li>
        <li>
            <a href="{{ route('facebook', ['clientID' => Crypt::encrypt($client->id)]) }}"
               class="{{ Route::is('facebook') ? 'active' : '' }}">
                Facebook
            </a>
        </li>
        <li>
            <a href="{{ route('facebookPages', ['clientID' => Crypt::encrypt($client->id)]) }}"
               class="{{ Route::is('facebookPages') ? 'active' : '' }}">
                Facebook Pages
            </a>
        </li>
        <li>
            <a href="{{ route('competitorScores', ['clientID' => Crypt::encrypt($client->id)]) }}"
               class="{{ Route::is('competitorScores') ? 'active' : '' }}">
                Competitor Scores
            </a>
        </li>

        <li class="heading">Cloud Telephony</li>
        <li>
            <a href="{{ route('exotel', ['clientID' => Crypt::encrypt($client->id)]) }}"
               class="{{ Route::is('exotel') ? 'active' : '' }}">
                Exotel
            </a>
        </li>

        <li class="heading">Email</li>
        <li>
            <a href="{{ route('emailServer', ['clientID' => Crypt::encrypt($client->id)]) }}"
               class="{{ Route::is('emailServer') ? 'active' : '' }}">
                Emailer Server-SMTP
            </a>
        </li>
        <li>
            <a href="{{ route('firstResponseEmailer', ['clientID' => Crypt::encrypt($client->id)]) }}"
               class="{{ Route::is('firstResponseEmailer') ? 'active' : '' }}">
                First Response Emailer
            </a>
        </li>
        <li>
            <a href="{{ route('emailLeadNotifications', ['clientID' => Crypt::encrypt($client->id)]) }}"
               class="{{ Route::is('emailLeadNotifications') ? 'active' : '' }}">
                Lead Notifications
            </a>
        </li>
        <li>
            <a href="{{ route('freTemplate', ['clientID' => Crypt::encrypt($client->id)]) }}"
               class="{{ Route::is('freTemplate') ? 'active' : '' }}">
                FRE Template
            </a>
        </li>
        <li>
            <a href="{{ route('emailleadNotificationTemplate', ['clientID' => Crypt::encrypt($client->id)]) }}"
               class="{{ Route::is('emailleadNotificationTemplate') ? 'active' : '' }}">
                Lead Notification Template
            </a>
        </li>

        <li class="heading">SMS</li>
        <li>
            <a href="{{ route('smsGateway', ['clientID' => Crypt::encrypt($client->id)]) }}"
               class="{{ Route::is('smsGateway') ? 'active' : '' }}">
                SMS Gateway
            </a>
        </li>
        <li>
            <a href="{{ route('firstResponseSms', ['clientID' => Crypt::encrypt($client->id)]) }}"
               class="{{ Route::is('firstResponseSms') ? 'active' : '' }}">
                First Response SMS
            </a>
        </li>
        <li>
            <a href="{{ route('smsLeadNotifications', ['clientID' => Crypt::encrypt($client->id)]) }}"
               class="{{ Route::is('smsLeadNotifications') ? 'active' : '' }}">
                Lead Notifications
            </a>
        </li>
        <li>
            <a href="{{ route('smsFreTemplate', ['clientID' => Crypt::encrypt($client->id)]) }}"
               class="{{ Route::is('smsFreTemplate') ? 'active' : '' }}">
                FRE Template
            </a>
        </li>
        <li>
            <a href="{{ route('smsLeadNotificationTemplate', ['clientID' => Crypt::encrypt($client->id)]) }}"
               class="{{ Route::is('smsLeadNotificationTemplate') ? 'active' : '' }}">
                Lead Notification Template
            </a>
        </li>

        <li class="heading">Reporting</li>
        <li>
            <a href="{{ route('leadSummaryNotifications', ['clientID' => Crypt::encrypt($client->id)]) }}"
               class="{{ Route::is('leadSummaryNotifications') ? 'active' : '' }}">
                Lead Summary Notifications
            </a>
        </li>

        <li class="heading">Goals</li>
        <li>
            <a href="{{ route('setupMonthlyGoals', ['clientID' => Crypt::encrypt($client->id)]) }}"
               class="{{ Route::is('setupMonthlyGoals') ? 'active' : '' }}">
                Setup Monthly Goals
            </a>
        </li>

        <li class="heading">Forms</li>
        <li>
            <a href="{{ route('leadCapture', ['clientID' => Crypt::encrypt($client->id)]) }}"
               class="{{ Route::is('leadCapture') ? 'active' : '' }}">
                Lead Capture
            </a>
        </li>
        <li>
            <a href="{{ route('leadActions', ['clientID' => Crypt::encrypt($client->id)]) }}"
               class="{{ Route::is('leadActions') ? 'active' : '' }}">
                Lead Actions
            </a>
        </li>
        <li>
            <a href="{{ route('blacklisting', ['clientID' => Crypt::encrypt($client->id)]) }}"
               class="{{ Route::is('blacklisting') ? 'active' : '' }}">
                Blacklisting
            </a>
        </li>
        <li>
            <a href="{{ route('hideCustInfo', ['clientID' => Crypt::encrypt($client->id)]) }}"
               class="{{ Route::is('hideCustInfo') ? 'active' : '' }}">
                Hide Cust Info
            </a>
        </li>

        <li class="heading">Revenue Tracking</li>
        <li>
            <a href="{{ route('revenueTracking', ['clientID' => Crypt::encrypt($client->id)]) }}"
               class="{{ Route::is('revenueTracking') ? 'active' : '' }}">
                Revenue Tracking
            </a>
        </li>


    </ul>
</div>
