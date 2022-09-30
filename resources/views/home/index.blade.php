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
<div class="p-4 flex item-center">
    <div class="overflow-x-auto  relative mr-4 shadow-md sm:rounded-lg">
        <h1 class="text-white text-xl mb-4">Tableau des pilotes</h1>
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase dark:text-gray-400">
            <tr>
                <th scope="col" class="py-3 px-6  dark:bg-gray-800">
                    Pos
                </th>
                <th scope="col"  class="py-3 px-6">
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
                <tr class="border-b border-gray-200 dark:border-gray-700">
                    <td  class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                        {{ $driver['id'] }}
                    </td>
                    <td
                        class="py-4 px-6">
                        {{ $driver['name'] }}
                    </td>

                    <td class="py-4 px-6 bg-gray-50 dark:bg-gray-800">
                        {{ $driver['car'] }}
                    </td>
                    <td class="py-4 px-6">
                        {{ $driver['points'] }}
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>
    <div>
        <h1 class="text-white text-xl mb-4">Probabilité du top 10 de dimanche</h1>
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


</body>
</html>
