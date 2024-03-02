@component('mail::message')
    Hello {{$name}}

    <p> we understand it happened. </p>

    @component('mail::button',['url' => url('resetform/'.$remember_token)])
        reset tour password
    @endcomponent
    <p>in case you have any issues recovering your password, please contact us;</p>

    thank you,<br>
    {{config('app.name')}}
@endcomponent
