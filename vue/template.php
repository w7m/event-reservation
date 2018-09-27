
<!DOCTYPE html>
<html>
<head>
    <title><?= $title ?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="css_js/member_area.css" rel="stylesheet" type="text/css" >
    <link href="css_js/member_area-home.css" rel="stylesheet" type="text/css" >
    <link href="css_js/member_area_login_page.css" rel="stylesheet" type="text/css" >
    <link href="css_js/member_area_registration_page.css" rel="stylesheet" type="text/css" >
    <link href="css_js/style-menu-user-connect.css" rel="stylesheet" type="text/css" >
    <meta charset="UTF-8">
</head>
<body>
<header class="navbar navbar-inverse  navbar-fixed-top bs-docs-nav format-navbar" role="banner">
    <?php
            if (isset($_SESSION['login'])) {
                ?>
                <div class="container">
                    <div class="btn-group col-lg-offset-11 col-lg-2 col-md-offset-10 col-md-2 col-xs-12  col-sm-2 menu-user-connect">
                        <button class="btn btn-default dropdown-toggle" data-toggle="dropdown"><ion-icon src="../vue/css_js/_ionicons_svg_md-person.svg"></ion-icon></button>
                        <ul class="dropdown-menu style-dropdown-menu">
                            <li><a href="../vue/update_my_account.php" >Mon Compte</a></li>
                            <li><a href="list_partevent_for_user.php">Mes participations</a></li>
                            <li><a href="../routeur/index.php?logout=deconnection">Déconnexion</a></li>
                        </ul>
                    </div>
                </div>
                <?php
            }else {
                ?>
                <div class="col-lg-offset-8 col-lg-4 col-md-offset-8 col-md-4 col-xs-12 col-sm-12 signup-connection">
                    <a href="member_area_registration_page.php"
                       class="col-lg-4 col-md-5 col-xs-5 col-sm-5 link-singup-connection">S'INSCRIRE</a>
                    <a href="member_area_login_page.php"
                       class="col-lg-4 col-md-5 col-xs-5 col-sm-5 link-singup-connection">SE CONNECTER</a>
                </div>
                <?php
            }
    ?>
    <div class="container">
        <div class="navbar-header">
            <button class="navbar-toggle button-navbar-responsive" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
                <span class="sr-only"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="index.php" class="navbar-brand title">ÉVÉNEMENTS GOMYCODE</a>
        </div>
        <nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
            <ul class="nav navbar-nav">
                <li class="ligne_vertical"></li>
                <li>
                    <a href="index.php" class="link-navbar">Accueil</a>
                </li>
                <li class="ligne_vertical"></li>
                <li>
                    <a href="participer_event.php" class="link-navbar">Participez</a>
                </li>
                <?php
                if (isset($_SESSION['login'])){
                    $role = "admin";
                    if ($_SESSION['login']['role'] == $role) {
                        echo "<li class='ligne_vertical'></li>
                        <li><a href='../routeur/index?list=list' class='link-navbar'>Liste Des Utilisateur</a></li>";
                        echo"<li class='ligne_vertical'></li>
                             <li class='dropdown'>
                             <a href='#' class='dropdown-toggle dropdown-toggle-js' data-toggle='dropdown'>Gestion Des Evenements <b class='caret'></b></a>
                             <ul class='dropdown-menu'>
                                <li><a href='addevent_page.php' class='text-center'>Ajouter</a></li>
                                <li><a href='list_event.php' class='text-center'>Liste</a></li>
                             </ul>
                             </li>";
                        echo "<li class='ligne_vertical'></li>
                        <li><a href='../routeur/index?listpart=listpart' class='link-navbar'>Liste Des Participations</a></li>";
                    }
                }
                ?>
                <li class='ligne_vertical'></li>
            </ul>
        </nav>
    </div>
</header>
        <?= $content ?>

<footer class="container-fluid footer">
    <p class=" col-lg-offset-1 col-lg-4 col-md-5 col-sm-12 col-xs-12 text-center ">2018 Tout les droits sont réservés.  Ce site crée par MHAMDI WAHID.</p>
    <div class="col-lg-4 col-md-offset-2 col-md-5 col-lg-offset-3 col-sm-12 col-xs-12 text-center">
        <p><a href="#"><i class="fa fa-facebook icons-link-social"></i></a> <a href="#"><i class="fa fa-linkedin icons-link-social"></i></a> <a href="#"><i class=" fa fa-twitter icons-link-social"></i></a> <a href="#"><i class=" fa fa-google-plus icons-link-social"></i></a> <a href="#"><i class=" fa fa-youtube icons-link-social"></i></a></p>
    </div>
</footer>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://unpkg.com/ionicons@4.4.1/dist/ionicons.js"></script>
<script src="css_js/member_area_registration_page_js1.js"></script>
<script src="css_js/member_area_js1.js"></script>
<script src="css_js/addevent_page_js1.js"></script>
<script type="text/javascript">

</script>
</body>
</html>