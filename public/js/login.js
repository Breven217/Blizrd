
async function checkLogin(event) {
    event.preventDefault();
console.log(event);
    let content = document.getElementsByClassName('content')[0]
    content.innerHTML = '<i class="fa-regular fa-snowflake fa-spin fa-4x"></i>'

    let response = await fetch("/login", {
        // body: {
        //     username : ,
        //     password : 
        // }
    });

}