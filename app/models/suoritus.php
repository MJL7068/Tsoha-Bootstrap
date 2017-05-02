<?php

class Suoritus extends BaseModel {

    public $id, $aihe, $nimi, $ohjaaja, $kuvaus, $tyomaara, $arvosana, $tekijat;

    public function __construct($attributes) {
        parent::__construct($attributes);

        $this->validators = array('validate_name', 'validate_description', 'validate_effort', 'validate_tekijat');
    }

    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Suoritus');
        $query->execute();

        $rows = $query->fetchAll();
        $suoritukset = array();

        foreach ($rows as $row) {
            $suoritukset[] = new Suoritus(array(
                'id' => $row['id'],
                'aihe' => $row['aihe'],
                'nimi' => $row['nimi'],
                'ohjaaja' => $row['ohjaaja'],
                'kuvaus' => $row['kuvaus'],
                'tyomaara' => $row['tyomaara'],
                'arvosana' => $row['arvosana']
            ));
        }

        return $suoritukset;
    }

    public static function find($id) {
        // Tarkistetaan onko suorituksen tunnuksena annettu muuttuva kokonaisluku
        if (!is_numeric($id)) {
            return null;
        }
        
        $query = DB::connection()->prepare('SELECT * FROM Suoritus WHERE id = :id');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $suoritus = new Suoritus(array(
                'id' => $row['id'],
                'aihe' => $row['aihe'],
                'nimi' => $row['nimi'],
                'ohjaaja' => $row['ohjaaja'],
                'kuvaus' => $row['kuvaus'],
                'tyomaara' => $row['tyomaara'],
                'arvosana' => $row['arvosana']
            ));

            return $suoritus;
        }
    }
    
    public static function count() {
        $query = DB::connection()->prepare('SELECT COUNT(*) as lukumaara FROM Suoritus');
        $query->execute();
        
        $row = $query->fetch();

        if ($row) {
            $lukumaara = $row['lukumaara'];
        }

        return $lukumaara;
    }
    

    public function tallenna() {
        $query = DB::connection()->prepare('INSERT INTO Suoritus (aihe, nimi, ohjaaja, kuvaus, tyomaara, arvosana) VALUES (:aihe, :nimi, :ohjaaja, :kuvaus, :tyomaara, :arvosana) RETURNING id');
        $query->execute(array('aihe' => $this->aihe, 'nimi' => $this->nimi, 'ohjaaja' => $this->ohjaaja, 'kuvaus' => $this->kuvaus, 'tyomaara' => $this->tyomaara, 'arvosana' => $this->arvosana));
        $row = $query->fetch();

        $this->id = $row['id'];
        
        self::tallennaSuorituksenTekijat($this->tekijat);
    }
    
    public function tallennaSuorituksenTekijat($tekijat) {        
        foreach($tekijat as $tekija) {
            $query = DB::connection()->prepare('INSERT INTO Suorittaja (opiskelija, suoritus) VALUES (:opiskelija, :suoritus)');
            $query->execute(array('opiskelija' => $tekija, 'suoritus' => $this->id));
        }
    }
    
    public function haeSuorituksenTekijat($id) {
        $query = DB::connection()->prepare('SELECT * FROM Suorittaja WHERE suoritus = :id');
        $query->execute(array('id' => $id));
        
        $rows = $query->fetchAll();
        $suoritukset_id = array();
        
        foreach ($rows as $row) {
            $suoritukset_id[] = $row['opiskelija'];
        }
        
        return $suoritukset_id;
    }

    public static function haeSuorituksetTekijanMukaan($id) {
        $query = DB::connection()->prepare('SELECT * FROM Suorittaja WHERE opiskelija = :id');
        $query->execute(array('id' => $id));
        
        $rows = $query->fetchAll();
        $suoritukset = array();
        
        foreach ($rows as $row) {
            $suoritukset[] = self::find($row['suoritus']);
        }
        
        return $suoritukset;
    }

    public static function haeSuorituksetOhjaajanMukaan($id) {
        $query = DB::connection()->prepare('SELECT * FROM Suoritus WHERE ohjaaja = :id');
        $query->execute(array('id' => $id));

        $rows = $query->fetchAll();
        $suoritukset = array();

        foreach ($rows as $row) {
            $suoritukset[] = new Suoritus(array(
                'id' => $row['id'],
                'aihe' => $row['aihe'],
                'nimi' => $row['nimi'],
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

        foreach ($rows as $row) {
            $suoritukset[] = new Suoritus(array(
                'id' => $row['id'],
                'aihe' => $row['aihe'],
                'nimi' => $row['nimi'],
                'ohjaaja' => $row['ohjaaja'],
                'kuvaus' => $row['kuvaus'],
                'tyomaara' => $row['tyomaara'],
                'arvosana' => $row['arvosana']
            ));
        }

        return $suoritukset;
    }

    public static function laskeSuoritustenArvosanojenKeskiarvo($suoritukset) {
        $summa = 0;
        foreach ($suoritukset as $suoritus) {
            $summa += $suoritus->arvosana;
        }
        
        return number_format((float) ($summa / count($suoritukset)), 1, '.', '');
    }

    public static function haeSuoritustenKorkeinarvosana($suoritukset) {
        $korkein = 0;
        foreach ($suoritukset as $suoritus) {
            if ($suoritus->arvosana > $korkein) {
                $korkein = $suoritus->arvosana;
            }
        }
        
        return $korkein;
    }

    public static function haeSuoritustenMatalinArvosana($suoritukset) {
        $matalin = 5;
        foreach ($suoritukset as $suoritus) {
            if ($suoritus->arvosana < $matalin) {
                $matalin = $suoritus->arvosana;
            }
        }
        
        return $matalin;
    }

    public static function poista($id) {
        self::poistaSuorituksenTekijat($id);
        
        $query = DB::connection()->prepare('DELETE FROM Suoritus WHERE id = :id');
        $query->execute(array('id' => $id));
    }
    
    public static function poistaSuorituksenTekijat($id) {
        $query = DB::connection()->prepare('DELETE FROM Suorittaja WHERE suoritus = :id');
        $query->execute(array('id' => $id));
    }

    public function update() {
        $query = DB::connection()->prepare('UPDATE Suoritus SET aihe = :aihe, nimi = :nimi, ohjaaja = :ohjaaja, kuvaus = :kuvaus, tyomaara = :tyomaara, arvosana = :arvosana WHERE id = :id');
        $query->execute(array('aihe' => $this->aihe, 'nimi' => $this->nimi, 'ohjaaja' => $this->ohjaaja, 'kuvaus' => $this->kuvaus, 'tyomaara' => $this->tyomaara, 'arvosana' => $this->arvosana, 'id' => $this->id));
        $query->fetch();
        
        self::updateSuorituksenTekijat($this->tekijat);
    }
    
    public function updateSuorituksenTekijat($tekijat) {
        self::poistaSuorituksenTekijat($this->id);
        foreach ($tekijat as $tekija) {
            $query = DB::connection()->prepare('INSERT INTO Suorittaja (opiskelija, suoritus) VALUES (:opiskelija, :suoritus)');
            $query->execute(array('opiskelija' => $tekija, 'suoritus' => $this->id));
        }
    }

    public function validate_name() {
        $errors = array();

        if ($this->nimi == '' || $this->nimi == null) {
            array_push($errors, 'Nimi ei saa olla tyhjä!');
        }

        if (strlen($this->nimi) < 3) {
            array_push($errors, 'Nimen pituuden tulee olla vähintään kolme merkkiä!');
        }

        return $errors;
    }
/*
    public function validate_description() {
        $errors = array();

        if ($this->kuvaus == '' || $this->kuvaus == null) {
            array_push($errors, 'Kuvaus ei saa olla tyhjä!');
        }
        
        if (strlen($this->kuvaus) > 400) {
            array_push($errors, 'Kuvaus saa olla korkeintaan 400 merkkiä pitkä!');
        }

        return $errors;
    }
*/
    public function validate_effort() {
        $errors = array();

        if (!is_numeric($this->tyomaara)) {
            array_push($errors, 'Annetun työmäärän pitää olla numero!');
        }

        if ($this->tyomaara < 0) {
            array_push($errors, 'Työmäärä ei saa olla negatiivinen!');
        }

        if ($this->tyomaara > 20000) {
            array_push($errors, 'Annettu työmäärä liian suuri!');
        }

        return $errors;
    }
    
    public function validate_tekijat() {
        $errors = array();
        
        if (count($this->tekijat) < 1) {
            array_push($errors, 'Suorituksella tulee olla ainakin yksi tekijä!');
        }
        
        if (count($this->tekijat) > 4) {
            array_push($errors, 'Suorituksella saa olla korkeintaan neljä tekijää!');
        }
        
        return $errors;
    }

}
