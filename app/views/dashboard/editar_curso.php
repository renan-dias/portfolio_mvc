<?php

// app/views/dashboard/editar_curso.php

// Garante que $curso e $msg estão definidas, mesmo que vazias
$curso = $curso ?? [];
$msg = $msg ?? '';

?>

<main class="container">
    <section class="py-5">
        <h1 class="display-5 fw-bold">Editar Curso</h1>
        <p class="lead">
            Preencha o formulário abaixo para editar as informações do curso.
        </p>

        <?php if (!empty($msg)): ?>
            <div class="alert alert-info" role="alert">
                <?= htmlspecialchars($msg) ?>
            </div>
        <?php endif; ?>

        <div class="card">
            <div class="card-body">
                <form action="/dashboard/atualizarCurso" method="post">
                    <input type="hidden" name="id_curso" value="<?= htmlspecialchars($curso['id'] ?? '') ?>">
                    <div class="mb-3">
                        <label for="nome_curso" class="form-label">Nome do Curso <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="nome_curso" name="nome_curso" value="<?= htmlspecialchars($curso['nome_curso'] ?? '') ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="instituicao_curso" class="form-label">Instituição <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="instituicao_curso" name="instituicao_curso" value="<?= htmlspecialchars($curso['instituicao_curso'] ?? '') ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="descricao_curso" class="form-label">Descrição do Curso (Opcional)</label>
                        <textarea class="form-control" id="descricao_curso" name="descricao_curso" rows="3"><?= htmlspecialchars($curso['descricao_curso'] ?? '') ?></textarea>
                        <div class="form-text">Pequena descrição sobre o curso, carga horária, etc.</div>
                    </div>
                    <div class="mb-3">
                        <label for="link_curso" class="form-label">Link do Curso (Opcional)</label>
                        <input type="url" class="form-control" id="link_curso" name="link_curso" value="<?= htmlspecialchars($curso['link_curso'] ?? '') ?>" placeholder="URL para a página do curso, certificado, etc.">
                    </div>

                    <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                    <a href="/dashboard/listarCursos" class="btn btn-secondary ms-2">Cancelar</a>
                </form>
            </div>
        </div>
    </section>
</main>