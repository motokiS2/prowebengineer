<?php

class selectValidation {

    // error_messageプロパティの宣言
    private $error_message;

    // // mainMethod用のバリデーションチェックです。
    public function checkSelect($input) {
        if(empty($input)) {
            // getErrorMessage実装にエラーメッセージの格納を実装
            $this->error_message = "入力は'". ATM::COMMAND_TYPE_DEPOSIT ."','" . ATM::COMMAND_TYPE_WITHDRAW . "','" . ATM::COMMAND_TYPE_BALANCE . "'で入力してください。" . PHP_EOL;
            // return $this->error_message;
            return false;
        }
        // 1,2,3が入力されていること
        // 定数を用いた表現に修正しました
        if($input !== ATM::COMMAND_TYPE_DEPOSIT && $input !== ATM::COMMAND_TYPE_WITHDRAW && $input !== ATM::COMMAND_TYPE_BALANCE ) {
            // getErrorMessage実装にエラーメッセージの格納を実装
            $this->error_message = "入力は'". ATM::COMMAND_TYPE_DEPOSIT ."','" . ATM::COMMAND_TYPE_WITHDRAW . "','" . ATM::COMMAND_TYPE_BALANCE . "'で入力してください。" . PHP_EOL;
            // return $this->error_message;
            return false;
        }

        // return $this->error_message;
        return true;
    }

    public function getErrorMessage() {
        return $this->error_message;
    }
}