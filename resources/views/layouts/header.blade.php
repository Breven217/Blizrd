<div class="navbar">
    @php
        $url = '';
        if(Request::path() == 'home'){ $url = "home";}
        if(Request::path() == 'reports'){ $url = "reports";}
        if(Request::path() == 'invoicing'){ $url = "invoicing";}
        if(Request::path() == 'management'){ $url = "management";}
    @endphp

    <div @class(['navbutton', 'navbutton-active' => ($url == "home")])>Home</div>
    <div @class(['navbutton', 'navbutton-active' => ($url == "reports")])>Reports</div>
    <div @class(['navbutton', 'navbutton-active' => ($url == "invoicing")])>Invoicing</div>
    <div @class(['navbutton', 'navbutton-active' => ($url == "management")])>Management</div>
    <div class="navbutton">Logout</div>
</div>
