
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
            username : event.target.username.value,
            password : event.target.password.value
        })
    })
    .then((response) => response.json())
    .then((data) => {
        console.log('Success:', data);
    })
    .catch((error) => {
        console.error('Error:', error);
    });
}