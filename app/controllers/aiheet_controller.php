<?php

class AiheetController extends BaseController {
    
    public static function index() {
        $suoritusCount = Suoritus::count();
        $aiheCount = Aihe::count();
        $opiskelijaCount = Opiskelija::count();
        
        View::make('/index.html', array('suoritusCount' => $suoritusCount, 'aiheCount' => $aiheCount, 'opiskelijaCount' => $opiskelijaCount));
    }

    public static function aihe_lista() {
        $params = $_GET; 
        $options = array();
        
        if (isset($params['search'])) {
            $options['search'] = $params['search'];
        }
        
        $aiheet = Aihe::All($options);

        View::make('aihe/aihe_lista.html', array('aiheet' => $aiheet));
    }

    public static function show($id) {
        $aihe = Aihe::find($id);
        
        // Jos aihetta ei löydy esimerkiksi huonon linkin takia, palataan aihelistaukseen ja annetaan virheilmoitus
        if (!$aihe) {
            Redirect::to('/aiheet', array('message' => 'Aihetta ei ole olemassa!'));
        }
        
        // Haetaan kaikki aiheeseen liittyvä informaatio
        $suoritukset = Suoritus::haeSuorituksetAiheenMukaan($id);
        $kurssi = Kurssi::find($aihe->kurssi);
        $aiheenSuoritustenKeskiarvo = Suoritus::laskeSuoritustenArvosanojenKeskiarvo($suoritukset);
        $aiheenSuoritustenLukumaara = count($suoritukset);
        $aiheenSuoritustenMatalinArvosana = Suoritus::haeSuoritustenMatalinArvosana($suoritukset);
        $aiheenSuoritustenKorkeinArvosana = Suoritus::haeSuoritustenKorkeinarvosana($suoritukset);
        
        $data = array('lukumaara' => $aiheenSuoritustenLukumaara, 'keskiarvo' => $aiheenSuoritustenKeskiarvo, 'matalin' => $aiheenSuoritustenMatalinArvosana, 'korkein' => $aiheenSuoritustenKorkeinArvosana);

        View::make('aihe/aihe_esittely.html', array('aihe' => $aihe, 'suoritukset' => $suoritukset, 'kurssi' => $kurssi, 'data' => $data));
    }

    public static function uusi_kaavio() {
        $kurssit = Kurssi::all();

        self::check_logged_in();
        View::make('aihe/aihe_uusi.html', array('kurssit' => $kurssit));
    }

    public static function tallenna() {
        $params = $_POST;

        $kurssi = Kurssi::haeNimenPerusteella($params['kurssi']);

        $attributes = array(
            'nimi' => $params['nimi'],
            'vaikeustaso' => $params['vaikeustaso'],
            'maksimiarvosana' => $params['maksimiarvosana'],
            'kurssi' => $kurssi->id,
            'kuvaus' => $params['kuvaus']
        );

        $aihe = new Aihe($attributes);
        $errors = $aihe->errors();

        if (count($errors) == 0) {
            $aihe->tallenna();

            Redirect::to('/aihe/' . $aihe->id, array('message' => 'Aihe lisätty tietokantaan.'));
        } else {
            $kurssit = Kurssi::all();
            View::make('aihe/aihe_uusi.html', array('kurssit' => $kurssit, 'errors' => $errors, 'attributes' => $attributes));
        }
    }

    public static function edit($id) {
        self::check_logged_in();

        $aihe = Aihe::find($id);
        $kurssi = Kurssi::find($aihe->kurssi);
        $kurssit = Kurssi::all();

        View::make('aihe/aihe_edit.html', array('aihe' => $aihe, 'kurssi' => $kurssi, 'kurssit' => $kurssit));
    }

    public static function update($id) {
        $params = $_POST;

        $kurssi = Kurssi::haeNimenPerusteella($params['kurssi']);

        $attributes = array(
            'id' => $id,
            'nimi' => $params['nimi'],
            'vaikeustaso' => $params['vaikeustaso'],
            'maksimiarvosana' => $params['maksimiarvosana'],
            'kurssi' => $kurssi->id,
            'kuvaus' => $params['kuvaus']
        );

        $aihe = new Aihe($attributes);
        $errors = $aihe->errors();
        
        if (count($errors) == 0) {
            $aihe->update();
            Redirect::to('/aihe/' . $aihe->id, array('message' => 'Suoritusta muokattu onnistuneesti.'));
        } else {
            $aihe = Aihe::find($id);
            $kurssi = Kurssi::find($aihe->kurssi);
            $kurssit = Kurssi::all();
            
            View::make('aihe/aihe_edit.html', array('aihe' => $aihe, 'aihe_id' => $aihe->id, 'aihe_nimi' => $aihe->nimi, 'kurssi' => $kurssi, 'kurssit' => $kurssit, 'errors' => $errors, 'attributes' => $attributes));
        }
    }

    public static function poista($id) {
        Aihe::poista($id);

        Redirect::to('/', array('message' => 'Suoritus poistettu onnistunueesti.'));
    }

}
