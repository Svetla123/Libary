<?php
class Inventar
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function pronadiSlobodneKnjigeUInventaru()
    {
        $this->db->query('SELECT i.inventarni_broj_ID, k.naslov_knjige   
        FROM inventar i, knjiga k WHERE i.slobodno = 1 AND i.isbn = k.isbn
        ORDER BY i.inventarni_broj_ID ASC');

        $inventar = $this->db->resultSet();
        return $inventar;
    }

    public function dohvatiInventar()
    {
        $this->db->query('SELECT i.inventarni_broj_ID, i.slobodno, k.naslov_knjige, knj.ime_knjiznice
        FROM inventar i
        INNER JOIN knjiznica knj ON knj.knjiznica_ID = i.knjiznica_ID
        INNER JOIN knjiga k ON  k.isbn = i.isbn
        ORDER BY i.inventarni_broj_ID ASC');

        $inventar = $this->db->resultSet();
        return $inventar;
    }
}
