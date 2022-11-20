async function loadWeather(){
    let content = document.getElementsByClassName('content')[0]
    console.log('called');
    await fetch("/test", {
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        },
    })
    .then((response) => response.json())
    .then((data) => {
        if (data.error){
            //throw up an error modal here
        }
        else{
        }
    });
}