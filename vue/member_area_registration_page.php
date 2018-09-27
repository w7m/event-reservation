<?php
session_start();
if (isset($_SESSION['login'])) {
    header('Location: ../vue/index.php');
}else{
    true;
}
?>
        <?php ob_start(); ?>
        <?php $title = 'INSCRIPTION'; ?>
        <?php
        if(isset($_SESSION['erreur'])){
            echo "<div class='modal fade' id='modal-infos'data-backdrop='false'>
                        <div class='modal-dialog'>
                            <div class='modal-content'>
                                <div class='modal-body'>
                                    <button type='button' class='close' data-dismiss='modal'>x</button>
                                    <h3 class='modal-title title-message-error'>",$_SESSION['erreur'],"</h3>
                                </div>
                            </div>
                        </div>
                    </div>";
            unset($_SESSION['erreur']);
        }
        if (isset($_SESSION['pseudo_exist'])){
            echo "<div class='modal fade' id='modal-infos' data-backdrop='false'>
                        <div class='modal-dialog'>
                            <div class='modal-content'>
                                <div class='modal-body'>
                                    <button type='button' class='close' data-dismiss='modal'>x</button>
                                    <h3 class='modal-title title-message-error'>",$_SESSION['pseudo_exist'],"</h3>
                                </div>
                            </div>
                        </div>
                    </div>";
            unset($_SESSION['pseudo_exist']);
        }
        ?>
        <section class="container section-login-signup">

            <div class="col-lg-3 col-md-3"></div>
            <div class="col-lg-5 col-md-5 col-xs-12 col-sm-12 form-connection">
                <form action="../routeur/index.php" method="POST" id="form-registration" >
                    <legend>Inscrivez vous </legend>
                    <div class="form-group">
                        <label for="name1">Nom : </label>
                        <input id="name1" type="text" name="name1" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="first-name">Prénom : </label>
                        <input id="firts-name" type="text" name="first-name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="date_birth">Date de naissance  : </label>
                        <input id="date_birth" name="date_birth" type="date" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="Pseudo">Pseudo : </label>
                        <input id="pseudo" name="pseudo" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="email">Email : </label>
                        <input id="email" name="email" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="phone">Numéros téléphone : </label>
                        <input id="phone" name="phone" type="tel" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="password">Mot de passe : </label>
                        <input id="password" name="password" type="password" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="password-confirmation">Confirmer votre mot de passe : </label>
                        <input id="password-confirmation"  type="password" class="form-control">
                    </div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="terms-and-conditions" value="1" name="terms-and-conditions">
                        <label class="form-check-label" for="terms-and-conditions">J'accepte les <a href="#" style="color:#2c8300;">Termes et conditions</a></label>
                    </div>
                    <input class="button-connection" type="submit" value="S'INSCRIRE" name="adduser">
                    <button class="button-connection" type="reset">RÉINITIALISER</button>

                </form>
                <p class="text-center" style="margin-top:15px;">VOUS avez déjà un compte ?<a href="member_area_login_page.html" style="color:#2c8300;"> Connectez-vous</a>
                </p>
            </div>
        </section>
        <?php $content = ob_get_clean(); ?>
        <?php require('template.php'); ?>



	