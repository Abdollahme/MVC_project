<?php
/**
 * Created by PhpStorm.
 * User: yassineelmaaroufi
 * Date: 27/07/2019
 * Time: 09:58
 */

namespace MVC_project\model;

require_once("Manager.php");


class AccountsUsersManager extends Manager
{

    public function register()
    {

        $verif_mail = $this->verif_mail();
        if ($verif_mail == true){
            $psw_verif = $this->psw_verif();
            if ($psw_verif == true)
            {
                $db=$this->dbConnect();
                $query=$db->prepare("SELECT * FROM accounts_users WHERE login = :login");
                $query->execute(array('login'=>htmlspecialchars($_POST['login'])));
                $count=$query->rowCount();
                if($count==0){
                    $insert=$db->prepare('
                  INSERT INTO accounts_users (login, password, mail, firstname, lastname)
                  VALUES(:login, :password, :mail, :firstname, :lastname)
                  ');
                    $insert->execute(array('login'=>htmlspecialchars($_POST['login']),'password'=>htmlspecialchars($_POST['password']),'mail'=>htmlspecialchars($_POST['email']),'firstname'=>htmlspecialchars($_POST['firstname']),'lastname'=>htmlspecialchars($_POST['lastname']),));
                    return 1;
                }else{
                    return 0;
                }
            }else
            {
                return 3;
            }

        }else{
            return 2;
        }

    }

    public function login()
    {

        $is_user_connect = $this->is_user_connect($_POST['login']);

        if ($is_user_connect == false) {
            $db = $this->dbConnect();

            $query = $db->prepare("SELECT password FROM accounts_users WHERE login = :login");
            $query->execute(array(
                'login' => htmlspecialchars($_POST['login'])
            ));


            $mdp = $query->fetchColumn();
            if($mdp == $_POST['password'])
            {

                $this->user_connect($_SERVER['REMOTE_ADDR'], $_POST['login']);
                $this->maj_connect($_SERVER['REMOTE_ADDR'], $_POST['login']);

                return 1;
            }
            return 0;
        }
        else{
            return 2;
        }


    }

    protected function is_user_connect($login) {
        $bdd = $this->dbConnect();

        $query = $bdd->prepare('
      SELECT * FROM chat_online WHERE online_user = :login
      ');
        $query->execute(array(
            'login' => $login,

        ));
        $count = $query->rowCount();
        if ($count == 0) {
            $is_user_connect = false;
        }
        else {
            $is_user_connect = true;
        }
        return $is_user_connect;
    }

    protected function user_connect($ip,$login) {

        $bdd = $this->dbConnect();
        $query = $bdd->prepare("
        INSERT INTO chat_online (online_ip, online_user, online_time)
        VALUES(:online_ip, :online_user, :online_time)
        ");
        $query->execute(array(
            'online_ip' => $ip,
            'online_user' => $login,
            'online_time' => time(),
        ));
    }

    protected function maj_connect($ip,$login) {
        $bdd = $this->dbConnect();
        $query = $bdd->prepare('
    SELECT * FROM chat_online WHERE online_user = :login
    ');
        $query->execute(array(
            'login' => $login,
        ));
        $count = $query->rowCount();
        if ($count == 0) {
            $maj = $bdd->prepare("
            INSERT INTO chat_online (online_ip, online_user, online_time)
            VALUES(:online_ip, :online_user, :online_time)
        ");
            $maj->execute(array(
                'online_ip' => $ip,
                'online_user' => $login,
                'online_time' => time(),
            ));
        }
        else {}
    }

    function delete_user($ip_suppr) {
        $bdd = $this->dbConnect();
        $time_out = time()-60;
        $query = $bdd->prepare('
        DELETE FROM chat_online WHERE online_ip = :ip 
        ');
        $query->execute(array(
            'ip' => $ip_suppr,
        ));
    }
    function deconnexion() {
        session_destroy();

    }

    function verif_mail() {
        $bdd = $this->dbConnect();
        $mail = htmlspecialchars($_POST['email']);
        $query = $bdd->prepare('
  SELECT * FROM accounts_users WHERE mail = :mail
  ');
        $query->execute(array(
            'mail' => $mail,
        ));
        $count = $query->rowCount();
        if ($count == 0)
        {
            $verif_mail = true;
        }
        else
        {
            $verif_mail = false;
        }
        return $verif_mail;
    }

    function psw_verif() {
          $password = htmlspecialchars($_POST['password']);
          $password_confirm = htmlspecialchars($_POST['passwordconfirm']);
            if ($password == $password_confirm) {
                $psw_verif = true;
                }
             else {
            $psw_verif = false;
            }
            return $psw_verif;
}


}