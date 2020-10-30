<?php

namespace App\Http\Controllers;

use App\Models\PageContent;
use App\Models\PageSetting;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function addPage(Request $request)
    {
        return view('pages.add');
    }

    public function savePage(Request $request)
    {
        PageSetting::create($request->except('_token'));
        return redirect()->route('page_list')->withSuccess('Page Successfully Added.');
    }

    public function pageList()
    {
        $pages = PageSetting::all();
        return view('pages.index')->with('pages', $pages);
    }

    public function pagePost(Request $request, $id)
    {
        $page_config = PageSetting::where('page_id', $id)->first();
        $client = new \GuzzleHttp\Client();

        try {
            $response = $client->request('GET', 'https://graph.facebook.com/' . $page_config['page_id'] . '/feed', ['query' => [
                'access_token' => $page_config['access_token']
            ]]);
        } catch (\Exception $ex) {
            dd($ex->getMessage());
        }
        $content = json_decode($response->getBody(), true);

        return view('pages.show')->with(['page_config' => $page_config, 'content' => $content]);
    }

    public function storePost(Request $request)
    {

        $images = array();
        if ($files = $request->file('photos')) {
            foreach ($files as $file) {
                $strtotime = strtotime("now");
                $name = $strtotime . '_' . $file->getClientOriginalName();
                $file->move('image', $name);
                $images[] = $name;
            }
        }

        $videos = array();
        if ($files = $request->file('videos')) {
            foreach ($files as $file) {
                $strtotime = strtotime("now");
                $name = $strtotime . '_' . $file->getClientOriginalName();
                $file->move('image', $name);
                $videos[] = $name;
            }
        }

        $page_config = PageSetting::where('page_id', $request->get('page_id'))->first();
        $client = new \GuzzleHttp\Client();

        try {
            $time = $request->get('date').' '. $request->get('time');

            $response = $client->request('POST', 'https://graph.facebook.com/' . $page_config['page_id'] . '/feed', ['query' => [
                'message' => $request->get('content'),
                'link' => $request->get('link'),
                'published' => false,
                'scheduled_publish_time' => strtotime($time) ,
                'access_token' => $page_config['access_token']
            ]]);
        } catch (\Exception $ex) {
            dd($ex->getMessage());
        }

        $content = json_decode($response->getBody(), true);

        $request->merge([
            'page_post_id' => $content['id'],
            'photo' => json_encode($images),
            'video ' => json_encode($videos),
            'schedule_time' => $request->get('date') . ':' . $request->get('time')
        ]);

        PageContent::create($request->except('_token'));
        dd($content);
    }
}
