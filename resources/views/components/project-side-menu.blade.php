<div class="lead_adds_side_bar py-5 px-4">
    <ul class="setting_menu">
        <li><a href="{{ route('projectLeads', ['projectID' => Crypt::encrypt($client->id)]) }}" >Dashboard</a></li>

        <li class="heading">Social</li>
        <li><a href="{{ route('facebook', ['clientID' => Crypt::encrypt($client->id)]) }}">Facebook</a></li>
        <li><a href="{{ route('facebookPages', ['clientID' => Crypt::encrypt($client->id)]) }}">Facebook Pages</a></li>
        <li><a href="{{ route('competitorScores', ['clientID' => Crypt::encrypt($client->id)]) }}">Competitor Scores</a></li>

        <li class="heading">Cloud Telephony</li>
        <li><a href="{{ route('exotel', ['clientID' => Crypt::encrypt($client->id)]) }}">Exotel</a></li>

        <li class="heading">Email</li>
        <li><a href="{{ route('emailServer', ['clientID' => Crypt::encrypt($client->id)]) }}">Email Server</a></li>
        <li><a href="{{ route('firstResponseEmailer', ['clientID' => Crypt::encrypt($client->id)]) }}">First Response Emailer</a></li>
        <li><a href="{{ route('emailLeadNotifications', ['clientID' => Crypt::encrypt($client->id)]) }}">Lead Notifications</a></li>
        <li><a href="{{ route('freTemplate', ['clientID' => Crypt::encrypt($client->id)]) }}">FRE Template</a></li>
        <li><a href="{{ route('emailleadNotificationTemplate', ['clientID' => Crypt::encrypt($client->id)]) }}">Lead Notification Template</a></li>

        <li class="heading">SMS</li>
        <li><a href="{{ route('smsGateway', ['clientID' => Crypt::encrypt($client->id)]) }}">SMS Gateway</a></li>
        <li><a href="{{ route('firstResponseSms', ['clientID' => Crypt::encrypt($client->id)]) }}">First Response SMS</a></li>
        <li><a href="{{ route('smsLeadNotifications', ['clientID' => Crypt::encrypt($client->id)]) }}">Lead Notifications</a></li>
        <li><a href="{{ route('smsFreTemplate', ['clientID' => Crypt::encrypt($client->id)]) }}">FRE Template</a></li>
        <li><a href="{{ route('smsleadNotificationTemplate', ['clientID' => Crypt::encrypt($client->id)]) }}">Lead Notification Template</a></li>

        <li class="heading">Reporting</li>
        <li><a href="{{ route('leadSummaryNotifications', ['clientID' => Crypt::encrypt($client->id)]) }}">Lead Summary Notifications</a></li>

        <li class="heading">Goals</li>
        <li><a href="{{ route('setupMonthlyGoals', ['clientID' => Crypt::encrypt($client->id)]) }}">Setup Monthly Goals</a></li>

        <li class="heading">Forms</li>
        <li><a href="{{ route('leadCapture', ['clientID' => Crypt::encrypt($client->id)]) }}">Lead Capture</a></li>
        <li><a href="{{ route('leadActions', ['clientID' => Crypt::encrypt($client->id)]) }}">Lead Actions</a></li>
        <li><a href="{{ route('blacklisting', ['clientID' => Crypt::encrypt($client->id)]) }}">Blacklisting</a></li>
        <li><a href="{{ route('hideCustInfo', ['clientID' => Crypt::encrypt($client->id)]) }}">Hide Cust Info</a></li>

        <li class="heading">Revenue Tracking</li>
        <li><a href="{{ route('revenueTracking', ['clientID' => Crypt::encrypt($client->id)]) }}">Revenue Tracking</a></li>
    </ul>
</div>
