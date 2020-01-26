<?php

// バリデーション用のクラスを別ファイルに作成しました。
class checkValidation {

    // エラーメッセージを格納するプロパティを作成しました。
    public $error_message = "";

    // // mainMethod用のバリデーションチェックです。
    public function checkSelect($input) {
        if(empty($input)) {
            $this->error_message = "入力は'". ATM::COMMAND_TYPE_DEPOSIT ."','" . ATM::COMMAND_TYPE_WITHDRAW . "','" . ATM::COMMAND_TYPE_BALANCE . "'で入力してください。" . PHP_EOL;
            return $this->error_message;
        }
        // 1,2,3が入力されていること
        // 定数を用いた表現に修正しました
        if($input !== ATM::COMMAND_TYPE_DEPOSIT && $input !== ATM::COMMAND_TYPE_WITHDRAW && $input !== ATM::COMMAND_TYPE_BALANCE ) {
            $this->error_message = "入力は'". ATM::COMMAND_TYPE_DEPOSIT ."','" . ATM::COMMAND_TYPE_WITHDRAW . "','" . ATM::COMMAND_TYPE_BALANCE . "'で入力してください。" . PHP_EOL;
            return $this->error_message;
        }

        return $this->error_message;
    }

    // // depositMoneyのバリデーションチェックです。
    public function checkDeposite($input) {
        if(empty($input)) {
            $this->error_message = "半角数値で入金額を入力してください。" . PHP_EOL;
            return $this->error_message;
        }
        if(is_int($input) === false) {
            $this->error_message = "半角数値で入金額を入力してください。" . PHP_EOL;
            return $this->error_message;
        }
        if($input <= 0) {
            $this->error_message = "0より大きい数値を入力してください" . PHP_EOL;
            return $this->error_message;
        }

        return $this->error_message;
    }

    // // withdrawMoneyのバリデーションチェックです。
    public function checkWithdraw($input, $balance) {
        if(empty($input)) {
            $this->error_message = "半角数値で入金額を入力してください。" . PHP_EOL;
            return $this->error_message;
        }
        if(!is_int($input)) {
            $this->error_message = "半角数値で入金額を入力してください。" . PHP_EOL;
            return $this->error_message;
        }
        if($input <= 0) {
            $this->error_message = "0より大きい数値を入力してください" . PHP_EOL;
            return $this->error_message;
        }
        if($input > $balance) {
            $this->error_message = "出金額が残高を超えています。残高以下の数値を入力してください。" . PHP_EOL;
            $this->error_message .= "残高：" . $balance . PHP_EOL;
            return $this->error_message;
        }

        return $this->error_message;
    }

    // // loginのバリデーションチェックです。
    public function checkInputId($input) {
        if(empty($input)) {
            $this->error_message = "IDは半角数値で入力してください。" . PHP_EOL;
            return $this->error_message;
        }
        if(is_int($input) === false) {
            $this->error_message = "IDは半角数値で入力してください。2" . PHP_EOL;
            return $this->error_message;
        }

        return $this->error_message;
    }

    // // login(password)のバリデーションチェックです。
    public function checkInputPassword($input) {
        if(empty($input)) {
            $this->error_message = "パスワードはは半角数値4桁で入力してください。" . PHP_EOL;
            return $this->error_message;
        }
        if(is_int($input) === false) {
            $this->error_message = "パスワードはは半角数値4桁で入力してください。" . PHP_EOL;
            return $this->error_message;
        }
        if(strlen($input) !== 4) {
            $this->error_message = "パスワードはは半角数値4桁で入力してください。" . PHP_EOL;
            return $this->error_message;
        }

        return $this->error_message;
    }

    // // // continueOperateのバリデーションチェックです。
    public function checkContinue($input) {
        if(empty($input)) {
            $this->error_message = "入力は'" . ATM::CONTINUE_YES . "'か'" . ATM::CONTINUE_NO . "'を入力してください。" . PHP_EOL;
            return $this->error_message;
        }
        // yかnが入力されていること
        if($input !== ATM::CONTINUE_YES && $input !== ATM::CONTINUE_NO) {
            $this->error_message = "入力は'" . ATM::CONTINUE_YES . "'か'" . ATM::CONTINUE_NO . "'を入力してください。" . PHP_EOL;
            return $this->error_message;
        }

        return $this->error_message;
    }


}


?>