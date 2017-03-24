<?php

class SuoritusController extends BaseController {
    public static function show($id) {
        $suoritus = Suoritus::find($id);

        $aihe = Aihe::find($suoritus->aihe);
        $tekija = Opiskelija::find($suoritus->tekija);
        $ohjaaja = Opettaja::find($suoritus->ohjaaja);

        View::make('suunnitelmat/suoritus_esittely.html', array('suoritus' => $suoritus, 'aihe' => $aihe, 'tekija' => $tekija, 'ohjaaja' => $ohjaaja));
    }

    public static function uusi_suoritus() {
        $aiheet = Aihe::all();
        $opiskelijat = Opiskelija::all();
        $opettajat = Opettaja::all();

        View::make('suunnitelmat/suoritus_uusi.html', array('aiheet' => $aiheet, 'opiskelijat' => $opiskelijat, 'opettajat' => $opettajat));
    }

    public static function tallenna() {
        $params = $_POST;

        $aihe = Aihe::haeNimenPerusteella($params['aihe']);
        $opiskelija = Opiskelija::haeNimenPerusteella($params['tekija']);
        $opettaja = Opettaja::haeNimenPerusteella($params['ohjaaja']);

        $suoritus = new Suoritus(array(
            'id' => $row['id'],
            'aihe' => $aihe->id,
            'nimi' => $row['nimi'],
            'tekija' => $opiskelija->id,
            'ohjaaja' => $opettaja->id,                
            'kuvaus' => $row['kuvaus'],
			'tyomaara' => $row['tyomaara'],
			'arvosana' => $row['arvosana']
        ));

        $suoritus->tallenna();

        Redirect::to('/suoritus/' . $suoritus->id, array('message' => 'Uusi suoritus lisätty tietokantaan.'));
    }
}