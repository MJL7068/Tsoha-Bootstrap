<?php

class OpiskelijaController extends BaseController {
    public static function show($id) {
        self::check_logged_in();

        $opiskelija = Opiskelija::find($id);

        $suoritukset = Suoritus::haeSuorituksetTekijanMukaan($id);

        View::make('suunnitelmat/opiskelija.html', array('opiskelija' => $opiskelija, 'harjoitustyot' => $suoritukset));
    }

    public static function uusi_opiskelija() {
        self::check_logged_in();

        View::make('suunnitelmat/opiskelija_uusi.html');
    }

    public static function tallenna() {
        $params = $_POST;

        $attributes = array(
            'nimi' => $params['nimi'],
            'opiskelijanumero' => $params['opiskelijanumero']
        );

        $opiskelija = new Opiskelija($attributes);
        $errors = $opiskelija->errors();

        if (count($errors) == 0) {
            $opiskelija->tallenna();

            Redirect::to('/opiskelija/' . $opiskelija->id, array('message' => 'Opiskelijan tiedot lisätty tietokantaan.'));
        } else {
            View::make('suunnitelmat/opiskelija_uusi.html', array('errors' => $errors, 'attributes' => $attributes));
        }
    }
}