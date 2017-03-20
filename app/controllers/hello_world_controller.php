<?php

  class HelloWorldController extends BaseController{

    public static function aihe_lista() {
	    View::make('suunnitelmat/aihe_lista.html');
    }

    public static function login() {
      View::make('suunnitelmat/login.html');
    }

    public static function aihe_esittely() {
      View::make('suunnitelmat/aihe_esittely.html');
    }

    public static function opiskelija() {
      View::make('suunnitelmat/opiskelija.html');
    }

    public static function haku() {
      View::make('suunnitelmat/haku.html');
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
