<?php

class AiheetController extends BaseController {
    public static function aihe_lista() {
        $aiheet = Aihe:All();

        View::make('suunnitelmat/aihe_lista.html', array('aiheet') => $aiheet);
    }
}