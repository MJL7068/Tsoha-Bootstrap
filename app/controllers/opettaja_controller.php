<?php

class OpettajaController extends BaseController {
    public static function show($id) {
        $opettaja = Opettaja::find($id);

        View::make('suunnitelmat/opettaja.html', array('opettaja' => $opettaja));
    }
}