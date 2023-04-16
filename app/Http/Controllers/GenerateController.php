<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\User;


class GenerateController extends Controller
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

    public function index(){

   $md = new User();
   $token = $md->getUser()->notion_token;
   $dbid = $md->getUser()->notion_dbid;


    //----------------------NOTION------------------------------------------------
    define('NOTION_TOKEN', $token);
    define('NOTION_TABLE', 'https://api.notion.com/v1/databases/'.$dbid.'/query'); 

    $curl = curl_init();
    
    curl_setopt_array($curl, [
        CURLOPT_URL => NOTION_TABLE,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_HTTPHEADER => [
            "Notion-Version: 2022-06-28",
            "accept: application/json",
            'Authorization: Bearer ' .NOTION_TOKEN,
            "Content-Type: application/json"
        ],
        CURLOPT_POSTFIELDS => json_encode([
            "filter" => [
                "property" => "PJ",
                "multi_select" => [
                    "contains" => $_REQUEST['pj']
                ]
            ]
        ])
    ]);
    
    $response = curl_exec($curl);
    $err = curl_error($curl);
    
    curl_close($curl);
    
    if ($err) {
        echo "cURL Error #:" . $err;
    } else {
        $res_notion_array = json_decode($response, true);
    }



 //----------------------CiteAPI------------------------------------------------

 // doiを格納する配列
$doi_array = [];

// resultsの要素を1つずつ処理
foreach ($res_notion_array['results'] as $result) {
    // doiの要素を取り出して配列に追加
    $doi = $result['properties']['doi']['url'];
    $doi_array[] = $doi;
} 

foreach ($doi_array as $citation) {
    $REF_DOI_G='https://api.citeas.org/product/'.$citation; 

    $header = [
        "Content-Type: application/json",
      ];
    

    $ch = curl_init($REF_DOI_G);
 
    curl_setopt_array($ch,
      [
        CURLOPT_RETURNTRANSFER  => true,
        CURLOPT_HTTPHEADER      => $header,
      ]
    );

    $result_cite = curl_exec($ch);

    if (curl_errno($ch)) {
      $error = curl_error($ch);
      echo $error;
    }

    curl_close($ch);

    $res_cite_array= json_decode($result_cite, true);
    $gen_citation=$res_cite_array['citations']['0']['citation'];
    $gen_citation_array[]=$gen_citation;



    unset($REF_DOI_G);
}



return view('generate', compact('gen_citation_array'));


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

}}