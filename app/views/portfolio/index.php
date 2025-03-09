<?php

// app/views/portfolio/index.php

// Certifique-se de que as variáveis $portfolioBasico, $informacoesPessoais,
// $experienciasAcademicas, $projetos e $contatoRedesSociais estão disponíveis
// (foram passadas do controller para a view)

// Se alguma variável não estiver definida (ex: se não houver dados no banco),
// defina como array vazio para evitar erros
$portfolioBasico = $portfolioBasico ?? [];
$informacoesPessoais = $informacoesPessoais ?? [];
$experienciasAcademicas = $experienciasAcademicas ?? [];
$projetos = $projetos ?? [];
$contatoRedesSociais = $contatoRedesSociais ?? [];

?>

<main>
    <section id="hero" class="hero-section text-center py-5">
        <div class="container">
            <div class="hero-content">
                <img src="<?= $informacoesPessoais['foto_perfil'] ?? 'images/profile-placeholder.jpg' ?>" alt="Foto de Perfil" class="profile-image rounded-circle img-fluid mb-3" width="150">
                <h1 class="display-4 fw-bold"><?= $portfolioBasico['nome_aluno'] ?? 'Nome do Aluno' ?></h1>
                <p class="lead"><?= $informacoesPessoais['profissao'] ?? 'Profissão não informada' ?> | Apaixonado por Tecnologia | Criando Soluções Digitais</p>
                <ul class="list-inline social-links">
                    <?php if (!empty($contatoRedesSociais['linkedin'])): ?>
                        <li class="list-inline-item"><a href="<?= htmlspecialchars($contatoRedesSociais['linkedin']) ?>" title="LinkedIn"><i class="bi bi-linkedin"></i></a></li>
                    <?php endif; ?>
                    <?php if (!empty($contatoRedesSociais['github'])): ?>
                        <li class="list-inline-item"><a href="<?= htmlspecialchars($contatoRedesSociais['github']) ?>" title="GitHub"><i class="bi bi-github"></i></a></li>
                    <?php endif; ?>
                    <?php if (!empty($contatoRedesSociais['whatsapp'])): ?>
                        <li class="list-inline-item"><a href="https://wa.me/<?= htmlspecialchars($contatoRedesSociais['whatsapp']) ?>" title="WhatsApp"><i class="bi bi-whatsapp"></i></a></li>
                    <?php endif; ?>
                    <?php if (!empty($contatoRedesSociais['email'])): ?>
                        <li class="list-inline-item"><a href="mailto:<?= htmlspecialchars($contatoRedesSociais['email']) ?>" title="Email"><i class="bi bi-envelope-fill"></i></a></li>
                    <?php endif; ?>
                </ul>
                <a href="#sobre" class="btn btn-primary btn-lg mt-3">Saiba Mais Sobre Mim</a>
            </div>
        </div>
    </section>

    <div class="container content-section">
        <section id="sobre" class="section-sobre py-5">
            <h2 class="section-title fw-bold mb-4">Sobre Mim</h2>
            <div class="section-content">
                <p>
                   <?= $informacoesPessoais['bio'] ?? 'Biografia do aluno não informada.' ?>
                </p>
            </div>
        </section>

        <section id="experiencia-academica" class="section-experiencia-academica py-5">
            <h2 class="section-title fw-bold mb-4">Experiência Acadêmica</h2>
            <div class="section-content">
                <?php if (empty($experienciasAcademicas)): ?>
                    <p>Nenhuma experiência acadêmica cadastrada.</p>
                <?php else: ?>
                    <?php foreach ($experienciasAcademicas as $experiencia): ?>
                        <div class="card mb-3">
                            <div class="card-body">
                                <h5 class="card-title fw-bold"><?= htmlspecialchars($experiencia['instituicao']) ?></h5>
                                <h6 class="card-subtitle mb-2 text-muted"><?= htmlspecialchars($experiencia['curso']) ?> - <?= htmlspecialchars($experiencia['periodo']) ?></h6>
                                <p class="card-text">
                                    <?= htmlspecialchars($experiencia['descricao']) ?>
                                </p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
                </div>
        </section>

        <section id="projetos" class="section-projetos py-5">
            <h2 class="section-title fw-bold mb-4">Projetos</h2>
            <div class="section-content">
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                    <?php if (empty($projetos)): ?>
                        <p>Nenhum projeto cadastrado.</p>
                    <?php else: ?>
                        <?php foreach ($projetos as $projeto): ?>
                            <div class="col">
                                <div class="card h-100">
                                    <img src="<?= htmlspecialchars($projeto['imagem_projeto'] ?? 'images/project-placeholder.jpg') ?>" class="card-img-top" alt="<?= htmlspecialchars($projeto['titulo_projeto']) ?>">
                                    <div class="card-body">
                                        <h5 class="card-title fw-bold"><?= htmlspecialchars($projeto['titulo_projeto']) ?></h5>
                                        <p class="card-text"><?= htmlspecialchars($projeto['descricao_projeto']) ?></p>
                                        <?php if (!empty($projeto['link_projeto'])): ?>
                                            <a href="<?= htmlspecialchars($projeto['link_projeto']) ?>" class="btn btn-primary" target="_blank">Ver Projeto</a>
                                        <?php endif; ?>
                                        <?php if (!empty($projeto['link_github'])): ?>
                                            <a href="<?= htmlspecialchars($projeto['link_github']) ?>" class="btn btn-secondary" target="_blank">GitHub</a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    </div>
            </div>
        </section>

        <section id="contato" class="section-contato py-5">
            <h2 class="section-title fw-bold mb-4">Contato</h2>
            <div class="section-content">
                <p>
                    Sinta-se à vontade para entrar em contato comigo!
                </p>
                <ul class="list-unstyled contact-list">
                    <?php if (!empty($contatoRedesSociais['linkedin'])): ?>
                        <li><i class="bi bi-linkedin"></i> <a href="<?= htmlspecialchars($contatoRedesSociais['linkedin']) ?>" target="_blank">LinkedIn</a></li>
                    <?php endif; ?>
                    <?php if (!empty($contatoRedesSociais['github'])): ?>
                        <li><i class="bi bi-github"></i> <a href="<?= htmlspecialchars($contatoRedesSociais['github']) ?>" target="_blank">GitHub</a></li>
                    <?php endif; ?>
                    <?php if (!empty($contatoRedesSociais['whatsapp'])): ?>
                        <li><i class="bi bi-whatsapp"></i> <a href="https://wa.me/<?= htmlspecialchars($contatoRedesSociais['whatsapp']) ?>" target="_blank">WhatsApp</a></li>
                    <?php endif; ?>
                    <?php if (!empty($contatoRedesSociais['email'])): ?>
                        <li><i class="bi bi-envelope-fill"></i> <a href="mailto:<?= htmlspecialchars($contatoRedesSociais['email']) ?>">Email</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </section>
    </div>
</main>