<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
	<title>reftion</title>
</head>
<body>
<?php

//DB接続
$DB_DATABASE = 'reftion';
$DB_USERNAME = 'root';
$DB_PASSWORD = '';
$DB_OPTION = 'charset=utf8';
$PDO_DSN = "mysql:host=localhost;dbname=" . $DB_DATABASE . ";" . $DB_OPTION;
$db = new PDO($PDO_DSN, $DB_USERNAME, $DB_PASSWORD);
//notion_token読み込み
$stmt=$db->prepare('SELECT value FROM manage WHERE name=\'notion_token\';');
$stmt->execute();
$notion_token_array=$stmt->fetch(PDO::FETCH_BOTH);



     //----------------------CiteAPI------------------------------------------------
     define('REF_DOI', 'https://api.citeas.org/product/'.$_REQUEST['doi']); 
        //-----------------------------------------------------------------------------
    // (1) cURL ヘッダー情報 設定
    //-----------------------------------------------------------------------------
    $header = [
        "Content-Type: application/json",
      ];
    
     // (3) cURL セッション 初期化
    //-----------------------------------------------------------------------------
    $ch = curl_init(REF_DOI);
       //-----------------------------------------------------------------------------
    // (4) cURL オプション 設定
    //-----------------------------------------------------------------------------
    curl_setopt_array($ch,
      [
        CURLOPT_RETURNTRANSFER  => true,
        CURLOPT_HTTPHEADER      => $header,
      ]
    );
    //-----------------------------------------------------------------------------
    // (5) cURL 実行
    //-----------------------------------------------------------------------------
    $result_cite = curl_exec($ch);
    //-----------------------------------------------------------------------------
    // (6) cURL エラー処理
    //-----------------------------------------------------------------------------
    if (curl_errno($ch)) {
      $error = curl_error($ch);
      echo $error;
    }
    //-----------------------------------------------------------------------------
    // (7) cURL システムリソース解放
    //-----------------------------------------------------------------------------
    curl_close($ch);
    //-----------------------------------------------------------------------------
    // (8) 結果画面表示
    //-----------------------------------------------------------------------------
    //echo '<pre class="text-light">';    
    $res_cite_array= json_decode($result_cite, true);
    //echo $res_cite_array['citations']['0']['citation']."\n"; 
    //echo $res_cite_array['metadata']['abstract']."\n"; 
    //echo $res_cite_array['name']."\n"; 
    //print_r(json_decode($result_cite, true));
    //echo '</pre>';


    //受け取ったデータなどをnotionに渡せるように定義

    $notion_cite_title=$res_cite_array['name'];
    $notion_cite_doi=$_REQUEST['doi'];
    $notion_cite_abs=$res_cite_array['metadata']['abstract'];
    $notion_cite_citation=$res_cite_array['citations']['0']['citation'];

    //----------------------NOTION------------------------------------------------
    define('NOTION_TOKEN', $notion_token_array['value']);
    define('NOTION_TABLE', '422fed2fabc04532a7930787a3d1809b'); 

    //-----------------------------------------------------------------------------
    // (1) cURL ヘッダー情報 設定
    //-----------------------------------------------------------------------------
    $header = [
      "Authorization: Bearer ".NOTION_TOKEN,
      "Content-Type: application/json",
      "Notion-Version: 2022-06-28"
    ];
    //-----------------------------------------------------------------------------
    // (2) cURL 送信データ 設定
    //-----------------------------------------------------------------------------
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
                "abstract"=> [
                    "rich_text"=> [
                      [
                        "text"=> [
                          "content"=>$notion_cite_abs
                        ]
                      ]
                    ]
                  ],
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
    //-----------------------------------------------------------------------------
    // (3) cURL セッション 初期化
    //-----------------------------------------------------------------------------
    $ch = curl_init("https://api.notion.com/v1/pages");
    //-----------------------------------------------------------------------------
    // (4) cURL オプション 設定
    //-----------------------------------------------------------------------------
    curl_setopt_array($ch,
      [
        CURLOPT_RETURNTRANSFER  => true,
        CURLOPT_HTTPHEADER      => $header,
        CURLOPT_POST            => true,
        CURLOPT_POSTFIELDS      => json_encode($post_data),
      ]
    );
    //-----------------------------------------------------------------------------
    // (5) cURL 実行
    //-----------------------------------------------------------------------------
    $res_notion = curl_exec($ch);
    //-----------------------------------------------------------------------------
    // (6) cURL エラー処理
    //-----------------------------------------------------------------------------
    if (curl_errno($ch)) {
      $error = curl_error($ch);
      echo $error;
    }
    //-----------------------------------------------------------------------------
    // (7) cURL システムリソース解放
    //-----------------------------------------------------------------------------
    curl_close($ch);
    //-----------------------------------------------------------------------------
    // (8) 結果画面表示
    //-----------------------------------------------------------------------------
    $res_notion_array= json_decode($res_notion, true);
   // echo $res_notion_array['url']; ?>

<p><?php  echo $res_cite_array['name'].'を登録しました。';?></p>
<a href="<?php echo $res_notion_array['url']?>">登録したページはこちらから確認してください。</a> 


</body></html>
