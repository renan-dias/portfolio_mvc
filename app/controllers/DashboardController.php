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
    //  CRUD - Projetos (Listar e Adicionar - Completos)
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


    // ----------------------------------------------------------------
    //  CRUD - Projetos (Editar e Remover - A SEREM IMPLEMENTADOS)
    // ----------------------------------------------------------------
    public function editarProjeto(int $id = 0) {
        // *** A ser implementada na próxima etapa ***
        // Lógica para buscar os dados do projeto e passar para a view de edição
         $this->view('dashboard/editar_projeto'); // View placeholder ainda
    }

    public function atualizarProjeto() {
        // *** A ser implementada na próxima etapa ***
        // Lógica para atualizar o projeto no banco de dados
    }

    public function removerProjeto(int $id = 0) {
        // *** A ser implementada na próxima etapa ***
        // Lógica para remover o projeto do banco de dados
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