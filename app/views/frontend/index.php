<?php

// app/views/frontend/index.php

$informacoesPessoais = $informacoesPessoais ?? []; // Garante que $informacoesPessoais está definida
$habilidades = $habilidades ?? []; // Garante que $habilidades está definida

?>

<main>
    <section class="py-5 text-center container">
        <div class="row py-lg-5">
            <div class="col-lg-6 col-md-8 mx-auto">
                <h1 class="fw-light"><?= htmlspecialchars($informacoesPessoais['nome_completo'] ?? 'Seu Nome Aqui') ?></h1>
                <p class="lead text-muted"><?= htmlspecialchars($informacoesPessoais['profissao'] ?? 'Sua Profissão Aqui') ?></p>
                <p>
                    <a href="/projetos" class="btn btn-primary my-2">Meus Projetos</a>
                    <a href="/contato" class="btn btn-secondary my-2">Entre em Contato</a>
                </p>
            </div>
        </div>
    </section>

    <div class="album py-5 bg-light">
        <div class="container">

            <section class="py-3">
                <h2>Habilidades</h2>
                <p class="lead text-muted">Algumas das minhas principais habilidades e competências.</p>
                <?php if (empty($habilidades)): ?>
                    <div class="alert alert-info" role="alert">
                        Nenhuma habilidade cadastrada ainda. Cadastre suas habilidades no Dashboard para exibi-las aqui!
                    </div>
                <?php else: ?>
                    <div>
                        <?php foreach ($habilidades as $habilidade): ?>
                            <span class="badge bg-primary m-1"><?= htmlspecialchars($habilidade['nome_habilidade']) ?> - <?= htmlspecialchars($habilidade['nivel_habilidade']) ?></span>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </section>


            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                <div class="col">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <p class="card-text">
                                Conteúdo da Página Inicial do Portfólio.
                                Aqui você poderá adicionar mais seções como "Sobre Mim", "Experiência", "Cursos", etc.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>