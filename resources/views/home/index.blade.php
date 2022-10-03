<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>F1 SCRAP</title>
</head>
<body class="bg-gray-600 scrollbar scrollbar-thumb-gray-900 scrollbar-track-gray-100">
<div class="text-center my-[6rem]">
    <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl dark:text-white">
        Analyse F1</h1>
    <p class="mb-6 text-lg font-normal text-gray-500 lg:text-xl sm:px-16 xl:px-48 dark:text-gray-400">Les meilleurs
        stats f1 c'est ici la team go encaisser.</p>
</div>

<div class="text-center mb-40">
    <h1 class="mb-[4rem] text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl dark:text-white">
        LE GROS SAFE DE DIMANCHE !
        <br> TOP 10 :</h1>
    <div class=""
         style="text-align: center; display: flex; align-items: center; justify-content: center; flex-wrap: wrap; max-width: 1400px; margin: 0 auto;">
        @foreach($safes as $safe)
            <div
                class="block p-6 mr-4 mb-4 max-w-sm bg-white rounded-lg border border-gray-200 shadow-md hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $safe['name'] }}</h5>

                @if($safe['pourcentage'] > 50)
                    <p class="font-normal text-green-500">{{ $safe['pourcentage'] }} %</p>
                @else
                    <p class="font-normal text-red-500">{{ $safe['pourcentage'] }} %</p>
                @endif

            </div>
        @endforeach
    </div>

</div>
<div class="text-center mb-40">
    <h1 class="mb-[4rem] text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl dark:text-white">
        LE GROS SAFE DE DIMANCHE !
        <br> TOP 10 :</h1>
    <div
        style="text-align: center; display: flex; align-items: center; justify-content: center; flex-wrap: wrap; max-width: 1400px; margin: 0 auto;">
        @foreach($topProba as $safe)
            <div
                class="block mb-4 mr-4 p-6 max-w-sm bg-white rounded-lg border border-gray-200 shadow-md hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $safe['name'] }}</h5>
                @if($safe['pourcentage'] > 49)
                    <p class="font-normal text-green-500">{{ $safe['pourcentage'] }} %</p>
                @else
                    <p class="font-normal text-red-500">{{ $safe['pourcentage'] }} %</p>
                @endif
            </div>
        @endforeach
    </div>

</div>


<div class="flex mb-4 item-center justify-center">
    <div class="shadow-lg w-3/4 rounded-lg overflow-hidden">
        <div class="py-3 px-5 bg-gray-50">Réccurence du top 10 par joueurs</div>
        <canvas class="p-10 bg-gray-300" id="chartBar"></canvas>
    </div>
</div>

<div class="p-4 flex item-center">
    <div style="max-height: 600px"
         class=" scrollbar scrollbar-thumb-gray-900 scrollbar-track-gray-100 overflow-x-auto relative mr-4 shadow-md sm:rounded-lg">
        <h1 class="bg-gray-50 text-center bold text-black text-xl uppercase">Top 10 & Accident</h1>
        <table class="w-full overflow-auto text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase dark:text-gray-400">
            <tr>
                <th scope="col" class="py-3 px-6  dark:bg-gray-800">
                    Name
                </th>
                <th scope="col" class="py-3 px-6">
                    % Top 10 %
                </th>
                <th scope="col" class="py-3 px-6 bg-gray-50 dark:bg-gray-800">
                    nbr de Top 10
                </th>
                <th scope="col" class="py-3 px-6">
                    % Accident %
                </th>
                <th scope="col" class="py-3 px-6 bg-gray-50 dark:bg-gray-800">
                    nbr Accident
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($top10pourcent as $key => $value)
                <tr>
                    <td class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                        {{ $value['name'] }}
                    </td>
                    @if($value['top10pourcent'] > 70)
                        <td class="py-4 px-6 text-green-500 text-center">
                            {{ $value['top10pourcent'] }} %
                        </td>
                    @else
                        <td class="py-4 px-6 text-orange-200 text-center">
                            {{ $value['top10pourcent'] }} %
                        </td>
                    @endif
                    <td class="py-4 text-center px-6 bg-gray-50 dark:bg-gray-800">
                        {{ $value['top10'] }}
                    </td>
                    @if($value['nbrAccidentPourcent'] < 10)
                        <td class="py-4 px-6 text-green-500 text-center">
                            {{ $value['nbrAccidentPourcent'] }} %
                        </td>
                    @else
                        <td class="py-4 px-6 text-orange-200 text-center">
                            {{ $value['nbrAccidentPourcent'] }} %
                        </td>
                    @endif

                    <td class="py-4 text-center px-6 bg-gray-50 dark:bg-gray-800">
                        {{ $value['nbrAccident'] }}

                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="mr-4 overflow-auto scrollbar scrollbar-thumb-gray-900 scrollbar-track-gray-100 sm:rounded-lg"
         style="max-height: 600px">
        <h1 class="bg-gray-50 text-center bold text-black text-xl uppercase">Accidents par personne</h1>
        <div class="">
            <table class="w-full text-sm shadow-md text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase dark:text-gray-400">
                <tr>
                    <th scope="col" class="py-4 px-6 bg-gray-50 dark:bg-gray-800">Pilotes</th>
                    <th scope="col" class="py-3 px-6">Nbr accidents</th>
                </tr>
                </thead>
                <tbody>
                @foreach($drivers as $driver)
                    <tr class="border-b border-gray-200 dark:border-gray-700">
                        <td class="py-4 px-6 bg-gray-800 dark:bg-gray-800">
                            {{ $driver['name'] }}
                        </td>
                        @if(isset($accidents[$driver['name']]))
                            @if($accidents[$driver['name']] > 1)
                                <td class="py-4 px-6 text-orange-200 text-center">
                                    {{ $accidents[$driver['name']] }}
                                </td>
                            @else
                                <td class="py-4 px-6 text-green-500 text-center">
                                    {{ $accidents[$driver['name']] }}
                                </td>
                            @endif
                        @endif
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="mr-4 overflow-auto scrollbar scrollbar-thumb-gray-900 scrollbar-track-gray-100 sm:rounded-lg"
         style="max-height: 600px">
        <h1 class="bg-gray-50 text-center bold text-black text-xl uppercase">Accidents par écuries</h1>
        <table class="w-full text-sm shadow-md text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase dark:text-gray-400">
            <tr>
                <th scope="col" class="py-4 px-6 bg-gray-50 dark:bg-gray-800">Marques</th>
                <th scope="col" class="py-3 px-6">Nbr accidents</th>
            </tr>
            </thead>
            <tbody>
            @foreach($marques as $marque)
                <tr class="border-b border-gray-200 dark:border-gray-700">
                    <td class="py-4 px-6 bg-gray-800 dark:bg-gray-800">
                        {{ $marque['name'] }}
                    </td>
                    @if(isset($carAccidents[$marque['name']]))
                        @if($carAccidents[$marque['name']] > 1)
                            <td class="py-4 px-6 text-orange-200 text-center">
                                {{ $carAccidents[$marque['name']] }}
                            </td>
                        @else
                            <td class="py-4 px-6 text-green-500 text-center">
                                {{ $carAccidents[$marque['name']] }}
                            </td>
                        @endif
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
{{--<div class="flex justify-betwen  item-center w-2/4" style="margin: 0 auto;">--}}
{{--    <div class="mr-8">--}}
{{--        <h1 class="text-white text-xl mb-4">Pilote qui a fais le plus d'accident : <br>--}}
{{--            <span>{{ array_search(max($accidents),$accidents) }}</span> -> <span--}}
{{--                class="text-red-500">{{ max($accidents) }}</span></h1>--}}
{{--    </div>--}}
{{--    <div>--}}
{{--        <h1 class="text-white text-xl mb-4">Marque qui a fais le plus d'accident : <br>--}}
{{--            <span>{{ array_search(max($carAccidents),$carAccidents) }}</span> -> <span--}}
{{--                class="text-red-500">{{ max($carAccidents) }}</span></h1></div>--}}
{{--</div>--}}

<div class="text-center my-[4rem]">
    <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl dark:text-white">
        Stats general</h1>

</div>

<div class="flex item-center justify-beteween p-4">
    <div class="w-1/4 mr-4 overflow-auto scrollbar sm:rounded-lg scrollbar-thumb-gray-900 scrollbar-track-gray-100"
         style="height: 600px">
        <h1 class="bg-gray-50 text-center bold text-black text-xl uppercase">Tableau des pilotes</h1>
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase dark:text-gray-400">
            <tr>
                <th scope="col" class="py-3 px-6  dark:bg-gray-800">
                    Pos
                </th>
                <th scope="col" class="py-3 px-6">
                    Name
                </th>
                <th scope="col" class="py-3 px-6 bg-gray-50 dark:bg-gray-800">
                    Marque
                </th>
                <th scope="col" class="py-3 px-6">
                    Points
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($drivers as $driver)
                <tr>
                    <td class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                        {{ $driver['id'] }}
                    </td>
                    <td class="py-4 px-6">
                        {{ $driver['name'] }}
                    </td>
                    <td class="py-4 px-6 bg-gray-50 dark:bg-gray-800">
                        {{ $driver['car'] }}
                    </td>
                    @if($driver['points'] > 100)
                        <td class="py-4 px-6 text-green-500">
                            {{ $driver['points'] }}
                        </td>
                    @else
                        <td class="py-4 px-6 text-orange-500">
                            {{ $driver['points'] }}
                        </td>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div
        class="w-3/4 overflow-auto relative overflow-auto scrollbar sm:rounded-lg scrollbar-thumb-gray-900 scrollbar-track-gray-100"
        style="height: 600px">
        <h1 class="bg-gray-50 w-full text-center bold text-black text-xl uppercase">Liste des courses de la saison
            2022</h1>
        <table class="text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="py-3 px-6">Course</th>
                @for($i = 1; $i <= 20; $i++)
                    <th scope="col" class="py-3 px-6">
                        {{ $i }}
                    </th>
                @endfor
            </tr>
            </thead>
            <tbody>
            @foreach($courses as $key => $course)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $course['title'] }}
                    </th>
                    @foreach($course['all'] as $player)

                        {{--                        <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">--}}
                        {{--                            {{ $player['position'] }}--}}
                        {{--                        </th>--}}
                        <td class="py-4 px-6">
                            {{ $player['name'] }}
                            <br>
                            @if($player['temps'] != 'DNF')
                                <span class="text-green-500">
                                {{ $player['temps'] }}
                            </span>
                            @else
                                <span class="text-red-500">
                                {{ $player['temps'] }}
                        </span>
                            @endif
                        </td>




                    @endforeach
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>


<!-- Required chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<!-- Chart bar -->
<script>
    const labelsBarChart = [
        @foreach($top10 as $key => $top)
            '{{ $key  }}',
        @endforeach
    ];

    const dataBarChart = {
        labels: labelsBarChart,
        datasets: [
            {
                label: "Top 10",
                backgroundColor: "hsl(252, 82.9%, 67.8%)",
                borderColor: "hsl(252, 82.9%, 67.8%)",
                data: [@foreach($top10 as $top) {{ $top }}, @endforeach],
            },
        ],
    };

    const configBarChart = {
        type: "bar",
        data: dataBarChart,
        backgroundColor: 'red',
        options: {},
    };

    var chartBar = new Chart(
        document.getElementById("chartBar"),
        configBarChart
    );
</script>
</body>
</html>
