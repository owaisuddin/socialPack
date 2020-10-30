<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Http;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
//        $endpoint = "https://graph.facebook.com/oauth/access_token";
        $client = new \GuzzleHttp\Client();
//
//        $response = $client->request('GET', $endpoint, ['query' => [
//            'client_id' => '273079300700427',
//            'client_secret' => 'eaf422c78123130cd076ba35a43d7cfd',
//            'grant_type' => 'client_credentials'
//        ]]);
//
//
//        $content = json_decode($response->getBody(), true);

//        $endpoint = 'https://graph.facebook.com/111044047467634/feed';
//        try {
//            $response = $client->request('POST', $endpoint, ['query' => [
//                'message' => 'access_token..', //
//                'access_token' => 'EAAFKl3d1vsQBABo9qbPk880uTErMuEFZA7MOZAqFE5DDng8fjwdnmC4Wxuyt9EUbaDjEA1nqC892H6BClewaLXyvyIugM5ZAEbLHoMybz357EnlOWV2P5W39G5OeR7Cbmcn5uHZBMrXmHY60JoyqfZC3TOZCRVA8TZCJ2uE9EBFFpOE6tvCP10DbnVhZCkXNHZAiq4VaJq3RF6jpuOKSLCZCLT'
//            ]]);
//        }catch (\Exception $ex){
//            echo '<pre>';print_r($ex->getMessage());
//        }
//        $content = json_decode($response->getBody(), true);
//        dd($content);
        return view('home');
    }
}
