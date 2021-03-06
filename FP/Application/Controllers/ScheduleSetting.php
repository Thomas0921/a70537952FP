<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 03-11-16
 * Time: 11:42 AM
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
if (isset($_SESSION["id"]) && isset($_SESSION["email"]) && isset($_SESSION["password"])) {

    $userModel = new UserModel();
    $jj = $userModel->Login($_SESSION["email"], $_SESSION["password"], $_SERVER["REMOTE_ADDR"]);

    if ($jj instanceof UserObject) {
        $FixedExpenseModel = new UserFixedExpenseModel();
        $FixedIncomeModel = new UserFixedIncomeModel();

        $fixedExpenseList = $FixedExpenseModel->getFixedExpenseByUserID($jj->ID);
        $fixedIncomeList = $FixedIncomeModel->getFixedIncomeByUserID($jj->ID);
        require '../Views/ScheduleSetting.html';


    } else {
        echo "Error!" . mysql_error();
        session_unset();
        session_destroy();
        header("Location: ../../index.php");

    }

// echo "已登录";
} else {
    session_unset();
    session_destroy();
    header("Location: ../../index.php");
    // echo "未登录";
    //echo "请重新登录";
}