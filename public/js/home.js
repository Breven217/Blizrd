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
                    '<div>' + 'Min: ' + data[i].temp_min + '°F<br>' +
                    'Max: ' + data[i].temp_max +'°F</div>'

                if (y != 0) { newContent += '<hr>'}

                newContent += '<div class="forecast-day-hour">'

                for (y = 0; y < data[i].data.length; y++){
                    let entry = data[i].data[y]
                    let weatherIcon = ''
                    let weatherId = entry.weather_code
                    if (weatherId == 800) {
                        if (isDayTime){weatherIcon = '<i class="fa-solid fa-sun"></i>'}
                        else {weatherIcon = '<i class="fa-solid fa-moon"></i>'}
                    }
                    else if (weatherId > 800 && weatherId <= 804) {
                        if (isDayTime){weatherIcon = '<i class="fa-solid fa-cloud-sun"></i>'}
                        else {weatherIcon = '<i class="fa-solid fa-cloud-moon"></i>'}
                    }
                    else if (weatherId >= 600 && weatherId <=622) {
                        weatherIcon = '<i class="fa-solid fa-snowflake"></i>'
                    }
                    else if (weatherId >= 500 && weatherId <= 531) {
                        if (isDayTime){weatherIcon = '<i class="fa-solid fa-cloud-sun-rain"></i>'}
                        else {weatherIcon = '<i class="fa-solid fa-cloud-moon-rain"></i>'}
                    }
                    else if (weatherId >= 200 && weatherId <= 232) {
                        weatherIcon = '<i class="fa-solid fa-cloud-bolt"></i>'
                    }
                    else {
                        weatherIcon = '<i class="fa-solid fa-temperature-quarter"></i>'
                    }

                    newContent += '<div>' + entry.time + 
                    weatherIcon + '<br>' + entry.weather_description + '</div>'
                }
                newContent +='</div></div></div>'

                container.className = 'forecast-populated'
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
            if (weatherId == 800) {
                if (isDayTime){weatherIcon = '<i class="fa-solid fa-sun fa-5x"></i>'}
                else {weatherIcon = '<i class="fa-solid fa-moon fa-5x"></i>'}
            }
            else if (weatherId > 800 && weatherId <= 804) {
                if (isDayTime){weatherIcon = '<i class="fa-solid fa-cloud-sun fa-5x"></i>'}
                else {weatherIcon = '<i class="fa-solid fa-cloud-moon fa-5x"></i>'}
            }
            else if (weatherId >= 600 && weatherId <=622) {
                weatherIcon = '<i class="fa-solid fa-snowflake fa-5x"></i>'
            }
            else if (weatherId >= 500 && weatherId <= 531) {
                if (isDayTime){weatherIcon = '<i class="fa-solid fa-cloud-sun-rain fa-5x"></i>'}
                else {weatherIcon = '<i class="fa-solid fa-cloud-moon-rain fa-5x"></i>'}
            }
            else if (weatherId >= 200 && weatherId <= 232) {
                weatherIcon = '<i class="fa-solid fa-cloud-bolt fa-5x"></i>'
            }
            else {
                weatherIcon = '<i class="fa-solid fa-temperature-quarter fa-5x"></i>'
            }
                    
            container.className = "current-weather-populated"
            container.innerHTML = "<div class='extra-large-font'>" + data.main.temp + "°F</div>" + 
            "<div>" + weatherIcon + "<br>" + weatherDescription + "</div>"
        }
    });
}