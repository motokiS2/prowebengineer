<?php

const HAND_TYPE = array(1 => "グー", 2 => "チョキ", 3 => "パー"); // 定数を用いてじゃんけんの手を宣言しました。

// じゃんけんの手を入力をチェック
function checkHand($hand) {
    if(empty($hand)) {
        return false;
    }
    // 1,2,3が入力されていること
    if($hand === 1 || $hand === 2 || $hand === 3 ) {
        return true;
    }
    return false;
}

// 再度ジャンケンするかどうかの入力をチェック
function checkReplay($input) {
    if(empty($input)) {
        return false;
    }
    // 1,2が入力されていること
    if($input === 1 || $input === 2) {
        return true;
    }
    return false;
}

function selectHand() { // 自分の手を出す関数を作成しました
    fscanf(STDIN, "%d", $input);
    $check = checkHand($input);
    if(!$check) {
        //再度入力させる
        echo "出す手は1,2,3から選んでください。" . PHP_EOL;
        return selectHand();
    }
    return $input;
}

function getComHand() { // 相手の出す手を決める関数を作成しました。
    return mt_rand(1, 3);
}

function judgeJanken($yourHand, $rivalHand) { // 勝敗を変数に格納されている値で判断するようにしました。
    $judge = ($yourHand - $rivalHand + 3) % 3;  // 条件式に使用する変数を追加しました。
    switch($judge) { // if文からswitch文に変更しました。
        case 1:
            echo "あなたの負けです。" . PHP_EOL;
            return replayJanken(); // 再度ジャンケンするかどうかを決めます。
            break;
        case 2:
            echo "あなたの勝ちです" . PHP_EOL;
            return replayJanken();
            break;
        case 0:
            echo "あいこで・・・" . PHP_EOL;
            return playJanken();
    }
}

function playJanken() {
    echo "1:". HAND_TYPE[1] ." 2:" . HAND_TYPE[2] . " 3:". HAND_TYPE[3] . PHP_EOL;
    // 入力値によって出す手を決める&バリデーションチェックをする　定数を用いて出す手を表現しました。
    $yourHand = selectHand();
    // 相手の出す手をランダムに決める
    $rivalHand = getComHand();
    echo "ポン！！！" . PHP_EOL;
    echo "あなたの手:" . HAND_TYPE[$yourHand] . PHP_EOL; // HAND_TYPEの宣言をしたのでHAND_TYPEを用いて出す手を出力させます。
    echo "あいての手:" . HAND_TYPE[$rivalHand] . PHP_EOL;
    // 勝負を判定:勝ち、負け、あいこ
    judgeJanken($yourHand, $rivalHand);
}

function replayJanken() { // 再度ジャンケンするかどうか決める関数を作成しました。
    echo "もう一度ジャンケンしますか？" . PHP_EOL;
    echo "する:1　しない:2" . PHP_EOL;
    fscanf(STDIN, "%d", $input);
    $check = checkReplay($input);
    if(!$check) {
        echo "1か2を入力してください。" . PHP_EOL;
        return replayJanken();
    }
    if($input === 1) {
        echo "最初は" . HAND_TYPE[1] . "！ ジャンケン・・・" . PHP_EOL;
        return playJanken();
    } else if($input === 2) {
        echo "終了します。";
    }
}

echo "最初は" . HAND_TYPE[1] . "！ ジャンケン・・・" . PHP_EOL; //　グーを定数を用いて表現しなおしました。

playJanken();

?>