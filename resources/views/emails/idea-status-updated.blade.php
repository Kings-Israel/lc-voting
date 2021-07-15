@component('mail::message')
# Idea status updated

The Idea: {{ $idea->title }}

has been updated to a status of:

{{ $idea->status->name }}

@component('mail::button', ['url' => route('idea.show', $idea)])
View Idea
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
