<?php

class inputPasswordValidation {

    // error_messageプロパティの宣言
    private $error_message;

    // // login(password)のバリデーションチェックです。
    public function checkInputPassword($input) {
        if(empty($input)) {
            // getErrorMessage実装にエラーメッセージの格納を実装
            $this->error_message = "パスワードはは半角数値4桁で入力してください。" . PHP_EOL;
            // return $this->error_message;
            return false;
        }
        if(is_int($input) === false) {
            // getErrorMessage実装にエラーメッセージの格納を実装
            $this->error_message = "パスワードはは半角数値4桁で入力してください。" . PHP_EOL;
            // return $this->error_message;
            return false;
        }
        if(strlen($input) !== 4) {
            // getErrorMessage実装にエラーメッセージの格納を実装
            $this->error_message = "パスワードはは半角数値4桁で入力してください。" . PHP_EOL;
            // return $this->error_message;
            return false;
        }

        return true;
    }

    public function getErrorMessage() {
        return $this->error_message;
    }
}