<?php

class KayttajaController extends BaseController {
    public static function login() {
        View::make('suunnitelmat/login.html');
    }

    public static function handle_login() {
        $params = $_POST;

        $kayttaja = Kayttaja::authenticate($params['kayttajatunnus'], $params['salasana']);

        if (!$kayttaja) {
            View::make('suunnitelmat/login.html', array('error' => 'Väärä käyttäjätunnus tai salasana!', 'kayttajatunnus' => $params['kayttajatunnus']));
        } else {
            $_SESSION['user'] = $kayttaja->id;

            Redirect::to('/', array('message' => 'Tervetuloa takaisin ' . $kayttaja->nimi . '!'));
        }
    }
    
    public static function handle_logout() {
        /*if (self::get_user_logged_in()) {
            $_SESSTION['user'] = null;

            Redirect::to('/', array('message' => 'Kirjauduttu ulos'));
        } else {
            Redirect::to('/');
        }*/
        $_SESSION['user'] = null;
        Redirect::to('/login', array('message' => 'Olet kirjautunut ulos!'));
    }
}