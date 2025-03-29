<x-mail::message>
<img src="{{ $logo }}">

# Welcome {{ $userName }} in {{ config('app.name') }} 👋🏼

we are vary happey to using Monexo to improve your financial status 🤗

<x-mail::button :url="$dashboardUrl">
view dashboard
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
