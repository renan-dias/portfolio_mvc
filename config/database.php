<?php

return [
    'host'     => 'localhost', // Endereço do servidor MySQL (geralmente 'localhost' para desenvolvimento local)
    'database' => 'portfolio',    // Nome do banco de dados que criamos (portfolio)
    'username' => 'seu_usuario_mysql', // Seu nome de usuário do MySQL
    'password' => 'sua_senha_mysql', // Sua senha do MySQL
    'charset'  => 'utf8mb4',   // Codificação de caracteres (UTF-8 Unicode, recomendado)
    'collation' => 'utf8mb4_unicode_ci', // Collation para UTF-8 (para comparar strings corretamente)
    'options'   => [             // Opções adicionais de conexão (opcional, mas recomendado)
        PDO::ATTR_PERSISTENT => true, // Usar conexões persistentes (melhora a performance em alguns casos)
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Configurar para lançar exceções em caso de erro
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // Definir o modo de fetch padrão como associativo (array)
        PDO::ATTR_EMULATE_PREPARES => false, // Desabilitar a emulação de prepared statements (segurança)
    ],
];