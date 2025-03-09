<?php

// app/config/routes.php

$routes = [
    // Rotas Públicas do Frontend
    '/' => 'FrontendController@index',         // Página inicial do portfólio
    '/projetos' => 'FrontendController@projetos',   // Página listando os projetos
    '/contato' => 'FrontendController@contato',    // Página de contato (opcional)

    // Rotas do Dashboard (prefixo 'dashboard')
    '/dashboard' => 'DashboardController@index',
    '/dashboard/editarInformacoesPessoais' => 'DashboardController@editarInformacoesPessoais',
    '/dashboard/salvarInformacoesPessoais' => 'DashboardController@salvarInformacoesPessoais',

    '/dashboard/listarExperienciasAcademicas' => 'DashboardController@listarExperienciasAcademicas',
    '/dashboard/adicionarExperienciaAcademica' => 'DashboardController@adicionarExperienciaAcademica',
    '/dashboard/salvarExperienciaAcademica' => 'DashboardController@salvarExperienciaAcademica',
    '/dashboard/editarExperienciaAcademica/(\d+)' => 'DashboardController@editarExperienciaAcademica/$1',
    '/dashboard/atualizarExperienciaAcademica' => 'DashboardController@atualizarExperienciaAcademica',
    '/dashboard/removerExperienciaAcademica/(\d+)' => 'DashboardController@removerExperienciaAcademica/$1',

    '/dashboard/listarProjetos' => 'DashboardController@listarProjetos',
    '/dashboard/adicionarProjeto' => 'DashboardController@adicionarProjeto',
    '/dashboard/salvarProjeto' => 'DashboardController@salvarProjeto',
    '/dashboard/editarProjeto/(\d+)' => 'DashboardController@editarProjeto/$1',
    '/dashboard/atualizarProjeto' => 'DashboardController@atualizarProjeto',
    '/dashboard/removerProjeto/(\d+)' => 'DashboardController@removerProjeto/$1',

    '/dashboard/listarHabilidades' => 'DashboardController@listarHabilidades',
    '/dashboard/adicionarHabilidade' => 'DashboardController@adicionarHabilidade',
    '/dashboard/salvarHabilidade' => 'DashboardController@salvarHabilidade',
    '/dashboard/editarHabilidade/(\d+)' => 'DashboardController@editarHabilidade/$1',
    '/dashboard/atualizarHabilidade' => 'DashboardController@atualizarHabilidade',
    '/dashboard/removerHabilidade/(\d+)' => 'DashboardController@removerHabilidade/$1',

    '/dashboard/listarCursos' => 'DashboardController@listarCursos',
    '/dashboard/adicionarCurso' => 'DashboardController@adicionarCurso',
    '/dashboard/salvarCurso' => 'DashboardController@salvarCurso',
    '/dashboard/editarCurso/(\d+)' => 'DashboardController@editarCurso/$1',
    '/dashboard/atualizarCurso' => 'DashboardController@atualizarCurso',
    '/dashboard/removerCurso/(\d+)' => 'DashboardController@removerCurso/$1',

    '/dashboard/editarSobreMim' => 'DashboardController@editarSobreMim',
    '/dashboard/atualizarSobreMim' => 'DashboardController@atualizarSobreMim',
];