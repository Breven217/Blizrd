async function checkLogin(event) 
{
    event.preventDefault();
    
    let content = document.getElementsByClassName('content')[0]
    let originalContent = content.innerHTML
    content.innerHTML = '<i class="fa-regular fa-snowflake fa-spin fa-4x"></i>'

    await fetch("/login", {
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        method: 'POST',
        body: new FormData(event.target)
    })
    .then((response) => response.json())
    .then((data) => {
        if (data.error){
            content.innerHTML = originalContent
            document.getElementById('login-error').style.visibility = 'visible'
        }
        else{
            sessionStorage.setItem('user.name', data.name)
            window.location.href = 'home'
        }
    });
}