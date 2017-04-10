<?php

class SuoritusController extends BaseController {
    public static function show($id) {
        self::check_logged_in();

        $suoritus = Suoritus::find($id);

        $aihe = Aihe::find($suoritus->aihe);
        $ohjaaja = Opettaja::find($suoritus->ohjaaja);
        
        $tekijat_id = Suoritus::haeSuorituksenTekijat($id);
        $tekijat = array();
        foreach ($tekijat_id as $tekija_id) {
            array_push($tekijat, Opiskelija::find($tekija_id));
        }

        View::make('suunnitelmat/suoritus_esittely.html', array('suoritus' => $suoritus, 'aihe' => $aihe, 'ohjaaja' => $ohjaaja, 'tekijat' => $tekijat));
    }

    public static function uusi_suoritus($aihe_id) {
        self::check_logged_in();

        $aiheet = Aihe::all();
        $suorituksen_aihe = Aihe::find($aihe_id);
        $opiskelijat = Opiskelija::all();
        $opettajat = Opettaja::all();

        View::make('suunnitelmat/suoritus_uusi.html', array('aiheet' => $aiheet, 'opiskelijat' => $opiskelijat, 'opettajat' => $opettajat, 'suorituksenAihe' => $suorituksen_aihe));
    }

    public static function tallenna() {
        $params = $_POST;

        $aihe = Aihe::haeNimenPerusteella($params['aihe']);
        $opettaja = Opettaja::haeNimenPerusteella($params['ohjaaja']);

        $attributes = array(
            'aihe' => $aihe->id,
            'nimi' => $params['nimi'],
            'ohjaaja' => $opettaja->id,                
            'kuvaus' => $params['kuvaus'],
            'tyomaara' => $params['tyomaara'],
            'arvosana' => $params['arvosana'],
            'tekijat' => $params['tekijat']
        );

        $suoritus = new Suoritus($attributes);
        $errors = $suoritus->errors();

        if (count($errors) == 0) {
            $suoritus->tallenna();

            Redirect::to('/suoritus/' . $suoritus->id, array('message' => 'Uusi suoritus lisätty tietokantaan.'));
        } else {
            $aiheet = Aihe::all();
            $suorituksen_aihe = Aihe::find($aihe->id);
            $opiskelijat = Opiskelija::all();
            $opettajat = Opettaja::all();

            View::make('suunnitelmat/suoritus_uusi.html', array('aiheet' => $aiheet, 'opiskelijat' => $opiskelijat, 'opettajat' => $opettajat, 'errors' => $errors, 'attributes' => $attributes, 'suorituksenAihe' => $suorituksen_aihe));
        }
    }

    public static function edit($id) {
        self::check_logged_in();

        $suoritus = Suoritus::find($id);
        $aihe = Aihe::find($suoritus->aihe);
        $ohjaaja = Opettaja::find($suoritus->ohjaaja);
        
        $tekijat_id = Suoritus::haeSuorituksenTekijat($id);
        $tekijat = array();
        foreach ($tekijat_id as $tekija_id) {
            array_push($tekijat, Opiskelija::find($tekija_id));
        }
        
        $aiheet = Aihe::all();
        $opiskelijat = Opiskelija::all();
        $opettajat = Opettaja::all();

        View::make('suunnitelmat/suoritus_edit.html', array('suoritus' => $suoritus, 'aihe' => $aihe, 'tekijat' => $tekijat, 'ohjaaja' => $ohjaaja, 'aiheet' => $aiheet, 'opiskelijat' => $opiskelijat, 'opettajat' => $opettajat));
    }

    public static function update($id) {
        $params = $_POST;

        $aihe = Aihe::haeNimenPerusteella($params['aihe']);
        $opettaja = Opettaja::haeNimenPerusteella($params['ohjaaja']);

        $attributes = array(
            'id' => $id,
            'aihe' => $aihe->id,
            'nimi' => $params['nimi'],
            'tekijat' => $params['tekijat'],
            'ohjaaja' => $opettaja->id,                
            'kuvaus' => $params['kuvaus'],
            'tyomaara' => $params['tyomaara'],
            'arvosana' => $params['arvosana']
        );

        $suoritus = new Suoritus($attributes);
        $errors = $suoritus->errors();
        
        if (count($errors) == 0) {
            $suoritus->update();
            Redirect::to('/suoritus/' . $suoritus->id, array('message' => 'Suoritusta muokattu onnistuneesti.'));
        } else {
            $suoritus = Suoritus::find($id);
            $aihe = Aihe::find($suoritus->aihe);
            $ohjaaja = Opettaja::find($suoritus->ohjaaja);
            
            $tekijat_id = Suoritus::haeSuorituksenTekijat($id);
            $tekijat = array();
            foreach ($tekijat_id as $tekija_id) {
                array_push($tekijat, Opiskelija::find($tekija_id));
            }
        
            $aiheet = Aihe::all();
            $opiskelijat = Opiskelija::all();
            $opettajat = Opettaja::all();
            
            View::make('suunnitelmat/suoritus_edit.html', array('suoritus' => $suoritus, 'aihe' => $aihe, 'tekijat' => $tekijat, 'ohjaaja' => $ohjaaja, 'aiheet' => $aiheet, 'opiskelijat' => $opiskelijat, 'opettajat' => $opettajat, 'errors' => $errors));
        }
    }

    public static function poista($id) {
        Suoritus::poista($id);

        Redirect::to('/', array('message' => 'Suoritus poistettu onnistunueesti.'));
    }
}