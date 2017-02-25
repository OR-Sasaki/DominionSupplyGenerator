<?php
$accessToken = getenv('LINE_CHANNEL_ACCESS_TOKEN');
//配列定義 
$box=array("基本","陰謀","異郷","海辺");
$num=array(0,0,0,0);
$boxnum=array($box,$num);
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
	$testbox="";
	$kihoncords=array("地下貯蔵庫",
		     "礼拝堂",
		     "堀",
		     "木こり",
		     "工房",
		     "村",
		     "改築",
		     "宰相",
		     "村",
		     "改築",
		     "鍛冶屋",
		     "金貸し",
		     "玉座の間",
		     "祝宴",
		     "泥棒",
		     "密偵",
		     "民兵",
		     "役人",
		     "庭園",
		     "市場",
		     "議事堂",
		     "研究",
		     "鉱山",
		     "祝祭",
		     "書庫",
		     "魔女",
		     "冒険者");
    for($i=0;$i<10;$i++){
	$randnum=rand(0,3);
    	$boxnum[1][$randnum]++;
    }
    $keys=array_keys($kihoncords);
    shuffle($keys);
    for($i=0;$i<$boxnum[1][0];$i++){
    	$testbox=$textbox.$kihoncords[$keys[$i]].",";
    }
  $response_format_text = [
    "type" => "template",
    "altText" => "こちらのオリジナルメニューはいかがですか？",
    "template" => [
      "type" => "buttons",
      "title" => "基本".$boxnum[1][0]."陰謀".$boxnum[1][1]."異郷".$boxnum[1][2]."海辺".$boxnum[1][3],
      "text" => $testbox,
      "actions" => [
          [
            "type" => "message",
            "label" => "もっかい",
            "text" => "はい"
          ]
      ]
    ]
  ];
} else if ($text == 'いいえ') {
  exit;
} else if ($text == '違うやつお願い') {
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
