<?php

class withdrawValidation {

    // error_messageプロパティの宣言
    private $error_message;

    // // withdrawMoneyのバリデーションチェックです。
    public function checkWithdraw($input, $balance) {
        if(empty($input)) {
            // getErrorMessage実装にエラーメッセージの格納を実装
            $this->error_message = "半角数値で入金額を入力してください。" . PHP_EOL;
            // return $this->error_message;
            return false;
        }
        if(!is_int($input)) {
            // getErrorMessage実装にエラーメッセージの格納を実装
            $this->error_message = "半角数値で入金額を入力してください。" . PHP_EOL;
            // return $this->error_message;
            return false;
        }
        if($input <= 0) {
            // getErrorMessage実装にエラーメッセージの格納を実装
            $this->error_message = "0より大きい数値を入力してください" . PHP_EOL;
            // return $this->error_message;
            return false;
        }
        if($input > $balance) {
            // getErrorMessage実装にエラーメッセージの格納を実装
            $this->error_message = "出金額が残高を超えています。残高以下の数値を入力してください。" . PHP_EOL;
            $this->error_message .= "残高：" . $balance . PHP_EOL;
            // return $this->error_message;
            return false;
        }

        return true;
    }

    public function getErrorMessage() {
        return $this->error_message;
    }

}