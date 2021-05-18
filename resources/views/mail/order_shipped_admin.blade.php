@component('mail::message')
    # Клиент оформил заказ

@component('mail::button', ['url' => $url,'color' => 'success'])
    Посмотреть заказ
@endcomponent

@endcomponent
