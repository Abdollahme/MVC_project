<?php
session_start();

?>
<?php $title = 'Chat'; ?>

<?php ob_start(); ?>


<!-- Button trigger modal -->
<button id="modal" type="button" onclick='old_msg(echoMsg)' class="btn btn-primary" data-toggle="modal" data-target="#exampleModalScrollable">
    Afficher les anciens messages
</button>

<div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalScrollableTitle">Historiques des messages</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div id="modalbody" class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>

            </div>
        </div>
    </div>
</div>

<span id="deconnexion" class="float-right">
    <a class="btn btn-danger" href="../../index.php?action=deconnexion">Déconnexion</a>
</span>
<div class="container">
    <div class="row">
        <div class="col-md-2 border border-info border-right-0">
            <div class="alert alert-info" role="alert">
                <b>Liste utilisateurs</b>
            </div>
            <div id="membres_connectes">

            </div>
        </div>

        <div class="col-md-8 border border-info">
            <div class="card border-0">
                <div class="alert alert-info" role="alert">
                    <b>Messages</b>
                    <div id="change_status">
                        <form action="#" method="post">
                            <table><tr><td><select class='custom-select' name="status" id="status">
                                            <option value="#" selected>Status</option>
                                            <option value="0">En ligne</option>
                                            <option value="1">Occupé</option>
                                            <option value="2">Absent</option>
                                        </select></td><td><input class="btn btn-secondary" type="button" value="Ok" onClick="set_status()" /></td></tr>
                               </table>
                        </form>
                    </div>
                </div>
                <div class="card-body border-0">

                    <div id="cadre_chat">

                    </div>

                </div>

            </div>

        </div>
        <div class="col-md-2">
            <div class="alert alert-info" role="alert">
                <b>Saisie de message</b>
            </div>
            <form id="form" action="#" method="post">


                    <textarea onKeyPress="if(event.keyCode==13){post(); clear();}" name="message" id="message"  rows="4" placeholder="Message ..." ></textarea>

                    <input id="envoyer" class="btn btn-secondary" type="button" onClick="post(), clear()" value="Envoyer !" />


            </form>

    </div>
</div>





<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>

