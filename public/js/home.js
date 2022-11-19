async function loadWeather(){
    let content = document.getElementsByClassName('content')[0]
    console.log('called');
    await fetch("http://api.openweathermap.org/data/2.5/forecast?lat=41.68417&lon=-111.67957&appid=54a6d10f3bffb5d3e5e67b9fa58a63a6", {
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        }
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