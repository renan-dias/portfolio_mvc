<?php

// app/views/dashboard/listar_cursos.php

$cursos = $cursos ?? []; // Garante que $cursos está definida, mesmo que vazia

?>

<main class="container">
    <section class="py-5">
        <h1 class="display-5 fw-bold">Gerenciar Cursos</h1>
        <p class="lead">
            Liste, adicione, edite e remova os cursos que você deseja exibir no seu portfólio.
        </p>

        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <a href="/dashboard" class="btn btn-secondary">
                    <i class="bi bi-arrow-left me-2"></i> Voltar ao Dashboard
                </a>
                <a href="/dashboard/adicionarCurso" class="btn btn-primary">
                    <i class="bi bi-plus-circle me-2"></i> Adicionar Curso
                </a>
            </div>
            <span>
                Total de Cursos: <strong><?= count($cursos) ?></strong>
            </span>
        </div>

        <?php if (empty($cursos)): ?>
            <div class="alert alert-info" role="alert">
                Nenhum curso cadastrado ainda. Comece adicionando seu primeiro curso!
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Curso</th>
                            <th scope="col">Instituição</th>
                            <th scope="col" style="width: 120px;">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($cursos as $curso): ?>
                            <tr>
                                <th scope="row"><?= $curso['id'] ?></th>
                                <td><?= htmlspecialchars($curso['nome_curso']) ?></td>
                                <td><?= htmlspecialchars($curso['instituicao_curso']) ?></td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <a href="/dashboard/editarCurso/<?= $curso['id'] ?>" class="btn btn-sm btn-outline-secondary">
                                            <i class="bi bi-pencil-square"></i> Editar
                                        </a>
                                        <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#removerCursoModal<?= $curso['id'] ?>">
                                            <i class="bi bi-trash"></i> Remover
                                        </button>
                                    </div>

                                    <div class="modal fade" id="removerCursoModal<?= $curso['id'] ?>" tabindex="-1" aria-labelledby="removerCursoModalLabel<?= $curso['id'] ?>" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="removerCursoModalLabel<?= $curso['id'] ?>">Confirmar Remoção</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Tem certeza que deseja remover o curso: <strong><?= htmlspecialchars($curso['nome_curso']) ?></strong> da instituição <strong><?= htmlspecialchars($curso['instituicao_curso']) ?></strong>?
                                                    <br>Essa ação não poderá ser desfeita.
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                    <a href="/dashboard/removerCurso/<?= $curso['id'] ?>" class="btn btn-danger">Confirmar Remover</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </section>
</main>