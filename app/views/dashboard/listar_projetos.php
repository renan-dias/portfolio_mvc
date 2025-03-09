<?php

// app/views/dashboard/listar_projetos.php

// Garante que $projetos está definida e é um array
$projetos = $projetos ?? [];

?>

<main class="container">
    <section class="py-5">
        <h1 class="display-5 fw-bold">Gerenciar Projetos</h1>
        <p class="lead">
            Liste, adicione, edite ou remova os projetos do seu portfólio.
        </p>

        <div class="d-flex justify-content-end mb-3">
            <a href="/dashboard/adicionarProjeto" class="btn btn-primary">
                <i class="bi bi-plus-circle me-2"></i> Adicionar Projeto
            </a>
        </div>

        <?php if (empty($projetos)): ?>
            <p>Nenhum projeto cadastrado.</p>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Título</th>
                            <th>Descrição</th>
                            <th>Imagem</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($projetos as $projeto): ?>
                            <tr>
                                <td><?= htmlspecialchars($projeto['titulo_projeto']) ?></td>
                                <td><?= htmlspecialchars(substr($projeto['descricao_projeto'], 0, 100)) ?>...</td> <td>
                                    <?php if (!empty($projeto['imagem_projeto'])): ?>
                                        <img src="<?= htmlspecialchars($projeto['imagem_projeto']) ?>" alt="Imagem do Projeto" class="img-thumbnail" style="max-width: 100px; max-height: 80px;">
                                    <?php else: ?>
                                        <p>Sem Imagem</p>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="/dashboard/editarProjeto/<?= $projeto['id'] ?>" class="btn btn-sm btn-outline-secondary">
                                        <i class="bi bi-pencil-square"></i> Editar
                                    </a>
                                    <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal<?= $projeto['id'] ?>">
                                        <i class="bi bi-trash"></i> Remover
                                    </button>

                                    <div class="modal fade" id="confirmDeleteModal<?= $projeto['id'] ?>" tabindex="-1" aria-labelledby="confirmDeleteModalLabel<?= $projeto['id'] ?>" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="confirmDeleteModalLabel<?= $projeto['id'] ?>">Confirmar Remoção</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Tem certeza de que deseja remover o projeto <strong><?= htmlspecialchars($projeto['titulo_projeto']) ?></strong>?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                    <a href="/dashboard/removerProjeto/<?= $projeto['id'] ?>" class="btn btn-danger">Confirmar Remover</a>
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