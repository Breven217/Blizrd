
async function checkLogin(event) {
    event.preventDefault();
console.log(event.target);
    let content = document.getElementsByClassName('content')[0]
    content.innerHTML = '<i class="fa-regular fa-snowflake fa-spin fa-4x"></i>'

    let response = await fetch("/login", {
        body: {
            username : event.target.input.username,
            password : event.target.input.password
        }
    });

}