<?php 
class RazinaObrazovanja {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function pronadiRazinuObrazovanja($kratica) {
    
        $this->db->query('SELECT razina_obrazovanja_ID FROM razina_obrazovanja WHERE :kratica =kratica_obeazovanja');
    
        $this->db->bind(':kratica', $kratica);
    
        $kraticaObrazovanja = $this->db->single();
        // var_dump($kraticaObrazovanja);
            return $kraticaObrazovanja->razina_obrazovanja_ID;
    }
    
}