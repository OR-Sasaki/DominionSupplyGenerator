<?php
$accessToken = getenv('LINE_CHANNEL_ACCESS_TOKEN');
//配列定義 
$box=array("基本","陰謀","異郷","海辺","帝国");
$num=array(0,0,0,0,0); 
$boxnum=array($box,$num);
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
$inboucords=array("手先", 
		     "中庭",
		     "秘密の部屋",
		     "仮面舞踏会",
		     "執事",
		     "願いの井戸",
		     "貧民街",
		     "詐欺師",
		     "大広間",
		     "共謀者",
		     "鉱山の村",
		     "男爵",
		     "偵察員",
		     "鉄工所",
		     "銅細工師",
		     "橋",
		     "改良",
		     "交易場",
		     "貢物",
		     "拷問人",
		     "寵臣",
		     "破壊工作員",
		     "公爵",
		     "貴族",
		     "ハーレム");
$umibecords=array("原住民の村",
			  "真珠採り",
			  "抑留",
			  "停泊所",
			  "灯台",
			  "倉庫",
			  "密輸",
			  "見張り",
			  "大使",
			  "漁村",
			  "航海士",
			  "宝の地図",
			  "引揚水夫",
			  "海の妖婆",
			  "海賊船",
			  "巾着切り",
			  "隊商",
			  "島",
			  "探検家",
			  "バザー",
			  "宝物庫",
			  "幽霊船",
			  "策士",
			  "商船",
			  "前哨地",
			  "船着場");
$ikyoucords=array("岐路",
			  "公爵夫人",
			  "愚者の黄金",
			  "オアシス",
			  "開発",
			  "画策",
			  "神託",
			  "坑道",
			  "香辛料商人",
			  "遊牧民の野営地",
			  "よろずや",
			  "義賊",
			  "交易人",
			  "シルクロード",
			  "街道",
			  "官吏",
			  "厩舎",
			  "大使館",
			  "地図職人",
			  "値切り屋",
			  "宿屋",
			  "辺境伯",
			  "不正利得",
			  "埋蔵金",
			  "国境の村",
			  "農地");
$teikokucords=array("資料庫",
		    "元手",
		    "投石機/石",
		    "戦車競走",
		    "御守り",
		    "市街",
		    "冠",
		    "陣地/鹵獲品",
		    "女魔術師",
		    "技術者",
		    "農家の市場",
		    "公共広場",
		    "剣闘士/大金",
		    "庭師",
		    "軍団兵",
		    "王室の鍛冶屋",
		    "大君主",
		    "パトリキ/エンポリウム",
		    "生贄",
		    "開拓者/騒がしい村",
		    "神殿",
		    "ヴィラ",
		    "ワイルドハント",
		    "城",
		    "アヴァント/サウナ");
$eventcords=array("意外な授かり物",
		  "宴会",
		  "凱旋",
		  "儀式",
		  "寄付",
		  "掘進",
		  "結婚式",
		  "昇進",
		  "制圧",
		  "征服",
		  "大地への塩まき",
		  "徴税",
		  "併合");
$randcords=array("狼の巣",
		 "オベリスク",
		 "凱旋門",
		 "果樹園",
		 "壁",
		 "宮殿",
		 "汚された神殿",
		 "公会堂",
		 "山賊の砦",
		 "水道橋",
		 "戦場",
		 "搭",
		 "闘技場",
		 "峠",
		 "砦",
		 "博物館",
		 "噴水",
		 "墓標",
		 "迷宮",
		 "浴場",
		 "列柱");
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
    for($i=0;$i<10;$i++){
	$randnum=rand(0,3);
    	$boxnum[1][$randnum]++;
    }
    $kihonbox="【基】";$inboubox="【陰】";$umibebox="【海】";$ikyoubox="【異】";
    $keys=array_keys($kihoncords);
    shuffle($keys);
	for($i=0;$i<$boxnum[1][0];$i++){
		$kihonbox=$kihonbox.$kihoncords[$keys[$i]].",";
	}
    $keys=array_keys($inboucords);
    shuffle($keys);
	for($i=0;$i<$boxnum[1][1];$i++){
		$inboubox=$inboubox.$inboucords[$keys[$i]].",";
	}
    $keys=array_keys($ikyoucords);
    shuffle($keys);
	for($i=0;$i<$boxnum[1][2];$i++){
		$ikyoubox=$ikyoubox.$ikyoucords[$keys[$i]].",";
	}
    $keys=array_keys($umibecords);
    shuffle($keys);
	for($i=0;$i<$boxnum[1][3];$i++){
		$umibebox=$umibebox.$umibecords[$keys[$i]].",";
	}
  $response_format_text = [
    "type" => "template",
    "altText" => "こちらのオリジナルメニューはいかがですか？",
    "template" => [
      "type" => "buttons",
      "title" => "基本".$boxnum[1][0]."陰謀".$boxnum[1][1]."異郷".$boxnum[1][2]."海辺".$boxnum[1][3],
      "text" => $kihonbox.$inboubox.$ikyoubox.$umibebox,
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
	for($i=0;$i<10;$i++){
	$randnum=rand(0,4);
    	$boxnum[1][$randnum]++;
    }
    $kihonbox="【基】";$inboubox="【陰】";$umibebox="【海】";$ikyoubox="【異】";$teikokubox="【帝】";
    $eventbox="【イベ】";$randbox="【ランド】";
    $keys=array_keys($kihoncords);
    shuffle($keys);
	for($i=0;$i<$boxnum[1][0];$i++){
		$kihonbox=$kihonbox.$kihoncords[$keys[$i]].",";
	}
    $keys=array_keys($inboucords);
    shuffle($keys);
	for($i=0;$i<$boxnum[1][1];$i++){
		$inboubox=$inboubox.$inboucords[$keys[$i]].",";
	}
    $keys=array_keys($ikyoucords);
    shuffle($keys);
	for($i=0;$i<$boxnum[1][2];$i++){
		$ikyoubox=$ikyoubox.$ikyoucords[$keys[$i]].",";
	}
    $keys=array_keys($umibecords);
    shuffle($keys);
	for($i=0;$i<$boxnum[1][3];$i++){
		$umibebox=$umibebox.$umibecords[$keys[$i]].",";
	}
    $keys=array_keys($teikokucords);
    shuffle($keys);
	for($i=0;$i<$boxnum[1][4];$i++){
		$teikokubox=$teikokubox.$teikokucords[$keys[$i]].",";
	}
    $keys=array_keys($eventcords);
    shuffle($keys);
	for($i=0;$i<1;$i++){
		$eventbox=$eventbox.$eventcords[$keys[$i]].",";
	}
    $keys=array_keys($randcords);
    shuffle($keys);
	for($i=0;$i<1;$i++){
		$randbox=$randbox.$randcords[$keys[$i]].",";
	}
  $response_format_text = [
    "type" => "template",
    "altText" => "サプライを表示しています",
    "template" => [
      "type" => "carousel",
      "columns" => [
          [
            "title" => "基本".$boxnum[1][0]."陰謀".$boxnum[1][1]."海辺".$boxnum[1][3],
            "text" => $kihonbox."\n".$inboubox."\n".$umibebox,
            "actions" => [
              [
            "type" => "message",
            "label" => "もっかい",
            "text" => "シャム"
          ]
            ]
          ],
          [
            "title" => "異郷".$boxnum[1][2]."帝国".$boxnum[1][4],
            "text" => $ikyoubox."\n".$teikokubox,
            "actions" => [
              [
            "type" => "message",
            "label" => "もっかい",
            "text" => "シャム"
              ]
            ]
          ],
	  [
            "title" => "イベント1ランドマーク1",
            "text" => $eventbox."\n".$randbox,
            "actions" => [
              [
            "type" => "message",
            "label" => "もっかい",
            "text" => "シャム"
              ]
            ]
          ],
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
