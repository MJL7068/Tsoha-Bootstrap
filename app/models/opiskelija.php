<?php

class Opiskelija extends BaseModel{
    public $id, $nimi, $opiskelijanumero;

    public function __construct($attributes) {
        parent::__construct($attributes);

        $this->validators = array('validate_name', 'validate_student_number');
    }

    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Opiskelija');
        $query->execute();

        $rows = $query->fetchAll();
        $opiskelijat = array();

        foreach($rows as $row) {
            $opiskelijat[] = new Opiskelija(array(
                'id' => $row['id'],
                'nimi' => $row['nimi'],
                'opiskelijanumero' => $row['opiskelijanumero']
            ));
        }

        return $opiskelijat;
    }

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Opiskelija WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $opiskelija = new Opiskelija(array(
                'id' => $row['id'],
                'nimi' => $row['nimi'],
                'opiskelijanumero' => $row['opiskelijanumero']
            ));

            return $opiskelija;
        }
    }
    
    public static function count() {
        $query = DB::connection()->prepare('SELECT COUNT(*) as lukumaara FROM Opiskelija');
        $query->execute();
        
        $row = $query->fetch();

        if ($row) {
            $lukumaara = $row['lukumaara'];
        }

        return $lukumaara;
    }

    public static function haeNimenPerusteella($nimi) {
        $query = DB::connection()->prepare('SELECT * FROM Opiskelija WHERE nimi = :nimi LIMIT 1');
        $query->execute(array('nimi' => $nimi));
        $row = $query->fetch();

        if ($row) {
            $opiskelija = new Opiskelija(array(
                'id' => $row['id'],
                'nimi' => $row['nimi'],
                'opiskelijanumero' => $row['opiskelijanumero']
            ));

            return $opiskelija;
        }
    }

    public function tallenna() {
        $query = DB::connection()->prepare('INSERT INTO Opiskelija (nimi, opiskelijanumero) VALUES (:nimi, :opiskelijanumero) RETURNING ID');
        $query->execute(array('nimi' => $this->nimi, 'opiskelijanumero' => $this->opiskelijanumero));

        $row = $query->fetch();
        $this->id = $row['id'];
    }

    public function validate_student_number() {
        $errors = array();

        if (!preg_match("/^[0-9]{9}$/", $this->opiskelijanumero)) {
            array_push($errors, 'Opiskelijanumeron tulee olla yhdeksän numeron mittainen!');
        }
        
        // Tulee tarkistaa että annettua opiskelijanumeroa ei ole vielä käytetty
        $query = DB::connection()->prepare('SELECT * FROM Opiskelija WHERE opiskelijanumero = :opiskelijanumero');
        $query->execute(array('opiskelijanumero' => $this->opiskelijanumero));
        
        $row = $query->fetch();
        if ($row) {
            array_push($errors, 'Opiskelijanumeron tulee olla uniikki!');
        }

        return $errors;
    }

}