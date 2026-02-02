<x-mail::message>
# Kedves Adminisztrátor!

Létrehozásra került egy admin fiók a következő belépési adatokkal:

E-mail cím: <b>{{ $email }}</b>

Jelszó: <b>{{ $password }}</b>

{!! __('mail.salutation') !!}
</x-mail::message>
