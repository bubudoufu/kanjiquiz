<?php
$questions = ['紫陽花', '百合', '薔薇', '秋桜', '水芭蕉', '石楠花', '蒲公英', '翌檜', '椿', '彼岸花', '酢橘', '白詰草', '鈴蘭', '鳳仙花', '薇', '百日紅', '千日紅', '山茶花', '阿列布', '薄荷', '蘆薈', '金木犀', '菫', '満天星', '虎杖', '万年青', '帚木', '蕨', '公孫樹', '木天蓼', '鬼灯', '大葉子', '椎茸', '湿地・占地', '木耳', '菖蒲', '雛罌粟', '独活', '枳殻', '蓬', '擬宝珠', '竜胆', '風信子', '柊', '燕子花', '椰子', '沙羅双樹', '紫苑', ' 含羞草', '紫蘇', '薊', '沈丁花', '仙人掌', '団栗', '朮', '木槿', '馬酔木', '梔子', '合歓木', '蕺草', '落葉松', '柘植', '咱夫藍', '山椒', '海松', '水雲', '勿忘草', '吾亦紅', '芹', '薺', '御形', '繁縷', '仏の座', '菘', '蘿蔔', '女郎花', '尾花', '桔梗', '撫子', '藤袴', '葛', '萩'];

/**
 * Yahoo! JAPAN Web APIのご利用には、アプリケーションIDの登録が必要です。
 * あなたが登録したアプリケーションIDを $appid に設定してお使いください。
 * アプリケーションIDの登録URLは、こちらです↓
 * http://e.developer.yahoo.co.jp/webservices/register_application
 */
$appid = ''; // <-- ここにあなたのアプリケーションIDを設定してください。
$url = 'http://jlp.yahooapis.jp/MAService/V1/parse?appid='.$appid.'&results=ma';
$r = array_rand($questions);
$url .= '&sentence='.urlencode($questions[$r]);
$xml  = simplexml_load_file($url);
$result = $xml->ma_result->word_list->word->reading;
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>植物の漢字クイズ</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1></h1>
    <h2></h2>
    <form onsubmit="return false;">
        <div>
            <input type="text" id="message" autocomplete="off"><br />
            <input type="button" onclick="send()" value="送信">
            <input type="reset" value="リセット">
            <input type="button" onclick="document.location.reload()" value="次の問題へ">
        </div>
    </form>
    <p>正解判定にはYahoo! JAPANが提供している日本語形態素解析APIを利用しています。</p>
    <!-- Begin Yahoo! JAPAN Web Services Attribution Snippet -->
    <a href="https://developer.yahoo.co.jp/sitemap/">
        <img src="https://s.yimg.jp/images/yjdn/yjdn_attbtn2_105_17.gif" width="105" height="17"
            title="Webサービス by Yahoo! JAPAN" alt="Webサービス by Yahoo! JAPAN" border="0"
            style="margin:4px 15px 15px 0px"></a>
    <!-- End Yahoo! JAPAN Web Services Attribution Snippet -->

    <script type="text/javascript">
    const question = "<?php echo $questions[$r];?>"; // 問題の漢字
    const answer = "<?php echo $result;?>"; // 正解のひらがな

    const h1 = document.querySelector("h1");
    h1.textContent = "次の漢字をひらがなで入力してください";
    const h2 = document.querySelector("h2");
    h2.textContent = question;

    // 送信ボタンが押された時の処理
    function send() {
        const textbox = document.getElementById("message").value; // テキストボックスに入力された文字
        // 正解か判定
        if (textbox === answer) {
            h1.textContent = "正解です！";
        } else {
            h1.textContent = "不正解です...";
        }
        h2.innerHTML = question + "(<span>" + answer + "</span>)"
    }
    </script>
</body>

</html>