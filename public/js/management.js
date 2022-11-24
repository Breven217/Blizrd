async function searchUsers(event)
{
    event.preventDefault();

    let queryString = ''
    let query = event.target.query.value 

    if (!isNaN(query)){
        queryString = 'phone_number=' + query
    }
    else if (query.includes('@')){
        queryString = 'email_address=' + query
    }
    else{
        queryString = 'name=' + query
    }

    let content = document.getElementById('management-content')
    content.innerHTML = '<i class="fa-regular fa-snowflake fa-spin fa-4x"></i>'

    await fetch("/search_users?" + queryString, {
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
    })
    .then((response) => response.json())
    .then((data) => {
        if (data.error){
            content.innerHTML = originalContent
            //throw up an error modal here
        }
        else{
            let userTable = `
            <table class='user-table'> 
                <tr>
                    <th>Name</th>
                    <th>Phone Number</th>
                    <th>Email Address</th>
                    <th>Receives Alert</th>
                </tr>`

            data.forEach(result => {
                let alertBox = '<i class="fa-regular fa-square fa-lg"></i>'
                if (result.receives_alerts){
                    alertBox = '<i class="fa-regular fa-square-check fa-lg"></i>'
                }
                userTable += `
                <tr onclick="editUser(` + result.id + `)">
                    <td>` + result.name + `</td>
                    <td>` + result.phone_number.slice(0,3) + '-' + 
                        result.phone_number.slice(3,6) + '-' + 
                        result.phone_number.slice(6,10) + 
                    `</td>
                    <td>` + result.email_address + `</td>
                    <td>` + alertBox + `</td>
                </tr>
                `
            });

            userTable += '</table>'

            content.innerHTML = userTable
        }
    });
}

async function editUser(user_id=null)
{
    let content = document.getElementById('management-content')
    let originalContent = content.innerHTML
    content.innerHTML = '<i class="fa-regular fa-snowflake fa-spin fa-4x"></i>'

    let user_data = null
    if (user_id != null) {
        await fetch("/get_user?user_id=" + user_id, {
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
        })
        .then((response) => response.json())
        .then((data) => {
            if (data.error){
            content.innerHTML = originalContent
            //throw up an error modal here
            }
            else {
                user_data = data;
            }   
        })
    }

    content.innerHTML = `
    <form class="user-form" onsubmit="updateUser(event)"  method="POST">
    @csrf
        <input type="text" name="username" id="username" placeholder="Username" value="` + user_data.username ?? '' + `">
        <input type="text" name="password" id="password" placeholder="Password" value="` + user_data.password ?? '' + `">
        <input type="text" name="name" id="name" placeholder="Name" value="` + user_data.name ?? '' + `">
        <input type="text" name="phone_number" id="phone-number" placeholder="Phone Number" value="` + user_data.phone_number ?? '' + `">
        <input type="text" name="email_address" id="email-address" placeholder="Email Address" value="` + user_data.email_address ?? '' + `">
        <input type="checkbox" name="alerts" id="alert-box" value="` + user_data.receives_alerts ?? false + `">

        <button name="login-button" class="login-button">
            <span>
                Login
            </span>
        </button>
    </form>
    `
}

async function updateUser(event)
{
    event.preventDefault()
}

