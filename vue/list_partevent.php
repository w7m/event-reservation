<?php
session_start();
    include_once '../control/controllerParticipation.php';
    include_once '../control/controllerEvent.php';
include_once '../control/controllerUsers.php';
if (isset($_SESSION['login'])) {
    $role = "admin";
    if ($_SESSION['login']['role'] == $role) {
        true;
    } else
        header('Location: ../vue/index.php');
}
else
header('Location: ../vue/index.php');
?>
<?php ob_start(); ?>
<?php $title = "Liste des participations" ?>
    <section class="container list-users">
        <?php
            if (isset($_SESSION['updatenumberpart'])){
            echo "<div class='modal fade' id='modal-infos' data-backdrop='false'>
                <div class='modal-dialog'>
                    <div class='modal-content'>
                        <div class='modal-body'>
                            <button type='button' class='close' data-dismiss='modal'>x</button>
                            <h3 class='modal-title title-message-error'>",$_SESSION['updatenumberpart'],"</h3>
                        </div>
                    </div>
                </div>
            </div>";
            unset($_SESSION['updatenumberpart']);
            }
        if (isset($_SESSION['numberplacelower'])){
            echo "<div class='modal fade' id='modal-infos' data-backdrop='false'>
                <div class='modal-dialog'>
                    <div class='modal-content'>
                        <div class='modal-body'>
                            <button type='button' class='close' data-dismiss='modal'>x</button>
                            <h3 class='modal-title title-message-error'>",$_SESSION['numberplacelower'],"</h3>
                        </div>
                    </div>
                </div>
            </div>";
            unset($_SESSION['numberplacelower']);
        }
        if (isset($_SESSION['deletenumberpart'])){
            echo "<div class='modal fade' id='modal-infos' data-backdrop='false'>
                <div class='modal-dialog'>
                    <div class='modal-content'>
                        <div class='modal-body'>
                            <button type='button' class='close' data-dismiss='modal'>x</button>
                            <h3 class='modal-title title-message-error'>",$_SESSION['deletenumberpart'],"</h3>
                        </div>
                    </div>
                </div>
            </div>";
            unset($_SESSION['deletenumberpart']);
        }
        ?>
        <?php
        if (isset($_SESSION['deleteparticicp'])){
            echo "<div class='modal fade' id='modal-infos' data-backdrop='false'>
                <div class='modal-dialog'>
                    <div class='modal-content'>
                        <div class='modal-body'>
                            <button type='button' class='close' data-dismiss='modal'>x</button>
                            <h3 class='modal-title title-message-error'>",$_SESSION['deleteparticicp'],"</h3>
                        </div>
                    </div>
                </div>
            </div>";
            unset($_SESSION['deleteparticicp']);
        }
        if (isset($_SESSION['error'])){
            echo "<div class='modal fade' id='modal-infos' data-backdrop='false'>
                <div class='modal-dialog'>
                    <div class='modal-content'>
                        <div class='modal-body'>
                            <button type='button' class='close' data-dismiss='modal'>x</button>
                            <h3 class='modal-title title-message-error'>",$_SESSION['error'],"</h3>
                        </div>
                    </div>
                </div>
            </div>";
            unset($_SESSION['error']);
        }
        if (isset($_SESSION["confirmationpartuser"])){
            echo "<div class='modal fade' id='modal-infos' data-backdrop='false'>
                <div class='modal-dialog'>
                    <div class='modal-content'>
                        <div class='modal-body'>
                            <button type='button' class='close' data-dismiss='modal'>x</button>
                            <h3 class='modal-title title-message-error'>",$_SESSION["confirmationpartuser"],"</h3>
                        </div>
                    </div>
                </div>
            </div>";
            unset($_SESSION["confirmationpartuser"]);
        }

        ?>
        <table class="table table-bordered table-striped table-condensed table-responsive">
            <caption>
                <h2>Liste des participations :</h2>
            </caption>
            <thead>
            <tr>
                <th>Nom évenement</th>
                <th>Nom tilisateur</th>
                <th>Prénom tilisateur</th>
                <th>Pseudo</th>
                <th>ÉTAT</th>
                <th>Confirmation</th>
                <th>Suppression</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $list = listPartEventController();
            if ($list !=null){
                foreach ( $list as $value){
                    $id_event = $value['id_event'];
                    $id_user = $value['id_user'];
                    $user = getUserbyid($id_user);
                    $event = getEventbyid($id_event);
                    echo "<tr>";
                    echo "<td>",$event['nameevent'],"</td>";
                    echo "<td>",$user['name1'],"</td>";
                    echo "<td>",$user['first_name'],"</td>";
                    echo "<td>",$user['pseudo'],"</td>";
                    echo "<td>",$value['confirmation'],"</td>";

                    if ($value['confirmation']=="Non confirmer"){
                    echo "<td><a href='../routeur/index.php?updateparteventid=",$id_event,"&updatepartusersid=",$id_user,"'>Confirmer</a></td>";
                    }
                    else{
                        echo "<td><a href='../routeur/index.php?deleteparteventid=",$id_event,"&deletepartusersid=",$id_user,"'>Supprimer confirmation</a>  
                          </td>";
                    }
                    echo "<td><a href='../routeur/index.php?deleteparteventidadmin=",$id_event,"&deletepartusersidadmin=",$id_user,"'><i class='glyphicon glyphicon-trash'></i></a></td>";
                    echo "</tr>";
                }
            }

            ?>
            </tbody>
        </table>
    </section>

<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>



