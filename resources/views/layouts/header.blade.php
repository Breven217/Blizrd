<div class="navbar">
    @php
        $url = "";
        if(Request::url() == 'blizrd.com/home'){
            $url = "home";
        }
    @endphp

    <div @class(['navbutton', 'active' => ($url == "home")])>Home {!! $email_body !!}
    </div>
    <div class="navbutton">Reports</div>
    <div class="navbutton">Invoicing</div>
    <div class="navbutton">Management</div>
    <div class="navbutton">Logout</div>
</div>
