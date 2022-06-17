<?php 
class VrstaZaposlenika {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

   
    public function pronadiVrstuZaposlenika($vrstaZaposlenika) {
    
        $this->db->query('SELECT vrsta_zaposlenika_ID FROM vrsta_zaposlenika WHERE :vrstaZaposlenika = ime_vrsta_zaposlenika');
    
        $this->db->bind(':vrstaZaposlenika', $vrstaZaposlenika);
    
        $imeVrsteZaposlenika = $this->db->single();
            return $imeVrsteZaposlenika->vrsta_zaposlenika_ID;
    }
    
    
}