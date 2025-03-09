<?php

// app/views/frontend/projetos.php

$projetos = $projetos ?? []; // Garante que $projetos está definida, mesmo que vazia

?>

<main>
    <section class="py-5 text-center container">
        <div class="row py-lg-5">
            <div class="col-lg-6 col-md-8 mx-auto">
                <h1 class="fw-light">Meus Projetos</h1>
                <p class="lead text-muted">
                    Confira alguns dos meus principais projetos e trabalhos.
                </p>
            </div>
        </div>
    </section>

    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">

                <?php if (empty($projetos)): ?>
                    <div class="col-12">
                        <div class="alert alert-info" role="alert">
                            Nenhum projeto cadastrado ainda. Em breve terei projetos para exibir aqui!
                        </div>
                    </div>
                <?php else: ?>
                    <?php foreach ($projetos as $projeto): ?>
                        <div class="col">
                            <div class="card shadow-sm">
                                <img src="<?= htmlspecialchars($projeto['imagem_projeto'] ?? '/assets/images/projeto-default.jpg') ?>" class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false">
                                <div class="card-body">
                                    <h5 class="card-title"><?= htmlspecialchars($projeto['nome_projeto']) ?></h5>
                                    <p class="card-text"><?= htmlspecialchars($projeto['descricao_projeto']) ?></p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="btn-group">
                                            <?php if (!empty($projeto['link_projeto'])): ?>
                                                <a href="<?= htmlspecialchars($projeto['link_projeto']) ?>" target="_blank" class="btn btn-sm btn-outline-secondary">
                                                    <i class="bi bi-eye"></i> Ver Projeto
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                        <small class="text-muted"><?= htmlspecialchars($projeto['ano_projeto']) ?></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>

            </div>
        </div>
    </div>
</main>