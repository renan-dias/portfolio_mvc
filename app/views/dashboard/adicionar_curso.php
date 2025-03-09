<?php

// app/views/dashboard/adicionar_curso.php

// Garante que $msg está definida, mesmo que vazia
$msg = $msg ?? '';

?>

<main class="container">
    <section class="py-5">
        <h1 class="display-5 fw-bold">Adicionar Novo Curso</h1>
        <p class="lead">
            Preencha o formulário abaixo para adicionar um novo curso ao seu portfólio.
        </p>

        <?php if (!empty($msg)): ?>
            <div class="alert alert-info" role="alert">
                <?= htmlspecialchars($msg) ?>
            </div>
        <?php endif; ?>

        <div class="card">
            <div class="card-body">
                <form action="/dashboard/salvarCurso" method="post">
                    <div class="mb-3">
                        <label for="nome_curso" class="form-label">Nome do Curso <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="nome_curso" name="nome_curso" required>
                    </div>
                    <div class="mb-3">
                        <label for="instituicao_curso" class="form-label">Instituição <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="instituicao_curso" name="instituicao_curso" required>
                    </div>
                    <div class="mb-3">
                        <label for="descricao_curso" class="form-label">Descrição do Curso (Opcional)</label>
                        <textarea class="form-control" id="descricao_curso" name="descricao_curso" rows="3"></textarea>
                        <div class="form-text">Pequena descrição sobre o curso, carga horária, etc.</div>
                    </div>
                    <div class="mb-3">
                        <label for="link_curso" class="form-label">Link do Curso (Opcional)</label>
                        <input type="url" class="form-control" id="link_curso" name="link_curso" placeholder="URL para a página do curso, certificado, etc.">
                    </div>

                    <button type="submit" class="btn btn-primary">Salvar Curso</button>
                    <a href="/dashboard/listarCursos" class="btn btn-secondary ms-2">Cancelar</a>
                </form>
            </div>
        </div>
    </section>
</main>