<?php

require ('./admin/lib/php/fpdf/fpdf.php');

class PDF extends FPDF {
    // En-tête
    function Header() {
        $this->SetFont('Arial', 'B', 15);
        // Titre
        $this->Cell(0, 20, iconv('UTF-8', 'windows-1252', 'Récapitulatif de commande Mamadou Dépannage'), 1, 0, 'C');
        // Saut de ligne
        $this->Ln(20);
    }

    // Pied de page
    function Footer() {
        // Positionnement à 1,5 cm du bas
        $this->SetY(-15);
        // Police Arial italique 8
        $this->SetFont('Arial', 'I', 8);
        // Numéro de page
        $this->Cell(0, 10, 'Page ' . $this->PageNo() . ' sur {nb}', 0, 0, 'R');
    }
}