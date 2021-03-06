<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 07-10-16
 * Time: 3:48 PM
 */

spl_autoload_register(function ($class) {


    if (strpos($class, "Base") === 0) {
        require 'Application/Framework/' . $class . '.php';
    } else if (strpos($class, "Model")) {
        require 'Application/Models/' . $class . '.php';
    } else if (strpos($class, "Object")) {
        require 'Application/Objects/' . $class . '.php';
    } else {
        require "Helper/" . $class . ".php";
    }

});
session_start();
if (isset($_SESSION["id"]) && isset($_SESSION["email"]) && isset($_SESSION["password"])) {

    $a = new UserModel();
    $jj = $a->Login($_SESSION["email"], $_SESSION["password"], $_SERVER["REMOTE_ADDR"]);

    if ($jj instanceof UserObject) {
        $expensesModel = new  UserExpenseModel();
        $incomeModel = new UserIncomeModel();
        $expenseList = $expensesModel->getExpenseByUserID($jj->ID);
        $incomeList = $incomeModel->getIncomeByUserID($jj->ID);


        /*CURRENT MONTH*/
        $CurrentMonthExpense = $expensesModel->getExpenseGroupByUserIDAndMonth($jj->ID, date('m'));
        $CurrentMonthIncome = $incomeModel->getIncomeGroupByUserIDAndMonth($jj->ID, date('m'));
        $CurrentMonthTotalIncome = 0;
        $CurrentMonthTotalExpense = 0;
        foreach ($CurrentMonthExpense as $k =>$v){$CurrentMonthTotalExpense+=$v;}
        foreach ($CurrentMonthIncome as $k =>$v){$CurrentMonthTotalIncome+=$v;}

        /*LAST MONTH*/
        $LastMonthExpense = $expensesModel->getExpenseGroupByUserIDAndMonth($jj->ID, date('m')-1);
        $LastMonthIncome = $incomeModel->getIncomeGroupByUserIDAndMonth($jj->ID, date('m')-1);
        $LastMonthTotalIncome = 0;
        $LastMonthTotalExpense = 0;
        foreach ($LastMonthExpense as $k =>$v){$LastMonthTotalExpense+=$v;}
        foreach ($LastMonthIncome as $k =>$v){$LastMonthTotalIncome+=$v;}

        /*LAST LAST MONTH*/
        $LastLastMonthExpense = $expensesModel->getExpenseGroupByUserIDAndMonth($jj->ID, date('m')-2);
        $LastLastMonthIncome = $incomeModel->getIncomeGroupByUserIDAndMonth($jj->ID, date('m')-2);
        $LastLastMonthTotalIncome = 0;
        $LastLastMonthTotalExpense = 0;
        foreach ($LastLastMonthExpense as $k =>$v){$LastLastMonthTotalExpense+=$v;}
        foreach ($LastLastMonthIncome as $k =>$v){$LastLastMonthTotalIncome+=$v;}


        $calendarIncome = $incomeModel->getEveryDayTotalIncomeByUserID($jj->ID);
        $calendarExpense = $expensesModel->getEveryDayTotalExpenseByUserID($jj->ID);


      require 'Application/Views/overviewDemo.html';




} else {
    echo "Error!" . mysql_error();
    session_unset();
    session_destroy();
    require 'Application/Views/index.html';
}

// echo "已登录";
} else {
    session_unset();
    session_destroy();
    require 'Application/Views/index.html';
    // echo "未登录";
    //echo "请重新登录";
}