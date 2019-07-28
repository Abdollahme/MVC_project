<?php
session_start();

require_once('model/AccountsUsersManager.php');
require_once('model/ChatManager.php');

function acceuil()
{
    header('Location: view/accountuser/login.php');
}

function login()
{
    $acountsusersManager = new MVC_project\model\AccountsUsersManager();
    $loginsuccess = $acountsusersManager->login();

    if($loginsuccess)
    {
        $_SESSION['login'] = htmlspecialchars($_POST['login']);
        $_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];

        header('Location: view/chat/chat.php');

    }elseif($loginsuccess == 2){
        echo 'Erreur : vous êtez déjà connectés !';

    }else
    {
        echo 'Mot de passe incorrecte';
    }
}
function post()
{

    $postManager = new MVC_project\model\ChatManager();
    $postManager->post();
    header('Location: view/chat/chat.php');
}


function register()
{

    $acountsusersManager = new MVC_project\model\AccountsUsersManager();
    $registersuccess = $acountsusersManager->register();

    switch($registersuccess){
    case 0:
    {
        echo 'Ce pseudo existe déjà !';
        header('Location: view/accountuser/register.php');
        break;
    }
    case 1:
    {
        header('Location: view/accountuser/login.php');
        break;
    }
    case 2:
    {
        echo 'Cet email existe déja !';
        header('Location: view/accountuser/register.php');
        break;

    }
    case 3:
    {
        echo 'mot de passe de confirmation incorrecte !';
        header('Location: view/accountuser/register.php');
        break;
    }
    }


}
function message()
{

    $messageManager = new MVC_project\model\ChatManager();
    $messageManager->message();

}
function status()
{

    $statusManager = new MVC_project\model\ChatManager();
    $statusManager->status();

}

function state()
{

    $statusManager = new MVC_project\model\ChatManager();
    $statusManager->state();
    header('Location: view/chat/chat.php');

}

function deconnexion()
{

    $deconnexion= new MVC_project\model\AccountsUsersManager();
    $deconnexion->delete_user($_SESSION["ip"]);
    $deconnexion->deconnexion();
    header('Location: view/accountuser/login');

}

