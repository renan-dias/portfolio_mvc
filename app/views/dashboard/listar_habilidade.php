<?php

// app/views/dashboard/listar_habilidades.php

$habilidades = $habilidades ?? []; // Garante que $habilidades está definida, mesmo que vazia

?>

<main class="container">
    <section class="py-5">
        <h1 class="display-5 fw-bold">Gerenciar Habilidades</h1>
        <p class="lead">
            Liste, adicione, edite e remova as habilidades que você deseja exibir no seu portfólio.
        </p>

        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <a href="/dashboard" class="btn btn-secondary">
                    <i class="bi bi-arrow-left me-2"></i> Voltar ao Dashboard
                </a>
                <a href="/dashboard/adicionarHabilidade" class="btn btn-primary">
                    <i class="bi bi-plus-circle me-2"></i> Adicionar Habilidade
                </a>
            </div>
            <span>
                Total de Habilidades: <strong><?= count($habilidades) ?></strong>
            </span>
        </div>


        <?php if (empty($habilidades)): ?>
            <div class="alert alert-info" role="alert">
                Nenhuma habilidade cadastrada ainda. Comece adicionando sua primeira habilidade!
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Habilidade</th>
                            <th scope="col">Nível</th>
                            <th scope="col" style="width: 120px;">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($habilidades as $habilidade): ?>
                            <tr>
                                <th scope="row"><?= $habilidade['id'] ?></th>
                                <td><?= htmlspecialchars($habilidade['nome_habilidade']) ?></td>
                                <td><?= htmlspecialchars($habilidade['nivel_habilidade']) ?></td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <a href="/dashboard/editarHabilidade/<?= $habilidade['id'] ?>" class="btn btn-sm btn-outline-secondary">
                                            <i class="bi bi-pencil-square"></i> Editar
                                        </a>
                                        <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#removerHabilidadeModal<?= $habilidade['id'] ?>">
                                            <i class="bi bi-trash"></i> Remover
                                        </button>
                                    </div>

                                    <div class="modal fade" id="removerHabilidadeModal<?= $habilidade['id'] ?>" tabindex="-1" aria-labelledby="removerHabilidadeModalLabel<?= $habilidade['id'] ?>" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="removerHabilidadeModalLabel<?= $habilidade['id'] ?>">Confirmar Remoção</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Tem certeza que deseja remover a habilidade: <strong><?= htmlspecialchars($habilidade['nome_habilidade']) ?></strong>?
                                                    <br>Essa ação não poderá ser desfeita.
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                    <a href="/dashboard/removerHabilidade/<?= $habilidade['id'] ?>" class="btn btn-danger">Confirmar Remover</a>
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