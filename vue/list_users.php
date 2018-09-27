<?php
    session_start();
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
<?php $title = "Liste des utilisateurs" ?>
    <section class="container list-users">
        <?php
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
        if(isset($_SESSION['update-succe'])){
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
        if(isset($_SESSION['user undefined'])){
            echo "<div class='modal fade' id='modal-infos' data-backdrop='false'>
                        <div class='modal-dialog'>
                            <div class='modal-content'>
                                <div class='modal-body'>
                                    <button type='button' class='close' data-dismiss='modal'>x</button>
                                    <h3 class='modal-title title-message-error'>",$_SESSION['user undefined'],"</h3>
                                </div>
                            </div>
                        </div>
                    </div>";
            unset($_SESSION['user undefined']);
        }
        if(isset($_SESSION['delete-succe'])){
            echo "<div class='modal fade' id='modal-infos' data-backdrop='false'>
                        <div class='modal-dialog'>
                            <div class='modal-content'>
                                <div class='modal-body'>
                                    <button type='button' class='close' data-dismiss='modal'>x</button>
                                    <h3 class='modal-title title-message-error'>",$_SESSION['delete-succe'],"</h3>
                                </div>
                            </div>
                        </div>
                    </div>";
            unset($_SESSION['delete-succe']);
        }
        ?>
        <h3 style="text-align: right;"><b><?php echo number();?></b> Utilisateurs enregistrés </h3>
        <table class="table table-bordered table-striped table-condensed table-responsive">
            <caption>
                <h2>Listes des utilisateurs order by DESC:  </h2>
            </caption>
            <thead>
            <tr>
                <th>Id</th>
                <th>Pseudo</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Date de naissance</th>
                <th>Email</th>
                <th>Numéros téléphone</th>
                <th>Date d'inscription</th>
                <th>Disponibilité</th>
                <th>Rôle</th>
                <th>Modifer</th>
                <th>Supprimer</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $list = listUserController();
            if ($list !=null){
                foreach ( $list as $value){
                    $id = $value['id'];
                    echo "<tr>";
                    echo "<td>",$value['id'],"</td>";
                    echo "<td>",$value['pseudo'],"</td>";
                    echo "<td>",$value['name1'],"</td>";
                    echo "<td>",$value['first_name'],"</td>";
                    echo "<td>",$value['date_birth'],"</td>";
                    echo "<td>",$value['email'],"</td>";
                    echo "<td>",$value['phone'],"</td>";
                    echo "<td>",$value['date_registration'],"</td>";
                    echo "<td>",$value['enabled'],"</td>";
                    echo "<td>",$value['role'],"</td>";
                    echo "<td><a href='../vue/update_user.php?update=",$id,"'><i class='glyphicon glyphicon-cog'></i></a></td>";
                    echo "<td><a href='../routeur/index.php?delete=",$id,"'><i class='glyphicon glyphicon-trash'></i></a></td>";
                    echo "</tr>";
                }
            }

            ?>
            </tbody>
        </table>
    </section>

<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>



