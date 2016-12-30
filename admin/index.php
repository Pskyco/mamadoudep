<!doctype html>
<?php
include ('./lib/php/adm_liste_include.php');
$cnx = Connexion::getInstance($dsn, $user, $pass);

session_start();
?>

<html>
    <head>
        <title>Festif'Consult - Votre guichet en ligne</title>
        <link rel="stylesheet" type="text/css" href="./lib/css/bootstrap-3.3.7/dist/css/bootstrap.css" />
        <link rel="stylesheet" type="text/css" href="./lib/css/festivals_style.css"/> 
        <script src="lib/js/jquery-3.1.1.js"></script>
        <script src="lib/css/bootstrap-3.3.7/dist/js/bootstrap.js"></script>
        <script src="lib/js/functionsBtJquery.js"></script>
        <meta charset='UTF-8'/>
    </head>

    <body>
        <header>
            <div class="container">

                <?php
                if (file_exists('./lib/php/header_admin.php')) {
                    include ('./lib/php/header_admin.php');
                }
                ?>


                <nav>
                    <?php
                    if (!isset($_SESSION['admin'])) {
                        $path = './lib/php/menu_connect.php';
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
            <div class="row">
                <div class="col-sm-12">
                    <a href="./index.php?page=disconnect" class="pull-right ecart10">
                        <?php
                        if (isset($_SESSION['admin'])) {
                            print "Déconnexion";
                        } else {
                            print "Connexion";
                        }
                        ?>
                    </a>
                </div>
            </div>

            <section id="main">
                <div class="row">
                    <div class="col-sm-12">
                        <h2>Bienvenue chez Festif'Consult</h2>
                    </div>
                </div>
                <?php
                if (!isset($_SESSION['admin'])) {
                    $_SESSION['page'] = "accueil_connect";
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
                    <span class="txtGras txtRouge">Oups!La page demandée n'existe pas</span>
                    <meta http-refresh: Content="1;url=index.php?page=accueil"/>
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