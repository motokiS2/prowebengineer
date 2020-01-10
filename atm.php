<?php

class ATM {
    // 残高の初期化
    private $balance = 10000;

    // 入力値を定数に持たせました。
    const COMMAND_TYPE_DEPOSIT = 1;
    const COMMAND_TYPE_WITHDRAW = 2;
    const COMMAND_TYPE_BALANCE = 3;
    const INPUT_TYPE_SELECT_METHOD = "select";
    const INPUT_TYPE_DEPOSIT = "deposit";
    const INPUT_TYPE_WITHDRAW = "withdraw";
    // y/nの値に定数を持たせました。
    const CONTINUE_YES = "y";
    const CONTINUE_NO = "n";

    function __construct() {
        echo "いらっしゃいませ。";
    }

    // 操作を選ぶメソッド
    public function mainMethod() { // selectMethodからmainMethodへ名前を変更し、位置を変更しました。
        echo "ご希望の操作をご選択ください" . PHP_EOL;
        echo "1:入金 2:出金 3:残高照会" . PHP_EOL;
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
        $input = intval(trim(fgets(STDIN)));

        switch($type) {
            case "select":
                $check = $this->checkSelect($input);
                break;
            case "deposit":
                $check = $this->checkDeposite($input);
                break;
            case "withdraw":
                $check = $this->checkWithdraw($input);
                break;
        }
        if(!$check) {
            return $this->input($type);
        }
        return $input;
    }

    // continueOperateのバリデーションチェック
    private function checkContinue($input) {
        if(empty($input)) {
            return false;
        }
        // yかnが入力されていること
        if($input === self::CONTINUE_YES || $input === self::CONTINUE_NO) {
            return true;
        }
        return false;
    }

    // mainMethodのバリデーションチェック
    private function checkSelect($input) {
        if(empty($input)) {
            echo "入力は'1','2','3'で入力してください。" . PHP_EOL;
            return false;
        }
        // 1,2,3が入力されていること
        if($input === self::COMMAND_TYPE_DEPOSIT || $input === self::COMMAND_TYPE_WITHDRAW || $input === self::COMMAND_TYPE_BALANCE ) {
            return true;
        }
        echo "入力は'1','2','3'で入力してください。" . PHP_EOL;
        return false;
    }

    // 入金と出金のバリデーションチェックを分けて作成しました。
    // 入金額のバリデーションチェック
    private function checkDeposite($input) {
        if(empty($input)) {
            return false;
        }
        if(is_int($input)) {
            return true;
        } else {
            echo "半角数値で入金額を入力してください。" . PHP_EOL;
            false;
        }
    }

    // 出金額のバリデーションチェック
    private function checkWithdraw($input) {
        if(empty($input)) {
            return false;
        }
        if(!is_int($input)) {
            echo "半角数値で入金額を入力してください。" . PHP_EOL;
            return false;
        }
        if($input <= $this->balance) {
            return true;
        } elseif($input > $this->balance) {
            echo "出金額が残高を超えています。残高以下の数値を入力してください。" . PHP_EOL;
            echo "残高：" . $this->balance . PHP_EOL;
            return false;
        }
    }

    // 入金動作のメソッド
    private function depositeMoney() {
        echo "ご希望の入金額を入力ください" . PHP_EOL;
        $deposite = $this->input(self::INPUT_TYPE_DEPOSIT);

        // 取引操作
        $this->balance += $deposite;
        echo "入金が完了しました。" . PHP_EOL;
        echo "入金額：" . $deposite . "円" . PHP_EOL;
        echo "残高  ：" . $this->balance . "円" . PHP_EOL;
        $this->continueOparate();
    }

    // 出金動作のメソッド
    private function withdrawMoney() {
        echo "ご希望の出金額を入力ください" . PHP_EOL;
        $withdraw = $this->input(self::INPUT_TYPE_WITHDRAW);

        // 取引操作
        $this->balance -= $withdraw;
        echo "出金が完了しました。" . PHP_EOL;
        echo "出金額：" . $withdraw . "円" . PHP_EOL;
        echo "残高  ：" . $this->balance . "円" . PHP_EOL;
        $this->continueOparate();
    }

    // 残高確認のメソッド
    private function checkBalanceMoney() {
        echo "残高は" . $this->balance . "円です。" . PHP_EOL;
        $this->continueOparate();
    }

    // 操作を続けるか終了するか選ぶメソッド
    public function continueOparate() {
        echo "操作を続けますか？(y/n)" . PHP_EOL;
        $input = trim(fgets(STDIN));
        $check = $this->checkContinue($input);
        if(!$check) {
            // 再入力をさせる
            echo "入力は'y'か'n'を入力してください。" . PHP_EOL;
            return $this->continueOparate();
        }
        if($input === self::CONTINUE_YES) {
            return $this->mainMethod();
        } elseif($input === self::CONTINUE_NO) {
            echo "終了します。ご利用ありがとうございました。" . PHP_EOL;
            exit;
        }
    }
}

$atm = new ATM();
$atm->mainMethod();