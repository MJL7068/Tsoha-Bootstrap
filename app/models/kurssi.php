<?php

class Kurssi extends BaseModel{
    public $id, $nimi;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Kurssi');
        $query->execute();

        $rows = $query->fetchAll();
        $kurssit = array();

        foreach($rows as $row) {
            $kurssit[] = new Kurssi(array(
                'id' => $row['id'],
                'nimi' => $row['nimi']
            ));
        }

        return $kurssit;
    }

    public static function find($id) {
        if (!is_numeric($id)) {
            return null;
        }
        
        $query = DB::connection()->prepare('SELECT * FROM Kurssi WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $kurssi = new Kurssi(array(
                'id' => $row['id'],
                'nimi' => $row['nimi']
            ));

            return $kurssi;
        } else {
            return null;
        }
    }

    public static function haeNimenPerusteella($nimi) {
        $query = DB::connection()->prepare('SELECT * FROM Kurssi WHERE nimi = :nimi LIMIT 1');
        $query->execute(array('nimi' => $nimi));
        $row = $query->fetch();

        if ($row) {
            $kurssi = new Kurssi(array(
                'id' => $row['id'],
                'nimi' => $row['nimi']
            ));

            return $kurssi;
        }
    }
}