<?php

class KurssitController extends BaseController {
    public static function kurssit() {
        $kurssit = Kurssi::all();

        View::make('suunnitelmat/kurssit_lista.html', array('kurssit' => $kurssit));
    }

    public static function show($id) {
        $kurssi = Kurssi::find($id);

        $aiheet = Aihe::aiheetKurssinPerusteella($id);

        View::make('suunnitelmat/kurssi_esittely.html', array('kurssi' => $kurssi, 'aiheet' => $aiheet));
    }

    public static function uusi_kurssi() {
        View::make('suunnitelmat/kurssi_uusi.html');
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