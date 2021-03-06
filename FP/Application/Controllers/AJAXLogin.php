<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 25-09-16
 * Time: 2:24 PM
 */

spl_autoload_register(function ($class) {


    if (strpos($class, "Base") === 0) {
        require '../Framework/' . $class . '.php';
    } else if (strpos($class, "Model")) {
        require '../Models/' . $class . '.php';
    } else if (strpos($class, "Object")) {
        require '../Objects/' . $class . '.php';
    } else {
        require "../../Helper/" . $class . ".php";
    }

});
session_start();
$email = $_POST["email"];
$password = $_POST["password"];
$loginIP = $_SERVER["REMOTE_ADDR"];

$a = new UserModel();
$jj = $a->Login($email, $password, $loginIP);

if ($jj instanceof UserObject) {
    if ($jj->EmailVerified == 1) {

        $_SESSION["id"] = $jj->ID;
        $_SESSION["email"] = $jj->Email;
        $_SESSION["password"] = $password;
        echo "LoginSuccess";
    } else {
        echo "EmailNoVerify";
    }

} else {
    echo "LoginFailed";
    // echo "Error!". mysql_error();
}