<!doctype html>
<?php
    include ('./lib/php/adm_liste_include.php');
    $cnx = Connexion::getInstance($dsn, $user, $pass);
    session_start();

    if (isset($_POST['form_connect_admin'])) {
        unset($_SESSION['client']);
        $data = new ClientBD($cnx);
        $retour = $data->isClient($_POST['email'], $_POST['password']);
        if ($retour > 0) {
            $_SESSION['client'] = $retour;
            $userAuthentifie = $data->getClientById($retour);
            $_SESSION['client'] = $userAuthentifie;
        }
    }
?>

<html>
    <head>
        <title>Mamadou Dépannage - Pourquoi aller voir ailleurs ?</title>     
        <link rel="stylesheet" type="text/css" href="./lib/css/bootstrap-3.3.7/dist/css/bootstrap.css" />
        <link rel="stylesheet" type="text/css" href="./lib/css/style.css"/>
        <script src="./lib/js/jquery-3.1.1.js"></script>
        <script src="./lib/js/jquery-validation-1.15.0/dist/jquery.validate.min.js" type="text/javascript"></script>
        <script src="./lib/css/bootstrap-3.3.7/dist/js/bootstrap.js" type="text/javascript"></script>
        <script src="./lib/js/functionsDetailCom.js" type="text/javascript"></script>
        <script src="./lib/js/functionsJqueryAdmin.js" type="text/javascript"></script>
        <script src="./lib/js/bootstrap-notify-master/bootstrap-notify.js" type="text/javascript"></script>
        <script src="./lib/js/messagesValidator.js" type="text/javascript"></script>
        <script src="./lib/js/functionInscription.js" type="text/javascript"></script>
        <script src="./lib/js/functionArticles.js" type="text/javascript"></script>
        <script src="./lib/js/bootbox.min.js" type="text/javascript"></script>
        <meta charset='UTF-8'/>
    </head>

    <body>
        <header>
            <div class="container">
                <?php
                if (file_exists('./lib/php/header.php')) {
                    include ('./lib/php/header.php');
                }
                ?>

                <nav>
                    <?php
                    if (!$_SESSION['client'][0]->admin) {
                        $path = './lib/php/menu.php';
                    } else {
                        $path = './lib/php/menu_admin.php';
                    }
                    if (file_exists($path)) {
                        include ($path);
                    }
                    ?>
                </nav>
            </div>
        </header>
        <div class="container">
            <section id="main">
                <?php
                if (!$_SESSION['client'] || !$_SESSION['client'][0]->admin) {
                    $_SESSION['page'] = "connect";
                    if(!$_SESSION['client'][0]->admin) { ?>
                        <br><br>
                        <section id="message">
                            <div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"></span></button>
                                <strong>Erreur !</strong> Le compte <?php echo $_SESSION['client'][0]->mail; ?> n'est pas un compte administrateur !
                            </div>
                        </section>
                    <?php }
                } else {
                    if (isset($_SESSION['page'])) {
                        $_SESSION['page'] = "accueil_admin";
                    }

                    if (isset($_GET['page'])) {
                        $_SESSION['page'] = $_GET['page'];
                    }
                }
                $path = './pages/' . $_SESSION['page'] . '.php';
                //print "path : " . $path . "<br/>";
                if (file_exists($path)) {
                    include ($path);
                } else {
                    ?>
                    <span class="txtGras txtRouge">Erreur 404: la page demandée n'existe pas.</span>
                    <meta http-equiv="refresh" content="4; url=index.php?page=accueil" />
                    <?php
                }
                ?> 


                <footer class="footer">
                    <?php
                    if (file_exists('./lib/php/footer.php')) {
                        include ('./lib/php/footer.php');
                    }
                    ?>  
                </footer>
            </section>
        </div>
    </body>
</html>