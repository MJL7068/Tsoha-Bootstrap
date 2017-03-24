<?php

class AiheetController extends BaseController {
    public static function aihe_lista() {
        $aiheet = Aihe::All();

        View::make('suunnitelmat/aihe_lista.html', array('aiheet' => $aiheet));
    }
	
	public static function show($id) {
		$aihe = Aihe::find($id);

        $suoritukset = Suoritus::haeSuorituksetAiheenMukaan($id);
		
		View::make('suunnitelmat/aihe_esittely.html', array('aihe' => $aihe, 'suoritukset' => $suoritukset));
	}

    public static function uusi_kaavio() {
        $kurssit = Kurssi::all();

        View::make('suunnitelmat/aihe_uusi.html', array('kurssit' => $kurssit));
    }

    public static function tallenna() {
        $params = $_POST;

        $kurssi = Kurssi::haeNimenPerusteella($params['kurssi']);

        $aihe = new Aihe(array(
            'nimi' => $params['nimi'],
            'vaikeustaso' => $params['vaikeustaso'],
            'maksimiarvosana' => $params['maksimiarvosana'],
            'kurssi' => $kurssi->id,
            'kuvaus' => $params['kuvaus']
        ));

        $aihe->tallenna();

        Redirect::to('/aihe/' . $aihe->id, array('message' => 'Aihe lisätty tietokantaan.'));
    }
}