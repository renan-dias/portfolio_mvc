<?php

// app/views/dashboard/adicionar_projeto.php

// Garante que $msg está definida, mesmo que vazia
$msg = $msg ?? '';

?>

<main class="container">
    <section class="py-5">
        <h1 class="display-5 fw-bold">Adicionar Novo Projeto</h1>
        <p class="lead">
            Preencha o formulário abaixo para adicionar um novo projeto ao seu portfólio.
        </p>

        <?php if (!empty($msg)): ?>
            <div class="alert alert-info" role="alert">
                <?= htmlspecialchars($msg) ?>
            </div>
        <?php endif; ?>

        <div class="card">
            <div class="card-body">
                <form action="/dashboard/salvarProjeto" method="post">
                    <div class="mb-3">
                        <label for="titulo_projeto" class="form-label">Título do Projeto <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="titulo_projeto" name="titulo_projeto" required>
                    </div>
                    <div class="mb-3">
                        <label for="descricao_projeto" class="form-label">Descrição do Projeto <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="descricao_projeto" name="descricao_projeto" rows="4" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="link_projeto" class="form-label">Link do Projeto (URL)</label>
                        <input type="url" class="form-control" id="link_projeto" name="link_projeto" placeholder="Opcional">
                    </div>
                    <div class="mb-3">
                        <label for="link_github" class="form-label">Link do GitHub (URL)</label>
                        <input type="url" class="form-control" id="link_github" name="link_github" placeholder="Opcional">
                    </div>
                    <div class="mb-3">
                        <label for="imagem_projeto" class="form-label">URL da Imagem do Projeto</label>
                        <input type="url" class="form-control" id="imagem_projeto" name="imagem_projeto" placeholder="Opcional - URL para a imagem do projeto">
                        <div class="form-text">Recomendado usar URLs de imagens externas ou você pode implementar upload de imagens posteriormente.</div>
                    </div>

                    <button type="submit" class="btn btn-primary">Salvar Projeto</button>
                    <a href="/dashboard/listarProjetos" class="btn btn-secondary ms-2">Cancelar</a>
                </form>
            </div>
        </div>
    </section>
</main>