<?php

// public/index.php

// 1. Carregar o Autoload do Composer
require_once __DIR__ . '/../vendor/autoload.php';

// 2. Carregar as Configurações do Banco de Dados
$dbConfig = require_once __DIR__ . '/../config/database.php';

// 3. Roteamento Básico (Exemplo Simplificado)
$uri = $_SERVER['REQUEST_URI']; // Obtém a URI da requisição (ex: '/portfolio', '/dashboard')
$method = $_SERVER['REQUEST_METHOD']; // Obtém o método da requisição (ex: 'GET', 'POST')

// Remover a barra inicial da URI, se existir
$uri = ltrim($uri, '/');

// Define a rota padrão (página inicial do portfólio)
if (empty($uri)) {
    $controllerName = 'PortfolioController';
    $actionName = 'index';
} else {
    // Separar a URI em segmentos (controlador/ação/parametros...)
    $segments = explode('/', $uri);
    $controllerName = ucfirst(array_shift($segments)) . 'Controller'; // Capitaliza e adiciona 'Controller'
    $actionName = array_shift($segments) ?? 'index'; // Pega a ação (ou usa 'index' se não especificada)
    $params = $segments; // Parametros restantes da URI
}

// 4. Instanciar o Controlador e Executar a Ação
$controllerFile = __DIR__ . '/../app/controllers/' . $controllerName . '.php';

if (file_exists($controllerFile)) {
    require_once $controllerFile;
    if (class_exists($controllerName)) {
        $controller = new $controllerName();
        if (method_exists($controller, $actionName)) {
            // Chamar a ação do controlador passando os parâmetros
            call_user_func_array([$controller, $actionName], $params);
            exit; // Encerrar a execução após processar a requisição
        } else {
            // Ação não encontrada
            http_response_code(404);
            echo "Ação '{$actionName}' não encontrada no controlador '{$controllerName}'.";
        }
    } else {
        // Controlador não é uma classe válida
        http_response_code(500); // Erro interno do servidor
        echo "Controlador '{$controllerName}' inválido.";
    }
} else {
    // Controlador não encontrado
    http_response_code(404); // Página não encontrada
    echo "Controlador '{$controllerName}' não encontrado.";
}

// 5. (Opcional) Página de Erro Padrão (se o roteamento falhar completamente)
http_response_code(404);
echo "Página não encontrada.";