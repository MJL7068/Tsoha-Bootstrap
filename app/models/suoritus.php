<?php

class Suoritus extends BaseModel{
    public $id, $aihe, $tekija, $ohjaaja, $kuvaus, $tyomaara, $arvosana;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Suoritus');
        $query->execute();

        $rows = $query->fetchAll();
        $suoritukset = array();

        foreach($rows as $row) {
            $suoritukset[] = new Suoritus(array(
                'id' => $row['id'],
                'aihe' => $row['aihe'],
                'tekija' => $row['tekija'],
                'ohjaaja' => $row['ohjaaja'],                
                'kuvaus' => $row['kuvaus'],
				'tyomaara' => $row['tyomaara'],
				'arvosana' => $row['arvosana']
            ));
        }

        return $suoritukset;
    }

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Suoritus WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $suoritus = new Suoritus(array(
                'id' => $row['id'],
                'aihe' => $row['aihe'],
                'tekija' => $row['tekija'],
                'ohjaaja' => $row['ohjaaja'],                
                'kuvaus' => $row['kuvaus'],
				'tyomaara' => $row['tyomaara'],
				'arvosana' => $row['arvosana']
            ));

            return $suoritus;
        }
    }
}