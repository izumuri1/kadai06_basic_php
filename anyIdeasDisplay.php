<?php
// ◆anyIdeasデータのindex.phpへの表示：data.txtのanyIdeasデータを読み込み、JSON形式で返す（APIエンドポイント）


$data = [];
// ファイルが存在したら、処理する
if (file_exists('data/data.txt')) {
    // 組込関数（file）を使い、data.txtの改行を取り除き、空行を無視し、$linesに格納
    $lines = file('data/data.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    // $linesを$lineとして1行ごと読み取り、オブジェクトに変換する
    foreach ($lines as $line) {
        // 組込関数（explode）で$lineをカンマで分割し、構文（list）で配列各要素を変数に一括代入する
        list($time, $whenToDo, $whoWith, $whatToDo) = explode(',', $line);
        // $dataに$line1行ごと、カンマで区切ったデータを格納
        $data[] = [
            'time' => $time,
            'whenToDo' => $whenToDo,
            'whoWith' => $whoWith,
            'whatToDo' => $whatToDo
        ];
    }
    // 組込関数（usort）、無名関数（fn）、組込関数（strcmp）を使ってwhenToDoを昇順並び替え
    // usort＝司令塔、fn＝比較ルールの箱、strcmp＝実際の判定係
    // usort(第一引数：並べ替え対象の配列（ここでは $data）,第二：比較関数（2つの要素を受け取りどちらが先かを判断（ここではfn()）））
    // strcmp() は 2つの文字列を辞書順で比較する関数。この戻り値を usort() が使って、並べ替えの順序を決める
    usort($data, fn($a, $b) => strcmp($a['whenToDo'], $b['whenToDo']));
}

// ◆ PHPを簡易的なJSON APIとして使えるようにするコード
// PHPが出力するデータの種類を「JSON形式です」とブラウザやクライアントに伝えるための宣言
header('Content-Type: application/json');
// PHPの配列やオブジェクトをJSON形式の文字列に変換して出力する➡json_encode($data) をブラウザやAPIのレスポンスとして返す
echo json_encode($data);


?>