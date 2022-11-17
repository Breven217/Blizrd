<div class="navbar">
    @php
        if(Request::url() == 'blizrd.com/home'){
            $home = true;
        }
    @endphp

    <div @class(['navbutton', 'active' => $home])>Home</div>
    <div class="navbutton">Reports</div>
    <div class="navbutton">Invoicing</div>
    <div class="navbutton">Management</div>
    <div class="navbutton">Logout</div>
</div>
