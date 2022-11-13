class Login {
    
}
function checkLogin(event) {
    event.preventDefault();
    console.log('hereIAm')
    let content = document.getElementsByClassName('content')[0]
    content.innerHTML = '<i class="fa-regular fa-snowflake"></i>'
}