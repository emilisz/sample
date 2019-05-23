@component('mail::message')
# Message

New company was created.

@component('mail::button', ['url' => ''])
Check it out
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
