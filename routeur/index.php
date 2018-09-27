<?php
session_start();
require_once('../control/controllerEvent.php');
require_once('../control/controllerUsers.php');
require_once('../control/controllerParticipation.php');
if (isset($_POST["adduser"])) {
    if (!isset($_SESSION['login'])) {
        add();

    }
    else
        header('Location: ../vue/index.php');
} elseif (isset($_GET['delete'])){
    if (isset($_SESSION['login'])){
        $role = "admin";
        if ($_SESSION['login']['role']== $role){
            $id = $_GET['delete'];
            deleteUserController($id);
        }
        else
            header('Location: ../vue/index.php');
    }
    else
        header('Location: ../vue/index.php');
} elseif (isset($_POST['updateuser'])) {
    if (isset($_SESSION['login'])) {
        $role = "admin";
        if ($_SESSION['login']['role'] == $role) {
            update();
        } else
            header('Location: ../vue/index.php');

    }
    else
        header('Location: ../vue/index.php');
} elseif (isset($_POST['update-myaccount'])){
    if (isset($_SESSION['login'])) {
        updateMyaccount();
    } else {
        header('Location: ../vue/index.php');
    }
} elseif (isset($_POST['loginuser'])){
    if (!isset($_SESSION['login'])) {
        login();
    }
    else
        header('Location: ../vue/index.php');
} elseif (isset($_GET['logout'])){
    if (isset($_SESSION['login'])) {
        $_SESSION['logout'] = "Vous êtes maintenant déconnecté(e).";
        unset($_SESSION['login']);
        header('Location: ../vue/index.php');
    }
    else
        header('Location: ../vue/index.php');
} elseif (isset($_GET['list'])) {
    if (isset($_SESSION['login'])) {
        $role = "admin";
        if ($_SESSION['login']['role'] == $role) {
            header('Location: ../vue/list_users.php');
        } else
            header('Location: ../vue/index.php');
    }
    else
        header('Location: ../vue/index.php');
} elseif (isset($_GET['deleteevent'])){
    if (isset($_SESSION['login'])){
        $role = "admin";
        if ($_SESSION['login']['role']== $role){
            $id = $_GET['deleteevent'];
            deleteEventController($id);
        }
        else
            header('Location: ../vue/index.php');
    }
    else
        header('Location: ../vue/index.php');
} elseif(isset($_POST["addevent"])){

    if (isset($_SESSION['login'])){

        $role = "admin";
        if ($_SESSION['login']['role']== $role){
            addevent();
        }
        else
            header('Location: ../vue/index.php');
    }
    else
         header('Location: ../vue/index.php');
} elseif (isset($_POST['updateevent'])) {
    if (isset($_SESSION['login'])) {
        $role = "admin";
        if ($_SESSION['login']['role'] == $role) {
            updateevent();
        } else
            header('Location: ../vue/index.php');

    }
    else
        header('Location: ../vue/index.php');
} elseif (isset($_GET['part'])){
    if (isset($_SESSION['login'])) {
        $id_event = $_GET['part'];
        $id_user = $_SESSION['login']['id'];
        partUserInEvent($id_event,$id_user);
    }
    else{
        $_SESSION['inscription-befor-particip'] = "Connectez vous pour participer ! ";
        header('Location: ../vue/member_area_login_page.php');
    }
} elseif (isset($_GET['listpart'])) {
    if (isset($_SESSION['login'])) {
        $role = "admin";
        if ($_SESSION['login']['role'] == $role) {
            header('Location: ../vue/list_partevent.php');
        } else
            header('Location: ../vue/index.php');
    }
    else
        header('Location: ../vue/index.php');
} elseif(isset($_GET['updateparteventid'])){
    if (isset($_GET['updatepartusersid'])){
        if (isset($_SESSION['login'])) {
            $role = "admin";
            if ($_SESSION['login']['role'] == $role) {
                $id_event = $_GET['updateparteventid'];
                $id_user = $_GET['updatepartusersid'];
                updatepartevent($id_event,$id_user);
            } else
                header('Location: ../vue/index.php');

        }
        else
            header('Location: ../vue/index.php');
    }
} elseif (isset($_GET['deleteparteventid'])){
    if (isset($_GET['deletepartusersid'])){
        if (isset($_SESSION['login'])) {
            $role = "admin";
            if ($_SESSION['login']['role'] == $role) {

                $id_event = $_GET['deleteparteventid'];
                $id_user = $_GET['deletepartusersid'];
                deletepartevent($id_event,$id_user);

            } else
                header('Location: ../vue/index.php');
        }
        else
            header('Location: ../vue/index.php');
    }
} elseif (isset($_GET['deleteparteventiduser']) && isset($_GET['deletepartusersiduser']) ){
    $id_event = $_GET['deleteparteventiduser'];
    $id_user = $_GET['deletepartusersiduser'];
    deleteparteventforuser($id_event,$id_user);
} elseif (isset($_GET['deleteparteventidadmin']) && isset($_GET['deletepartusersidadmin']) ){
    $id_event = $_GET['deleteparteventidadmin'];
    $id_user = $_GET['deletepartusersidadmin'];
    deleteparteventforadmin($id_event,$id_user);
} elseif(isset($_GET['id']) && isset($_GET['tokenconfirm']) ){
    $id = $_GET['id'];
    $token = $_GET['tokenconfirm'];
    confirmAccount($id,$token);
} elseif (isset($_POST['emailforgotpassword'])){
    if (!isset($_SESSION['login'])){
        changepasswordwithemail();
    }else{
        header('Location: ../vue/index.php');
    }
} elseif(isset($_GET['token'])){
    $token = $_GET['token'];
    if (!isset($_SESSION['login'])){
        header('Location: ../vue/member_area_change_password.php?token='.$token);
    }else{
        header('Location: ../vue/index.php');
    }
} elseif (isset($_POST['updatemotdepasse'])){
    if (!isset($_SESSION['login'])){
        changepassword();
        header('Location: ../vue/member_area_login_page.php');
    }else{
        header('Location: ../vue/index.php');
    }
} else{
    echo 'Erreur ';
}














/*if ($_GET['update']){
    if (isset($_SESSION['login'])) {
        $role = "admin";
        if ($_SESSION['login']['role'] == $role) {
            updateUserController($_GET['update']);
            header('Location: ../vue/update_user.php');
        } else
            header('Location: ../vue/index.php');
    }
    else
        header('Location: ../vue/index.php');

}*/