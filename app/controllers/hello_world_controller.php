<?php

  class HelloWorldController extends BaseController{

    public static function aihe_lista() {
	View::make('suunnitelmat/aihe_lista.html');
    }

    public static function index(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
   	  //View::make('home.html');
       echo 'Työaihetietokanta tulee tähän lähitulevaisuudessa.';
    }

    public static function sandbox(){
      // Testaa koodiasi täällä
      echo 'Hello World!';
    }
  }
