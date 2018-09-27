<?php
session_start();
include_once '../control/controllerEvent.php';
?>
<?php ob_start(); ?>
    <title><?= $title='Accueil' ?></title>
<section class="container list-users">
    <?php
        if (isset($_SESSION['message-connec-valid'])){
        echo "<div class='modal fade' id='modal-infos' data-backdrop='false'>
            <div class='modal-dialog'>
                <div class='modal-content'>
                    <div class='modal-body'>
                        <button type='button' class='close' data-dismiss='modal'>x</button>
                        <h3 class='modal-title title-message-error'>",$_SESSION['message-connec-valid'],"</h3>
                    </div>
                </div>
            </div>
        </div>";
        unset($_SESSION['message-connec-valid']);
        }
    if (isset($_SESSION['logout'])){
        echo "<div class='modal fade' id='modal-infos' data-backdrop='false'>
            <div class='modal-dialog'>
                <div class='modal-content'>
                    <div class='modal-body'>
                        <button type='button' class='close' data-dismiss='modal'>x</button>
                        <h3 class='modal-title title-message-error'>",$_SESSION['logout'],"</h3>
                    </div>
                </div>
            </div>
        </div>";
        unset($_SESSION['logout']);
        session_destroy();
    }
    if (isset($_SESSION['emailconfirmationchangepassword'])){
        echo "<div class='modal fade' id='modal-infos' data-backdrop='false'>
            <div class='modal-dialog'>
                <div class='modal-content'>
                    <div class='modal-body'>
                        <button type='button' class='close' data-dismiss='modal'>x</button>
                        <h3 class='modal-title title-message-error'>",$_SESSION['emailconfirmationchangepassword'],"</h3>
                    </div>
                </div>
            </div>
        </div>";
        unset($_SESSION['emailconfirmationchangepassword']);
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
    if (isset($_SESSION['errormyaccount'])){
        echo "<div class='modal fade' id='modal-infos' data-backdrop='false'>
            <div class='modal-dialog'>
                <div class='modal-content'>
                    <div class='modal-body'>
                        <button type='button' class='close' data-dismiss='modal'>x</button>
                        <h3 class='modal-title title-message-error'>",$_SESSION['errormyaccount'],"</h3>
                    </div>
                </div>
            </div>
        </div>";
        unset($_SESSION['errormyaccount']);
    }
    if (isset($_SESSION['update-succe'])){
        echo "<div class='modal fade' id='modal-infos' data-backdrop='false'>
            <div class='modal-dialog'>
                <div class='modal-content'>
                    <div class='modal-body'>
                        <button type='button' class='close' data-dismiss='modal'>x</button>
                        <h3 class='modal-title title-message-error'>",$_SESSION['update-succe'],"</h3>
                    </div>
                </div>
            </div>
        </div>";
        unset($_SESSION['update-succe']);
    }
    if (isset($_SESSION['erroremailvalidation'])){
        echo "<div class='modal fade' id='modal-infos' data-backdrop='false'>
            <div class='modal-dialog'>
                <div class='modal-content'>
                    <div class='modal-body'>
                        <button type='button' class='close' data-dismiss='modal'>x</button>
                        <h3 class='modal-title title-message-error'>",$_SESSION['erroremailvalidation'],"</h3>
                    </div>
                </div>
            </div>
        </div>";
        unset($_SESSION['erroremailvalidation']);
    }
    if (isset($_SESSION['active_compte_expiré'])){
        echo "<div class='modal fade' id='modal-infos' data-backdrop='false'>
            <div class='modal-dialog'>
                <div class='modal-content'>
                    <div class='modal-body'>
                        <button type='button' class='close' data-dismiss='modal'>x</button>
                        <h3 class='modal-title title-message-error'>",$_SESSION['active_compte_expiré'],"</h3>
                    </div>
                </div>
            </div>
        </div>";
        unset($_SESSION['active_compte_expiré']);
    }


    ?>
    <table class="table table-bordered table-striped table-condensed table-responsive">
        <caption>
            <h2>Liste des trois Evénements :</h2>
        </caption>
        <thead>
        <tr>
            <th>nom</th>
            <th>Date début</th>
            <th>Date fin</th>
            <th>position</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $list = listForThreeEventController();
        if ($list !=null){
            foreach ( $list as $value){
                echo "<tr>";
                echo "<td>",$value['nameevent'],"</td>";
                echo "<td>",$value['date_begin'],"</td>";
                echo "<td>",$value['date_end'],"</td>";
                echo "<td>",$value['position'],"</td>";
                echo "</tr>";
            }
        }
        ?>
        </tbody>
    </table>
</section>
<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>