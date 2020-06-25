@component('mail::message')
# Invitation from {{ $senderName }}

You have been invited to contribute in {{ $boardName }} board.

@component('mail::button', ['url' => \URL::to('/invites')])
Invitations
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
