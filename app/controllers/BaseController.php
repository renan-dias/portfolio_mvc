<?php

// app/controllers/BaseController.php

class BaseController {

    protected function view(string $viewPath, array $data = []) {
        // Extrair os dados para variáveis locais, para serem acessíveis na view
        extract($data);

        // Caminho completo para o arquivo de layout padrão
        $layoutPath = __DIR__ . '/../views/layouts/default.php';
        // Caminho completo para o arquivo de view específico
        $viewFullPath = __DIR__ . '/../views/' . $viewPath . '.php'; // **CORREÇÃO IMPORTANTE: Removi 'portfolio/' do caminho, pois BaseController é genérico**

        // Verificar se o arquivo de view existe
        if (file_exists($viewFullPath)) {
            // Iniciar o buffer de saída para capturar o conteúdo da view
            ob_start();
            // Incluir o arquivo de view (o código PHP/HTML da view será executado aqui)
            require $viewFullPath;
            // Obter o conteúdo do buffer (a view renderizada)
            $viewContent = ob_get_clean();

            // Incluir o layout padrão, que irá "envolver" a view
            if (file_exists($layoutPath)) {
                require $layoutPath; // O layout irá usar a variável $viewContent para inserir o conteúdo da view
            } else {
                // Layout padrão não encontrado, exibir apenas o conteúdo da view (sem layout)
                echo $viewContent;
            }
        } else {
            // View não encontrada, exibir mensagem de erro
            http_response_code(404);
            echo "View '{$viewPath}' não encontrada.";
        }
    }
}