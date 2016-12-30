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
        $i = 0;
        for ($i = 1; $i < $nbrP+1; $i++) { 
            if($i == 1 || !$i%3) echo '<div class="col-sm-12">'; ?>
                <div class="col-sm-4">
                    <div class="thumbnail" >
                        <?php $path = './lib/images/'.$liste_p[$i-1]->id_produit.'.jpg'; ?>
                        <img src=<?php echo $path ?> class="img-thumbnail" style="width:200px;height:200px;">
                        <div class="caption">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h3 style="margin:5px auto;"><label>€ <?php print $liste_p[$i-1]->prix; ?></label></h3>
                                </div>
                                <div class="col-sm-4">
                                    <a href="#" class="btn btn-success btn-product <?php if($liste_p[$i-1]->quantite == 0) echo 'disabled' ?>"><span class="glyphicon glyphicon-shopping-cart"></span> Ajouter au panier</a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-8">
                                    <p><?php print utf8_encode($liste_p[$i-1]->nom); ?></p>
                                </div>
                                <div class="col-sm-2">
                                    <?php if($liste_p[$i-1]->quantite > 0) { ?><span class="glyphicon glyphicon-thumbs-up" aria-hidden="true" style="color:#79B947"></span> <?php } else { ?>
                                        <span class="glyphicon glyphicon-thumbs-down" aria-hidden="true" style="color:#E24D4E"></span> <?php } ?>
                                    <?php print utf8_encode($liste_p[$i-1]->quantite); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
            <?php if($i == 0 || !$i%3) echo '</div>';
            } ?>
    </div>
</div>
<!--<div class="row">
    <div class="col-sm-3">
        <span class="txtGras">Choisissez votre pays :</span>
    </div>
    <form action="<?php print $_SERVER['PHP_SELF']; ?>" method="get">
        <div class="col-sm-3">
            <select name="choix_pays" id="choix_pays">
                <option value="1">Choisissez</option>
                <?php
                for ($i = 0; $i < $nbrP; $i++) {
                    ?>                    
                    <option value="<?php print $liste_p[$i]->pays; ?>">
                        <?php print $liste_p[$i]->pays; ?>
                    </option>
                    <?php
                }
                ?>
            </select>

        </div>
        <div class="col-sm-3">
            <input type="submit" name="submit_pays" value="" id="submit_pays"/>
        </div> 
    </form>
</div>