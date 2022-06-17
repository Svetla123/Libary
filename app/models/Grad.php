<?php 
class Grad {
    private $db;

    public function __construct () {
        $this->db = new Database;
    }

    public function pronadiGradove () {
        $this->db->query('SELECT ime_grada FROM grad ORDER BY ime_grada ASC');

        $gradovi = $this->db->resultSet();
        return $gradovi;
    }

    public function pronadiGrad ($grad) {

        $this->db->query('SELECT grad_ID FROM grad WHERE :grad = ime_grada');
    
        $this->db->bind(':grad', $grad);
    
        $grad = $this->db->single();
            return $grad->grad_ID;
    }

    public function pronadiGradPoID ($id) {
        
        $this->db->query('SELECT ime_grada FROM grad WHERE :id = grad_ID');
    
        $this->db->bind(':id', $id);
    
        $grad = $this->db->single();
            return $grad->ime_grada;
    }
}