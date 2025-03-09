@component('mail::message')
# Introduction

{{$msg}}

@component('mail::button', ['url' => "$otp"])
{{$otp}}
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent