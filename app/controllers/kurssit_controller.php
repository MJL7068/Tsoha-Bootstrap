<?php

class KurssitController extends BaseController {
    public static function kurssit() {
        $kurssit = Kurssi::all();

        View::make('kurssi/kurssit_lista.html', array('kurssit' => $kurssit));
    }

    public static function show($id) {
        $kurssi = Kurssi::find($id);

        $aiheet = Aihe::aiheetKurssinPerusteella($id);

        View::make('kurssi/kurssi_esittely.html', array('kurssi' => $kurssi, 'aiheet' => $aiheet));
    }

    public static function uusi_kurssi() {
        self::check_logged_in();

        View::make('kurssi/kurssi_uusi.html');
    }

    public static function tallenna() {
        $params = $_POST;

        $kurssi = new Kurssi(array(
            'nimi' => $params['nimi']
        ));

        $kurssi->tallenna();

        Redirect::to('/kurssi/' . $kurssi->id, array('message' => 'Kurssi lisätty tietokantaan.'));
    }
}