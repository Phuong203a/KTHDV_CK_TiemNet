<?php
require_once 'debug.php';
session_start();
function redirectMainPageByRole($role_id)
{

    switch ($role_id){
        case 1:
            header('Location: admin.php');
            break;
        case 2:
            header('Location: Home.php');
            break;
        case 3:
            header('Location: Home.php');
            break;
    }
    exit();
}
function redirectToAdmin()
{
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === "true" && $_SESSION['id_role']==1) {
        header('Location: admin.php');
        exit();
    }
}
function checkLogin($isLoginPage = false)
{
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === "true") {
        if ($isLoginPage)
        {
            redirectMainPageByRole($_SESSION['id_role']);
            exit();
        }
    }
    else
    {
        header('Location: LoginAdmin.php');
        exit();
    }
}


?>