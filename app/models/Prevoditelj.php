<?php
class Prevoditelj
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function dohvatiPrevoditelje()
    {
        $this->db->query('SELECT p.prevoditelj_ID, p.ime_prevoditelja, p.prezime_prevoditelja, p.službeni_prevoditelj, r.kratica_obeazovanja
        FROM prevoditelj p
        INNER JOIN razina_obrazovanja r ON r.razina_obrazovanja_ID = p.razina_obrazovanja_ID
        ORDER BY p.prevoditelj_ID ASC');

        $prevoditelji = $this->db->resultSet();
        return $prevoditelji;
    }
}
