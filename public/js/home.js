async function checkLogin(event) {
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
            //throw up an error modal here
        }
        else{
            console.log(data)
            sessionStorage.setItem('user.id', data.id)
            sessionStorage.setItem('user.name', data.name)
            sessionStorage.setItem('user.username', data.username)
            sessionStorage.setItem('user.email_address', data.email_address)
            sessionStorage.setItem('user.phone_number', data.phone_number)

            window.location.href = window.location.href + 'home';
        }
    });
}