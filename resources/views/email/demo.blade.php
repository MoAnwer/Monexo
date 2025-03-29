<x-mail::panel>
	This is a panel
</x-mail::panel>

<x-mail::message>
# Introduction

The body of your message.
{{$goalName}}
<x-mail::button :url="''">
Button Text
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
