<?php
$produits = new ProduitsBD($cnx);
$liste_p = $produits->getProduits();
$nbrP = count($liste_p);

$categories = new CategoriesBD($cnx);
$liste_c = $categories->getCategories();
$nbrC = count($liste_c);

if(isset($_GET['submit_categories'])) {
    $liste_p = $produits->getProduitsByCategorie($_GET['choix_categories']);
    $nbrP = count($liste_p);
}
?>

<div class="container">
    <section id="message">
            <?php if (isset($_GET['action']) && $_GET['code'] == 1) { ?>
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>Félicitations ! </strong> L'article a correctement été ajouté à votre panier.
            </div> <?php } else if (isset($_GET['action']) && $_GET['code'] == 2) { ?>
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>Attention ! </strong> Il n'est pas possible d'ajouter plus de quantité pour cet article.
            </div> <?php } ?>
    </section>
    <div class="row">
        <div class="col-sm-12">
            <div class="col-sm-4">
                <span class="txtGras">Choisissez une catégorie: </span>
            </div>
            <div class="col-sm-4">
                <form action="<?php print $_SERVER['PHP_SELF']; ?>" method="get">
                    <select name="choix_categories" id="choix_categories">
                        <option value="1">Choisissez</option>
                        <?php
                        for ($i = 0; $i < $nbrC; $i++) {
                            ?>                    
                            <option value="<?php print $liste_c[$i]->id_categorie; ?>">
                                <?php print $liste_c[$i]->nom; ?>
                            </option>
                            <?php
                        }
                        ?>
                    </select>
                    <input type="submit" name="submit_categories" value="" id="submit_categories"/>
                </form>
            </div> 
        </div>
    </div>
    <div class="row">
        <br>
        <?php
        for ($i = 1; $i < $nbrP+1; $i++) { ?>
            <div class="col-sm-6 col-md-4">
                <div class="thumbnail">
                    <?php $path = './lib/images/products/'.$liste_p[$i-1]->id_produit.'.jpg'; ?>
                    <img src=<?php echo $path ?> class="img-thumbnail" style="width:200px;height:200px;">
                    <div class="caption">
                        <h3 style="margin:5px auto;"><label>€ <?php print $liste_p[$i-1]->prix; ?></label></h3>
                        <div id="overflow"><p style="font-size:80%;"><?php print utf8_encode($liste_p[$i-1]->nom); ?></p></div>
                        <p><?php if($liste_p[$i-1]->quantite > 0) { ?><a class="btn btn-success"><span class="glyphicon glyphicon-heart"></span> <?php print utf8_encode($liste_p[$i-1]->quantite).' en stock'; ?></a> <?php } else { ?> <a class="btn btn-danger"><span class="glyphicon glyphicon-star-empty"></span><?php print 'Rupture de stock'; ?></a> <?php } ?> <a href="index.php?page=add_article&amp;id_produit=<?php echo $liste_p[$i-1]->id_produit; ?>" class="btn btn-info <?php if($liste_p[$i-1]->quantite == 0) echo 'disabled' ?>"><span class="glyphicon glyphicon-shopping-cart"></span> Acheter</a></p>
                    </div>
                </div>
            </div>
            <?php } ?>
    </div>
</div>