<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\User;


class InsertController extends Controller
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

  //----------------------CiteAPI------------------------------------------------
     define('REF_DOI', 'https://api.citeas.org/product/'.$_REQUEST['doi']); 

    $header = [
        "Content-Type: application/json",
      ];
    
    $ch = curl_init(REF_DOI);
 
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

    //受け取ったデータなどをnotionに渡せるように定義

    $notion_cite_title=$res_cite_array['name'];
    $notion_cite_doi=$_REQUEST['doi'];
    //$notion_cite_abs=$res_cite_array['metadata']['abstract'];
    $notion_cite_citation=$res_cite_array['citations']['0']['citation'];

    //----------------------NOTION------------------------------------------------
    define('NOTION_TOKEN', $token);
    define('NOTION_TABLE', $dbid); 

    $header = [
      "Authorization: Bearer ".NOTION_TOKEN,
      "Content-Type: application/json",
      "Notion-Version: 2022-06-28"
    ];

    $post_data = [
      "parent"=> ["database_id"=> NOTION_TABLE],
      "properties"=> [
        "title"=> [
          "title"=> [
            [
              "text"=> [
                "content"=>$notion_cite_title
              ]
            ]
          ]
        ],
                "doi"=> [
                  "url"=> $notion_cite_doi
                ],
               // "abstract"=> [
               //     "rich_text"=> [
               //       [
               //         "text"=> [
               //           "content"=>$notion_cite_abs
               //         ]
               //       ]
               //     ]
               //   ],
                  "citation"=> [
                    "rich_text"=> [
                      [
                        "text"=> [
                          "content"=>$notion_cite_citation
                        ]
                      ]
                    ]
                  ],
              
      ]
    ];

    $ch = curl_init("https://api.notion.com/v1/pages");

    curl_setopt_array($ch,
      [
        CURLOPT_RETURNTRANSFER  => true,
        CURLOPT_HTTPHEADER      => $header,
        CURLOPT_POST            => true,
        CURLOPT_POSTFIELDS      => json_encode($post_data),
      ]
    );

    $res_notion = curl_exec($ch);

    if (curl_errno($ch)) {
      $error = curl_error($ch);
      echo $error;
    }
    curl_close($ch);

    $res_notion_array= json_decode($res_notion, true);

   return view('insert', compact('res_cite_array','res_notion_array'));
}
   


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

}
