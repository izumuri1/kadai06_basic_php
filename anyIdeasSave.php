<?php
// ◆◆◆index.phpの入力フォーム（anyIdeas）から送信されたデータを受け取ってテキストファイルへ保存
$whenToDo = $_POST['whenToDo'];
$whoWith = $_POST['whoWith'];
$whatToDo = $_POST['whatToDo'];
$time = date('Y/m/d');
$anyIdeas = ($time.','.$whenToDo.','.$whoWith.','.$whatToDo."\n");
// ◆◆◆受け取ったデータをテキストファイルへ書き出して保存
file_put_contents('data/data.txt', $anyIdeas, FILE_APPEND);

// ◆◆◆index.php にリダイレクト
header("Location: index.php");
exit;

?>