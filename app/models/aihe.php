<?php

class Aihe extends BaseModel{
    public $id, $nimi, $vaikeustaso, $maksimiarvosana, $kurssi, $kuvaus;

    public function __construct($attributes) {
        parent::__construct($attributes);

        $this->validators = array('validate_name', 'validate_description');
    }

    public static function all($options) {
        $query_string = 'SELECT * FROM Aihe';
        $arr = array();
        if (isset($options['search'])) {
            $query_string .= ' WHERE nimi LIKE :like';
            $arr['like'] = '%' . $options['search'] . '%';
        }
        
        $query = DB::connection()->prepare($query_string/*'SELECT * FROM Aihe'*/);
        $query->execute($arr);

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
    
    public static function count() {
        $query = DB::connection()->prepare('SELECT COUNT(*) as lukumaara FROM Aihe');
        $query->execute();
        
        $row = $query->fetch();

        if ($row) {
            $lukumaara = $row['lukumaara'];
        }

        return $lukumaara;
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

    public static function haeNimenPerusteella($nimi) {
        $query = DB::connection()->prepare('SELECT * FROM Aihe WHERE nimi = :nimi LIMIT 1');
        $query->execute(array('nimi' => $nimi));
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

    public function tallenna() {
        $query = DB::connection()->prepare('INSERT INTO Aihe (nimi, vaikeustaso, maksimiarvosana, kurssi, kuvaus) VALUES (:nimi, :vaikeustaso, :maksimiarvosana, :kurssi, :kuvaus) RETURNING ID');
        $query->execute(array('nimi' => $this->nimi, 'vaikeustaso' => $this->vaikeustaso, 'maksimiarvosana' => $this->maksimiarvosana, 'kurssi' => $this->kurssi, 'kuvaus' => $this->kuvaus));

        $row = $query->fetch();
        $this->id = $row['id'];
    }

    public static function poista($id) {
        // Poistetaan ensin aiheeseen liittyvät suoritukset tietokannasta.
        $query = DB::connection()->prepare('SELECT id FROM Suoritus WHERE aihe = :id');
        $query->execute(array('id' => $id));
        
        $rows = $query->fetchAll();
        foreach($rows as $row) {
            Suoritus::poistaSuorituksenTekijat($row['id']);
        }
        
        $query = DB::connection()->prepare('DELETE FROM Suoritus WHERE aihe = :id');
        $query->execute(array('id' => $id));
        
        // Poistetaan itse aihe.
        $query = DB::connection()->prepare('DELETE FROM Aihe WHERE id = :id');
        $query->execute(array('id' => $id));
    }

    public function update() {
        $query = DB::connection()->prepare('UPDATE Aihe SET nimi = :nimi, vaikeustaso = :vaikeustaso, maksimiarvosana = :maksimiarvosana, kurssi = :kurssi, kuvaus = :kuvaus WHERE id = :id');
        $query->execute(array('nimi' => $this->nimi, 'vaikeustaso' => $this->vaikeustaso, 'maksimiarvosana' => $this->maksimiarvosana, 'kurssi' => $this->kurssi, 'kuvaus' => $this->kuvaus, 'id' => $this->id));
    }

    public function validate_name() {
        $errors = array();

        if($this->nimi == '' || $this->nimi == null){
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

        return $errors;
    }
 */
}