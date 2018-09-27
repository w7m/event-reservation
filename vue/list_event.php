<?php
session_start();
    include_once '../control/controllerEvent.php';
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
<?php $title = "Liste des évenements" ?>
    <section class="container list-users">
        <?php
        if (isset($_SESSION['add-event-succ'])){
            echo "<div class='modal fade' id='modal-infos'  data-backdrop='false'>
            <div class='modal-dialog'>
                <div class='modal-content'>
                    <div class='modal-body'>
                        <button type='button' class='close' data-dismiss='modal'>x</button>
                        <h3 class='modal-title title-message-error'>",$_SESSION['add-event-succ'],"</h3>
                    </div>
                </div>
            </div>
            </div>";
            unset($_SESSION['add-event-succ']);
        }
        if (isset($_SESSION['event_exist'])){
            echo "<div class='modal fade' id='modal-infos' data-backdrop='false'>
                <div class='modal-dialog'>
                    <div class='modal-content'>
                        <div class='modal-body'>
                            <button type='button' class='close' data-dismiss='modal'>x</button>
                            <h3 class='modal-title title-message-error'>",$_SESSION['event_exist'],"</h3>
                        </div>
                    </div>
                </div>
            </div>";
            unset($_SESSION['event_exist']);
        }
        if (isset($_SESSION['event_delete'])){
            echo "<div class='modal fade' id='modal-infos' data-backdrop='false'>
                <div class='modal-dialog'>
                    <div class='modal-content'>
                        <div class='modal-body'>
                            <button type='button' class='close' data-dismiss='modal'>x</button>
                            <h3 class='modal-title title-message-error'>",$_SESSION['event_delete'],"</h3>
                        </div>
                    </div>
                </div>
            </div>";
            unset($_SESSION['event_delete']);
        }
        if (isset($_SESSION["event-undefined"])){
            echo "<div class='modal fade' id='modal-infos' data-backdrop='false'>
                <div class='modal-dialog'>
                    <div class='modal-content'>
                        <div class='modal-body'>
                            <button type='button' class='close' data-dismiss='modal'>x</button>
                            <h3 class='modal-title title-message-error'>",$_SESSION["event-undefined"],"</h3>
                        </div>
                    </div>
                </div>
            </div>";
            unset($_SESSION["event-undefined"]);
        }
        if(isset($_SESSION['erreur'])){
            echo "<div class='modal fade' id='modal-infos' data-backdrop='false'>
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
        if(isset($_SESSION['eventupdate'])){
            echo "<div class='modal fade' id='modal-infos' data-backdrop='false'>
                        <div class='modal-dialog'>
                            <div class='modal-content'>
                                <div class='modal-body'>
                                    <button type='button' class='close' data-dismiss='modal'>x</button>
                                    <h3 class='modal-title title-message-error'>",$_SESSION['eventupdate'],"</h3>
                                </div>
                            </div>
                        </div>
                    </div>";
            unset($_SESSION['eventupdate']);
        }
        if(isset($_SESSION['eventnotupdate'])){
            echo "<div class='modal fade' id='modal-infos' data-backdrop='false'>
                        <div class='modal-dialog'>
                            <div class='modal-content'>
                                <div class='modal-body'>
                                    <button type='button' class='close' data-dismiss='modal'>x</button>
                                    <h3 class='modal-title title-message-error'>",$_SESSION['eventnotupdate'],"</h3>
                                </div>
                            </div>
                        </div>
                    </div>";
            unset($_SESSION['eventnotupdate']);
        }
        ?>
        <h3 style="text-align: right;"><b><?php echo numberevent();?></b> Evenements enregistrés </h3>
        <table class="table table-bordered table-striped table-condensed table-responsive">
            <caption>
                <h2>Listes des Evenements :</h2>
            </caption>
            <thead>
            <tr>
                <th>Id</th>
                <th>nom</th>
                <th>Date début</th>
                <th>Date fin</th>
                <th>Nombres des participants</th>
                <th>position</th>
                <th>Modifer</th>
                <th>Supprimer</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $list = listEventController();
            if ($list !=null){
                foreach ( $list as $value){
                    $id = $value['id'];
                    echo "<tr>";
                    echo "<td>",$value['id'],"</td>";
                    echo "<td>",$value['nameevent'],"</td>";
                    echo "<td>",$value['date_begin'],"</td>";
                    echo "<td>",$value['date_end'],"</td>";
                    echo "<td>",$value['number_place'],"</td>";
                    echo "<td>",$value['position'],"</td>";
                    echo "<td><a href='../vue/update_event_page.php?updateevent=",$id,"'><i class='glyphicon glyphicon-cog'></i></a></td>";
                    echo "<td><a href='../routeur/index.php?deleteevent=",$id,"'><i class='glyphicon glyphicon-trash'></i></a></td>";
                    echo "</tr>";
                }
            }
            ?>
            </tbody>
        </table>
    </section>

<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>


