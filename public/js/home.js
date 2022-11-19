async function loadWeather(){
    let content = document.getElementsByClassName('content')[0]
    console.log('called');
    await fetch("https://api.weather.gov/points/41.7370,111.8338", {
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'User-Agent': ['blizrd.com', 'contact@myweatherapp.com']
        },
        accept: application/ld+json
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