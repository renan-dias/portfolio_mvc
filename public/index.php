<?php

require_once __DIR__ . '/../vendor/autoload.php';

// *** TESTE SIMPLES - BYPASS ROTAS - CHAMANDO DIRETAMENTE FrontendController@index ***
require_once __DIR__ . '/../app/controllers/BaseController.php';
require_once __DIR__ . '/../app/controllers/FrontendController.php';
require_once __DIR__ . '/../app/models/PortfolioModel.php'; // Garante que PortfolioModel seja carregado

$frontendController = new FrontendController();
$frontendController->index();
exit();
// *** FIM DO TESTE SIMPLES ***


// *** Código original do index.php (sistema de rotas) - VAMOS IGNORAR POR ENQUANTO PARA ESTE TESTE ***
/*
require_once __DIR__ . '/../app/config/config.php';
require_once __DIR__ . '/../app/config/routes.php';
require_once __DIR__ . '/../app/core/App.php';
require_once __DIR__ . '/../app/core/Controller.php';
require_once __DIR__ . '/../app/controllers/BaseController.php';
require_once __DIR__ . '/../app/controllers/FrontendController.php';


$app = new App($routes);
*/