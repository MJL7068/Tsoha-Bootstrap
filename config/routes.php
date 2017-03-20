<?php

  $routes->get('/', function() {
    HelloWorldController::index();
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });

  $routes->get('/aiheet', function() {
    HelloWorldController::aihe_lista();
  });

  $routes->get('/aihe', function() {
    HelloWorldController::aihe_esittely();
  });

  $routes->get('/login', function() {
    HelloWorldController::login();
  });

  $routes->get('/opiskelija', function() {
    HelloWorldController::opiskelija();
  });

  $routes->get('/haku', function() {
    HelloWorldController::haku();
  });
