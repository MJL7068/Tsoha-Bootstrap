<?php

class KurssitController extends BaseController {
    public static function kurssit() {
        $kurssit = Kurssi::all();

        View::make('kurssi/kurssit_lista.html', array('kurssit' => $kurssit));
    }

    public static function show($id) {
        $kurssi = Kurssi::find($id);
        
        if (!$kurssi) {
            Redirect::to('/kurssit', array('message' => 'Kurssia ei löytynyt!'));
        }

        $aiheet = Aihe::aiheetKurssinPerusteella($id);

        View::make('kurssi/kurssi_esittely.html', array('kurssi' => $kurssi, 'aiheet' => $aiheet));
    }

}