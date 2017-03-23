<?php

class OpiskelijaController extends BaseController {
    public static function show($id) {
        $opiskelija = Opiskelija::find($id);

        View::make('suunnitelmat/opiskelija.html', array('opiskelija' => $opiskelija));
    }
}