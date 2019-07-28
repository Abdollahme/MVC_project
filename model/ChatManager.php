<?php
/**
 * Created by PhpStorm.
 * User: yassineelmaaroufi
 * Date: 27/07/2019
 * Time: 13:45
 */

namespace MVC_project\model;


class ChatManager extends Manager
{

    public function message()
    {
        $bdd=$this->dbConnect();
        if($_GET['value']=='new'){
            $reponse=$bdd->query('SELECT login, message_text FROM chat_messages ORDER BY message_id DESC LIMIT 0, 50');


            while($donnees=$reponse->fetch()){
                $pseudo=$donnees['login'];
                $texte=$donnees['message_text'];
                $message=$this->smiley($texte);
                echo '<p><strong>'.$pseudo.'</strong> : '.$message.'</p>';

            }

            $reponse->closeCursor();
        }
        if($_GET['value']=='anc'){
            $reponse_2=$bdd->query('SELECT login, message FROM old_message ORDER BY id DESC ');


            while($donnees_2=$reponse_2->fetch()){
                $pseudo_2=$donnees_2['login'];
                $texte_2=$donnees_2['message'];
                $message_2=$this->smiley($texte_2);
                echo '<p><strong>'.$pseudo_2.'</strong> : '.$message_2.'</p>';
            }

            $reponse_2->closeCursor();
        }

    }
    public function status()
    {
        $bdd = $this->dbConnect();
        $reponse = $bdd->query('SELECT * FROM chat_online');
        while ($donnees = $reponse->fetch()) {

            $user_status = $donnees['online_status'];

            if ($user_status == 0) {
                echo '<a class="lien_info" style="text-decoration:none;color:black;" href="user_info.php?user='.$donnees['online_user'].'" />'.$donnees['online_user'].'</a>'.'    <img src="http://localhost/MVC_project/public/images/vert.png" alt="En ligne"/><br />';
            }
            elseif ($user_status == 1) {
                echo '<a class="lien_info" style="text-decoration:none;color:black;" href="user_info.php?user='.$donnees['online_user'].'" />'.$donnees['online_user'].'</a>'.'    <img src="http://localhost/MVC_project/public/images/orange.png" alt="Occup�"/><br />';
            }
            elseif ($user_status == 2) {
                echo '<a class="lien_info" style="text-decoration:none;color:black;" href="user_info.php?user='.$donnees['online_user'].'" />'.$donnees['online_user'].'</a>'.'    <img src="http://localhost/MVC_project/public/images/rouge.png" alt="Absent"/><br />';
            }
            else {
                echo '<a class="lien_info" style="text-decoration:none;color:black;" href="user_info.php?user='.$donnees['online_user'].' />"'.$donnees['online_user'].'</a>'.'    <img src="http://localhost/MVC_project/public/images/vert.png" /><br />';
            }



        }

    }
    public function post()
    {

        $bdd = $this->dbConnect();
        $this->delete_msg();
        $req = $bdd->prepare('INSERT INTO chat_messages (login, message_text, timestamp) VALUES(:login, :message_text, :timestamp)');
        $req->execute(array(
            'login' => $_SESSION['login'],
            'message_text' => $_GET['msg'],
            'timestamp' => time()
        ));

    }
    function state() {
        $bdd = $this->dbConnect();
        $new_status = $_GET['statechange'];
        $set_status = $bdd->prepare('UPDATE chat_online SET online_status = :status WHERE online_user = :login');
        $set_status->execute(array(
            'status' => $new_status,
            'login' => $_SESSION['login'],
        ));

    }
    function delete_msg() {
        $bdd = $this->dbConnect();
        $time_out = time()-900;
        $recup_message = $bdd->prepare('SELECT * FROM chat_messages WHERE timestamp < :time');
        $recup_message->execute(array(
            'time' => $time_out
        ));

        while ($message = $recup_message->fetch()) {
            $query_1 = $bdd->prepare('INSERT INTO old_message (message, login) VALUES (:message, :login)');
            $query_1->execute(array(
                'message' => $message['message_text'],
                'login' => $message['login'],
            ));
        }
        $query = $bdd->prepare("DELETE FROM chat_messages WHERE timestamp < :time");
        $query->execute(array(
            'time' => $time_out
        ));

    }
    function smiley($texte) {
        $texte = str_replace(' :) ', '<img src="http://localhost/MVC_project/public/images/sourire.png" />', $texte);
        $texte = str_replace(':) ', '<img src="http://localhost/MVC_project/public/images/sourire.png" />', $texte);
        $texte = str_replace(':)', '<img src="http://localhost/MVC_project/public/images/sourire.png"  />', $texte);
        $texte = str_replace(' :)', '<img src="http://localhost/MVC_project/public/images/sourire.png" />', $texte);
        $texte = str_replace(' ;) ', '<img src="http://localhost/MVC_project/public/images/clin.png" />', $texte);
        $texte = str_replace(';) ', '<img src="http://localhost/MVC_project/public/images/clin.png" />', $texte);
        $texte = str_replace(';)', '<img src="http://localhost/MVC_project/public/images/clin.png" />', $texte);
        $texte = str_replace(' ;)', '<img src="http://localhost/MVC_project/public/images/clin.png" />', $texte);
        $texte = str_replace(' :p ', '<img src="http://localhost/MVC_project/public/images/langue.png" />', $texte);
        $texte = str_replace(':p ', '<img src="http://localhost/MVC_project/public/images/langue.png" />', $texte);
        $texte = str_replace(' :p', '<img src="http://localhost/MVC_project/public/images/langue.png" />', $texte);
        $texte = str_replace(':p', '<img src="http://localhost/MVC_project/public/images/langue.png" />', $texte);
        $texte = str_replace(' :d ', '<img src="http://localhost/MVC_project/public/images/rigole.png" />', $texte);
        $texte = str_replace(':d ', '<img src="http://localhost/MVC_project/public/images/rigole.png" />', $texte);
        $texte = str_replace(' :d', '<img src="http://localhost/MVC_project/public/images/rigole.png" />', $texte);
        $texte = str_replace(':d', '<img src="http://localhost/MVC_project/public/images/rigole.png" />', $texte);
        $texte = str_replace(' :D ', '<img src="http://localhost/MVC_project/public/images/rigole.png" />', $texte);
        $texte = str_replace(':D ', '<img src="http://localhost/MVC_project/public/images/rigole.png" />', $texte);
        $texte = str_replace(' :D', '<img src="http://localhost/MVC_project/public/images/rigole.png" />', $texte);
        $texte = str_replace(':D', '<img src="http://localhost/MVC_project/public/images/rigole.png" />', $texte);
        $texte = str_replace(' <3 ', '<img src="http://localhost/MVC_project/public/images/coeur.png" />', $texte);
        $texte = str_replace('<3 ', '<img src="http://localhost/MVC_project/public/images/coeur.png" />', $texte);
        $texte = str_replace(' <3', '<img src="http://localhost/MVC_project/public/images/coeur.png" />', $texte);
        $texte = str_replace('<3', '<img src="http://localhost/MVC_project/public/images/coeur.png" />', $texte);
        $texte = str_replace('^^', '<img src="http://localhost/MVC_project/public/images/hihi.png" />', $texte);
        $texte = str_replace(' ^^', '<img src="http://localhost/MVC_project/public/images/hihi.png" />', $texte);
        $texte = str_replace('^^ ', '<img src="http://localhost/MVC_project/public/images/hihi.png" />', $texte);
        $texte = str_replace(' ^^ ', '<img src="http://localhost/MVC_project/public/images/hihi.png" />', $texte);


        return $texte;
    }

}