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
            //$errors[] = 'Nimi ei saa olla tyhjä!';
            array_push($errors, 'Nimi ei saa olla tyhjä!');
        }

        if (strlen($this->nimi) < 3) {
            //$errors[] = 'Nimen pituuden tulee olla vähintään kolme merkkiä!';
            array_push($errors, 'Nimen pituuden tulee olla vähintään kolme merkkiä!');
        }

        return $errors;
    }

  }
