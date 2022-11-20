function loadWeather()
{
    currentWeather()
    forecast()
}

async function forecast() 
{
    await fetch("/forecast", {
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
            console.log(data)
            let container = document.getElementById('forecast-container')

            let hours = new Date().getHours()
            let isDayTime = hours > 6 && hours < 20

            let newContent = ''
            for (let i = 0; i < data.length; i++){
                newContent += '<div class="forecast-day">' + 
                    '<div>' + data[i].day + '</div>' +  
                    '<div>' + data[i].temp_min + '°F/' + data[i].temp_max +'°F</div>'

                for (y = 0; y < data[i].length; y++){
                    let weatherIcon = ''
                    let weatherId = data[i][y].weather_code
                    switch(weatherId) {
                        case 800:
                            if (isDayTime){weatherIcon = '<i class="fa-solid fa-sun fa-2x"></i>'}
                            else {weatherIcon = '<i class="fa-solid fa-moon fa-2x"></i>'}
                          break;
                        case weatherId > 800 && weatherId <= 804:
                            if (isDayTime){weatherIcon = '<i class="fa-solid fa-cloud-sun fa-2x"></i>'}
                            else {weatherIcon = '<i class="fa-solid fa-cloud-moon fa-2x"></i>'}
                          break;
                        case weatherId >= 600 && weatherId <=622:
                            weatherIcon = '<i class="fa-solid fa-snowflake fa-2x"></i>'
                          break;
                        case weatherId >= 500 && weatherId <= 531:
                            if (isDayTime){weatherIcon = '<i class="fa-solid fa-cloud-sun-rain fa-2x"></i>'}
                            else {weatherIcon = '<i class="fa-solid fa-cloud-moon-rain fa-2x"></i>'}
                          break;
                        case weatherId >= 200 && weatherId <= 232:
                            weatherIcon = '<i class="fa-solid fa-cloud-bolt fa-2x"></i>'
                          break;
                        default:
                            weatherIcon = '<i class="fa-solid fa-temperature-quarter fa-2x"></i>'
                    }

                    newContent += '<div>' + data[i][y].time + '</div>' + 
                    '<div>' + weatherIcon + '<br>' + data[i][y].weatherDescription + '</div>'
                }
                newContent +='</div>'

                container.innerHTML = newContent
            }
        }
    });
}

async function currentWeather()
{
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
            let container = document.getElementById('current-weather-container')

            let hours = new Date().getHours()
            let isDayTime = hours > 6 && hours < 20

            let weatherDescription = data.weather[0].description.charAt(0).toUpperCase() + data.weather[0].description.slice(1);

            let weatherIcon = ''
            let weatherId = data.weather[0].id
            switch(weatherId) {
                case 800:
                    if (isDayTime){weatherIcon = '<i class="fa-solid fa-sun fa-5x"></i>'}
                    else {weatherIcon = '<i class="fa-solid fa-moon fa-5x"></i>'}
                  break;
                case weatherId > 800 && weatherId <= 804:
                    if (isDayTime){weatherIcon = '<i class="fa-solid fa-cloud-sun fa-5x"></i>'}
                    else {weatherIcon = '<i class="fa-solid fa-cloud-moon fa-5x"></i>'}
                  break;
                case weatherId >= 600 && weatherId <=622:
                    weatherIcon = '<i class="fa-solid fa-snowflake fa-5x"></i>'
                  break;
                case weatherId >= 500 && weatherId <= 531:
                    if (isDayTime){weatherIcon = '<i class="fa-solid fa-cloud-sun-rain fa-5x"></i>'}
                    else {weatherIcon = '<i class="fa-solid fa-cloud-moon-rain fa-5x"></i>'}
                  break;
                case weatherId >= 200 && weatherId <= 232:
                    weatherIcon = '<i class="fa-solid fa-cloud-bolt fa-5x"></i>'
                  break;
                default:
                    weatherIcon = '<i class="fa-solid fa-temperature-quarter fa-5x"></i>'
              }

            container.className = "current-weather-populated"
            container.innerHTML = "<div class='extra-large-font'>" + data.main.temp + "°F</div>" + 
            "<div>" + weatherIcon + "<br>" + weatherDescription + "</div>"
        }
    });
}