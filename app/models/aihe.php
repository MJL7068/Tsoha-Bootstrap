<?php

class Aihe extends BaseModel{
    public $id, $nimi, $vaikeustaso, $maksimiarvosana, $kurssi, $kuvaus;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Aihe');
        $query->execute();

        $rows = $query->fetchAll();
        $aiheet = array();

        foreach($rows as $row) {
            $aiheet[] = new Aihe(array(
                'id' => $row['id'],
                'nimi' => $row['nimi'],
                'vaikeustaso' => $row['vaikeustaso'],
                'maksimiarvosana' => $row['maksimiarvosana'],
                'kurssi' => $row['kurssi'],
                'kuvaus' => $row['kuvaus']
            ));
        }

        return $aiheet;
    }

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Aihe WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $aihe = new Aihe(array(
                'id' => $row['id'],
                'nimi' => $row['nimi'],
                'vaikeustaso' => $row['vaikeustaso'],
                'maksimiarvosana' => $row['maksimiarvosana'],
                'kurssi' => $row['kurssi'],
                'kuvaus' => $row['kuvaus']
            ));

            return $aihe;
        }
    }

    public static function aiheetKurssinPerusteella($id) {
        $query = DB::connection()->prepare('SELECT * FROM Aihe WHERE kurssi = :id LIMIT 1');
        $query->execute(array('id' => $id));
        
        $rows = $query->fetchAll();
        $aiheet = array();

        foreach($rows as $row) {
            $aiheet[] = new Aihe(array(
                'id' => $row['id'],
                'nimi' => $row['nimi'],
                'vaikeustaso' => $row['vaikeustaso'],
                'maksimiarvosana' => $row['maksimiarvosana'],
                'kurssi' => $row['kurssi'],
                'kuvaus' => $row['kuvaus']
            ));
        }

        return $aiheet;
    }
}