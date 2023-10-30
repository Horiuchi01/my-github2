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

    <form action="{{ route('city.con') }}" method="post">
        @csrf
        <label for="city-name">都市名</label>
        <input id="city-name" type="text" name="city" placeholder="都市名を入力">
        @error("city")
        <p style="color: red;">{{ $message }}</p>
        @enderror

        <label for="city-latitude">緯度</label>
        <input id="city-latitude" type="text" name="latitude" placeholder="緯度を入力">
        @error("latitude")
        <p style="color: red;">{{ $message }}</p>
        @enderror

        <label for="city-longitude">経度</label>
        <input id="city-longitude" type="text" name="longitude" placeholder="経度を入力">
        @error("longitude")
        <p style="color: red;">{{ $message }}</p>
        @enderror

        <button type="submit">登録</button>
    </form>


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

<p>↓大阪の天気</p>
<p id="target"></p>

<!-- "https://api.open-meteo.com/v1/forecast?latitude=33.6,35.6895,43.3667&longitude=130.4167,139.6917,144.4333&hourly=weathercode&timezone=Asia%2FTokyo&forecast_days=1" -->
<!-- "https://geocoding-api.open-meteo.com/v1/search?name=fukuoka&count=1&language=en&format=json" -->

<script>
    var array = <?php echo $json; ?>;

    array.forEach(elm => {
    document.write(elm['city']+'の緯度は'+elm['latitude']+'、経度は'+elm['longitude']+'。<br>');
    })
</script>
<script>
    async function fetchWeather() {
        try {
            const response = await fetch("https://api.open-meteo.com/v1/forecast?latitude=34.6911&longitude=135.4969&hourly=weathercode&timezone=Asia%2FTokyo&forecast_days=1");
            
            if (!response.ok) throw new Error("Network response was not ok");
            
            const data = await response.json();
            const header = document.getElementById('target');
            const today = new Date();
            const year = today.getFullYear();
            const month = today.getMonth() + 1;
            const day = today.getDate();
            let hour = today.getHours();
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
                        header.insertAdjacentHTML('beforebegin', `<p>${weatherType}</p>`);
                        header.insertAdjacentHTML('beforebegin', `<p>${weatherDate}</p>`);
                    } 
                }
            }
        } catch (error) {
            console.log(`エラーが発生しました: ${error.message}`);
        }
    }

    fetchWeather();
</script>