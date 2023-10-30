@php
use App\Models\City;
$cities = City::all();
$json = json_encode($cities);
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<p>↓各都市の天気</p>
<div id="weatherOutput"></div>

<script>
    async function fetchWeather(city, latitude, longitude) {
        try {
            const response = await fetch(`https://api.open-meteo.com/v1/forecast?latitude=${latitude}&longitude=${longitude}&hourly=weathercode&timezone=Asia%2FTokyo&forecast_days=1`);
            
            if (!response.ok) throw new Error("Network response was not ok");
            
            const data = await response.json();
            const output = document.getElementById('weatherOutput');
            const today = new Date();
            const year = today.getFullYear();
            const month = today.getMonth() + 1;
            const day = today.getDate();
            const hour = today.getHours();
            if (hour >= 0 && hour <= 9) {
                hour = "0" + hour;
            }
            const todayDate = `${year}-${month}-${day}T${hour}:00`;
            const weatherMap = {
                "Unknown": "晴天",
                1: "晴れ",
                2: "時々曇り",
                3: "曇り",
                45: "霧",
                48: "霧氷",
                51: "軽い霧雨",
                53: "霧雨",
                55: "濃い霧雨",
                56: "氷結霧雨",
                57: "濃い氷結霧雨",
                61: "小雨",
                63: "雨",
                65: "大雨",
                66: "凍てつく雨",
                67: "激しい凍てつく雨",
                71: "小雪",
                73: "雪",
                75: "大雪",
                77: "ひょう",
                80: "軽いにわか雨",
                81: "にわか雨",
                82: "激しいにわか雨",
                85: "降雪",
                86: "激しい降雪",
                95: "雷雨",
                96: "ひょうを伴う雷雨",
                99: "ひょうを伴う激しい雷雨",
            };

            if (data.hourly && data.hourly.weathercode) {
                for(let i = 0; i < data.hourly.weathercode.length; i++) {
                    const weatherCode = data.hourly.weathercode[i] || "Unknown"; 
                    const weatherDate = data.hourly.time[i] || "Unknown";
                    if (weatherDate == todayDate) {
                        const weatherType = weatherMap[weatherCode] || "不明";
                        output.insertAdjacentHTML('beforeend', `<p>${city}: ${weatherType} 日付・時刻: ${weatherDate}</p>`);
                    } 
                }
            }
        } catch (error) {
            console.log(`エラーが発生しました: ${error.message}`);
        }
    }

    const citiesData = <?php echo $json; ?>;
    citiesData.forEach(cityData => {
        fetchWeather(cityData.city, cityData.latitude, cityData.longitude);
    });
</script>
