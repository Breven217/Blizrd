
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

            let hours = new Date().getHours()
            let isDayTime = hours > 6 && hours < 20

            let weatherIcon = ''
            switch(data.weather[0].main) {
                case 'Clear':
                    if (isDayTime){
                        weatherIcon = '<i class="fa-solid fa-sun extra-large-font"></i>'
                    }
                    else {
                        weatherIcon = '<i class="fa-solid fa-moon extra-large-font"></i>'
                    }
                  break;
                default:
                    weatherIcon = '<i class="fa-solid fa-temperature-quarter extra-large-font"></i>'
              }

            container.className = "current-weather-populated"
            container.innerHTML = "<div class='extra-large-font'>" + data.main.temp + "°F</div>" + 
            "<div>" + weatherIcon + "<br>" + data.weather[0].main + "</div>"
        }
    });
}