<?php

class Kayttaja extends BaseModel {
    public $id, $nimi, $salasana;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    public static function authenticate($kayttajatunnus, $salasana) {
        $query = DB::connection()->prepare('SELECT * FROM Yllapitaja WHERE nimi = :nimi AND salasana = :salasana LIMIT 1');
        $query->execute(array('nimi' => $kayttajatunnus, 'salasana' => $salasana));
        $row = $query->fetch();
        
        if ($row) {
            $kayttaja = new Kayttaja(array (
                'id' => $row['id'],
                'nimi' => $row['nimi'],
                'salasana' => $row['salasana']
            ));

            return $kayttaja;
        } else {
            return null;
        }
    }

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Yllapitaja WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $kayttaja = new Kayttaja(array (
                'id' => $row['id'],
                'nimi' => $row['nimi'],
                'salasana' => $row['salasana']
            ));

            return $kayttaja;
        }
    }
}