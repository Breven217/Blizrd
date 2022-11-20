async function logout(){
    await fetch("/logout", {
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
    })
    .then(response => {
        if (response.ok){
            window.location.href = 'login'
        }
        else{
            //throw up an error modal here
        }
    });
}

async function management(){
    window.location.href = 'management'
}