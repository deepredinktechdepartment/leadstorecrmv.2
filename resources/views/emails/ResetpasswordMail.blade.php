@component('mail::message')
# Dear {{ $mailData['name']??'' }}

Looks like you've asked your password to be reset!. If not, just ignore this email

To proceed with the reset, Click on the below Verify button to setup a new password.


@component('mail::button', ['url' => $mailData['url']])
Update your password
@endcomponent

Thanks,

{{ config('app.name') }}
@endcomponent