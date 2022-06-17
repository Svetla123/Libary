<?php
class Prevodi
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function pronadiJezike()
    {
        $this->db->query('SELECT pr.prevoditelj_ID, pr.ime_prevoditelja, pr.prezime_prevoditelja,
        (SELECT j.ime_jezika FROM jezik j WHERE j.jezik_ID = p.jezik_s_ID) AS prevodi_s,
        (SELECT j.ime_jezika FROM jezik j WHERE j.jezik_ID = p.jezik_na_ID) AS prevodi_na
        FROM prevodi p
        INNER JOIN prevoditelj pr ON pr.prevoditelj_id = p.prevoditelj_id
        ORDER BY pr.prevoditelj_id ASC');

        $jezici = $this->db->resultSet();
        return $jezici;
    }
}
