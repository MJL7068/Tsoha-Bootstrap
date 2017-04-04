<?php

require 'app/models/aihe.php';

class HelloWorldController extends BaseController {

    public static function sandbox() {
        $drinkit = Aihe::find(1);
        $aiheet = Aihe::all();

        $opiskelija = Opiskelija::find(1);
        $opiskelijat = Opiskelija::all();

        $suoritus = Suoritus::find(1);
        $suoritukset = Suoritus::all();

        $kurssi = Kurssi::find(1);
        $kurssit = Kurssi::all();

        Kint::dump($aiheet);
        Kint::dump($drinkit);

        Kint::dump($opiskelija);
        Kint::dump($opiskelijat);

        Kint::dump($suoritus);
        Kint::dump($suoritukset);

        Kint::dump($kurssi);
        Kint::dump($kurssit);

        Kint::dump(Suoritus::haeSuorituksetOhjaajanMukaan(2));

        Kint::dump(Suoritus::haeKorkeinArvosanaAiheenMukaan(2));
        Kint::dump(Suoritus::haeMatalinArvosanaAiheenMukaan(2));

        $ville = new Opiskelija(array(
            'nimi' => 'vi',
            'opiskelijanumero' => '014412354'
        ));
        $errors = $ville->errors();
        Kint::dump($errors);
    }

    public static function aihe_lista() {
        View::make('suunnitelmat/aihe_lista.html');
    }

    public static function login() {
        View::make('suunnitelmat/login.html');
    }

    public static function aihe_esittely() {
        View::make('suunnitelmat/aihe_esittely.html');
    }

    public static function aihe_muokkaus() {
        View::make('suunnitelmat/aihe_muokkaus.html');
    }

    public static function suoritus_esittely() {
        View::make('suunnitelmat/suoritus_esittely.html');
    }

    public static function suoritus_muokkaus() {
        View::make('suunnitelmat/suoritus_muokkaus.html');
    }

    public static function opiskelija() {
        View::make('suunnitelmat/opiskelija.html');
    }

    public static function opettaja() {
        View::make('suunnitelmat/opettaja.html');
    }

    public static function haku() {
        View::make('suunnitelmat/haku.html');
    }

    public static function index() {
        View::make('suunnitelmat/aihe_lista.html');
    }

}
