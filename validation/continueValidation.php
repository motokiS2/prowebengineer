<?php

class continueValidation {

    // error_messageプロパティの宣言
    private $error_message;

    // continueOperateのバリデーションチェックです。
    public function checkContinue($input) {
        if(empty($input)) {
            // getErrorMessage実装にエラーメッセージの格納を実装
            $this->error_message = "入力は'" . ATM::CONTINUE_YES . "'か'" . ATM::CONTINUE_NO . "'を入力してください。" . PHP_EOL;
            // return $this->error_message;
            return false;
        }
        // yかnが入力されていること
        if($input !== ATM::CONTINUE_YES && $input !== ATM::CONTINUE_NO) {
            // getErrorMessage実装にエラーメッセージの格納を実装
            $this->error_message = "入力は'" . ATM::CONTINUE_YES . "'か'" . ATM::CONTINUE_NO . "'を入力してください。" . PHP_EOL;
            // return $this->error_message;
            return false;
        }

        return true;
    }

    public function getErrorMessage() {
        return $this->error_message;
    }
}