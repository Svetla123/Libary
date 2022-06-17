<?php
class Knjiga
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function dohvatiKnjige()
    {
        $this->db->query('SELECT * FROM knjiga ORDER BY ibn ASC');

        $knjige = $this->db->resultSet();
        return $knjige;
    }

    public function dohvatiKnjigeSve()
    {
        $this->db->query('SELECT k.isbn, k.naslov_knjige, k.godina_objave, k.broj_kopija, p.ime_prevoditelja, p.prezime_prevoditelja, z.ime_zanra, ik.ime_izdavacke_kuce, j.ime_jezika,

            (SELECT COUNT(*) FROM inventar i WHERE i.isbn = k.isbn AND i.slobodno = 1) AS broj_slobodnih,

            (SELECT COUNT(*) FROM inventar i
            INNER JOIN knjiznica knj ON knj.knjiznica_ID = i.knjiznica_ID
            WHERE i.isbn = k.isbn AND i.slobodno=1 AND knj.knjiznica_ID = 1) AS broj_slobodnih_GKIV,

            (SELECT COUNT(*) FROM inventar i
            INNER JOIN knjiznica knj ON knj.knjiznica_ID = i.knjiznica_ID
            WHERE i.isbn = k.isbn AND i.slobodno=1 AND knj.knjiznica_ID = 2) AS broj_slobodnih_klostar,

            (SELECT a.prezime_autora FROM autor a
            WHERE a.autor_ID = ak.autor_ID AND ak.isbn = k.isbn) AS prezime_autora,

            (SELECT a.ime_autora FROM autor a
            WHERE a.autor_ID = ak.autor_ID AND ak.isbn = k.isbn) AS ime_autora
 
        FROM knjiga k 
        INNER JOIN prevoditelj p ON p.prevoditelj_ID = k.prevoditelj_ID
        INNER JOIN zanr z ON z.zanr_ID = k.zanr_ID
        INNER JOIN jezik j ON j.jezik_ID = k.jezik_ID
        INNER JOIN izdavacka_kuca ik ON ik.izdavacka_kuca_ID= k.izdavacke_kuca_ID
        INNER JOIN autorstvo_knjige ak ON ak.isbn = k.isbn
        
        ORDER BY k.isbn ASC');

        $knjige = $this->db->resultSet();
        return $knjige;
    }
}
