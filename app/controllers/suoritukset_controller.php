<?php

class SuoritusController extends BaseController {
    public static function show($id) {
        self::check_logged_in();

        $suoritus = Suoritus::find($id);

        $aihe = Aihe::find($suoritus->aihe);
        $tekija = Opiskelija::find($suoritus->tekija);
        $ohjaaja = Opettaja::find($suoritus->ohjaaja);

        View::make('suunnitelmat/suoritus_esittely.html', array('suoritus' => $suoritus, 'aihe' => $aihe, 'tekija' => $tekija, 'ohjaaja' => $ohjaaja));
    }

    public static function uusi_suoritus() {
        self::check_logged_in();

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

        $attributes = array(
            'aihe' => $aihe->id,
            'nimi' => $params['nimi'],
            'tekija' => $opiskelija->id,
            'ohjaaja' => $opettaja->id,                
            'kuvaus' => $params['kuvaus'],
			'tyomaara' => $params['tyomaara'],
			'arvosana' => $params['arvosana']
        );

        $suoritus = new Suoritus($attributes);
        $errors = $suoritus->errors();

        if (count($errors) == 0) {
            $suoritus->tallenna();

            Redirect::to('/suoritus/' . $suoritus->id, array('message' => 'Uusi suoritus lisätty tietokantaan.'));
        } else {
            $aiheet = Aihe::all();
            $opiskelijat = Opiskelija::all();
            $opettajat = Opettaja::all();

            View::make('suunnitelmat/suoritus_uusi.html', array('aiheet' => $aiheet, 'opiskelijat' => $opiskelijat, 'opettajat' => $opettajat, 'errors' => $errors, 'attributes' => $attributes));
        }
    }

    public static function edit($id) {
        self::check_logged_in();

        $suoritus = Suoritus::find($id);
        $aihe = Aihe::find($suoritus->aihe);
        $tekija = Opiskelija::find($suoritus->tekija);
        $ohjaaja = Opettaja::find($suoritus->ohjaaja);

        View::make('suunnitelmat/suoritus_edit.html', array('suoritus' => $suoritus, 'aihe' => $aihe, 'tekija' => $tekija, 'ohjaaja' => $ohjaaja));
    }

    public static function update($id) {
        $params = $_POST;

        $aihe = Aihe::haeNimenPerusteella($params['aihe']);
        $opiskelija = Opiskelija::haeNimenPerusteella($params['tekija']);
        $opettaja = Opettaja::haeNimenPerusteella($params['ohjaaja']);

        $attributes = array(
            'id' => $id,
            'aihe' => $aihe->id,
            'nimi' => $params['nimi'],
            'tekija' => $opiskelija->id,
            'ohjaaja' => $opettaja->id,                
            'kuvaus' => $params['kuvaus'],
			'tyomaara' => $params['tyomaara'],
			'arvosana' => $params['arvosana']
        );

        $suoritus = new Suoritus($attributes);
        $suoritus->update();

        Redirect::to('/suoritus/' . $suoritus->id, array('message' => 'Suoritusta muokattu onnistuneesti.'));
    }

    public static function poista($id) {
        Suoritus::poista($id);

        Redirect::to('/', array('message' => 'Suoritus poistettu onnistunueesti.'));
    }
}