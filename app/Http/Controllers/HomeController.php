<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\User;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        /*$this->middleware('auth');*/
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $md = new User();

        if (Auth::check()) {
            $token = $md->getLoginUser()->notion_token;
            $dbid = $md->getLoginUser()->notion_dbid;
        } else {
            $token = $md->getGuestUser_token();
            $dbid = $md->getGuestUser_dbid();
        }


        define('NOTION_TOKEN', $token);
        define('NOTION_TABLE', 'https://api.notion.com/v1/databases/' . $dbid);

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => NOTION_TABLE,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "Notion-Version: 2022-06-28",
                "accept: application/json",
                'Authorization: Bearer ' . NOTION_TOKEN,
                "Content-Type: application/json"
            ],

        ]);


        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        //notionAPIとの通信が失敗した場合
        if ($err) {
            /*echo "cURL Error #:" . $err;*/
            return view('home_error');
        }
        //デバッグ用 var_dump($db_properties_array = json_decode($response, true));
        $db_properties_array = json_decode($response, true);
        //notionAPIから値はとれたが、戻り値にerrorという文言が含まれていた場合（integrationが追加されていないなど）
        if (in_array('error', $db_properties_array)) {
            return view('home_error');
            //成功
        } else {
            $tag_name_array = [];
            $db_multiselect_options_array = [];

            $db_multiselect_options_array = $db_properties_array['properties']['tag']['multi_select']['options'];

            foreach ($db_multiselect_options_array as $option) {
                $tag_name_array[] = $option['name'];
            }

            return view('home', compact('tag_name_array', 'db_properties_array'));
        }
    }
}
