<?php

class Suoritus extends BaseModel{
    public $id, $aihe, $nimi, $tekija, $ohjaaja, $kuvaus, $tyomaara, $arvosana;

    public function __construct($attributes) {
        parent::__construct($attributes);

        $this->validators = array('validate_name', 'validate_description', 'validate_effort');
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
                'nimi' => $row['nimi'],
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
        $query = DB::connection()->prepare('SELECT * FROM Suoritus WHERE id = :id');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $suoritus = new Suoritus(array(
                'id' => $row['id'],
                'aihe' => $row['aihe'],
                'nimi' => $row['nimi'],
                'tekija' => $row['tekija'],
                'ohjaaja' => $row['ohjaaja'],                
                'kuvaus' => $row['kuvaus'],
				'tyomaara' => $row['tyomaara'],
				'arvosana' => $row['arvosana']
            ));

            return $suoritus;
        }
    }

    public function tallenna() {
        $query = DB::connection()->prepare('INSERT INTO Suoritus (aihe, nimi, tekija, ohjaaja, kuvaus, tyomaara, arvosana) VALUES (:aihe, :nimi, :tekija, :ohjaaja, :kuvaus, :tyomaara, :arvosana) RETURNING id');
        $query->execute(array('aihe' => $this->aihe, 'nimi' => $this->nimi, 'tekija' => $this->tekija, 'ohjaaja' => $this->ohjaaja, 'kuvaus' => $this->kuvaus, 'tyomaara' => $this->tyomaara, 'arvosana' => $this->arvosana));
        $row = $query->fetch();

        $this->id = $row['id'];
    }

    public static function haeSuorituksetTekijanMukaan($id) {
        $query = DB::connection()->prepare('SELECT * FROM Suoritus WHERE tekija = :id');
        $query->execute(array('id' => $id));

        $rows = $query->fetchAll();
        $suoritukset = array();

        foreach($rows as $row) {
            $suoritukset[] = new Suoritus(array(
                'id' => $row['id'],
                'aihe' => $row['aihe'],
                'nimi' => $row['nimi'],
                'tekija' => $row['tekija'],
                'ohjaaja' => $row['ohjaaja'],                
                'kuvaus' => $row['kuvaus'],
				'tyomaara' => $row['tyomaara'],
				'arvosana' => $row['arvosana']
            ));
        }

        return $suoritukset;
    }

    public static function haeSuorituksetOhjaajanMukaan($id) {
        $query = DB::connection()->prepare('SELECT * FROM Suoritus WHERE ohjaaja = :id');
        $query->execute(array('id' => $id));

        $rows = $query->fetchAll();
        $suoritukset = array();

        foreach($rows as $row) {
            $suoritukset[] = new Suoritus(array(
                'id' => $row['id'],
                'aihe' => $row['aihe'],
                'nimi' => $row['nimi'],
                'tekija' => $row['tekija'],
                'ohjaaja' => $row['ohjaaja'],                
                'kuvaus' => $row['kuvaus'],
				'tyomaara' => $row['tyomaara'],
				'arvosana' => $row['arvosana']
            ));
        }

        return $suoritukset;
    }

    public static function haeSuorituksetAiheenMukaan($id) {
        $query = DB::connection()->prepare('SELECT * FROM Suoritus WHERE aihe = :id');
        $query->execute(array('id' => $id));

        $rows = $query->fetchAll();
        $suoritukset = array();

        foreach($rows as $row) {
            $suoritukset[] = new Suoritus(array(
                'id' => $row['id'],
                'aihe' => $row['aihe'],
                'nimi' => $row['nimi'],
                'tekija' => $row['tekija'],
                'ohjaaja' => $row['ohjaaja'],                
                'kuvaus' => $row['kuvaus'],
				'tyomaara' => $row['tyomaara'],
				'arvosana' => $row['arvosana']
            ));
        }

        return $suoritukset;
    }

    public static function poista($id) {
        $query = DB::connection()->prepare('DELETE FROM Suoritus WHERE id = :id');
        $query->execute(array('id' => $id));
    }

    public function update() {
        $query = DB::connection()->prepare('UPDATE Suoritus SET aihe = :aihe, nimi = :nimi, tekija = :tekija, ohjaaja = :ohjaaja, kuvaus = :kuvaus, tyomaara = :tyomaara, arvosana = :arvosana WHERE id = :id');
        $query->execute(array('aihe' => $this->aihe, 'nimi' => $this->nimi, 'tekija' => $this->tekija, 'ohjaaja' => $this->ohjaaja, 'kuvaus' => $this->kuvaus, 'tyomaara' => $this->tyomaara, 'arvosana' => $this->arvosana, 'id' => $this->id));
        $query->fetch();
    }

    public function validate_name() {
        $errors = array();

        if ($this->nimi == '' || $this->nimi == null) {
            $errors[] = 'Nimi ei saa olla tyhjä!';
        }

        if (strlen($this->nimi) < 3) {
            $errors[] = 'Nimen pituuden tulee olla vähintään kolme merkkiä!';
        }

        return $errors;
    }

    public function validate_description() {
        $errors = array();

        if ($this->nimi == '' || $this->nimi == null) {
            $errors[] = 'Kuvaus ei saa olla tyhjä!';
        }

        return $errors;
    }

    public function validate_effort() {
        $errors = array();

        if (!is_numeric($this->tyomaara)) {
            $errors[] = 'Annetun työmäärän pitää olla numero!';
        }

        if ($this->tyomaara < 0) {
            $errors[] = 'Työmäärä ei saa olla negatiivinen!';
        }

        if ($this->tyomaara > 20000) {
            $errors[] = 'Annettu työmäärä liian suuri!';
        }

        return $errors;
    }
}
