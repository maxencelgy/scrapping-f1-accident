<?php

namespace App\Http\Controllers;


use Goutte\Client;
use Illuminate\Http\Request;
use Symfony\Component\DomCrawler\Crawler;

class HomeController extends Controller
{
    private $result = array();
    private $drivers = array();

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
                $this->result[] = [
                    'title' => $el->filter('.circuit-info')->text(),
                    'winner' => $el->filter('tbody tr td:nth-child(4)')->text(),
                    'temps' => $el->filter('tbody tr td:nth-child(7)')->text(),
                    'all' => $el->filter('tbody tr')->each(function ($node) {
                        return [
                            'position' => $node->filter('td:nth-child(2)')->text(),
                            'name' => $node->filter('td:nth-child(4)')->text(),
                            'temps' => $node->filter('td:nth-child(7)')->text(),
                        ];
                    })
                ];
            });
        });
        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        ///
        ///  DRIVERS
        ///
        /// //////////////////////////////////////////////////////////////////////////////////////////////////////////////////


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



        return view('home.index', [
            'courses' => $this->result,
            'drivers' => $this->drivers,
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
