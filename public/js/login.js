class Login {
    checkLogin(event) {
    event.preventDefault();
    console.log('hereIAm')
    let content = document.getElementsByClassName('content')[0]
    content.innerHTML = '<i class="fa-thin fa-snowflake fa-spin fa-4x"></i>'
    }
}

