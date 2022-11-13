
async function checkLogin(event) {
    event.preventDefault();
    let content = document.getElementsByClassName('content')[0]
    content.innerHTML = '<i class="fa-regular fa-snowflake fa-spin fa-4x"></i>'

    let response = await fetch("/login", {
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        method: 'POST',
        body: JSON.stringify({
            username : event.target.username,
            password : event.target.password
        })
    });
    console.log(response.json());
}