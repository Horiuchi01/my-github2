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
<p>↓大阪？の天気</p>
<p id="target"></p>
<script>
    async function fetchWeather() {
        try {
            const response = await fetch("https://api.open-meteo.com/v1/forecast?latitude=34.6998&longitude=135.5148&hourly=weathercode");
            
            if (!response.ok) throw new Error("Network response was not ok");
            
            const data = await response.json();
            
            const header = document.getElementById('target');

            const today = new Date();
            const year = today.getFullYear();
            const month = today.getMonth() + 1;
            const day = today.getDate();
            const hour = today.getHours();
            const minute = today.getMinutes();
            const todayDate = `${year}-${month}-${day}T${hour}:${minute}`;

            // data.hourlyが存在するかを一度だけチェック
            if (data.hourly && data.hourly.weathercode) {
                for(let i = 0; i < data.hourly.weathercode.length; i++) {
                    const weatherCode = data.hourly.weathercode[i] || "Unknown"; 
                    const weatherDate = data.hourly.time[i] || "Unknown";
                     
                    switch (weatherCode){
                        case "Unknown":
                            weatherType = "晴天";
                            header.insertAdjacentHTML('beforebegin', `<p>${weatherType}</p>`);
                            header.insertAdjacentHTML('beforebegin', `<p>${weatherDate}</p>`);
                            header.insertAdjacentHTML('beforebegin', `<p>${todayDate}</p>`);
                            break;
                        case 1:
                            weatherType = "晴れ";
                            header.insertAdjacentHTML('beforebegin', `<p>${weatherType}</p>`);
                            header.insertAdjacentHTML('beforebegin', `<p>${weatherDate}</p>`);
                            break;
                        case 2:
                            weatherType = "時々曇り";
                            header.insertAdjacentHTML('beforebegin', `<p>${weatherType}</p>`);
                            header.insertAdjacentHTML('beforebegin', `<p>${weatherDate}</p>`);
                            break;
                        case 3:
                            weatherType = "曇り";
                            header.insertAdjacentHTML('beforebegin', `<p>${weatherType}</p>`);
                            header.insertAdjacentHTML('beforebegin', `<p>${weatherDate}</p>`);
                            break;
                        case 45:
                            weatherType = "霧";
                            header.insertAdjacentHTML('beforebegin', `<p>${weatherType}</p>`);
                            header.insertAdjacentHTML('beforebegin', `<p>${weatherDate}</p>`);
                            break;
                        case 48:
                            weatherType = "霧氷";
                            header.insertAdjacentHTML('beforebegin', `<p>${weatherType}</p>`);
                            header.insertAdjacentHTML('beforebegin', `<p>${weatherDate}</p>`);
                            break;
                        case 51:
                            weatherType = "軽い霧雨";
                            header.insertAdjacentHTML('beforebegin', `<p>${weatherType}</p>`);
                            header.insertAdjacentHTML('beforebegin', `<p>${weatherDate}</p>`);
                            break;
                        case 53:
                            weatherType = "霧雨";
                            header.insertAdjacentHTML('beforebegin', `<p>${weatherType}</p>`);
                            header.insertAdjacentHTML('beforebegin', `<p>${weatherDate}</p>`);
                            break;
                        case 55:
                            weatherType = "濃い霧雨";
                            header.insertAdjacentHTML('beforebegin', `<p>${weatherType}</p>`);
                            header.insertAdjacentHTML('beforebegin', `<p>${weatherDate}</p>`);
                            break;
                        case 56:
                            weatherType = "氷結霧雨";
                            header.insertAdjacentHTML('beforebegin', `<p>${weatherType}</p>`);
                            header.insertAdjacentHTML('beforebegin', `<p>${weatherDate}</p>`);
                            break;
                        case 57:
                            weatherType = "濃い氷結霧雨";
                            header.insertAdjacentHTML('beforebegin', `<p>${weatherType}</p>`);
                            header.insertAdjacentHTML('beforebegin', `<p>${weatherDate}</p>`);
                            break;
                        case 61:
                            weatherType = "小雨";
                            header.insertAdjacentHTML('beforebegin', `<p>${weatherType}</p>`);
                            header.insertAdjacentHTML('beforebegin', `<p>${weatherDate}</p>`);
                            break;
                        case 63:
                            weatherType = "雨";
                            header.insertAdjacentHTML('beforebegin', `<p>${weatherType}</p>`);
                            header.insertAdjacentHTML('beforebegin', `<p>${weatherDate}</p>`);
                            break;
                        case 65:
                            weatherType = "大雨";
                            header.insertAdjacentHTML('beforebegin', `<p>${weatherType}</p>`);
                            header.insertAdjacentHTML('beforebegin', `<p>${weatherDate}</p>`);
                            break;
                        case 66:
                            weatherType = "凍てつく雨";
                            header.insertAdjacentHTML('beforebegin', `<p>${weatherType}</p>`);
                            header.insertAdjacentHTML('beforebegin', `<p>${weatherDate}</p>`);
                            break;
                        case 67:
                            weatherType = "凍てつく大雨";
                            header.insertAdjacentHTML('beforebegin', `<p>${weatherType}</p>`);
                            header.insertAdjacentHTML('beforebegin', `<p>${weatherDate}</p>`);
                            break;
                        case 71:
                            weatherType = "小雪";
                            header.insertAdjacentHTML('beforebegin', `<p>${weatherType}</p>`);
                            header.insertAdjacentHTML('beforebegin', `<p>${weatherDate}</p>`);
                            break;
                        case 73:
                            weatherType = "雪";
                            header.insertAdjacentHTML('beforebegin', `<p>${weatherType}</p>`);
                            header.insertAdjacentHTML('beforebegin', `<p>${weatherDate}</p>`);
                            break;
                        case 75:
                            weatherType = "大雪";
                            header.insertAdjacentHTML('beforebegin', `<p>${weatherType}</p>`);
                            header.insertAdjacentHTML('beforebegin', `<p>${weatherDate}</p>`);
                            break;
                        case 77:
                            weatherType = "ひょう";
                            header.insertAdjacentHTML('beforebegin', `<p>${weatherType}</p>`);
                            header.insertAdjacentHTML('beforebegin', `<p>${weatherDate}</p>`);
                            break;
                        case 80:
                            weatherType = "軽いにわか雨";
                            header.insertAdjacentHTML('beforebegin', `<p>${weatherType}</p>`);
                            header.insertAdjacentHTML('beforebegin', `<p>${weatherDate}</p>`);
                            break;
                        case 81:
                            weatherType = "にわか雨";
                            header.insertAdjacentHTML('beforebegin', `<p>${weatherType}</p>`);
                            header.insertAdjacentHTML('beforebegin', `<p>${weatherDate}</p>`);
                            break;
                        case 82:
                            weatherType = "激しいにわか雨";
                            header.insertAdjacentHTML('beforebegin', `<p>${weatherType}</p>`);
                            header.insertAdjacentHTML('beforebegin', `<p>${weatherDate}</p>`);
                            break;
                        case 85:
                            weatherType = "軽い雪";
                            header.insertAdjacentHTML('beforebegin', `<p>${weatherType}</p>`);
                            header.insertAdjacentHTML('beforebegin', `<p>${weatherDate}</p>`);
                            break;
                        case 86:
                            weatherType = "激しい雪";
                            header.insertAdjacentHTML('beforebegin', `<p>${weatherType}</p>`);
                            header.insertAdjacentHTML('beforebegin', `<p>${weatherDate}</p>`);
                            break;
                        case 95:
                            weatherType = "雷雨";
                            header.insertAdjacentHTML('beforebegin', `<p>${weatherType}</p>`);
                            header.insertAdjacentHTML('beforebegin', `<p>${weatherDate}</p>`);
                            break;
                        case 96:
                            weatherType = "ひょうを伴う雷雨";
                            header.insertAdjacentHTML('beforebegin', `<p>${weatherType}</p>`);
                            header.insertAdjacentHTML('beforebegin', `<p>${weatherDate}</p>`);
                            break;
                        case 99:
                            weatherType = "ひょうを伴う激しい雷雨";
                            header.insertAdjacentHTML('beforebegin', `<p>${weatherType}</p>`);
                            header.insertAdjacentHTML('beforebegin', `<p>${weatherDate}</p>`);
                            break;
                        default:
                            weatherType = "不明";
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