<?php $title = 'Inscription';
?>

<?php ob_start(); ?>
<div class="wrapper fadeInDown">
<div class="formContent">
    <!-- Tabs Titles -->

    <!-- Icon -->
    <div class="fadeIn first">
        <h2>Devenir membre</h2>
    </div>

    <!-- Login Form -->
    <form action="http://localhost/MVC_project/index.php?action=register" method='post'>
        <input type="text" id="firstname" class="fadeIn second" name="firstname" placeholder="Prénom" required>
        <input type="text" id="lastname" class="fadeIn second" name="lastname" placeholder="Nom" required>
        <input type="email" id="email" class="fadeIn second" name="email" placeholder="email" required>
        <input type="text" id="loginr" class="fadeIn second" name="login" placeholder="Pseudo" required>
        <input  id="password" type="password" class="fadeIn third" name="password" placeholder="Mot de passe" required>
        <input  id="password2" type="password" class="fadeIn third" name="passwordconfirm" placeholder="Confirmer mot de passe" required>
        <input type="submit" class="fadeIn fourth" value="Register">
    </form>


</div>
</div>
<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>
