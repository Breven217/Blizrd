async function searchUsers(event)
{
    event.preventDefault();
console.log('here');
    let queryString = ''
    let query = event.target.query.value 

    if (query.length == 10 && !isNaN(query)){
        queryString = 'phone_number=' + query
    }
    else if (query.includes('@')){
        queryString = 'email_address=' + query
    }
    else{
        queryString = 'name=' + query
    }

    let content = document.getElementById('management-content')

    await fetch("/search_users?" + queryString, {
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
    })
    .then((response) => response.json())
    .then((data) => {
        if (data.error){
            content.innerHTML = originalContent
            //throw up an error modal here
        }
        else{
            content.innerHTML = data;
        }
    });
}