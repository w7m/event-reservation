<?php
session_start();
if (isset($_SESSION['login'])) {
    header('Location: ../vue/index.php');
}else{
    true;
}
?>
        <?php ob_start(); ?>
        <?php $title = 'MOT DE PASSE OUBLIE'; ?>
        <section class="container section-login-signup">
            <div class="col-lg-3 col-md-3"></div>
            <div class="col-lg-5 col-md-5 col-xs-12 col-sm-12 form-connection">
                <form action="../routeur/index.php" method="POST" id="form-registration">
                    <legend>Entrez votre adresse E-mail </legend>
                    <div class="form-group">
                        <label for="email">Email : </label>
                        <input id="email" name="email" type="text" class="form-control">
                    </div>
                    <input class="button-connection" type="submit" value="VALIDER" name="emailforgotpassword">
                    <button class="button-connection" type="reset">RÉINITIALISER</button>
                </form>
            </div>
        </section>
        <?php $content = ob_get_clean(); ?>
        <?php require('template.php'); ?>



	