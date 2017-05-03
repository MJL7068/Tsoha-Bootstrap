<?php

require 'app/models/aihe.php';

class HelloWorldController extends BaseController {

    public static function sandbox() {
        $drinkit = Aihe::find(1);
        $aiheet = Aihe::all(array());

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

        Kint::dump(Suoritus::haeSuoritustenKorkeinarvosana(2));
        Kint::dump(Suoritus::haeSuoritustenMatalinArvosana(2));

        $ville = new Opiskelija(array(
            'nimi' => 'vi',
            'opiskelijanumero' => '014412354'
        ));
        $errors = $ville->errors();
        Kint::dump($errors);

        Kint::dump(Suoritus::haeSuorituksenTekijat(6));
    }


}
