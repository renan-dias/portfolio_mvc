<?php

// public/index.php

// 1. Carregar o Autoload do Composer
require_once __DIR__ . '/../vendor/autoload.php';

// 2. Carregar as Configurações do Banco de Dados
$dbConfig = require_once __DIR__ . '/../config/database.php';

// 3. Roteamento Básico
$uri = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

$uri = ltrim($uri, '/');

if (empty($uri) || $uri === 'portfolio' || $uri === 'portfolio/') { // Rota para a página inicial do portfólio (mantém as rotas antigas)
    $controllerName = 'PortfolioController';
    $actionName = 'index';
} elseif (strpos($uri, 'dashboard') === 0) { // Rotas que começam com 'dashboard' vão para DashboardController
    $uri_segment = explode('/', $uri);
    array_shift($uri_segment); // Remove 'dashboard' do array
    $controllerName = 'DashboardController';
    $actionName = array_shift($uri_segment) ?? 'index';
    $params = $uri_segment;
    // Roteamento específico para actions do DashboardController (ex: editarInformacoesPessoais)
    if(empty($actionName) || !method_exists($controllerName, $actionName)){ // Se actionName estiver vazio ou a action não existir, usa 'index' por padrão.
        $actionName = 'index';
    }
}
else { // Rotas restantes (você pode adicionar mais regras aqui se necessário)
    $segments = explode('/', $uri);
    $controllerName = ucfirst(array_shift($segments)) . 'Controller';
    $actionName = array_shift($segments) ?? 'index';
    $params = $segments;
}


// 4. Instanciar o Controlador e Executar a Ação
$controllerFile = __DIR__ . '/../app/controllers/' . $controllerName . '.php';

if (file_exists($controllerFile)) {
    require_once $controllerFile;
    if (class_exists($controllerName)) {
        $controller = new $controllerName();
        if (method_exists($controller, $actionName)) {
            call_user_func_array([$controller, $actionName], $params);
            exit;
        } else {
            http_response_code(404);
            echo "Ação '{$actionName}' não encontrada no controlador '{$controllerName}'.";
        }
    } else {
        http_response_code(500);
        echo "Controlador '{$controllerName}' inválido.";
    }
} else {
    http_response_code(404);
    echo "Controlador '{$controllerName}' não encontrado.";
}

http_response_code(404);
echo "Página não encontrada.";