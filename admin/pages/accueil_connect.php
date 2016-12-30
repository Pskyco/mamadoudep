<?php
unset($_SESSION['client']);
unset($_SESSION['panier']);
if (isset($_POST['submit_login'])) {
    print "ici";
   $log = new AdminBD($cnx);
    $retour = $log->isAdmin($_POST['login'], $_POST['password']);
    var_dump($retour);
    if ($retour == 1) {
        $_SESSION['admin'] = 1;
        $message = "Authentifié!";
        print "message : " . $message;
        header('Location: http://localhost/projects/Projet_Festival/admin/index.php');
    } else {
        $message = "Données incorrectes";
    }
}
?>

<section id="message"><?php if (isset($message)) print $message; ?></section>
<div class="container" id="inline">
    <form action="<?php print $_SERVER['PHP_SELF']; ?>" method='post' id="form_auth_">    
        <div class="row">
            <div class="col-sm-offset-1 txt150">Authentifiez-vous<br/><br/></div>
        </div>
        <div class="row">
            <div class="col-sm-2 txtRouge txtGras">Login : </div>
            <div class="col-sm-4"><input type="text" id="login_" name="login" /></div><br/><br/>
        </div>
        <div class="row">
            <div class="col-sm-2 txtRouge txtGras">Mot de passe :</div>
            <div class="col-sm-4"><input type="password" id="password_" name="password" /></div>
        </div>
        <div class="row">
            <div class="col-sm-4"><br/>
                <input type="submit" name="submit_login" id="submit_login_" value="Login" />&nbsp;&nbsp;&nbsp;
                <input type="reset" id="annuler" value="Annuler" />
            </div>
        </div>            
    </form>
</div>




