<?php

class OpiskelijaController extends BaseController {
    public static function show($id) {
        $opiskelija = Opiskelija::find($id);

        $suoritukset = Suoritus::haeSuorituksetTekijanMukaan($id);

        View::make('suunnitelmat/opiskelija.html', array('opiskelija' => $opiskelija, 'harjoitustyot' => $suoritukset));
    }
}