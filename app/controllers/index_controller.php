<?php

class IndexController extends BaseController {
    
    public static function index() {
        $suoritusCount = Suoritus::count();
        $aiheCount = Aihe::count();
        $opiskelijaCount = Opiskelija::count();
        
        View::make('/index.html', array('suoritusCount' => $suoritusCount, 'aiheCount' => $aiheCount, 'opiskelijaCount' => $opiskelijaCount));
    }
}
