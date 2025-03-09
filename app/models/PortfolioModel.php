<?php

// app/models/PortfolioModel.php

class PortfolioModel {

    private $db;

    public function __construct() {
        $config = require __DIR__ . '/../../config/database.php';
        try {
            $this->db = new PDO(
                "mysql:host={$config['host']};dbname={$config['database']};charset={$config['charset']}",
                $config['username'],
                $config['password'],
                $config['options']
            );
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Configura para lançar exceções em erros
        } catch (PDOException $e) {
            // Em um ambiente real, লগar o erro de forma mais apropriada (ex: লগ em arquivo, serviço de লগ)
            error_log("Erro na conexão com o banco de dados: " . $e->getMessage());
            echo "Erro grave no banco de dados. Consulte os logs do servidor para mais detalhes.";
            die(); // Interrompe a execução em caso de falha grave na conexão
        }
    }

    // Métodos para Informações Básicas do Portfólio (tabela 'portfolios')
    public function getPortfolioBasico(string $studentId) {
        $sql = "SELECT * FROM portfolios WHERE student_id = :student_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['student_id' => $studentId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Métodos para Informações Pessoais (tabela 'portfolio_informacoes_pessoais')
    public function getInformacoesPessoais(int $portfolioId) {
        $sql = "SELECT * FROM portfolio_informacoes_pessoais WHERE portfolio_id = :portfolio_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['portfolio_id' => $portfolioId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function atualizarInformacoesPessoais(array $dadosInformacoesPessoais) {
        $sql = "UPDATE portfolio_informacoes_pessoais SET
                    nome_completo = :nome_completo,
                    profissao = :profissao,
                    email = :email,
                    telefone = :telefone,
                    linkedin = :linkedin,
                    github = :github,
                    whatsapp = :whatsapp,
                    bio = :bio,
                    foto_perfil = :foto_perfil
                WHERE portfolio_id = :portfolio_id";

        $stmt = $this->db->prepare($sql);
        return $stmt->execute($dadosInformacoesPessoais);
    }

    // Métodos para Experiência Acadêmica (tabela 'portfolio_experiencia_academica')
    public function getExperienciasAcademicas(int $portfolioId) {
        $sql = "SELECT * FROM portfolio_experiencia_academica WHERE portfolio_id = :portfolio_id ORDER BY periodo DESC"; // Ordenar por período
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['portfolio_id' => $portfolioId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function adicionarExperienciaAcademica(array $dadosExperiencia) {
        $sql = "INSERT INTO portfolio_experiencia_academica (portfolio_id, instituicao, curso, periodo, descricao) VALUES (:portfolio_id, :instituicao, :curso, :periodo, :descricao)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($dadosExperiencia);
    }

    public function atualizarExperienciaAcademica(array $dadosExperiencia) {
         $sql = "UPDATE portfolio_experiencia_academica SET
                    instituicao = :instituicao,
                    curso = :curso,
                    periodo = :periodo,
                    descricao = :descricao
                WHERE id = :id AND portfolio_id = :portfolio_id"; // Adicionado WHERE id para identificar registro específico e portfolio_id para segurança
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($dadosExperiencia);
    }

    public function removerExperienciaAcademica(int $id, int $portfolioId) {
        $sql = "DELETE FROM portfolio_experiencia_academica WHERE id = :id AND portfolio_id = :portfolio_id"; // Adicionado portfolio_id para segurança
        $stmt = $this->db->prepare($sql);
        return $stmt->execute(['id' => $id, 'portfolio_id' => $portfolioId]);
    }


    // Métodos para Projetos (tabela 'portfolio_projetos')
    public function getProjetos(int $portfolioId) {
        $sql = "SELECT * FROM portfolio_projetos WHERE portfolio_id = :portfolio_id ORDER BY data_criacao DESC"; // Ordenar por data de criação
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['portfolio_id' => $portfolioId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function adicionarProjeto(array $dadosProjeto) {
        $sql = "INSERT INTO portfolio_projetos (portfolio_id, titulo_projeto, descricao_projeto, link_projeto, link_github, imagem_projeto, data_criacao)
                VALUES (:portfolio_id, :titulo_projeto, :descricao_projeto, :link_projeto, :link_github, :imagem_projeto, NOW())"; // Usando NOW() para data_criacao
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($dadosProjeto);
    }

    public function atualizarProjeto(array $dadosProjeto) {
        $sql = "UPDATE portfolio_projetos SET
                    titulo_projeto = :titulo_projeto,
                    descricao_projeto = :descricao_projeto,
                    link_projeto = :link_projeto,
                    link_github = :link_github,
                    imagem_projeto = :imagem_projeto
                WHERE id = :id AND portfolio_id = :portfolio_id"; // Adicionado WHERE id para registro específico e portfolio_id para segurança
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($dadosProjeto);
    }

    public function removerProjeto(int $id, int $portfolioId) {
        $sql = "DELETE FROM portfolio_projetos WHERE id = :id AND portfolio_id = :portfolio_id"; // Adicionado portfolio_id para segurança
        $stmt = $this->db->prepare($sql);
        return $stmt->execute(['id' => $id, 'portfolio_id' => $portfolioId]);
    }


    // Métodos para Contato e Redes Sociais (tabela 'portfolio_contato_redes_sociais')
    public function getContatoRedesSociais(int $portfolioId) {
        $sql = "SELECT * FROM portfolio_contato_redes_sociais WHERE portfolio_id = :portfolio_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['portfolio_id' => $portfolioId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function atualizarContatoRedesSociais(array $dadosContato) {
        $sql = "UPDATE portfolio_contato_redes_sociais SET
                    linkedin = :linkedin,
                    github = :github,
                    whatsapp = :whatsapp,
                    email = :email
                WHERE portfolio_id = :portfolio_id";

        $stmt = $this->db->prepare($sql);
        return $stmt->execute($dadosContato);
    }

    // Métodos para Cursos (tabela 'portfolio_cursos')
    public function getCursos(int $portfolioId) {
        $sql = "SELECT * FROM portfolio_cursos WHERE portfolio_id = :portfolio_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['portfolio_id' => $portfolioId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function adicionarCurso(array $dadosCurso) {
        $sql = "INSERT INTO portfolio_cursos (portfolio_id, nome_curso, instituicao_curso, descricao_curso, link_curso)
                VALUES (:portfolio_id, :nome_curso, :instituicao_curso, :descricao_curso, :link_curso)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($dadosCurso);
    }

    public function atualizarCurso(array $dadosCurso) {
        $sql = "UPDATE portfolio_cursos SET
                    nome_curso = :nome_curso,
                    instituicao_curso = :instituicao_curso,
                    descricao_curso = :descricao_curso,
                    link_curso = :link_curso
                WHERE id = :id AND portfolio_id = :portfolio_id"; // Adicionado WHERE id para registro específico e portfolio_id para segurança
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($dadosCurso);
    }

    public function removerCurso(int $id, int $portfolioId) {
        $sql = "DELETE FROM portfolio_cursos WHERE id = :id AND portfolio_id = :portfolio_id"; // Adicionado portfolio_id para segurança
        $stmt = $this->db->prepare($sql);
        return $stmt->execute(['id' => $id, 'portfolio_id' => $portfolioId]);
    }


    // Métodos para Habilidades (tabela 'portfolio_habilidades')
    public function getHabilidades(int $portfolioId) {
        $sql = "SELECT * FROM portfolio_habilidades WHERE portfolio_id = :portfolio_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['portfolio_id' => $portfolioId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function adicionarHabilidade(array $dadosHabilidade) {
        $sql = "INSERT INTO portfolio_habilidades (portfolio_id, nome_habilidade, nivel_habilidade)
                VALUES (:portfolio_id, :nome_habilidade, :nivel_habilidade)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($dadosHabilidade);
    }


    public function atualizarHabilidade(array $dadosHabilidade) {
        $sql = "UPDATE portfolio_habilidades SET
                    nome_habilidade = :nome_habilidade,
                    nivel_habilidade = :nivel_habilidade
                WHERE id = :id AND portfolio_id = :portfolio_id"; // Adicionado WHERE id para registro específico e portfolio_id para segurança
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($dadosHabilidade);
    }

     public function removerHabilidade(int $id, int $portfolioId) {
        $sql = "DELETE FROM portfolio_habilidades WHERE id = :id AND portfolio_id = :portfolio_id"; // Adicionado portfolio_id para segurança
        $stmt = $this->db->prepare($sql);
        return $stmt->execute(['id' => $id, 'portfolio_id' => $portfolioId]);
    }


    // Métodos para Sobre Mim (tabela 'portfolio_sobre_mim')
    public function getSobreMim(int $portfolioId) {
        $sql = "SELECT * FROM portfolio_sobre_mim WHERE portfolio_id = :portfolio_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['portfolio_id' => $portfolioId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function atualizarSobreMim(array $dadosSobreMim) {
        $sql = "UPDATE portfolio_sobre_mim SET
                    texto_sobre = :texto_sobre
                WHERE portfolio_id = :portfolio_id";

        $stmt = $this->db->prepare($sql);
        return $stmt->execute($dadosSobreMim);
    }


    // *** Adicione mais métodos para outras tabelas e funcionalidades CRUD conforme necessário ***
}