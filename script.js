$('#weather-form').submit(function(e) {
    e.preventDefault();
    var city = $('#city').val();

    $.ajax({
        url: 'getWeather.php',
        type: 'GET',
        data: { city: city },
        success: function(data) {
            var weather = JSON.parse(data);
            $('#city-name').text(weather.name);
            $('#temperature').text(weather.main.temp + '°C');
            $('#description').text(weather.weather[0].description);
            $('#weather-info').removeClass('hidden');
        },
        error: function() {
            alert('Şehir bulunamadı.');
        }
    });
});
