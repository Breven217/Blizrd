
<div class="navbar">
    @php
        $url = '';
        if(Request::path() == 'home'){ $url = "home";}
        if(Request::path() == 'reports'){ $url = "reports";}
        if(Request::path() == 'installations'){ $url = "installations";}
        if(Request::path() == 'management'){ $url = "management";}
    @endphp

    <div @class(['navbutton' => ($url != "home"), 'navbutton-active' => ($url == "home")]) onclick="home()">Home</div>
    <div @class(['navbutton' => ($url != "reports"), 'navbutton-active' => ($url == "reports")])>Reports</div>
    <div @class(['navbutton' => ($url != "installations"), 'navbutton-active' => ($url == "installations")])>Installations</div>
    <div @class(['navbutton' => ($url != "management"), 'navbutton-active' => ($url == "management")]) onclick="management()">Management</div>
    <div class="navbutton" onclick="logout()">Logout</div>
</div>
