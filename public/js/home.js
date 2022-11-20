
async function loadWeather(){
    await fetch("/current_weather", {
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
            console.log(data);
            let container = document.getElementById('current-weather-container')

            container.innerHTML = "<div>" + data.main.temp + "°F</div>" + 
            "<div>" + data.weather[0].main + "</div>"
        }
    });
}