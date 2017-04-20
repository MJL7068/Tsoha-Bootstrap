<?php

class OpettajaController extends BaseController {
    public static function show($id) {
        self::check_logged_in();
        
        $opettaja = Opettaja::find($id);

        $opettajanOhjaamatSuoritukset = Suoritus::haeSuorituksetOhjaajanMukaan($id);

        View::make('kayttajat/opettaja.html', array('opettaja' => $opettaja, 'suoritukset' => $opettajanOhjaamatSuoritukset));
    }
    
    public static function opettajat_lista() {
        self::check_logged_in();
        
        $opettajat = Opettaja::all();
        
        View::make('kayttajat/opettaja_lista.html', array('opettajat' => $opettajat));
    }

    public static function uusi_opettaja() {
        self::check_logged_in();

        View::make('kayttajat/opettaja_uusi.html');
    }

    public static function tallenna() {
        $params = $_POST;

        $attributes = array(
            'nimi' => $params['nimi']
        );

        $opettaja = new Opettaja($attributes);
        $errors = $opettaja->errors();

        if (count($errors) == 0) {
            $opettaja->tallenna();

            Redirect::to('/opettaja/' . $opettaja->id, array('message' => 'Opettajan tiedot lisätty tietokantaan.'));
        } else {
            View::make('kayttajat/opettaja_uusi.html', array('errors' => $errors, 'attributes' => $attributes));
        }
    }
 
}