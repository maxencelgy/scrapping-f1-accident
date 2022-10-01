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
//        dd($this->nameCountAccidents);

        return view('home.index', [
            'courses' => $this->result,
            'marques' => $this->marques,
            'drivers' => $this->drivers,
            'accidents' => $this->nameCountAccidents,
            'carAccidents' => $this->carCountAccidents,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
