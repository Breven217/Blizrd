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
    content.innerHTML = '<i class="fa-regular fa-snowflake fa-spin fa-4x vertical-center"></i>'

    await fetch("/search_users?" + queryString, {
        headers: {
            'Accept': 'application/json',
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
    content.innerHTML = '<i class="fa-regular fa-snowflake fa-spin fa-4x vertical-center"></i>'

    let user_data = null
    if (user_id != null) {
        await fetch("/get_user?user_id=" + user_id, {
            headers: {
                'Accept': 'application/json',
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

    let alerts = user_data.receives_alerts ? 'checked' : ''
    content.innerHTML = `
    <form class="user-form" onsubmit="updateUser(event)"  method="POST">
        <input type="text" name="username" id="username" placeholder="Username" value="` + user_data.username + `">
        <input type="text" name="password" id="password" placeholder="Enter new Password">
        <input type="text" name="name" id="name" placeholder="Name" value="` + user_data.name + `">
        <input type="text" name="phone_number" id="phone-number" placeholder="Phone Number" value="` + user_data.phone_number + `">
        <input type="text" name="email_address" id="email-address" placeholder="Email Address" value="` + user_data.email_address + `">
        <div class="checkbox-div">
            <label for="alert-box">Receives Alerts: </label>
            <input type="checkbox" name="receives_alerts" id="alert-box" ` + alerts + `>
        </div>
        <button type="button" name="delete_button" class="user-delete-button" onclick="deleteUser(`+user_id+`)">
            <span>
                Delete User
            </span>
        </button>
        <button type="submit" name="update_button" class="user-update-button">
            <span>
                Update User
            </span>
        </button>

        <input type="hidden" name="user_id" value="` + user_id + `">
    </form>
    `
}

async function addUser()
{
    let content = document.getElementById('management-content')

    content.innerHTML = `
    <form class="user-form" onsubmit="updateUser(event)"  method="POST">
        <input type="text" name="username" id="username" placeholder="Username" required>
        <input type="text" name="password" id="password" placeholder="Password" required>
        <input type="text" name="name" id="name" placeholder="Name" required>
        <input type="text" name="phone_number" id="phone-number" placeholder="Phone Number" required>
        <input type="text" name="email_address" id="email-address" placeholder="Email Address" required>
        <div class="checkbox-div">
            <label for="alert-box">Receives Alerts: </label>
            <input type="checkbox" name="receives_alerts" id="alert-box">
        </div>
        <button name="update_button" class="user-update-button">
            <span>
                Create User
            </span>
        </button>
    </form>
    `
}

async function updateUser(event)
{
    event.preventDefault()
    let content = document.getElementById('management-content')
    let originalContent = content.innerHTML
    content.innerHTML = '<i class="fa-regular fa-snowflake fa-spin fa-4x vertical-center"></i>'

    let body = new FormData(event.target)
    body.set('receives_alerts', body.get('receives_alerts') != null ? 1 : 0)
    let response = await fetch("/update_user", {
        headers: {
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        method: 'POST',
        body: body
    })
    if (response.ok)
    {
        content.innerHTML = 'success'
            //throw up a success modal here
    }
    else 
    {
        content.innerHTML = originalContent
            //throw up an error modal here
    }
}

async function deleteUser(user_id=null)
{
    event.preventDefault()
    let content = document.getElementById('management-content')
    let originalContent = content.innerHTML
    content.innerHTML = '<i class="fa-regular fa-snowflake fa-spin fa-4x vertical-center"></i>'

    let response = await fetch("/delete_user?user_id=" + user_id, {
        headers: {
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        method: 'POST'
    })
    if (response.ok)
    {
        content.innerHTML = 'success'
            //throw up a success modal here
    }
    else 
    {
        content.innerHTML = originalContent
            //throw up an error modal here
    }
}

