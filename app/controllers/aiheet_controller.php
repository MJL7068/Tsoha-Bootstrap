<?php

class AiheetController extends BaseController {
    public static function aihe_lista() {
        $aiheet = Aihe:All();

        View::make('suunnitelmat/aihe_lista.html', array('aiheet') => $aiheet);
    }
	
	public static function show($id) {
		$aihe = Aihe:find($id);
		
		View::make('suunnitelmat/aihe_esittely.html', array('aihe') => $aihe;
	}
}