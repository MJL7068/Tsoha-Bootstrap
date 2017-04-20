<?php

class OpettajaController extends BaseController {
    public static function show($id) {
        self::check_logged_in();
        
        $opettaja = Opettaja::find($id);

        $opettajanOhjaamatSuoritukset = Suoritus::haeSuorituksetOhjaajanMukaan($id);

        View::make('kayttajat/opettaja.html', array('opettaja' => $opettaja, 'suoritukset' => $opettajanOhjaamatSuoritukset));
    }

    public static function uusi_opettaja() {
        self::check_logged_in();

        View::make('kayttajat/opettaja_uusi.html');
    }
/*
    public static function tallenna() {
        $params = $_POST;

        $opettaja = new Opettaja(array(
            'nimi' => $params['nimi']
        ));

        $opettaja->tallenna();

        Redirect::to('/opettaja/' . $opettaja->id, array('message' => 'Opettajan tiedot lisätty tietokantaan.'));
    }
 */
}