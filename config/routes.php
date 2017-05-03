<?php

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });

  $routes->get('/', function() {
    IndexController::index();
  });




// Aiheiden näyttämiseen, hakuun ja muokkaamiseen liittyvät pyynnöt

  $routes->get('/aiheet', function() {
    AiheetController::aihe_lista();
  });

  $routes->get('/aihe/uusi', function() {
    AiheetController::uusi_kaavio();
  });

    $routes->get('/aiheet', function() {
    AiheetController::aihe_lista();
  });

  $routes->get('/aihe/:id', function($id) {
    AiheetController::show($id);
  });

  $routes->get('/aihe/:id/edit', function($id){
    AiheetController::edit($id);
  });

  $routes->post('/aihe', function() {
    AiheetController::tallenna();
  });

  $routes->post('/aihe/:id/edit', function($id) {
    AiheetController::update($id);
  });

  $routes->post('/aihe/:id/poista', function($id) {
    AiheetController::poista($id);
  });



// Suoritusten näyttämiseen, hakuun ja muokkaamiseen liittyvät pyynnöt

  $routes->get('/suoritus/uusi/:aihe_id', function($aihe_id) {
    SuoritusController::uusi_suoritus($aihe_id);
  });

  $routes->get('/suoritus/:id', function($id) {
    SuoritusController::show($id);
  });

  $routes->get('/suoritus/:id/edit', function($id){
    SuoritusController::edit($id);
  });

  $routes->post('/suoritus', function() {
    SuoritusController::tallenna();
  });

  $routes->post('/suoritus/:id/edit', function($id) {
    SuoritusController::update($id);
  });

  $routes->post('/suoritus/:id/poista', function($id) {
    SuoritusController::poista($id);
  });



// Opettajien näyttämiseen ja hakuun liittyvät pyynnöt

  $routes->get('/opettaja/uusi', function() {
    OpettajaController::uusi_opettaja();
  });

  $routes->get('/opettajat', function() {
    OpettajaController::opettajat_lista();
  });
  
  $routes->get('/opettaja/:id', function($id) {
    OpettajaController::show($id);
  });

  $routes->post('/opettaja', function() {
    OpettajaController::tallenna();
  });



// Opiskelijoiden näyttämiseen ja hakuun liittyvät pyynnöt

  $routes->get('/opiskelija/uusi', function() {
    OpiskelijaController::uusi_opiskelija();
  });

  $routes->get('/opiskelijat', function() {
    OpiskelijaController::opiskelijat_lista();
  });

  $routes->get('/opiskelija/:id', function($id) {
    OpiskelijaController::show($id);
  });

  $routes->post('/opiskelija', function() {
    OpiskelijaController::tallenna();
  });



// Kurssien näyttämiseen ja hakuun liittyvät pyynnöt

  $routes->get('/kurssit', function() {
    KurssitController::kurssit();
  });

  $routes->get('/kurssi/:id', function($id) {
    KurssitController::show($id);
  });


// Sisäänkirjautumiseen liittyvät pyynnöt

  $routes->get('/login', function(){
    KayttajaController::login();
  });

  $routes->post('/login', function(){
    KayttajaController::handle_login();
  });

  $routes->post('/logout', function(){
    KayttajaController::handle_logout();
  });