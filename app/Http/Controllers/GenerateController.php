<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Crypt;


class GenerateController extends Controller
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

    public function index()
    {

        $md = new User();
        if (Auth::check()) {
            $token = $md->getLoginUser_token();
            $dbid = $md->getLoginUser_dbid();
        } else {
            $token = $md->getGuestUser_token();
            $dbid = $md->getGuestUser_dbid();
        }
        //--NOTIONから情報を取得する--
        define('NOTION_TOKEN', $token);
        define('NOTION_TABLE', 'https://api.notion.com/v1/databases/' . $dbid . '/query');

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
                'Authorization: Bearer ' . NOTION_TOKEN,
                "Content-Type: application/json"
            ],
            CURLOPT_POSTFIELDS => json_encode([
                "filter" => [
                    "property" => "tag",
                    "multi_select" => [
                        "contains" => $_POST['tag']
                    ]
                ]
            ])
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            //echo "cURL Error #:" . $err;
            $err_code = '1';
            return view('generate_error', compact('err_code'));
        }
        $res_notion_array = json_decode($response, true);
        if (in_array('error', $res_notion_array)) {
            $err_code = '2';
            return view('generate_error', compact('err_code'));
        }
        if (count($res_notion_array['results']) === 0) {
            $err_code = '3';
            return view('generate_error', compact('err_code'));
        } else {

            //--CiteAPIに情報を渡す--

            // doiを格納する配列
            $doi_array = [];

            // resultsの要素を1つずつ処理
            foreach ($res_notion_array['results'] as $result) {
                // doiの要素を取り出して配列に追加
                $doi = $result['properties']['doi']['url'];
                $doi_array[] = $doi;
            }

            foreach ($doi_array as $citation) {
                $REF_DOI_G = 'https://api.citeas.org/product/' . $citation;

                $header = [
                    "Content-Type: application/json",
                ];

                $ch = curl_init($REF_DOI_G);

                curl_setopt_array(
                    $ch,
                    [
                        CURLOPT_RETURNTRANSFER  => true,
                        CURLOPT_HTTPHEADER      => $header,
                    ]
                );

                $result_cite = curl_exec($ch);
                $err_ch = curl_error($ch);

                curl_close($ch);

                if ($err_ch) {
                    //echo "cURL Error #:" . $err;
                    //if (curl_errno($ch)) {
                    //$error = curl_error($ch);
                    //echo $error;
                    $err_code = '4';
                    return view('generate_error', compact('err_code'));
                }
                $res_cite_array = json_decode($result_cite, true);
                if ($res_cite_array == null) {
                    $err_code = '5';
                    return view('generate_error', compact('err_code'));
                } else {
                    $gen_citation = $res_cite_array['citations']['0']['citation'];
                    $gen_citation_array[] = $gen_citation;

                    unset($REF_DOI_G);
                }
            }
            //--画面表示する--
            return view('generate', compact('gen_citation_array'));

            /**
             * Show the application dashboard.
             *
             * @return \Illuminate\Contracts\Support\Renderable
             */
        }
    }
}
