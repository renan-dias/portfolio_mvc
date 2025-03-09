<?php

// app/controllers/DashboardController.php

class DashboardController extends BaseController {

    private $portfolioModel;

    public function __construct() {
        $this->portfolioModel = new PortfolioModel();
    }

    // ----------------------------------------------------------------
    //  Página Inicial do Dashboard
    // ----------------------------------------------------------------
    public function index() {
        // *** Aqui você pode adicionar lógica para buscar dados gerais para o dashboard, se necessário ***
        $data = []; // Por enquanto, nenhum dado específico para passar para a view do dashboard

        // Carregar a view 'dashboard/index' dentro do layout 'default'
        $this->view('dashboard/index', $data);
    }

    // ----------------------------------------------------------------
    //  CRUD - Informações Pessoais
    // ----------------------------------------------------------------
    public function editarInformacoesPessoais() {
        // *** Dados de exemplo - substitua pela lógica real para determinar o student_id do usuário logado ***
        $studentIdExemplo = '12345'; // ID do aluno logado (exemplo)

        // Buscar informações básicas do portfólio para obter o portfolio_id
        $portfolioBasico = $this->portfolioModel->getPortfolioBasico($studentIdExemplo);
        $portfolioId = $portfolioBasico['id'] ?? 0; // Obtém portfolio_id ou usa 0 como padrão se não encontrado

        // Buscar informações pessoais atuais do banco de dados
        $informacoesPessoais = $this->portfolioModel->getInformacoesPessoais($portfolioId);

        // Preparar dados para passar para a view
        $data = [
            'informacoesPessoais' => $informacoesPessoais ?? [], // Passa informações pessoais ou array vazio se não encontradas
            'msg' => '' // Variável para mensagens de feedback (inicialmente vazia)
        ];

        // Carregar a view 'dashboard/editar_informacoes_pessoais' dentro do layout 'default'
        $this->view('dashboard/editar_informacoes_pessoais', $data);
    }

    public function salvarInformacoesPessoais() {
        // *** Dados de exemplo - substitua pela lógica real para determinar o student_id do usuário logado ***
        $studentIdExemplo = '12345'; // ID do aluno logado (exemplo)
        $msg = ''; // Inicializa a variável de mensagem

        // Verificar se o formulário foi submetido via POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Obter dados do formulário e sanitizar (prevenir SQL Injection e XSS)
            $nomeCompleto = filter_input(INPUT_POST, 'nome_completo', FILTER_SANITIZE_STRING);
            $profissao = filter_input(INPUT_POST, 'profissao', FILTER_SANITIZE_STRING);
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $telefone = filter_input(INPUT_POST, 'telefone', FILTER_SANITIZE_STRING); // Sanitizar como STRING
            $linkedin = filter_input(INPUT_POST, 'linkedin', FILTER_SANITIZE_URL);
            $github = filter_input(INPUT_POST, 'github', FILTER_SANITIZE_URL);
            $whatsapp = filter_input(INPUT_POST, 'whatsapp', FILTER_SANITIZE_STRING); // Mantém como string
            $bio = filter_input(INPUT_POST, 'bio', FILTER_SANITIZE_STRING);
            $fotoPerfil = filter_input(INPUT_POST, 'foto_perfil', FILTER_SANITIZE_URL);

            // Buscar informações básicas do portfólio para obter o portfolio_id
            $portfolioBasico = $this->portfolioModel->getPortfolioBasico($studentIdExemplo);
            $portfolioId = $portfolioBasico['id'] ?? 0; // Obtém portfolio_id

            if ($portfolioId) {
                // Preparar array de dados para atualizar o banco de dados
                $dadosInformacoesPessoais = [
                    'portfolio_id' => $portfolioId,
                    'nome_completo' => $nomeCompleto,
                    'profissao' => $profissao,
                    'email' => $email,
                    'telefone' => $telefone,
                    'linkedin' => $linkedin,
                    'github' => $github,
                    'whatsapp' => $whatsapp,
                    'bio' => $bio,
                    'foto_perfil' => $fotoPerfil,
                ];

                // Chamar o model para atualizar as informações pessoais
                $atualizado = $this->portfolioModel->atualizarInformacoesPessoais($dadosInformacoesPessoais);

                if ($atualizado) {
                    $msg = "Informações pessoais atualizadas com sucesso!";
                } else {
                    $msg = "Erro ao atualizar informações pessoais.";
                }
            } else {
                $msg = "Portfolio não encontrado.";
            }
        } else {
            $msg = "Acesso inválido."; // Acesso direto à action via GET não permitido
        }

        // Após tentar salvar, vamos refazer a busca das informações pessoais para exibir o formulário novamente,
        // e passar a mensagem de feedback para a view
        $portfolioBasico = $this->portfolioModel->getPortfolioBasico($studentIdExemplo);
        $informacoesPessoais = $this->portfolioModel->getInformacoesPessoais($portfolioBasico['id'] ?? 0);
        $data = [
            'informacoesPessoais' => $informacoesPessoais ?? [],
            'msg' => $msg
        ];

        // Carregar a view 'dashboard/editar_informacoes_pessoais' novamente com a mensagem
        $this->view('dashboard/editar_informacoes_pessoais', $data);
    }


    // ----------------------------------------------------------------
    //  CRUD - Experiência Acadêmica
    // ----------------------------------------------------------------
    public function listarExperienciasAcademicas() {
        // *** Dados de exemplo - substitua pela lógica real para determinar o student_id do usuário logado ***
        $studentIdExemplo = '12345'; // ID do aluno logado (exemplo)

        // Buscar informações básicas do portfólio para obter o portfolio_id
        $portfolioBasico = $this->portfolioModel->getPortfolioBasico($studentIdExemplo);
        $portfolioId = $portfolioBasico['id'] ?? 0; // Obtém portfolio_id

        // Buscar todas as experiências acadêmicas do portfólio
        $experienciasAcademicas = $this->portfolioModel->getExperienciasAcademicas($portfolioId);

        // Preparar dados para passar para a view
        $data = [
            'experienciasAcademicas' => $experienciasAcademicas ?? [],
        ];

        // Carregar a view 'dashboard/listar_experiencias_academicas'
        $this->view('dashboard/listar_experiencias_academicas', $data);
    }

    public function adicionarExperienciaAcademica() {
        // Carregar a view 'dashboard/adicionar_experiencia_academica' (formulário vazio)
        $this->view('dashboard/adicionar_experiencia_academica');
    }

    public function salvarExperienciaAcademica() {
        // *** Dados de exemplo - substitua pela lógica real para determinar o student_id do usuário logado ***
        $studentIdExemplo = '12345'; // ID do aluno logado (exemplo)
        $msg = ''; // Inicializa a variável de mensagem
        $erro = false; // Inicializa a flag de erro

        // Verificar se o formulário foi submetido via POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Buscar informações básicas do portfólio para obter o portfolio_id
            $portfolioBasico = $this->portfolioModel->getPortfolioBasico($studentIdExemplo);
            $portfolioId = $portfolioBasico['id'] ?? 0; // Obtém portfolio_id

            if ($portfolioId) {
                // Obter dados do formulário e sanitizar
                $instituicao = filter_input(INPUT_POST, 'instituicao', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
                $curso = filter_input(INPUT_POST, 'curso', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
                $periodo = filter_input(INPUT_POST, 'periodo', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
                $descricao = filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);

                // Validar dados (adicione mais validações conforme necessário)
                if (empty($instituicao) || empty($curso) || empty($periodo)) {
                    $msg = "Por favor, preencha todos os campos obrigatórios.";
                    $erro = true; // Indica que houve erro de validação
                } else {
                    // Preparar array de dados para inserir no banco
                    $dadosExperiencia = [
                        'portfolio_id' => $portfolioId,
                        'instituicao' => $instituicao,
                        'curso' => $curso,
                        'periodo' => $periodo,
                        'descricao' => $descricao,
                    ];

                    // Chamar o model para adicionar a experiência acadêmica
                    $adicionado = $this->portfolioModel->adicionarExperienciaAcademica($dadosExperiencia);

                    if ($adicionado) {
                        $msg = "Experiência acadêmica adicionada com sucesso!";
                    } else {
                        $msg = "Erro ao adicionar experiência acadêmica.";
                        $erro = true; // Indica erro ao salvar no banco
                    }
                }
            } else {
                $msg = "Portfolio não encontrado.";
                $erro = true;
            }
        } else {
            $msg = "Acesso inválido."; // Acesso direto à action via GET não permitido
            $erro = true;
        }

        // Após tentar salvar, redirecionar para a listagem de experiências acadêmicas
        // (ou para o formulário de adicionar novamente, em caso de erro)
        if ($erro) {
             $data = ['msg' => $msg]; // Passa a mensagem de erro para a view
             $this->view('dashboard/adicionar_experiencia_academica', $data); //  Volta para o formulário de adicionar com mensagem
        } else {
            // Redirecionar para a listagem após sucesso
            header("Location: /dashboard/listarExperienciasAcademicas");
            exit(); // Importante: Terminar a execução do script após o redirecionamento
        }
    }

    public function editarExperienciaAcademica(int $id = 0) {
        if ($id <= 0) {
            echo "ID inválido para edição."; // Ou redirecione para uma página de erro
            return;
        }

        // *** Dados de exemplo - substitua pela lógica real para determinar o student_id do usuário logado ***
        $studentIdExemplo = '12345'; // ID do aluno logado (exemplo)

        // Buscar informações básicas do portfólio para segurança (verificar se o portfolioId pertence ao studentId logado - opcional para este exemplo)
        $portfolioBasico = $this->portfolioModel->getPortfolioBasico($studentIdExemplo);
        $portfolioId = $portfolioBasico['id'] ?? 0;

        // Buscar a experiência acadêmica específica pelo ID
        $experienciasAcademicas = $this->portfolioModel->getExperienciasAcademicas($portfolioId); // **CORREÇÃO:** Usar getExperienciasAcademicas e filtrar no loop da view para simplificar. Modelo não tem método `getExperienciaAcademicaPorId` específico.

        $experienciaParaEditar = null;
        foreach ($experienciasAcademicas as $exp) {
            if ($exp['id'] == $id) {
                $experienciaParaEditar = $exp;
                break;
            }
        }

        if (!$experienciaParaEditar) {
            echo "Experiência acadêmica não encontrada."; // Ou redirecione para uma página de erro
            return;
        }

        // Preparar dados para passar para a view
        $data = [
            'experiencia' => $experienciaParaEditar,
            'msg' => '' // Mensagem inicialmente vazia
        ];

        // Carregar a view 'dashboard/editar_experiencia_academica'
        $this->view('dashboard/editar_experiencia_academica', $data);
    }

    public function atualizarExperienciaAcademica() {
         // *** Dados de exemplo - substitua pela lógica real para determinar o student_id do usuário logado ***
        $studentIdExemplo = '12345'; // ID do aluno logado (exemplo)
        $msg = ''; // Inicializa a variável de mensagem
        $erro = false; // Inicializa a flag de erro


        // Verificar se o formulário foi submetido via POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
             // Buscar informações básicas do portfólio para obter o portfolio_id
            $portfolioBasico = $this->portfolioModel->getPortfolioBasico($studentIdExemplo);
            $portfolioId = $portfolioBasico['id'] ?? 0; // Obtém portfolio_id

            $idExperiencia = filter_input(INPUT_POST, 'id_experiencia', FILTER_SANITIZE_NUMBER_INT);

            if ($portfolioId && $idExperiencia) {
                // Obter dados do formulário e sanitizar
                $instituicao = filter_input(INPUT_POST, 'instituicao', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
                $curso = filter_input(INPUT_POST, 'curso', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
                $periodo = filter_input(INPUT_POST, 'periodo', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
                $descricao = filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);

                // Validar dados (adicione mais validações conforme necessário)
                if (empty($instituicao) || empty($curso) || empty($periodo)) {
                    $msg = "Por favor, preencha todos os campos obrigatórios.";
                    $erro = true;
                } else {
                    // Preparar array de dados para atualizar no banco
                    $dadosExperiencia = [
                        'id' => $idExperiencia,
                        'portfolio_id' => $portfolioId,
                        'instituicao' => $instituicao,
                        'curso' => $curso,
                        'periodo' => $periodo,
                        'descricao' => $descricao,
                    ];

                    // Chamar o model para atualizar a experiência acadêmica
                    $atualizado = $this->portfolioModel->atualizarExperienciaAcademica($dadosExperiencia);

                    if ($atualizado) {
                        $msg = "Experiência acadêmica atualizada com sucesso!";
                    } else {
                        $msg = "Erro ao atualizar experiência acadêmica.";
                        $erro = true;
                    }
                }
            } else {
                $msg = "Portfolio ou Experiência Acadêmica não encontrados.";
                $erro = true;
            }

        } else {
            $msg = "Acesso inválido."; // Acesso direto à action via GET não permitido
            $erro = true;
        }

        // Após tentar salvar, redirecionar para a listagem de experiências acadêmicas
        // (ou para o formulário de editar novamente, em caso de erro)
        if ($erro) {
            // Em caso de erro, refazer a busca dos dados da experiência para preencher o formulário novamente
            $portfolioBasico = $this->portfolioModel->getPortfolioBasico($studentIdExemplo);
            $portfolioId = $portfolioBasico['id'] ?? 0;
            $experienciasAcademicas = $this->portfolioModel->getExperienciasAcademicas($portfolioId);

             $experienciaParaEditar = null;
            if($idExperiencia){ // Tenta buscar a experiencia novamente se o ID foi passado
                 foreach ($experienciasAcademicas as $exp) {
                    if ($exp['id'] == $idExperiencia) {
                        $experienciaParaEditar = $exp;
                        break;
                    }
                }
            }


            $data = [
                'experiencia' => $experienciaParaEditar ?? [], // Passa a experiência (ou array vazio se não encontrada)
                'msg' => $msg // Passa a mensagem de erro
            ];
            $this->view('dashboard/editar_experiencia_academica', $data); //  Volta para o formulário de editar com mensagem de erro e dados
        } else {
            // Redirecionar para a listagem após sucesso
            header("Location: /dashboard/listarExperienciasAcademicas");
            exit(); // Importante: Terminar a execução do script após o redirecionamento
        }
    }

    public function removerExperienciaAcademica(int $id = 0) {
        if ($id <= 0) {
            echo "ID inválido para remoção."; // Ou redirecione para uma página de erro
            return;
        }

        // *** Dados de exemplo - substitua pela lógica real para determinar o student_id do usuário logado ***
        $studentIdExemplo = '12345'; // ID do aluno logado (exemplo)

        // Buscar informações básicas do portfólio para segurança
        $portfolioBasico = $this->portfolioModel->getPortfolioBasico($studentIdExemplo);
        $portfolioId = $portfolioBasico['id'] ?? 0;

        if ($portfolioId) {
             // Chamar o model para remover a experiência acadêmica
            $removido = $this->portfolioModel->removerExperienciaAcademica($id, $portfolioId);

            if (!$removido) {
                echo "Erro ao remover experiência acadêmica."; // Em um ambiente real, লগar e tratar o erro adequadamente
            }
        } else {
            echo "Portfolio não encontrado.";
        }

        // Redirecionar para a listagem de experiências acadêmicas após tentar remover (sucesso ou falha)
        header("Location: /dashboard/listarExperienciasAcademicas");
        exit();
    }


    // ----------------------------------------------------------------
    //  CRUD - Projetos (COMPLETAMENTE IMPLEMENTADO: Listar, Adicionar, Editar e Remover)
    // ----------------------------------------------------------------
    public function listarProjetos() {
        // *** Dados de exemplo - substitua pela lógica real para determinar o student_id do usuário logado ***
        $studentIdExemplo = '12345'; // ID do aluno logado (exemplo)

        // Buscar informações básicas do portfólio para obter o portfolio_id
        $portfolioBasico = $this->portfolioModel->getPortfolioBasico($studentIdExemplo);
        $portfolioId = $portfolioBasico['id'] ?? 0; // Obtém portfolio_id

        // Buscar todos os projetos do portfólio
        $projetos = $this->portfolioModel->getProjetos($portfolioId);

        // Preparar dados para passar para a view
        $data = [
            'projetos' => $projetos ?? [],
        ];

        // Carregar a view 'dashboard/listar_projetos'
        $this->view('dashboard/listar_projetos', $data);
    }

    public function adicionarProjeto() {
        // Carregar a view 'dashboard/adicionar_projeto' (formulário vazio)
        $this->view('dashboard/adicionar_projeto');
    }

    public function salvarProjeto() {
        // *** Dados de exemplo - substitua pela lógica real para determinar o student_id do usuário logado ***
        $studentIdExemplo = '12345'; // ID do aluno logado (exemplo)
        $msg = ''; // Inicializa a variável de mensagem
        $erro = false; // Inicializa a flag de erro

        // Verificar se o formulário foi submetido via POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Buscar informações básicas do portfólio para obter o portfolio_id
            $portfolioBasico = $this->portfolioModel->getPortfolioBasico($studentIdExemplo);
            $portfolioId = $portfolioBasico['id'] ?? 0; // Obtém portfolio_id

            if ($portfolioId) {
                // Obter dados do formulário e sanitizar
                $tituloProjeto = filter_input(INPUT_POST, 'titulo_projeto', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
                $descricaoProjeto = filter_input(INPUT_POST, 'descricao_projeto', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
                $linkProjeto = filter_input(INPUT_POST, 'link_projeto', FILTER_SANITIZE_URL);
                $linkGithub = filter_input(INPUT_POST, 'link_github', FILTER_SANITIZE_URL);
                $imagemProjeto = filter_input(INPUT_POST, 'imagem_projeto', FILTER_SANITIZE_URL);

                // Validar dados (adicione mais validações conforme necessário)
                if (empty($tituloProjeto) || empty($descricaoProjeto)) {
                    $msg = "Por favor, preencha o título e a descrição do projeto.";
                    $erro = true;
                } else {
                    // Preparar array de dados para inserir no banco
                    $dadosProjeto = [
                        'portfolio_id' => $portfolioId,
                        'titulo_projeto' => $tituloProjeto,
                        'descricao_projeto' => $descricaoProjeto,
                        'link_projeto' => $linkProjeto,
                        'link_github' => $linkGithub,
                        'imagem_projeto' => $imagemProjeto,
                    ];

                    // Chamar o model para adicionar o projeto
                    $adicionado = $this->portfolioModel->adicionarProjeto($dadosProjeto);

                    if ($adicionado) {
                        $msg = "Projeto adicionado com sucesso!";
                    } else {
                        $msg = "Erro ao adicionar projeto.";
                        $erro = true;
                    }
                }
            } else {
                $msg = "Portfolio não encontrado.";
                $erro = true;
            }
        } else {
            $msg = "Acesso inválido."; // Acesso direto à action via GET não permitido
            $erro = true;
        }

        // Após tentar salvar, redirecionar para a listagem de projetos
        // (ou para o formulário de adicionar novamente, em caso de erro)
        if ($erro) {
            $data = ['msg' => $msg]; // Passa a mensagem de erro para a view
            $this->view('dashboard/adicionar_projeto', $data); // Volta para o formulário de adicionar com mensagem
        } else {
            // Redirecionar para a listagem após sucesso
            header("Location: /dashboard/listarProjetos");
            exit(); // Importante: Terminar a execução do script após o redirecionamento
        }
    }

    public function editarProjeto(int $id = 0) {
        if ($id <= 0) {
            echo "ID inválido para edição."; // Ou redirecione para uma página de erro
            return;
        }

        // *** Dados de exemplo - substitua pela lógica real para determinar o student_id do usuário logado ***
        $studentIdExemplo = '12345'; // ID do aluno logado (exemplo)

        // Buscar informações básicas do portfólio para segurança
        $portfolioBasico = $this->portfolioModel->getPortfolioBasico($studentIdExemplo);
        $portfolioId = $portfolioBasico['id'] ?? 0;

        // Buscar o projeto específico pelo ID
        $projetos = $this->portfolioModel->getProjetos($portfolioId); // **CORREÇÃO:** Usar getProjetos e filtrar no loop da view para simplificar. Modelo não tem método `getProjetoPorId` específico.

        $projetoParaEditar = null;
        foreach ($projetos as $proj) {
            if ($proj['id'] == $id) {
                $projetoParaEditar = $proj;
                break;
            }
        }

        if (!$projetoParaEditar) {
            echo "Projeto não encontrado."; // Ou redirecione para uma página de erro
            return;
        }

        // Preparar dados para passar para a view
        $data = [
            'projeto' => $projetoParaEditar,
            'msg' => '' // Mensagem inicialmente vazia
        ];

        // Carregar a view 'dashboard/editar_projeto'
        $this->view('dashboard/editar_projeto', $data);
    }

    public function atualizarProjeto() {
        // *** Dados de exemplo - substitua pela lógica real para determinar o student_id do usuário logado ***
        $studentIdExemplo = '12345'; // ID do aluno logado (exemplo)
        $msg = ''; // Inicializa a variável de mensagem
        $erro = false; // Inicializa a flag de erro

        // Verificar se o formulário foi submetido via POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Buscar informações básicas do portfólio para obter o portfolio_id
            $portfolioBasico = $this->portfolioModel->getPortfolioBasico($studentIdExemplo);
            $portfolioId = $portfolioBasico['id'] ?? 0; // Obtém portfolio_id

            $idProjeto = filter_input(INPUT_POST, 'id_projeto', FILTER_SANITIZE_NUMBER_INT);

            if ($portfolioId && $idProjeto) {
                // Obter dados do formulário e sanitizar
                $tituloProjeto = filter_input(INPUT_POST, 'titulo_projeto', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
                $descricaoProjeto = filter_input(INPUT_POST, 'descricao_projeto', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
                $linkProjeto = filter_input(INPUT_POST, 'link_projeto', FILTER_SANITIZE_URL);
                $linkGithub = filter_input(INPUT_POST, 'link_github', FILTER_SANITIZE_URL);
                $imagemProjeto = filter_input(INPUT_POST, 'imagem_projeto', FILTER_SANITIZE_URL);

                // Validar dados (adicione mais validações conforme necessário)
                if (empty($tituloProjeto) || empty($descricaoProjeto)) {
                    $msg = "Por favor, preencha o título e a descrição do projeto.";
                    $erro = true;
                } else {
                    $erro = false;
                    // Preparar array de dados para atualizar no banco
                    $dadosProjeto = [
                        'id' => $idProjeto,
                        'portfolio_id' => $portfolioId,
                        'titulo_projeto' => $tituloProjeto,
                        'descricao_projeto' => $descricaoProjeto,
                        'link_projeto' => $linkProjeto,
                        'link_github' => $linkGithub,
                        'imagem_projeto' => $imagemProjeto,
                    ];

                    // Chamar o model para atualizar o projeto
                    $atualizado = $this->portfolioModel->atualizarProjeto($dadosProjeto);

                    if ($atualizado) {
                        $msg = "Projeto atualizado com sucesso!";
                    } else {
                        $msg = "Erro ao atualizar projeto.";
                        $erro = true;
                    }
                }
            } else {
                $msg = "Portfolio ou Projeto não encontrados.";
                $erro = true;
            }

        } else {
            $msg = "Acesso inválido."; // Acesso direto à action via GET não permitido
            $erro = true;
        }

        // Após tentar salvar, redirecionar para a listagem de projetos
        // (ou para o formulário de editar novamente, em caso de erro)
        if ($erro) {
            // Em caso de erro, refazer a busca dos dados do projeto para preencher o formulário novamente
            $portfolioBasico = $this->portfolioModel->getPortfolioBasico($studentIdExemplo);
            $portfolioId = $portfolioBasico['id'] ?? 0;
            $projetos = $this->portfolioModel->getProjetos($portfolioId);

             $projetoParaEditar = null;
            if($idProjeto){ // Tenta buscar o projeto novamente se o ID foi passado
                 foreach ($projetos as $proj) {
                    if ($proj['id'] == $idProjeto) {
                        $projetoParaEditar = $proj;
                        break;
                    }
                }
            }


            $data = [
                'projeto' => $projetoParaEditar ?? [], // Passa o projeto (ou array vazio se não encontrado)
                'msg' => $msg // Passa a mensagem de erro
            ];
            $this->view('dashboard/editar_projeto', $data); //  Volta para o formulário de editar com mensagem de erro e dados
        } else {
            // Redirecionar para a listagem após sucesso
            header("Location: /dashboard/listarProjetos");
            exit(); // Importante: Terminar a execução do script após o redirecionamento
        }
    }

    public function removerProjeto(int $id = 0) {
        if ($id <= 0) {
            echo "ID inválido para remoção."; // Ou redirecione para uma página de erro
            return;
        }

        // *** Dados de exemplo - substitua pela lógica real para determinar o student_id do usuário logado ***
        $studentIdExemplo = '12345'; // ID do aluno logado (exemplo)

        // Buscar informações básicas do portfólio para segurança
        $portfolioBasico = $this->portfolioModel->getPortfolioBasico($studentIdExemplo);
        $portfolioId = $portfolioBasico['id'] ?? 0;

        if ($portfolioId) {
             // Chamar o model para remover o projeto
            $removido = $this->portfolioModel->removerProjeto($id, $portfolioId);

            if (!$removido) {
                echo "Erro ao remover projeto."; // Em um ambiente real, লগar e tratar o erro adequadamente
            }
        } else {
            echo "Portfolio não encontrado.";
        }

        // Redirecionar para a listagem de projetos após tentar remover (sucesso ou falha)
        header("Location: /dashboard/listarProjetos");
        exit();
    }


    // ----------------------------------------------------------------
    //  CRUD - Habilidades
    // ----------------------------------------------------------------
    public function listarHabilidades() {
        // *** Dados de exemplo - substitua pela lógica real para determinar o student_id do usuário logado ***
        $studentIdExemplo = '12345'; // ID do aluno logado (exemplo)

        // Buscar informações básicas do portfólio para obter o portfolio_id
        $portfolioBasico = $this->portfolioModel->getPortfolioBasico($studentIdExemplo);
        $portfolioId = $portfolioBasico['id'] ?? 0; // Obtém portfolio_id

        // Buscar todas as habilidades do portfólio
        $habilidades = $this->portfolioModel->getHabilidades($portfolioId);

        // Preparar dados para passar para a view
        $data = [
            'habilidades' => $habilidades ?? [],
        ];

        // Carregar a view 'dashboard/listar_habilidades'
        $this->view('dashboard/listar_habilidades', $data);
    }

    public function adicionarHabilidade() {
        // Carregar a view 'dashboard/adicionar_habilidade' (formulário vazio)
        $this->view('dashboard/adicionar_habilidade');
    }

    public function salvarHabilidade() {
        // *** Dados de exemplo - substitua pela lógica real para determinar o student_id do usuário logado ***
        $studentIdExemplo = '12345'; // ID do aluno logado (exemplo)
        $msg = ''; // Inicializa a variável de mensagem
        $erro = false; // Inicializa a flag de erro

        // Verificar se o formulário foi submetido via POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Buscar informações básicas do portfólio para obter o portfolio_id
            $portfolioBasico = $this->portfolioModel->getPortfolioBasico($studentIdExemplo);
            $portfolioId = $portfolioBasico['id'] ?? 0; // Obtém portfolio_id

            if ($portfolioId) {
                // Obter dados do formulário e sanitizar
                $nomeHabilidade = filter_input(INPUT_POST, 'nome_habilidade', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
                $nivelHabilidade = filter_input(INPUT_POST, 'nivel_habilidade', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES); // Manter como string por enquanto (ex: "Básico", "Intermediário", "Avançado")

                // Validar dados (adicione mais validações conforme necessário)
                if (empty($nomeHabilidade) || empty($nivelHabilidade)) {
                    $msg = "Por favor, preencha o nome e o nível da habilidade.";
                    $erro = true;
                } else {
                    // Preparar array de dados para inserir no banco
                    $dadosHabilidade = [
                        'portfolio_id' => $portfolioId,
                        'nome_habilidade' => $nomeHabilidade,
                        'nivel_habilidade' => $nivelHabilidade,
                    ];

                    // Chamar o model para adicionar a habilidade
                    $adicionado = $this->portfolioModel->adicionarHabilidade($dadosHabilidade);

                    if ($adicionado) {
                        $msg = "Habilidade adicionada com sucesso!";
                    } else {
                        $msg = "Erro ao adicionar habilidade.";
                        $erro = true;
                    }
                }
            } else {
                $msg = "Portfolio não encontrado.";
                $erro = true;
            }
        } else {
            $msg = "Acesso inválido."; // Acesso direto à action via GET não permitido
            $erro = true;
        }

        // Após tentar salvar, redirecionar para a listagem de habilidades
        // (ou para o formulário de adicionar novamente, em caso de erro)
        if ($erro) {
            $data = ['msg' => $msg]; // Passa a mensagem de erro para a view
            $this->view('dashboard/adicionar_habilidade', $data); // Volta para o formulário de adicionar com mensagem
        } else {
            // Redirecionar para a listagem após sucesso
            header("Location: /dashboard/listarHabilidades");
            exit(); // Importante: Terminar a execução do script após o redirecionamento
        }
    }


    public function editarHabilidade(int $id = 0) {
         if ($id <= 0) {
            echo "ID inválido para edição.";
            return;
        }

        // *** Dados de exemplo - substitua pela lógica real para determinar o student_id do usuário logado ***
        $studentIdExemplo = '12345'; // ID do aluno logado (exemplo)

        // Buscar informações básicas do portfólio para segurança
        $portfolioBasico = $this->portfolioModel->getPortfolioBasico($studentIdExemplo);
        $portfolioId = $portfolioBasico['id'] ?? 0;

        // Buscar a habilidade específica pelo ID
        $habilidades = $this->portfolioModel->getHabilidades($portfolioId);

        $habilidadeParaEditar = null;
        foreach ($habilidades as $habilidade) {
            if ($habilidade['id'] == $id) {
                $habilidadeParaEditar = $habilidade;
                break;
            }
        }

        if (!$habilidadeParaEditar) {
            echo "Habilidade não encontrada.";
            return;
        }

        // Preparar dados para passar para a view
        $data = [
            'habilidade' => $habilidadeParaEditar,
            'msg' => '' // Mensagem inicialmente vazia
        ];

        // Carregar a view 'dashboard/editar_habilidade'
        $this->view('dashboard/editar_habilidade', $data);
    }


    public function atualizarHabilidade() {
        // *** Dados de exemplo - substitua pela lógica real para determinar o student_id do usuário logado ***
        $studentIdExemplo = '12345'; // ID do aluno logado (exemplo)
        $msg = '';
        $erro = false;

        // Verificar se o formulário foi submetido via POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Buscar informações básicas do portfólio para obter o portfolio_id
            $portfolioBasico = $this->portfolioModel->getPortfolioBasico($studentIdExemplo);
            $portfolioId = $portfolioBasico['id'] ?? 0;

            $idHabilidade = filter_input(INPUT_POST, 'id_habilidade', FILTER_SANITIZE_NUMBER_INT);

            if ($portfolioId && $idHabilidade) {
                // Obter dados do formulário e sanitizar
                $nomeHabilidade = filter_input(INPUT_POST, 'nome_habilidade', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
                $nivelHabilidade = filter_input(INPUT_POST, 'nivel_habilidade', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);

                // Validar dados (adicione mais validações conforme necessário)
                if (empty($nomeHabilidade) || empty($nivelHabilidade)) {
                    $msg = "Por favor, preencha o nome e o nível da habilidade.";
                    $erro = true;
                } else {
                    // Preparar array de dados para atualizar no banco
                    $dadosHabilidade = [
                        'id' => $idHabilidade,
                        'portfolio_id' => $portfolioId,
                        'nome_habilidade' => $nomeHabilidade,
                        'nivel_habilidade' => $nivelHabilidade,
                    ];

                    // Chamar o model para atualizar a habilidade
                    $atualizado = $this->portfolioModel->atualizarHabilidade($dadosHabilidade);

                    if ($atualizado) {
                        $msg = "Habilidade atualizada com sucesso!";
                    } else {
                        $msg = "Erro ao atualizar habilidade.";
                        $erro = true;
                    }
                }
            } else {
                $msg = "Portfolio ou Habilidade não encontrados.";
                $erro = true;
            }

        } else {
            $msg = "Acesso inválido.";
            $erro = true;
        }


        // Após tentar salvar, redirecionar para a listagem de habilidades
        // (ou para o formulário de editar novamente, em caso de erro)
        if ($erro) {
            // Em caso de erro, refazer a busca dos dados da habilidade para preencher o formulário novamente
            $portfolioBasico = $this->portfolioModel->getPortfolioBasico($studentIdExemplo);
            $portfolioId = $portfolioBasico['id'] ?? 0;
            $habilidades = $this->portfolioModel->getHabilidades($portfolioId);

             $habilidadeParaEditar = null;
            if($idHabilidade){ // Tenta buscar a habilidade novamente se o ID foi passado
                 foreach ($habilidades as $habilidade) {
                    if ($habilidade['id'] == $idHabilidade) {
                        $habilidadeParaEditar = $habilidade;
                        break;
                    }
                }
            }


            $data = [
                'habilidade' => $habilidadeParaEditar ?? [], // Passa a habilidade (ou array vazio se não encontrada)
                'msg' => $msg // Passa a mensagem de erro
            ];
            $this->view('dashboard/editar_habilidade', $data); //  Volta para o formulário de editar com mensagem de erro e dados
        } else {
            // Redirecionar para a listagem após sucesso
            header("Location: /dashboard/listarHabilidades");
            exit();
        }
    }


    public function removerHabilidade(int $id = 0) {
        if ($id <= 0) {
            echo "ID inválido para remoção.";
            return;
        }
        // *** Dados de exemplo - substitua pela lógica real para determinar o student_id do usuário logado ***
        $studentIdExemplo = '12345'; // ID do aluno logado (exemplo)

        // Buscar informações básicas do portfólio para segurança
        $portfolioBasico = $this->portfolioModel->getPortfolioBasico($studentIdExemplo);
        $portfolioId = $portfolioBasico['id'] ?? 0;

        if ($portfolioId) {
             // Chamar o model para remover a habilidade
            $removido = $this->portfolioModel->removerHabilidade($id, $portfolioId);

            if (!$removido) {
                echo "Erro ao remover habilidade."; // Em um ambiente real, লগar e tratar o erro adequadamente
            }
        } else {
            echo "Portfolio não encontrado.";
        }

        // Redirecionar para a listagem de habilidades após tentar remover (sucesso ou falha)
        header("Location: /dashboard/listarHabilidades");
        exit();
    }


    // ----------------------------------------------------------------
    //  CRUD - Cursos
    // ----------------------------------------------------------------

    public function listarCursos() {
         // *** Dados de exemplo - substitua pela lógica real para determinar o student_id do usuário logado ***
        $studentIdExemplo = '12345'; // ID do aluno logado (exemplo)

        // Buscar informações básicas do portfólio para obter o portfolio_id
        $portfolioBasico = $this->portfolioModel->getPortfolioBasico($studentIdExemplo);
        $portfolioId = $portfolioBasico['id'] ?? 0; // Obtém portfolio_id

        // Buscar todos os cursos do portfólio
        $cursos = $this->portfolioModel->getCursos($portfolioId);

        // Preparar dados para passar para a view
        $data = [
            'cursos' => $cursos ?? [],
        ];

        // Carregar a view 'dashboard/listar_cursos'
        $this->view('dashboard/listar_cursos', $data);
    }


    public function adicionarCurso() {
        // Carregar a view 'dashboard/adicionar_curso' (formulário vazio)
        $this->view('dashboard/adicionar_curso');
    }


    public function salvarCurso() {
         // *** Dados de exemplo - substitua pela lógica real para determinar o student_id do usuário logado ***
        $studentIdExemplo = '12345'; // ID do aluno logado (exemplo)
        $msg = ''; // Inicializa a variável de mensagem
        $erro = false; // Inicializa a flag de erro

        // Verificar se o formulário foi submetido via POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Buscar informações básicas do portfólio para obter o portfolio_id
            $portfolioBasico = $this->portfolioModel->getPortfolioBasico($studentIdExemplo);
            $portfolioId = $portfolioBasico['id'] ?? 0; // Obtém portfolio_id

            if ($portfolioId) {
                // Obter dados do formulário e sanitizar
                $nomeCurso = filter_input(INPUT_POST, 'nome_curso', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
                $instituicaoCurso = filter_input(INPUT_POST, 'instituicao_curso', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
                $descricaoCurso = filter_input(INPUT_POST, 'descricao_curso', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
                $linkCurso = filter_input(INPUT_POST, 'link_curso', FILTER_SANITIZE_URL);


                // Validar dados (adicione mais validações conforme necessário)
                if (empty($nomeCurso) || empty($instituicaoCurso)) {
                    $msg = "Por favor, preencha o nome e a instituição do curso.";
                    $erro = true;
                } else {
                    // Preparar array de dados para inserir no banco
                    $dadosCurso = [
                        'portfolio_id' => $portfolioId,
                        'nome_curso' => $nomeCurso,
                        'instituicao_curso' => $instituicaoCurso,
                        'descricao_curso' => $descricaoCurso,
                        'link_curso' => $linkCurso,
                    ];

                    // Chamar o model para adicionar o curso
                    $adicionado = $this->portfolioModel->adicionarCurso($dadosCurso);

                    if ($adicionado) {
                        $msg = "Curso adicionado com sucesso!";
                    } else {
                        $msg = "Erro ao adicionar curso.";
                        $erro = true;
                    }
                }
            } else {
                $msg = "Portfolio não encontrado.";
                $erro = true;
            }
        } else {
            $msg = "Acesso inválido."; // Acesso direto à action via GET não permitido
            $erro = true;
        }

        // Após tentar salvar, redirecionar para a listagem de cursos
        // (ou para o formulário de adicionar novamente, em caso de erro)
        if ($erro) {
            $data = ['msg' => $msg]; // Passa a mensagem de erro para a view
            $this->view('dashboard/adicionar_curso', $data); // Volta para o formulário de adicionar com mensagem
        } else {
            // Redirecionar para a listagem após sucesso
            header("Location: /dashboard/listarCursos");
            exit(); // Importante: Terminar a execução do script após o redirecionamento
        }
    }


    public function editarCurso(int $id = 0) {
         if ($id <= 0) {
            echo "ID inválido para edição.";
            return;
        }

        // *** Dados de exemplo - substitua pela lógica real para determinar o student_id do usuário logado ***
        $studentIdExemplo = '12345'; // ID do aluno logado (exemplo)

        // Buscar informações básicas do portfólio para segurança
        $portfolioBasico = $this->portfolioModel->getPortfolioBasico($studentIdExemplo);
        $portfolioId = $portfolioBasico['id'] ?? 0;

        // Buscar o curso específico pelo ID
        $cursos = $this->portfolioModel->getCursos($portfolioId);

        $cursoParaEditar = null;
        foreach ($cursos as $curso) {
            if ($curso['id'] == $id) {
                $cursoParaEditar = $curso;
                break;
            }
        }

        if (!$cursoParaEditar) {
            echo "Curso não encontrado.";
            return;
        }

        // Preparar dados para passar para a view
        $data = [
            'curso' => $cursoParaEditar,
            'msg' => '' // Mensagem inicialmente vazia
        ];

        // Carregar a view 'dashboard/editar_curso'
        $this->view('dashboard/editar_curso', $data);
    }


    public function atualizarCurso() {
         // *** Dados de exemplo - substitua pela lógica real para determinar o student_id do usuário logado ***
        $studentIdExemplo = '12345'; // ID do aluno logado (exemplo)
        $msg = '';
        $erro = false;

        // Verificar se o formulário foi submetido via POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Buscar informações básicas do portfólio para obter o portfolio_id
            $portfolioBasico = $this->portfolioModel->getPortfolioBasico($studentIdExemplo);
            $portfolioId = $portfolioBasico['id'] ?? 0;

            $idCurso = filter_input(INPUT_POST, 'id_curso', FILTER_SANITIZE_NUMBER_INT);

            if ($portfolioId && $idCurso) {
                 // Obter dados do formulário e sanitizar
                $nomeCurso = filter_input(INPUT_POST, 'nome_curso', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
                $instituicaoCurso = filter_input(INPUT_POST, 'instituicao_curso', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
                $descricaoCurso = filter_input(INPUT_POST, 'descricao_curso', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
                $linkCurso = filter_input(INPUT_POST, 'link_curso', FILTER_SANITIZE_URL);


                // Validar dados (adicione mais validações conforme necessário)
                if (empty($nomeCurso) || empty($instituicaoCurso)) {
                    $msg = "Por favor, preencha o nome e a instituição do curso.";
                    $erro = true;
                } else {
                    // Preparar array de dados para atualizar no banco
                    $dadosCurso = [
                        'id' => $idCurso,
                        'portfolio_id' => $portfolioId,
                        'nome_curso' => $nomeCurso,
                        'instituicao_curso' => $instituicaoCurso,
                        'descricao_curso' => $descricaoCurso,
                        'link_curso' => $linkCurso,
                    ];

                    // Chamar o model para atualizar o curso
                    $atualizado = $this->portfolioModel->atualizarCurso($dadosCurso);

                    if ($atualizado) {
                        $msg = "Curso atualizado com sucesso!";
                    } else {
                        $msg = "Erro ao atualizar curso.";
                        $erro = true;
                    }
                }
            } else {
                $msg = "Portfolio ou Curso não encontrados.";
                $erro = true;
            }

        } else {
            $msg = "Acesso inválido.";
            $erro = true;
        }

        // Após tentar salvar, redirecionar para a listagem de cursos
        // (ou para o formulário de editar novamente, em caso de erro)
        if ($erro) {
             // Em caso de erro, refazer a busca dos dados do curso para preencher o formulário novamente
            $portfolioBasico = $this->portfolioModel->getPortfolioBasico($studentIdExemplo);
            $portfolioId = $portfolioBasico['id'] ?? 0;
            $cursos = $this->portfolioModel->getCursos($portfolioId);

             $cursoParaEditar = null;
            if($idCurso){ // Tenta buscar o curso novamente se o ID foi passado
                 foreach ($cursos as $curso) {
                    if ($curso['id'] == $idCurso) {
                        $cursoParaEditar = $curso;
                        break;
                    }
                }
            }


            $data = [
                'curso' => $cursoParaEditar ?? [], // Passa o curso (ou array vazio se não encontrado)
                'msg' => $msg // Passa a mensagem de erro
            ];
            $this->view('dashboard/editar_curso', $data); //  Volta para o formulário de editar com mensagem de erro e dados
        } else {
            // Redirecionar para a listagem após sucesso
            header("Location: /dashboard/listarCursos");
            exit();
        }
    }


    public function removerCurso(int $id = 0) {
        if ($id <= 0) {
            echo "ID inválido para remoção.";
            return;
        }

        // *** Dados de exemplo - substitua pela lógica real para determinar o student_id do usuário logado ***
        $studentIdExemplo = '12345'; // ID do aluno logado (exemplo)

        // Buscar informações básicas do portfólio para segurança
        $portfolioBasico = $this->portfolioModel->getPortfolioBasico($studentIdExemplo);
        $portfolioId = $portfolioBasico['id'] ?? 0;

        if ($portfolioId) {
             // Chamar o model para remover o curso
            $removido = $this->portfolioModel->removerCurso($id, $portfolioId);

            if (!$removido) {
                echo "Erro ao remover curso."; // Em um ambiente real, লগar e tratar o erro adequadamente
            }
        } else {
            echo "Portfolio não encontrado.";
        }

        // Redirecionar para a listagem de cursos após tentar remover (sucesso ou falha)
        header("Location: /dashboard/listarCursos");
        exit();
    }



    // ----------------------------------------------------------------
    //  CRUD - Sobre Mim (Edição apenas)
    // ----------------------------------------------------------------
    public function editarSobreMim() {
        // *** Dados de exemplo - substitua pela lógica real para determinar o student_id do usuário logado ***
        $studentIdExemplo = '12345'; // ID do aluno logado (exemplo)

        // Buscar informações básicas do portfólio para obter o portfolio_id
        $portfolioBasico = $this->portfolioModel->getPortfolioBasico($studentIdExemplo);
        $portfolioId = $portfolioBasico['id'] ?? 0; // Obtém portfolio_id

        // Buscar informações "Sobre Mim" atuais do banco de dados
        $sobreMim = $this->portfolioModel->getSobreMim($portfolioId);

        // Preparar dados para passar para a view
        $data = [
            'sobreMim' => $sobreMim ?? [], // Passa informações "Sobre Mim" ou array vazio se não encontradas
            'msg' => '' // Variável para mensagens de feedback (inicialmente vazia)
        ];

        // Carregar a view 'dashboard/editar_sobre_mim'
        $this->view('dashboard/editar_sobre_mim', $data);
    }


    public function atualizarSobreMim() {
        // *** Dados de exemplo - substitua pela lógica real para determinar o student_id do usuário logado ***
        $studentIdExemplo = '12345'; // ID do aluno logado (exemplo)
        $msg = ''; // Inicializa a variável de mensagem

        // Verificar se o formulário foi submetido via POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Obter dados do formulário e sanitizar
            $textoSobre = filter_input(INPUT_POST, 'texto_sobre', FILTER_SANITIZE_STRING);


            // Buscar informações básicas do portfólio para obter o portfolio_id
            $portfolioBasico = $this->portfolioModel->getPortfolioBasico($studentIdExemplo);
            $portfolioId = $portfolioBasico['id'] ?? 0; // Obtém portfolio_id

            if ($portfolioId) {
                // Preparar array de dados para atualizar o banco de dados
                $dadosSobreMim = [
                    'portfolio_id' => $portfolioId,
                    'texto_sobre' => $textoSobre,
                ];

                // Chamar o model para atualizar a seção "Sobre Mim"
                $atualizado = $this->portfolioModel->atualizarSobreMim($dadosSobreMim);

                if ($atualizado) {
                    $msg = "Seção 'Sobre Mim' atualizada com sucesso!";
                } else {
                    $msg = "Erro ao atualizar a seção 'Sobre Mim'.";
                }
            } else {
                $msg = "Portfolio não encontrado.";
            }
        } else {
            $msg = "Acesso inválido."; // Acesso direto à action via GET não permitido
        }

        // Após tentar salvar, vamos refazer a busca da seção "Sobre Mim" para exibir o formulário novamente,
        // e passar a mensagem de feedback para a view
        $portfolioBasico = $this->portfolioModel->getPortfolioBasico($studentIdExemplo);
        $sobreMim = $this->portfolioModel->getSobreMim($portfolioBasico['id'] ?? 0);
        $data = [
            'sobreMim' => $sobreMim ?? [],
            'msg' => $msg
        ];

        // Carregar a view 'dashboard/editar_sobre_mim' novamente com a mensagem
        $this->view('dashboard/editar_sobre_mim', $data);
    }


    protected function view(string $viewPath, array $data = []) {
        extract($data);
        $layoutPath = __DIR__ . '/../views/layouts/default.php';
        $viewFullPath = __DIR__ . '/../views/dashboard/' . $viewPath . '.php';

        if (file_exists($viewFullPath)) {
            ob_start();
            require $viewFullPath;
            $viewContent = ob_get_clean();

            if (file_exists($layoutPath)) {
                require $layoutPath;
            } else {
                echo $viewContent;
            }
        } else {
            http_response_code(404);
            echo "View '{$viewPath}' não encontrada.";
        }
    }
}