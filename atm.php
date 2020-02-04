<?php

require_once('./validation/selectValidation.php');
require_once('./validation/depositValidation.php');
require_once('./validation/withdrawValidation.php');
require_once('./validation/inputIdValidation.php');
require_once('./validation/inputPasswordValidation.php');
require_once('./validation/continueValidation.php');
require_once('./validation/errorMessage.php');
require_once('./validation/userValidation.php');

class ATM {
    // user変数の宣言 staticを外しました
    public $user;

    // balanceプロパティを削除し、$user["balance"]に変更しました。

    // 入力値を定数に持たせました。
    const COMMAND_TYPE_DEPOSIT = 1;
    const COMMAND_TYPE_WITHDRAW = 2;
    const COMMAND_TYPE_BALANCE = 3;
    const INPUT_TYPE_SELECT_METHOD = "select";
    const INPUT_TYPE_DEPOSIT = "deposit";
    const INPUT_TYPE_WITHDRAW = "withdraw";
    const INPUT_TYPE_LOGINID = "id";
    const INPUT_TYPE_CONTINUE = "continue";
    const INPUT_TYPE_PASSWORD = "password";
    // y/nの値を定数に持たせました。
    const CONTINUE_YES = "y";
    const CONTINUE_NO = "n";

    function __construct() {
        echo "いらっしゃいませ。" . PHP_EOL;
        // ログイン
        $this->login();
    }

    // login用のメソッドを作成しました。
    public function login() {
        // Userクラスのインスタンス化
        $checkUserList = new User();
        $userValidation = new userValidation();

        //id入力
        echo "お客様のIDをご入力ください。" . PHP_EOL;
        $inputId = $this->input(self::INPUT_TYPE_LOGINID);
        //Userクラスのユーザーリストにidがあるかチェック
        $check = $userValidation->checkUserId($inputId);
            //なければエラー、再帰関数
        if(!$check) {
            return $this->login();
        }
        // else文を削除しました。
        $inputId = intval($inputId);

        //Userクラスから指定されたユーザー取得
        // $user = User::findById($inputId); パスワード一致後に取得に変更

        //パスワード取得
        echo "パスワードを入力してください。" . PHP_EOL;
        $password = $this->input(self::INPUT_TYPE_PASSWORD);

        //取得したユーザーのパスワードと入力値が一致するかチェック
        $check = $userValidation->checkPassword($inputId, $password);

            //なければエラー、再帰関数
        if(!$check) {
            // エラー文はcheck~メソッドで表示に統一しました。
            return $this->login();
        }

        //問題なければ、プロパティの$userにセット
        $this->user = $checkUserList->findById($inputId);
    }

    // 操作を選ぶメソッド
    public function mainMethod() { // selectMethodからmainMethodへ名前を変更し、位置を変更しました。
        echo $this->user["name"] . "様、ご利用ありがとうございます。ご希望の操作をご選択ください" . PHP_EOL;
        // 定数を用いた表現に変更しました
        echo self::COMMAND_TYPE_DEPOSIT . ":入金 " . self::COMMAND_TYPE_WITHDRAW . ":出金 " . self::COMMAND_TYPE_BALANCE . ":残高照会" . PHP_EOL;
        $input = $this->input(self::INPUT_TYPE_SELECT_METHOD); // 作成した標準入力のメソッドを使用しました。

        // 定義した定数に合わせて条件式を変更しました。
        if($input === self::COMMAND_TYPE_DEPOSIT) {
            return $this->depositeMoney();
        } elseif($input === self::COMMAND_TYPE_WITHDRAW) {
            return $this->withdrawMoney();
        } elseif($input === self::COMMAND_TYPE_BALANCE) {
            return $this->checkBalanceMoney();
        }
    }

    // 標準入力のメソッドを作成しました。
    public function input($type) {

        // 全てのインスタンスを作成するのではなく$typeの値によってクラスを生成するよう変更しました。
        // $selectValidation = new selectValidation();
        // $depositValidation = new depositValidation();
        // $withdrawValidation = new withdrawValidation();
        // $inputIdValidation = new inputIdValidation();
        // $inputPasswordValidation = new inputPasswordValidation();
        // $continueValidation = new continueValidation();
        $errorMessage = new errorMessage();
        $msg = "";

        switch($type) {
            case "select":
                $input = intval(trim(fgets(STDIN)));
                $validation = new selectValidation();
                $check = $validation->checkSelect($input);
                break;
            case "deposit":
                $input = intval(trim(fgets(STDIN)));
                $validation = new depositValidation();
                $check = $validation->checkDeposite($input);
                break;
            case "withdraw":
                $input = intval(trim(fgets(STDIN)));
                // ユーザー情報を引数で渡し値のチェックを行うように変えました]
                $validation = new withdrawValidation();
                $check = $validation->checkWithdraw($input, $this->user["balance"]);
                break;
            case "id":
                $input = intval(trim(fgets(STDIN)));
                $validation = new inputIdValidation();
                $check = $validation->checkInputId($input);
                $input = strval($input);
                break;
            case "password":
                $input = intval(trim(fgets(STDIN)));
                $validation = new inputPasswordValidation();
                $check = $validation->checkInputPassword($input);
                $input = strval($input);
            break;
            case "continue":
                $input = trim(fgets(STDIN));
                $validation = new continueValidation();
                $check = $validation->checkContinue($input);
            break;
        }
        // エラー文をATMメソッドで出力するにあたってエラーメッセージがあるかどうかで真偽を確認する方法に変えました。
        // if($msg !== "") {
        //     echo $msg . PHP_EOL;
        //     return $this->input($type);
        // }
        // $checkにて[true,false]の判定をしfalseであれば$msgにエラーメッセージを格納、出力を行う用に変えました
        if($check === false) {
            $msg = $errorMessage->getErrorMessage($type, $input, $this->user["balance"]);
            echo $msg . PHP_EOL;
            return $this->input($type);
        }

        return $input;
    }



    // mainMethodのバリデーションチェック
    // checkvalidation.phpに移動しました。


    // 入金と出金のバリデーションチェックを分けて作成しました。
    // 入金額のバリデーションチェック
    // if文の流れを変更しました。
    // checkvalidation.phpに移動しました。


    // 出金額のバリデーションチェック
    // if文の流れを変更しました。
    // checkvalidation.phpに移動しました。


    // ログインIDのバリデーションチェック
    // if文の流れを変更しました。
    // checkvalidation.phpに移動しました。


    // パスワード入力値のバリデーションチェックを作成しました
    // checkvalidation.phpに移動しました。


    // continueOperateのバリデーションチェック
    // checkvalidation.phpに移動しました。


    // 入金動作のメソッド
    private function depositeMoney() {
        echo "ご希望の入金額を入力ください" . PHP_EOL;
        $deposite = $this->input(self::INPUT_TYPE_DEPOSIT);

        // 取引操作
        $this->user["balance"] += $deposite;
        echo "入金が完了しました。" . PHP_EOL;
        echo "入金額：" . $deposite . "円" . PHP_EOL;
        echo "残高  ：" . $this->user["balance"] . "円" . PHP_EOL;
        $this->continueOparate();
    }

    // 出金動作のメソッド
    private function withdrawMoney() {
        echo "ご希望の出金額を入力ください" . PHP_EOL;
        $withdraw = $this->input(self::INPUT_TYPE_WITHDRAW);

        // 取引操作
        $this->user["balance"] -= $withdraw;
        echo "出金が完了しました。" . PHP_EOL;
        echo "出金額：" . $withdraw . "円" . PHP_EOL;
        echo "残高  ：" . $this->user["balance"] . "円" . PHP_EOL;
        $this->continueOparate();
    }

    // 残高確認のメソッド
    private function checkBalanceMoney() {
        echo "残高は" . $this->user["balance"] . "円です。" . PHP_EOL;
        $this->continueOparate();
    }

    // 操作を続けるか終了するか選ぶメソッド
    public function continueOparate() {
        echo "操作を続けますか？(" . self::CONTINUE_YES . "/" . self::CONTINUE_NO . ")" . PHP_EOL;
        $input = $this->input(self::INPUT_TYPE_CONTINUE);

        if($input === self::CONTINUE_YES) {
            return $this->mainMethod();
        } elseif($input === self::CONTINUE_NO) {
            echo "終了します。ご利用ありがとうございました。" . PHP_EOL;
            exit;
        }
    }
}

// Userクラスを追加しました。
class User {
    public static $user_list = array(
        1 => array(
            "id" => "1",
            "password" => "1111",
            "name" => "sato",
            "balance" => "200000"
        ),
        2 => array(
            "id" => "2",
            "password" => "2222",
            "name" => "suzuki",
            "balance" => "2000"
        ),
        3 => array(
            "id" => "3",
            "password" => "3333",
            "name" => "watanabe",
            "balance" => "1000000"
        )
    );

    public function findById($inputId) {
        return self::$user_list[$inputId];
    }

    // // ATMメソッドで入力されたIDが$user_listにあるかを確認する
    // public function checkUserId($inputId) {
    //     for($i = 1; $i <= count(self::$user_list); $i++) {
    //         if($inputId === self::$user_list[$i]["id"]) {
    //             return true;
    //         }
    //     }
    //     echo "登録されていないIDです。" . PHP_EOL;
    //     return false;
    // }

    // public function checkPassword($inputId, $password) {
    //     if($password === self::$user_list[$inputId]["password"]) {
    //         return true;
    //     } else {
    //         echo "パスワードが誤っています。もう一度やり直してください。" . PHP_EOL;
    //         return false;
    //     }
    // }

}

$atm = new ATM();
$atm->mainMethod();