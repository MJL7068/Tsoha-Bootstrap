<?php

  class BaseModel{
    // "protected"-attribuutti on käytössä vain luokan ja sen perivien luokkien sisällä
    protected $validators;

    public function __construct($attributes = null){
      // Käydään assosiaatiolistan avaimet läpi
      foreach($attributes as $attribute => $value){
        // Jos avaimen niminen attribuutti on olemassa...
        if(property_exists($this, $attribute)){
          // ... lisätään avaimen nimiseen attribuuttin siihen liittyvä arvo
          $this->{$attribute} = $value;
        }
      }
    }

    public function errors(){
      $errors = array();

      foreach($this->validators as $validator){
        $errors = array_merge($errors, $this->{$validator}());
      }

      return $errors;
    }

    public function validate_name() {
        $errors = array();

        if ($this->nimi == '' || $this->nimi == null) {
            array_push($errors, 'Nimi ei saa olla tyhjä!');
        }

        if (strlen($this->nimi) < 3) {
            array_push($errors, 'Nimen pituuden tulee olla vähintään kolme merkkiä!');
        }

        if (strlen($this->nimi) > 50) {
          array_push($errors, 'Nimi saa olla korkeintaan 50 merkkiä!');
        }

        return $errors;
    }

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

  }
