<?php
$accessToken = getenv('LINE_CHANNEL_ACCESS_TOKEN');
//配列定義
$box=array("いち","に","さん","よん","ご");
//ユーザーからのメッセージ取得
$json_string = file_get_contents('php://input');
$jsonObj = json_decode($json_string);

$type = $jsonObj->{"events"}[0]->{"message"}->{"type"};
//メッセージ取得
$text = $jsonObj->{"events"}[0]->{"message"}->{"text"};
//ReplyToken取得
$replyToken = $jsonObj->{"events"}[0]->{"replyToken"};

//メッセージ以外のときは何も返さず終了
if($type != "text"){
	exit;
}

//返信データ作成
if ($text == 'はい') {
    //ファイル読み込み
    $liness = file("kakutyo.csv");
    foreach($liness as $looss){
    $data[] = explode(",",$looss);}
    //配列の中からランダムな要素のポインタを取得
    $key = array_rand($box);
  $response_format_text = [
    "type" => "template",
    "altText" => "こちらのオリジナルメニューはいかがですか？",
    "template" => [
      "type" => "buttons",
      "thumbnailImageUrl" => "https://" . $_SERVER['SERVER_NAME'] . "/img1.jpg",
      "title" => "カツカレー炒飯",
      "text" => $data[0],
      "actions" => [
          [
            "type" => "uri",
            "label" => "動画を見る",
            "uri" => "http://www.nicovideo.jp/watch/sm27636439"
          ],
          [
            "type" => "message",
            "label" => "違うやつ",
            "text" => "違うやつお願い"
          ]
      ]
    ]
  ];
} else if ($text == 'いいえ') {
  exit;
} else if ($text == '違うやつお願い') {
  $response_format_text = [
    "type" => "template",
    "altText" => "候補を３つご案内しています。",
    "template" => [
      "type" => "carousel",
      "columns" => [
          [
            "thumbnailImageUrl" => "https://" . $_SERVER['SERVER_NAME'] . "/img2-1.jpg",
             "title" => "味噌キムチラーメン",
            "text" => "こちらにしますか？",
            "actions" => [
              [
                  "type" => "uri",
                  "label" => "動画を見る",
                  "uri" => "http://www.nicovideo.jp/watch/sm28066128"
              ]
            ]
          ],
          [
            "thumbnailImageUrl" => "https://" . $_SERVER['SERVER_NAME'] . "/img2-2.jpg",
            "title" => "カレーピラフ",
            "text" => "それともこちら？（２つ目）",
            "actions" => [
              [
                  "type" => "uri",
                  "label" => "動画を見る",
                  "uri" => "http://www.nicovideo.jp/watch/sm28017716"
              ]
            ]
          ],
          [
            "thumbnailImageUrl" => "https://" . $_SERVER['SERVER_NAME'] . "/img2-3.jpg",
            "title" => "チョコフレークケーキ",
            "text" => "はたまたこちら？（３つ目）",
            "actions" => [
              [
                  "type" => "uri",
                  "label" => "動画を見る",
                  "uri" => "http://www.nicovideo.jp/watch/sm28035912"
              ]
            ]
          ]
      ]
    ]
  ];
} else if($text == 'シャム'){
  $response_format_text = [
    "type" => "template",
    "altText" => "こんにちわ 何かご用ですか？（はい／いいえ）",
    "template" => [
        "type" => "buttons",
        "text" => "ｳｲｲｲｲｲｲｲｲｲｲｲｲ↑ｯｽ！どうも、",
        "actions" => [
            [
              "type" => "message",
              "label" => "シャムで～す！",
              "text" => "はい"
            ],
            [
              "type" => "message",
              "label" => "シャムではない",
              "text" => "いいえ"
            ]
        ]
    ]
  ];
}

$post_data = [
	"replyToken" => $replyToken,
	"messages" => [$response_format_text]
	];

$ch = curl_init("https://api.line.me/v2/bot/message/reply");
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_data));
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json; charser=UTF-8',
    'Authorization: Bearer ' . $accessToken
    ));
$result = curl_exec($ch);
curl_close($ch);
