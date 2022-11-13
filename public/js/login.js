
async function checkLogin(event) {
    event.preventDefault();
    let content = document.getElementsByClassName('content')[0]
    content.innerHTML = '<i class="fa-regular fa-snowflake fa-spin fa-4x"></i>'

    let response = await fetch("/login", {
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        method: 'POST',
        body: {
            username : event.target.username.value,
            password : event.target.password.value
        }
    });
    console.log(response);
}