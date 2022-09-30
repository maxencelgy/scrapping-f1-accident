<?php

namespace App\Http\Controllers;


use Goutte\Client;
use Illuminate\Http\Request;
use Symfony\Component\DomCrawler\Crawler;

class HomeController extends Controller
{
    private $result = array();
    private $url = array();

    public function index()
    {
        $client = new Client();
        $url = 'https://www.formula1.com/en/results.html';
        $page = $client->request('GET', $url);
        $page->filter('.dark .bold')->each(function ($item) use ($client) {
            $urlSingle = $item->attr('href');
            $singlePage = $client->request('GET', $urlSingle);

            $singlePage->filter('.resultsarchive-wrapper')->each(function (Crawler $el) {
                $this->result[] = [
                    'title' => $el->filter('.ResultsArchiveTitle')->text(),
                    'winner' => $el->filter('tbody tr td:nth-child(4)')->text(),
                    'temps' => $el->filter('tbody tr td:nth-child(7)')->text(),
                    'all' => $el->filter('tbody tr')->each(function ($node) {
                        return [
                            'name' => $node->filter('td:nth-child(4)')->text(),
                            'temps' => $node->filter('td:nth-child(7)')->text(),
                        ];
                    })
                ];

            });
        });
        dump($this->result);

        return view('home.index', [
            'user' => 'cc',
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
