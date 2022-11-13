
function checkLogin(event) {
    event.preventDefault();

    let content = document.getElementsByClassName('content')[0]
    content.innerHTML = '<i class="fa-regular fa-snowflake fa-spin fa-4x"></i>'

    fetch("/login")
    .then((response) => response.json())
    .then((data) => console.log(data));
}