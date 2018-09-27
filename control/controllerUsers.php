<?php
function my_autoloaderforuser($class)
{
    include '../model/' . $class . '.php';
}
spl_autoload_register('my_autoloaderforuser');
//use Tester_vos_connaissances_avec_select\model\User as User;
//use Tester_vos_connaissances_avec_select\model\Manager as Manager;
function connectbdUser()
{
    try {
        $db = new PDO('mysql:host=localhost;dbname=select_test;charset=utf8', 'root', '');
        //echo 'Connexion réussie !';
    } catch (PDOException $e) {
        echo 'La connexion a échoué.<br />';
        echo 'Informations : [', $e->getCode(), '] ', $e->getMessage();
    }

    return  ManagerUsers::getInstanceUsers($db);


}
function login()
{
    $manager = connectbdUser();
    $error = true;
    $pseudo=$_POST["pseudo"]??$error = false;
    $password=$_POST["password"]??$error = false;
    if ($error==false) {
        $_SESSION["pseudo_nexistpas"] = "Vérifier vos coordonées ! ";
        header('Location: ../vue/member_area_registration_page.php');
    }
    $user = new User([
        'pseudo' => $pseudo,
        'password' => md5($password),
    ]);
    $user_search = $manager->selectUserWithpseudopassword($user);
    if ($user_search == true) {
        if ($user_search['enabled']==0){
            $_SESSION["enabled"] = "Activez votre compte ! ";
            header('Location: ../vue/member_area_login_page.php');
        }else{
            $_SESSION['login'] = array('id' => $user_search['id'],
                'pseudo' => $user_search['pseudo'],
                'name' => $user_search['name1'],
                'first_name' => $user_search['first_name'],
                'role' => $user_search['role']);
            $_SESSION["message-connec-valid"] = "Content de vous revoir ".$user_search['pseudo'];
            header('Location: ../vue/index.php');
        }
        }
         else {
        $_SESSION["pseudo_nexistpas"] = "Vérifier vos coordonées ! ";
        header('Location: ../vue/member_area_login_page.php');
    }
}
function add()
{
    $manager = connectbdUser();
    $error = true;
    $name1=$_POST["name1"]??$error = false;
    $first_name=$_POST["first-name"]??$error = false;
    $date_birth=$_POST["date_birth"]??$error = false;
    $pseudo=$_POST["pseudo"]??$error = false;
    $email=$_POST["email"]??$error = false;
    $phone=$_POST["phone"]??$error = false;
    $password=$_POST["password"]??$error = false;
    $terms_and_conditions=$_POST["terms-and-conditions"]??$error = false;
    if ($error==false) {
        $_SESSION["erreur"] = "Verifier vos coordonnées ";
        return header('Location: ../vue/member_area_registration_page.php');
    }
    if ($name1=="" || $first_name=="" || $date_birth=="" || $pseudo=="" || $email=="" || $phone=="" || $password==""
        || $terms_and_conditions=="" ){
        $_SESSION["erreur"] = "Verifier vos coordonnées ";
        return header('Location: ../vue/list_users.php');
    }


    $date = date('Y-m-d H:i:s');
    $token  =md5(((FLOAT)microtime())*1000);
    $user = new User([
        'name1' => $name1,
        'first_name' => $first_name,
        'pseudo' => $pseudo,
        'date_birth' => $date_birth,
        'email' => $email,
        'password' => md5($password),
        'termsCondition'=>$terms_and_conditions,
        'phone' => $phone,
        'date_registration' => $date,
        'role' => "user",
        'enabled'=>"0",
        'token'=>$token,
        'dateAddToken'=>$date,
    ]);
    $user_search = $manager->selectUserWithPseudoAndEmail($user);
    if ($user_search == false) {
        $manager->addUser($user);
        $to = $user->getEmail();
        $subject = "Confirmer Votre compte";
        $headers = 'From: mhdwhm88@gmail.com' . "\r\n" .
            'Reply-To: mhdwhm88@gmail.com' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();
        $message = "http://localhost/gomycode/poo-pdo/routeur/index.php?id=".$user->getId()."&tokenconfirm=".$user->getToken();
        mail($to,$subject,$message,$headers);
        $_SESSION["vaid_inscription"] = "Email de confirmation a été envoyé pour valider votre compte ! ";
        header('Location: ../vue/member_area_login_page.php');
    } else {
        $_SESSION["pseudo_exist"] = "pseudo ou email exist ! ";
        header('Location: ../vue/member_area_registration_page.php');
    }
}
function update()
{
    $manager = connectbdUser();
    $error = true;

    $id=$_POST["id"]??$error = false;
    $name1=$_POST["name1"]??$error = false;
    $first_name=$_POST["first-name"]??$error = false;
    $date_birth=$_POST["date_birth"]??$error = false;
    $pseudo=$_POST["pseudo"]??$error = false;
    $email=$_POST["email"]??$error = false;
    $phone=$_POST["phone"]??$error = false;
    $password=$_POST["password"]??$error = false;
    $enabled=$_POST["enabled"]??$error = false;
    $role=$_POST["role"]??$error = false;
    if ($error == false) {
        $_SESSION["erreur"] = "Verifier vos coordonnées ";
        return header('Location: ../vue/list_users.php');
    }

    if ($id==""  || $name1=="" || $first_name=="" || $date_birth=="" || $pseudo=="" || $email=="" || $phone=="" || $password=="" || $enabled==""
        || $role=="" ){
        $_SESSION["erreur"] = "Verifier vos coordonnées ";
        return header('Location: ../vue/list_users.php');
    }
    $user_searchbyid = $manager->selectUserById($id);
    if ($user_searchbyid == true) {
        $user = new User([
            'id' => $id,
            'name1' => $name1,
            'first_name' => $first_name,
            'pseudo' => $pseudo,
            'date_birth' => $date_birth,
            'email' => $email,
            'password' => md5($password),
            'phone' => $phone,
            'enabled' => $enabled,
            'role' => $role,
        ]);

        $manager->updateUser($user);
        $_SESSION['update-succe']="Modification effectuée avec succès";
        header('Location: ../vue/list_users.php');
    } else
        $_SESSION['user undefined']="utilisateur n'existe pas !";
        header('Location: ../vue/list_users.php');
    }
function listUserController()
{
    $manager = connectbdUser();
    return $list = $manager->listUserManager();
}
function number()
{
    $manager = connectbdUser();
    return $number_user = $manager->numberUserManager();
}
function deleteUserController($id)
{
    $manager = connectbdUser();
    $user_searchbyid = $manager->selectUserById($id);
    if ($user_searchbyid == true) {
        $manager->deleteUserManager($id);
        //$manager->deleteparticipationuser($id);
        $_SESSION['delete-succe']="suppression effectuée avec succès";
        header('Location: ../vue/list_users.php');
    } else
        $_SESSION['user undefined']="utilisateur n'existe pas !";
        header('Location: ../vue/list_users.php');
}
function updateUserController($id)
{
    $manager = connectbdUser();
    $user_searchbyid = $manager->selectUserById($id);
    if ($user_searchbyid == true) {
        return $manager->getUserbyManager($id);
    } else
        $_SESSION['user undefined']="utilisateur n'existe pas !";
        header('Location: ../vue/list_users.php');
}
function getUserbyid($id_user)
{
    $id = $id_user;
    $manager = connectbdUser();
    return $manager->getUserbyManager($id);
}
function updateMyAccountController($id)
{
    $manager = connectbdUser();
    if ($_SESSION['login']['id']==$id){
        return $manager->getUserbyManager($id);
    } else {
        $_SESSION['errormyaccount']="Vérifier vos coordonnées !";
        header('Location: ../vue/index.php');
    }
}
function updateMyaccount()
{
    $manager = connectbdUser();
    $error = true;
    $id=$_POST["id"]??$error = false;
    $name1=$_POST["name1"]??$error = false;
    $first_name=$_POST["first-name"]??$error = false;
    $date_birth=$_POST["date_birth"]??$error = false;
    $pseudo=$_POST["pseudo"]??$error = false;
    $email=$_POST["email"]??$error = false;
    $phone=$_POST["phone"]??$error = false;
    $password=$_POST["password"]??$error = false;
    if ($error == false) {
        $_SESSION["erreur"] = "Verifier vos coordonnées ";
        return header('Location: ../vue/index.php');
    }
    if ($id==""  || $name1=="" || $first_name=="" || $date_birth=="" || $pseudo=="" || $email=="" || $phone=="" || $password=="" ){
        $_SESSION["erreur"] = "Verifier vos coordonnées ";
        return header('Location: ../vue/list_users.php');
    }
    if ($id != $_SESSION['login']['id']) {
        $_SESSION["erreur"] = "Verifier vos coordonnées ";
        return header('Location: ../vue/index.php');
    }
    $user_searchbyid = $manager->selectUserById($id);
    if ($user_searchbyid == true) {
        $user = new User([
            'id' => $id,
            'name1' => $name1,
            'first_name' => $first_name,
            'pseudo' => $pseudo,
            'date_birth' => $date_birth,
            'email' => $email,
            'password' => md5($password),
            'phone' => $phone,
        ]);

        $manager->updateMyAcount($user);
        $_SESSION['update-succe']="Modification effectuée avec succès";
        header('Location: ../vue/index.php');
    } else
        $_SESSION["erreur"] = "Verifier vos coordonnées ";
    return header('Location: ../vue/index.php');
}
function confirmAccount($id,$token){

    $manager = connectbdUser();
    $user=$manager->getUserbyManager($id);
    $date_add_token = new DateTime($user['date_add_confirmation_token']);
    $datenow = new DateTime(date('Y-m-d H:i:s'));
    $interval = $date_add_token->diff($datenow);
    $intervalyear = $interval->format('%y%');
    $intervalmoin = $interval->format('%m%');
    $intervalday = $interval->format('%j%');
    $intervalhour = $interval->format('%H%');
    $intervalminute = $interval->format('%i%');

    if ((INTEGER)$intervalyear>1){
        $_SESSION['active_compte_expiré']="Date d'activation éxpiré";
        header('Location: ../vue/index.php');
    } elseif ((INTEGER)$intervalmoin>1){
        $_SESSION['active_compte_expiré']="Date d'activation éxpiré";
        header('Location: ../vue/index.php');
    } elseif ((INTEGER)$intervalday > 1) {
        $_SESSION['active_compte_expiré']="Date d'activation éxpiré";
        header('Location: ../vue/index.php');
    } elseif((INTEGER)$intervalhour) {
        $_SESSION['active_compte_expiré']="Date d'activation éxpiré";
        header('Location: ../vue/index.php');
    } elseif ((INTEGER)$intervalminute>3 ) {
    $_SESSION['active_compte_expiré']="Date d'activation éxpiré";
    header('Location: ../vue/index.php');
    } else {
        $manager->updateAccountEnableManager($id,$token);
        $_SESSION['active_compte']="Validation effectué avec succés";
        header('Location: ../vue/member_area_login_page.php');
    }

}
function changepasswordwithemail()
{
    $manager = connectbdUser();
    if (isset($_POST["email"])) {
        true;
    } else {
        $_SESSION["erreur"] = "Verifier vos coordonnées ";
        header('Location: ../vue/member_area_registration_page.php');
    }
    $email = $_POST["email"];
    $user = $manager->selectUserWithEmail($email);
    if ($user==true){
        $token  =md5(((FLOAT)microtime())*1000);
        $email = $_POST["email"];
        $manager->updateTokenForgetPassword($token,$email);

        $to = $email;
        $subject = "Mot de passe oublié";
        $headers = 'From: mhdwhm88@gmail.com' . "\r\n" .
            'Reply-To: mhdwhm88@gmail.com' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();
        $message = "http://localhost/gomycode/poo-pdo/routeur/index.php?token=".$token;
        mail($to,$subject,$message,$headers);
        $_SESSION['emailconfirmationchangepassword'] ="Un email de confirmation a été envoyer à votre adresse.";
        header('Location: ../vue/index.php');
    } else {
        $_SESSION['erroremailvalidation'] ="Vérifier votre adresse email ! ";
        header('Location: ../vue/index.php');
    }



}
function changepassword()
{
    $manager = connectbdUser();
    if (isset($_POST["token"])) {
        true;
    } else {
        $_SESSION["erreur"] = "Verifier vos coordonnées ";
        header('Location: ../vue/member_area_change_password.php');
    }
    if (isset($_POST["password"])) {
        true;
    } else {
        $_SESSION["erreur"] = "Verifier vos coordonnées ";
        header('Location: ../vue/member_area_change_password.php');
    }
    $token = $_POST["token"];
    $password = md5($_POST["password"]);
    $manager->changePassword($token,$password);
    $_SESSION["changemotdepassesucces"] = "Votre mot de passe a été changé avec succés ";
    header('Location: ../vue/member_area_login_page.php');

}
