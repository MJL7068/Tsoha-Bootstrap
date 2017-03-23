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
}