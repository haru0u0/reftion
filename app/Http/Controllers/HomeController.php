<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\User;

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
    public function index(){

    $md = new User();
    $token = $md->getUser()->notion_token;
    $dbid = $md->getUser()->notion_dbid;



    define('NOTION_TOKEN', $token);
    define('NOTION_TABLE', 'https://api.notion.com/v1/databases/'.$dbid); 

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
            'Authorization: Bearer ' .NOTION_TOKEN,
            "Content-Type: application/json"
        ],
       
    ]);
    
    
    $response = curl_exec($curl);
    $err = curl_error($curl);
    
    curl_close($curl);
    
    if ($err) {
        echo "cURL Error #:" . $err;
    } else {
        //var_dump($res_notion_array = json_decode($response, true));
        $db_properties_array= json_decode($response, true);
    }
    
    $tag_name_array = [];
    $db_multiselect_options_array=[];

    $db_multiselect_options_array = $db_properties_array['properties']['tag']['multi_select']['options'];

    foreach ($db_multiselect_options_array as $option) {
    $tag_name_array[] = $option['name'];
    }
   
    
    return view('home', compact('tag_name_array', 'db_properties_array'));
    
    //var_dump ($tag_name_array);


    }
}
