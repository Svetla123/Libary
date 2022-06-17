<?php
class AutorstvoKnjige
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function dohvatiAutorstva()
    {
        $this->db->query('SELECT a.autor_ID, k.naslov_knjige, k.isbn FROM autorstvo_knjige a, knjiga k WHERE k.isbn = a.isbn ORDER BY a.autor_ID ASC');

        $autorstva = $this->db->resultSet();
        return $autorstva;
    }
}
