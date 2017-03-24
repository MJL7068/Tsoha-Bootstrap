<?php

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });

  $routes->get('/', function() {
    AiheetController::aihe_lista();
  });

  $routes->post('/aihe', function() {
    AiheetController::tallenna();
  });

  $routes->get('/aihe/uusi', function() {
    AiheetController::uusi_kaavio();
  });

  $routes->post('/suoritus', function() {
    SuoritusController::tallenna();
  });

  $routes->get('/suoritus/uusi', function() {
    SuoritusController::uusi_suoritus();
  });

  $routes->get('/kurssit', function() {
    KurssitController::kurssit();
  });

  $routes->get('/kurssi/:id', function($id) {
    KurssitController::show($id);
  });

  $routes->get('/aiheet', function() {
    AiheetController::aihe_lista();
  });

  $routes->get('/aihe/:id', function($id) {
    AiheetController::show($id);
  });
  
  $routes->get('/aihemuokkaus', function() {
    HelloWorldController::aihe_muokkaus();
  });

 /* $routes->get('/aiheuusi', function() {
    AiheetController::uusi_kaavio();
  });
  */
  $routes->get('/suoritus/:id', function($id) {
    SuoritusController::show($id);
  });

  $routes->get('/suoritusmuokkaus', function() {
    HelloWorldController::suoritus_muokkaus();
  });
  
  $routes->get('/login', function() {
    HelloWorldController::login();
  });

  $routes->get('/opiskelija/:id', function($id) {
    OpiskelijaController::show($id);
  });
  
  $routes->get('/opettaja/:id', function($id) {
    OpettajaController::show($id);
  });

  $routes->get('/haku', function() {
    HelloWorldController::haku();
  });
