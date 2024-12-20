require(['jquery'], function ($) {
    $(document).ready(function () {
        // Tự động load dữ liệu thời tiết cho Hà Nội khi trang được tải
        var defaultCity = 'Hà Nội';
        loadWeather(defaultCity);

        // Sự kiện khi người dùng chọn thành phố khác
        $('#city').on('change', function () {
            var selectedCity = $(this).val();
            loadWeather(selectedCity);
        });

        // Hàm load dữ liệu thời tiết
        function loadWeather(city) {
            // Hiển thị trạng thái Loading
            $('#loading').show();
            $('#weather-info').hide();

            // Gửi yêu cầu Ajax
            $.ajax({
                url: $('#city').data('ajax-url'), // URL từ data attribute
                type: 'POST',
                data: { city: city },
                success: function (response) {
                    $('#loading').hide(); // Ẩn trạng thái Loading
                    $('#weather-info').show(); // Hiển thị thông tin thời tiết

                    if (response.success) {
                        var weather = response.data;

                        // Chuyển đổi Kelvin sang Celsius
                        var temp = (weather.main.temp - 273.15).toFixed(1);
                        var tempMax = (weather.main.temp_max - 273.15).toFixed(1);
                        var tempMin = (weather.main.temp_min - 273.15).toFixed(1);

                        // Cập nhật dữ liệu vào giao diện
                        $('#temp').text(temp);
                        $('#temp-max').text(tempMax);
                        $('#temp-min').text(tempMin);
                        $('#location').text(weather.name);
                        $('#weather-icon').attr('src', 'http://openweathermap.org/img/wn/' + weather.weather[0].icon + '@2x.png');
                    } else {
                        alert(response.message);
                    }
                },
                error: function () {
                    $('#loading').hide(); // Ẩn trạng thái Loading
                    alert('Unable to fetch weather data. Please try again.');
                }
            });
        }
    });
});
