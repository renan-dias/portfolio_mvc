<?php

// app/controllers/PortfolioController.php

class PortfolioController {

    private $portfolioModel;

    public function __construct() {
        $this->portfolioModel = new PortfolioModel();
    }

    public function index() {
        // *** Dados de exemplo - substitua pela lógica real para determinar o student_id do portfólio a ser exibido ***
        $studentIdExemplo = '12345'; // ID do aluno para o portfólio que vamos exibir (exemplo)

        // Buscar dados do portfólio no banco de dados usando o Model
        $portfolioBasico = $this->portfolioModel->getPortfolioBasico($studentIdExemplo);
        $informacoesPessoais = $this->portfolioModel->getInformacoesPessoais($portfolioBasico['id'] ?? 0); // Passa portfolio_id, default 0 se portfolioBasico for nulo
        $experienciasAcademicas = $this->portfolioModel->getExperienciasAcademicas($portfolioBasico['id'] ?? 0);
        $projetos = $this->portfolioModel->getProjetos($portfolioBasico['id'] ?? 0);
        $contatoRedesSociais = $this->portfolioModel->getContatoRedesSociais($portfolioBasico['id'] ?? 0);


        // Preparar array de dados para passar para a view
        $data = [
            'portfolioBasico' => $portfolioBasico,
            'informacoesPessoais' => $informacoesPessoais,
            'experienciasAcademicas' => $experienciasAcademicas,
            'projetos' => $projetos,
            'contatoRedesSociais' => $contatoRedesSociais,
        ];

        // Carregar a view 'index' dentro do layout 'default' e passar os dados
        $this->view('portfolio/index', $data);
    }

    protected function view(string $viewPath, array $data = []) {
        extract($data);
        $layoutPath = __DIR__ . '/../views/layouts/default.php';
        $viewFullPath = __DIR__ . '/../views/portfolio/' . $viewPath . '.php';

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