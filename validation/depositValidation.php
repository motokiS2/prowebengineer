<?php

class depositValidation {

    // error_messageプロパティの宣言
    private $error_message;

    // // depositMoneyのバリデーションチェックです。
    public function checkDeposite($input) {
        if(empty($input)) {
            // getErrorMessage実装にエラーメッセージの格納を実装
            $this->error_message = "半角数値で入金額を入力してください。" . PHP_EOL;
            // return $this->error_message;
            return false;
        }
        if(is_int($input) === false) {
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

        return true;
    }

    public function getErrorMessage() {
        return $this->error_message;
    }

}