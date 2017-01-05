<?php
/* auto chargement pour toutes les classes dans admin*/
function autoload($nom_classe) {
    if(file_exists('./lib/php/classes/'.$nom_classe.'.class.php')) {
        require './lib/php/classes/'.$nom_classe.'.class.php';
    }    
    else if(file_exists('./admin/lib/php/classes/'.$nom_classe.'.class.php')) {
        require './admin/lib/php/classes/'.$nom_classe.'.class.php';
    }
    else print "échec du chargement des classes PHP";
    
}
//fct qui appelle méthode d'autochargement des classes
spl_autoload_register('autoload');

?>
