<?php

// app/controllers/FrontendController.php

class FrontendController extends BaseController {

    private $portfolioModel;

    public function __construct() {
        $this->portfolioModel = new PortfolioModel();
    }

    public function index() {
        // *** Dados de exemplo - substitua pela lógica real para determinar o student_id do usuário logado ***
        $studentIdExemplo = '12345'; // ID do aluno logado (exemplo)

        // Buscar informações básicas do portfólio para obter o portfolio_id
        $portfolioBasico = $this->portfolioModel->getPortfolioBasico($studentIdExemplo);
        $portfolioId = $portfolioBasico['id'] ?? 0; // Obtém portfolio_id

        // Buscar informações pessoais para exibir na página inicial
        $informacoesPessoais = $this->portfolioModel->getInformacoesPessoais($portfolioId);
        // Buscar lista de habilidades para exibir na página inicial
        $habilidades = $this->portfolioModel->getHabilidades($portfolioId);


        // Preparar dados para passar para a view
        $data = [
            'informacoesPessoais' => $informacoesPessoais ?? [], // Passa as informações pessoais
            'habilidades' => $habilidades ?? [] // Passa a lista de habilidades
        ];

        $this->view('frontend/index', $data); // Carrega a view 'frontend/index.php'
    }

    public function projetos() {
        // Action para a página de projetos do portfólio
        // ... (código da action projetos() como já está, sem alterações) ...
        $studentIdExemplo = '12345'; // ID do aluno logado (exemplo)
        $portfolioBasico = $this->portfolioModel->getPortfolioBasico($studentIdExemplo);
        $portfolioId = $portfolioBasico['id'] ?? 0;
        $projetos = $this->portfolioModel->getProjetos($portfolioId);
        $data = [
            'projetos' => $projetos ?? []
        ];
        $this->view('frontend/projetos', $data);
    }

    public function contato() {
        // Action para a página de contato (opcional)
        $data = []; // Por enquanto, dados vazios
        $this->view('frontend/contato', $data); // Carrega a view 'frontend/contato.php'
    }

    protected function view(string $viewPath, array $data = []) {
        extract($data);
        $layoutPath = __DIR__ . '/../views/layouts/frontend_layout.php'; // Layout para o frontend
        $viewFullPath = __DIR__ . '/../views/frontend/' . $viewPath . '.php';

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