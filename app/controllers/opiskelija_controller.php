<?php

class OpiskelijaController extends BaseController {
    public static function show($id) {
        $opiskelija = Opiskelija::find($id);

        $suoritukset = Suoritus::haeSuorituksetTekijanMukaan($id);

        View::make('suunnitelmat/opiskelija.html', array('opiskelija' => $opiskelija, 'harjoitustyot' => $suoritukset));
    }

    public static function uusi_opiskelija() {
        View::make('suunnitelmat/opiskelija_uusi.html');
    }

    public static function tallenna() {
        $params = $_POST;

        $opiskelija = new Opiskelija(array(
            'nimi' => $params['nimi'],
            'opiskelijanumero' => $params['opiskelijanumero']
        ));

        $opiskelija->tallenna();

        Redirect::to('/opiskelija/' . $opiskelija->id, array('message' => 'Opiskelijan tiedot lisätty tietokantaan.'));
    }
}