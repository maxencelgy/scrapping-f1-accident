<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>F1 SCRAP</title>
</head>
<body class="bg-gray-600">
<div>
    <a href="/live"
       class="relative inline-flex items-center justify-center p-0.5 mb-2 mr-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-pink-500 to-orange-400 group-hover:from-pink-500 group-hover:to-orange-400 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-pink-200 dark:focus:ring-pink-800">
  <span
      class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
 Voir la course en live
  </span>
    </a>
</div>
<div class="flex mb-4 item-center justify-center">
    <div class="shadow-lg w-3/4 rounded-lg overflow-hidden">
        <div class="py-3 px-5 bg-gray-50">Réccurence du top 10 par joueurs</div>
        <canvas class="p-10 bg-gray-50" id="chartBar"></canvas>
    </div>
</div>

<div class="p-4 flex item-center">
    <div class="overflow-x-auto relative mr-4 shadow-md sm:rounded-lg">
        <h1 class="text-white text-xl mb-4">Tableau des pilotes</h1>
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
    <div class="mr-4">
        <h1 class="text-white text-xl mb-4">Accidents par personne</h1>
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
                            <td class="py-4 px-6 text-orange-500 text-center">
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
    <div class="mr-4">
        <h1 class="text-white text-xl mb-4">Accidents par marque</h1>
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
                            <td class="py-4 px-6 text-orange-500 text-center">
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
    <div>
        <div><h1 class="text-white text-xl mb-4">Pilote qui a fais le plus d'accident : <br>
                <span>{{ array_search(max($accidents),$accidents) }}</span> -> <span
                    class="text-red-500">{{ max($accidents) }}</span></h1></div>
        <br>
        <div><h1 class="text-white text-xl mb-4">Marque qui a fais le plus d'accident : <br>
                <span>{{ array_search(max($carAccidents),$carAccidents) }}</span> -> <span
                    class="text-red-500">{{ max($carAccidents) }}</span></h1></div>
    </div>
</div>
<div class="p-4">
    <h1 class="text-white text-xl mb-4">Liste des courses de la saison 2022</h1>
    <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
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
        @foreach($top10 as $top)
              '{{ array_search($top, $top10)  }}',
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
