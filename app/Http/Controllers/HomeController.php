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
//        $client = new Client();
//        for ($i = 1; $i < 9; $i++) {
//            $url = 'https://www.novacel.world/en/news?page=' . $i;
//            $page = $client->request('GET', $url);
//            $page->filter('.card')->each(function ($item) use ($client) {
//                $urlSingle = $item->attr('href');
//                $singlePage = $client->request('GET', $urlSingle);
//
//                $singlePage->filter('article')->each(function (Crawler $el) {
//                    if ($el->filter('img')->count()) {
//                        $image = $el->filter('img')->image()->getUri();
//                    } else {
//                        $image = $el->filter('iframe')->attr('src');
//                    }results
//                    $this->[] = [
//                        'image' => $image,
//                        'title' => $el->filter('h1')->text(),
//                        'text' => $el->filter('[itemprop="articleBody"]')->html(),
//                        'date' => $el->filter('time')->attr('datetime'),
//                    ];
//                });
//            });}
//

        $client = new Client();
        $url = 'https://www.formula1.com/en/results.html';
        $page = $client->request('GET', $url);
        $page->filter('.dark .bold')->each(function ($item) use ($client) {
            $urlSingle = $item->attr('href');
            $singlePage = $client->request('GET', $urlSingle);

            $singlePage->filter('.resultsarchive-wrapper')->each(function (Crawler $el) {
                dump($el->filter('.ResultsArchiveTitle')->text());
//                dump($el->filter('.dark')->text());
                dump($el->filter('tbody .hide-for-tablet')->text());
//                dump($el->filter('tbody .hide-for-desktop')->text());

                });


            $this->url[] = [
                $urlSingle
            ];
        });


//        dump($this->url);
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
