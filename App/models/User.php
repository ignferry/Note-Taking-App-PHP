<?php

namespace App\models;

require_once "core/Model.php";

use App\core\Model;

class User extends Model {
    protected string $tableName = "user";

    public static function isNameValid(string $name) {
        return strlen($name) >= 3 && strlen($name) <= 100 && ctype_alpha(str_replace(' ', '', $name));
    }

    public static function isEmailValid(string $email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL) && strlen($email) <= 255;
    }

    public static function isPasswordValid(string $password) {
        return strlen($password) >= 8 && strlen($password) <= 16;
    }
}

?>