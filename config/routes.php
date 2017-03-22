<?php

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });

  $routes->get('/', function() {
    HelloWorldController::index();
  });

  $routes->get('/aiheet', function() {
    AiheetController::aihe_lista();
  });

  $routes->get('/aihe', function() {
    HelloWorldController::aihe_esittely();
  });
  
  $routes->get('/aihemuokkaus', function() {
    HelloWorldController::aihe_muokkaus();
  });
  
  $routes->get('/suoritus', function() {
    HelloWorldController::suoritus_esittely();
  });

  $routes->get('/suoritusmuokkaus', function() {
    HelloWorldController::suoritus_muokkaus();
  });
  
  $routes->get('/login', function() {
    HelloWorldController::login();
  });

  $routes->get('/opiskelija', function() {
    HelloWorldController::opiskelija();
  });
  
  $routes->get('/opettaja', function() {
    HelloWorldController::opettaja();
  });

  $routes->get('/haku', function() {
    HelloWorldController::haku();
  });
