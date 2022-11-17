<div class="navbar">
    @php
        $url = Request::url();
        if(Request::url() == '/home'){
            $url = "home";
        }
    @endphp

    <div @class(['navbutton', 'active' => ($url == "home")])>Home {!! $url !!}
    </div>
    <div class="navbutton">Reports</div>
    <div class="navbutton">Invoicing</div>
    <div class="navbutton">Management</div>
    <div class="navbutton">Logout</div>
</div>
