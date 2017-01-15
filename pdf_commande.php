<?php
include ('./admin/lib/php/adm_liste_include.php');
//récupération des infos de la facture
$numeroFacture = $_GET['facture'];
$fac = new FacturesBD($cnx);
$facture = $fac->getFactureById($numeroFacture);

switch($facture[0]->etat) {
	case 0 : $statutCommande = 'En attente de paiement';
	break;
	case 1 : $statutCommande = 'Paiement accepté';
	break;
	case 2 : $statutCommande = 'En préparation';
	break;
	case 3 : $statutCommande = 'En cours de livraison';
	break;
	case 4 : $statutCommande = 'Livré';
	break;
}

$cli = new ClientBD($cnx);
$client = $cli->getClientById($facture[0]->fk_utilisateur);

$pdf = new PDF('P','mm','A4');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Helvetica','',11);
$pdf->SetTextColor(0);
$pdf->Text(8,38,'Facture : '.$facture[0]->id_facture);
$pdf->Text(8,43,'Date : '.date('d/m/Y H:i:s', strtotime($facture[0]->date)));
$pdf->Text(8,48,'Statut de la commande : '.iconv('UTF-8', 'windows-1252', $statutCommande));
$pdf->Text(120,38,iconv('UTF-8', 'windows-1252', $client[0]->nom.' '.$client[0]->prenom));
$pdf->Text(120,43,$client[0]->rue);
$pdf->Text(120,48,iconv('UTF-8', 'windows-1252', $client[0]->ville));
$pdf->Text(8,56,'Email : '.$client[0]->mail);
$pdf->Text(8,61,iconv('UTF-8', 'windows-1252', 'Téléphone : '.$client[0]->tel));
// Position de l'entête à 10mm des infos (61 + 10)
$position_entete = 71;

function entete_table($position_entete){
    global $pdf;
    $pdf->SetDrawColor(183);
    $pdf->SetFillColor(221);
    $pdf->SetTextColor(0);
    $pdf->SetY($position_entete);
    $pdf->SetX(8);
    $pdf->Cell(158,8,iconv('UTF-8', 'windows-1252', 'Désignation'),1,0,'L',1);
    $pdf->SetX(166); // 8 + 96
    $pdf->Cell(10,8,'Qt',1,0,'C',1);
    $pdf->SetX(176); // 104 + 10
    $pdf->Cell(24,8,'Prix total',1,0,'C',1);
    $pdf->Ln(); // Retour à la ligne
}
entete_table($position_entete);

$position_detail = 79;
$com = new ComporteBD($cnx);
$comporte = $com->getComporteByFacture($numeroFacture);
$nbrComporte = count($comporte);
for($i=0 ; $i < $nbrComporte ; $i++) {
	$pro = new ProduitsBD($cnx);
	$produit = $pro->getProduit($comporte[$i]->fk_produit);
    $pdf->SetY($position_detail);
    $pdf->SetX(8);
    $pdf->MultiCell(158,8,$produit[0]->nom,1,'L');
    $pdf->SetY($position_detail);
    $pdf->SetX(166);
    $pdf->MultiCell(10,8,iconv('UTF-8', 'windows-1252', $comporte[$i]->quantite),1,'C');
    $pdf->SetY($position_detail);
    $pdf->SetX(176);
    $pdf->MultiCell(24,8,iconv('UTF-8', 'windows-1252', $comporte[$i]->prix*$comporte[$i]->quantite.' €'),1,'R');
    $position_detail += 8;
}
$pdf->Ln(7);
$pdf->SetFont('Arial','B',14);
$pdf->Cell(0, 10, iconv('UTF-8', 'windows-1252', 'Montant total de commande : '.$facture[0]->total.' €'), 0, 1,'R');
$pdf->Output("I");