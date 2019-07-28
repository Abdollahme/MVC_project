<?php
require('controler/AccountsUsersManagerController.php');

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
