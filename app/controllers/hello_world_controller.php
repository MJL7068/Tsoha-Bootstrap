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
	
	public static function aihe_muokkaus() {
      View::make('suunnitelmat/aihe_muokkaus.html');
    }
	
    public static function suoritus_esittely() {
      View::make('suunnitelmat/suoritus_esittely.html');
    }

    public static function suoritus_muokkaus() {
      View::make('suunnitelmat/suoritus_muokkaus.html');
    }	

    public static function opiskelija() {
      View::make('suunnitelmat/opiskelija.html');
    }
	
	public static function opettaja() {
		View::make('suunnitelmat/opettaja.html');
	}

    public static function haku() {
      View::make('suunnitelmat/haku.html');
    }

    public static function index(){
       View::make('suunnitelmat/aihe_lista.html');
    }

  }
