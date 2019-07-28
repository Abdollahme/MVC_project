<?php
require('controler/AccountsUsersManagerController.php');

try {
    if (isset($_GET['action'])) {

        switch($_GET['action']){
            case 'login':
            {
                login();
                break;
            }
            case 'register':
            {

                register();
                break;
            }
            case 'post':
            {
                post();
                break;
            }
            case 'message':
            {

                message();
                break;
            }
            case 'status':
            {

                status();
                break;
            }
            case 'state':
            {

                state();
                break;
            }
            case 'deconnexion':
            {

                deconnexion();
                break;
            }
        }
    }else
    {
        acceuil();
    }



 /*   if (isset($_GET['action'])) {
        if ($_GET['action'] == 'listPosts') {
            listPosts();
        }
        elseif ($_GET['action'] == 'post') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                post();
            }
            else {
                
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        }
        elseif ($_GET['action'] == 'addComment') {

            if (isset($_GET['id']) && $_GET['id'] > 0) {

                if (!empty($_POST['author']) && !empty($_POST['comment'])) {
                    addComment($_GET['id'], $_POST['author'], $_POST['comment']);
                }
                else {
                   
                    throw new Exception('Tous les champs ne sont pas remplis !');
                }
            }
            else {
               
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        }
        elseif ($_GET['action'] == 'modify') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                showComment();   
            }
            else {
                throw new Exception('Aucun identifiant de commentaire envoyé');
            }
        }
        elseif ($_GET['action'] == 'modifyComment'){
            if(!empty($_POST['comment'])){
               modifyComment($_POST['comment'], $_GET['id']); 
            }
            else {
                throw new Exception('Tous les champs ne sont pas remplis !');
            }
                
        }
    }
    else {
        listPosts();
    }*/
}
catch(Exception $e) {
    $errorMessage = $e->getMessage();
    require('view/errorView.php');
}
