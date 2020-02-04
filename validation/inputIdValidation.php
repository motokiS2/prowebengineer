<?php

class inputIdValidation {

    // error_messageプロパティの宣言
    private $error_message;


    // // loginのバリデーションチェックです。
    public function checkInputId($input) {
        if(empty($input)) {
            // getErrorMessage実装にエラーメッセージの格納を実装
            $this->error_message = "IDは半角数値で入力してください。" . PHP_EOL;
            // return $this->error_message;
            return false;
        }
        if(is_int($input) === false) {
            // getErrorMessage実装にエラーメッセージの格納を実装
            $this->error_message = "IDは半角数値で入力してください。2" . PHP_EOL;
            // return $this->error_message;
            return false;
        }

        return true;
    }

    public function getErrorMessage() {
        return $this->error_message;
    }

}