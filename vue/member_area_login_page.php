<?php
session_start();
if (isset($_SESSION['login'])) {
    header('Location: ../vue/index.php');
}
else
    true;
?>
        <?php ob_start(); ?>
        <?php $title = 'LOGIN'; ?>
        <section class="container section-login-signup">
            <div class="col-lg-3 col-md-3"></div>
            <div class="col-lg-5 col-md-5 col-xs-12 col-sm-12 form-connection">
                <?php
                if(isset($_SESSION["pseudo_nexistpas"])){
                    echo "<div class='modal fade' id='modal-infos' data-backdrop='false'>
                            <div class='modal-dialog'>
                                <div class='modal-content'>
                                    <div class='modal-body'>
                                        <button type='button' class='close' data-dismiss='modal'>x</button>
                                        <h3 class='modal-title title-message-error'>",$_SESSION['pseudo_nexistpas'],"</h3>
                                    </div>
                                </div>
                            </div>
                        </div>";
                    unset($_SESSION["pseudo_nexistpas"]);
                }
                if (isset($_SESSION["vaid_inscription"])){
                    echo "<div class='modal fade' id='modal-infos' data-backdrop='false'>
                            <div class='modal-dialog'>
                                <div class='modal-content'>
                                    <div class='modal-body'>
                                        <button type='button' class='close' data-dismiss='modal'>x</button>
                                        <h3 class='modal-title title-message-error'>",$_SESSION['vaid_inscription'],"</h3>
                                    </div>
                                </div>
                            </div>
                        </div>";
                    unset($_SESSION['vaid_inscription']);
                }
                if (isset($_SESSION["enabled"])){

                    echo "<div class='modal fade' id='modal-infos' data-backdrop='false'>
                            <div class='modal-dialog'>
                                <div class='modal-content'>
                                    <div class='modal-body'>
                                        <button type='button' class='close' data-dismiss='modal'>x</button>
                                        <h3 class='modal-title title-message-error'>",$_SESSION['enabled'],"</h3>
                                    </div>
                                </div>
                            </div>
                        </div>";
                    unset($_SESSION["enabled"]);
                }
                if (isset($_SESSION['inscription-befor-particip'])){

                    echo "<div class='modal fade' id='modal-infos' data-backdrop='false'>
                            <div class='modal-dialog'>
                                <div class='modal-content'>
                                    <div class='modal-body'>
                                        <button type='button' class='close' data-dismiss='modal'>x</button>
                                        <h3 class='modal-title title-message-error'>",$_SESSION['inscription-befor-particip'],"</h3>
                                    </div>
                                </div>
                            </div>
                        </div>";
                    unset($_SESSION['inscription-befor-particip']);
                }
                if (isset($_SESSION['active_compte'])){

                    echo "<div class='modal fade' id='modal-infos' data-backdrop='false'>
                            <div class='modal-dialog'>
                                <div class='modal-content'>
                                    <div class='modal-body'>
                                        <button type='button' class='close' data-dismiss='modal'>x</button>
                                        <h3 class='modal-title title-message-error'>",$_SESSION['active_compte'],"</h3>
                                    </div>
                                </div>
                            </div>
                        </div>";
                    unset($_SESSION['active_compte']);
                }
                if (isset($_SESSION["changemotdepassesucces"])){
                    echo "<div class='modal fade' id='modal-infos' data-backdrop='false'>
                            <div class='modal-dialog'>
                                <div class='modal-content'>
                                    <div class='modal-body'>
                                        <button type='button' class='close' data-dismiss='modal'>x</button>
                                        <h3 class='modal-title title-message-error'>",$_SESSION["changemotdepassesucces"],"</h3>
                                    </div>
                                </div>
                            </div>
                        </div>";
                    unset($_SESSION["changemotdepassesucces"]);
                }
                ?>
                <form action="../routeur/index.php" method="POST" id="form-connection">
                    <legend>Connectez vous </legend>
                    <div class="form-group">
                        <label for="Pseudo">Pseudo : </label>
                        <input id="pseudo" type="text" class="form-control" name="pseudo">
                    </div>
                    <div class="form-group">
                        <label for="password">Mot de passe : </label>
                        <input id="password" type="password" class="form-control" name="password">
                    </div>
                    <div class="form-check col-lg-5 col-md-5 col-sm-5 col-xs-5">
                        <input type="checkbox" class="form-check-input" id="Stay-connected">
                        <label class="form-check-label" for="Stay connected">Restez Connecté</label>
                    </div>
                    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7 text-right">
                        <a href="member_area_forgot_password_email_confirm.php" class="link-forgot-password ">Mot de passe oublié ?</a>
                    </div>
                    <button class="button-connection" type="submit" name="loginuser">SE CONNECTER</button>
                </form>
                <h3 class=" text-center title-choise-connection"> OU </h3>
                <div class="col-xs-5 col-sm-5 col-lg-5 col-md-5">
                    <a href="#" class="col-xs-12 col-sm-12 col-lg-11 col-md-12 connect-with-facebook text-center"><i class="fa fa-facebook icon-facebook"></i> FACEBOOK</a>
                </div>
                <div class="col-xs-5 col-sm-5 col-lg-5 col-md-5">
                    <a href="#" class="col-xs-12 col-sm-12 col-lg-11 col-md-12 connect-with-google text-center"><i class="fa fa-google icons-google"></i> GOOGLE</a>
                </div>
                <p class="text-center col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top:35px;">VOUS n'avez pas de compte ?<a href="member_area_registration_page.html" style="color:#2c8300;"> Iscrivez vous </a></p>
            </div>
        </section>
        <?php $content = ob_get_clean(); ?>
        <?php require('template.php'); ?>



	