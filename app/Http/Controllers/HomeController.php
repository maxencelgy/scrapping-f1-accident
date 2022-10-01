<?php

namespace App\Http\Controllers;


use Goutte\Client;
use Illuminate\Http\Request;
use Symfony\Component\DomCrawler\Crawler;

class HomeController extends Controller
{
    private $result = array();
    private $circuit;
    private $drivers = array();
    private $marques = array();
    private $accident = array();
    private $nameCountAccidents = array();
    private $carCountAccidents = array();
    private $top10 = array();
    private $top10PlayerCount = array();
    private $top10PlayerPourcent = array();
    private $safe = array();

    public function index()
    {
        //RESULTAT
        $client = new Client();
        $url = 'https://www.formula1.com/en/results.html';
        $page = $client->request('GET', $url);
        $page->filter('.dark .bold')->each(function ($item) use ($client) {
            $urlSingle = $item->attr('href');
            $singlePage = $client->request('GET', $urlSingle);

            $singlePage->filter('.resultsarchive-wrapper')->each(function (Crawler $el) {
                $this->circuit = $el->filter('.circuit-info')->text();
                $this->result[] = [
                    'title' => $this->circuit,
                    'all' => $el->filter('tbody tr')->each(function ($node) {
                        return [
                            'circuit' => $this->circuit,
                            'position' => $node->filter('td:nth-child(2)')->text(),
                            'car' => $node->filter('td:nth-child(5)')->text(),
                            'name' => $node->filter('td:nth-child(4)')->text(),
                            'temps' => $node->filter('td:nth-child(7)')->text(),
                        ];
                    })
                ];
            });
        });
//////////////  DRIVERS

        $url = 'https://www.formula1.com/en/results.html/2022/drivers.html';
        $page = $client->request('GET', $url);
        $page->filter('tbody tr')->each(function ($node) {
            $this->drivers[] = [
                'id' => $node->filter('td:nth-child(2)')->text(),
                'name' => $node->filter('td:nth-child(3)')->text(),
                'car' => $node->filter('td:nth-child(5)')->text(),
                'points' => $node->filter('td:nth-child(6)')->text(),
            ];
        });
//      MARQUES
        $url = 'https://www.formula1.com/en/results.html/2022/team.html';
        $page = $client->request('GET', $url);
        $page->filter('tbody tr')->each(function ($node) {
            $this->marques[] = [
                'id' => $node->filter('td:nth-child(2)')->text(),
                'name' => $node->filter('td:nth-child(3)')->text(),
                'points' => $node->filter('td:nth-child(4)')->text(),
            ];
        });

//        ADD ACCIDENT AVEC CIRCUIT ET NOM DU PILOTE
        foreach ($this->result as $key => $value) {
            foreach ($value['all'] as $player) {
                if ($player['temps'] == 'DNF') {
                    $this->accident[] = [
                        'circuits' => $player['circuit'],
                        'nom' => $player['name'],
                        'car' => $player['car'],
                    ];
                }
            }
        }

//     GROUP PILOTE NBR ACCIDENT
        foreach ($this->accident as $el => $pilotes) {
            if (!empty($this->nameCountAccidents[$pilotes['nom']])) {
                $this->nameCountAccidents[$pilotes['nom']] = $this->nameCountAccidents[$pilotes['nom']] + 1;
            } else {
                $this->nameCountAccidents[$pilotes['nom']] = +1;
            };
        }

//     GROUP MARQUES NBR ACCIDENT
        foreach ($this->accident as $el => $pilotes) {
            if (!empty($this->carCountAccidents[$pilotes['car']])) {
                $this->carCountAccidents[$pilotes['car']] = $this->carCountAccidents[$pilotes['car']] + 1;
            } else {
                $this->carCountAccidents[$pilotes['car']] = +1;
            };
        }

//        TOP 10 LE PLUS PROBABLE
        foreach ($this->result as $key => $course) {
            $this->top10[$course['title']] = [
                1 => $course['all'][0]['name'],
                2 => $course['all'][1]['name'],
                3 => $course['all'][2]['name'],
                4 => $course['all'][3]['name'],
                5 => $course['all'][4]['name'],
                6 => $course['all'][5]['name'],
                7 => $course['all'][6]['name'],
                8 => $course['all'][7]['name'],
                9 => $course['all'][8]['name'],
                10 => $course['all'][9]['name'],
            ];
        }


        foreach ($this->top10 as $el => $top) {
            foreach ($top as $key => $value) {
                if (!empty($this->top10PlayerCount[$value])) {
                    $this->top10PlayerCount[$value] = $this->top10PlayerCount[$value] + 1;
                } else {
                    $this->top10PlayerCount[$value] = +1;
                };
            };
        }



        $driverTop = $this->top10PlayerCount;

        foreach ($driverTop as $key => $value) {
            if(!empty($this->nameCountAccidents[$key])){
                $nbrAccident =    $this->nameCountAccidents[$key];
            } else {
                $nbrAccident =  0;
            }

            $this->top10PlayerPourcent[] = [
                'name' => $key,
                'top10' => $value,
                'top10pourcent' => $value / count($this->result) * 100,
                'nbrAccident' => $nbrAccident,
                'nbrAccidentPourcent' => $nbrAccident / count($this->result) * 100,
            ];
        }

//        LE SAFE DU JOUR

        foreach ($this->top10PlayerPourcent as $key => $value) {
//            dump($value);
            if ($value['top10pourcent'] - $value['nbrAccidentPourcent'] > 70) {
                $this->safe[] = [
                    'name' => $value['name'],
                    'pourcentage' => $value['top10pourcent'] - $value['nbrAccidentPourcent'],
                ];
            }
//            $this->safe[$value['name']]['safe'] = $value['top10pourcent'] - $value['nbrAccidentPourcent'];
        }

//        dd($this->safe);

        return view('home.index', [
            'courses' => $this->result,
            'marques' => $this->marques,
            'drivers' => $this->drivers,
            'accidents' => $this->nameCountAccidents,
            'carAccidents' => $this->carCountAccidents,
            'top10' => $this->top10PlayerCount,
            'top10pourcent' => $this->top10PlayerPourcent,
            'safes' => $this->safe,
        ]);
    }
}
