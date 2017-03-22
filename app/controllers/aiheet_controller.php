<?php

class AiheetController extends BaseController {
    public static function index() {
        $aiheet = Aihe:All();

        View::make('suunnitelmat/aihe_lista.html', array('aiheet') => $aiheet);
    }
}