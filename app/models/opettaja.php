<?php

class Opettaja extends BaseModel {
    public $id, $nimi;

    public function __construct($attributes) {
        parent::__construct($attributes);

        $this->validators = array('validate_name');
    }

    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Opettaja');
        $query->execute();

        $rows = $query->fetchAll();
        $opettajat = array();

        foreach($rows as $row) {
            $opettajat[] = new Opettaja(array(
                'id' => $row['id'],
                'nimi' => $row['nimi']
            ));
        }

        return $opettajat;
    }

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Opettaja WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $opettaja = new Opettaja(array(
                'id' => $row['id'],
                'nimi' => $row['nimi']
            ));

            return $opettaja;
        }
    }

    public static function haeNimenPerusteella($nimi) {
        $query = DB::connection()->prepare('SELECT * FROM Opettaja WHERE nimi = :nimi LIMIT 1');
        $query->execute(array('nimi' => $nimi));
        $row = $query->fetch();

        if ($row) {
            $opettaja = new Opettaja(array(
                'id' => $row['id'],
                'nimi' => $row['nimi']
            ));

            return $opettaja;
        }
    }
/*
    public function tallenna() {
        $query = DB::connection()->prepare('INSERT INTO Opettaja (nimi) VALUES (:nimi) RETURNING ID');
        $query->execute(array('nimi' => $this->nimi));

        $row = $query->fetch();
        $this->id = $row['id'];
    }
*/
}