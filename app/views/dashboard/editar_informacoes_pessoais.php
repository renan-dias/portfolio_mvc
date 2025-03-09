<?php

// app/views/dashboard/editar_informacoes_pessoais.php

// Assegura que $informacoesPessoais está definida (e é um array)
$informacoesPessoais = $informacoesPessoais ?? [];

?>

<main class="container">
    <section class="py-5">
        <h1 class="display-5 fw-bold">Editar Informações Pessoais</h1>
        <p class="lead">
            Atualize suas informações pessoais que serão exibidas no seu portfólio.
        </p>

        <?php if (!empty($msg)): ?>
            <div class="alert alert-info" role="alert">
                <?= htmlspecialchars($msg) ?>
            </div>
        <?php endif; ?>

        <div class="card">
            <div class="card-body">
                <form action="/dashboard/salvarInformacoesPessoais" method="post"> <div class="mb-3">
                        <label for="nome_completo" class="form-label">Nome Completo</label>
                        <input type="text" class="form-control" id="nome_completo" name="nome_completo" value="<?= htmlspecialchars($informacoesPessoais['nome_completo'] ?? '') ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="profissao" class="form-label">Profissão</label>
                        <input type="text" class="form-control" id="profissao" name="profissao" value="<?= htmlspecialchars($informacoesPessoais['profissao'] ?? '') ?>">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($informacoesPessoais['email'] ?? '') ?>">
                    </div>
                    <div class="mb-3">
                        <label for="telefone" class="form-label">Telefone</label>
                        <input type="tel" class="form-control" id="telefone" name="telefone" value="<?= htmlspecialchars($informacoesPessoais['telefone'] ?? '') ?>">
                    </div>
                    <div class="mb-3">
                        <label for="linkedin" class="form-label">LinkedIn</label>
                        <input type="url" class="form-control" id="linkedin" name="linkedin" value="<?= htmlspecialchars($informacoesPessoais['linkedin'] ?? '') ?>">
                    </div>
                    <div class="mb-3">
                        <label for="github" class="form-label">GitHub</label>
                        <input type="url" class="form-control" id="github" name="github" value="<?= htmlspecialchars($informacoesPessoais['github'] ?? '') ?>">
                    </div>
                    <div class="mb-3">
                        <label for="whatsapp" class="form-label">WhatsApp (apenas números, com DDD)</label>
                        <input type="text" class="form-control" id="whatsapp" name="whatsapp" value="<?= htmlspecialchars($informacoesPessoais['whatsapp'] ?? '') ?>">
                    </div>
                    <div class="mb-3">
                        <label for="bio" class="form-label">Biografia</label>
                        <textarea class="form-control" id="bio" name="bio" rows="5"><?= htmlspecialchars($informacoesPessoais['bio'] ?? '') ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="foto_perfil" class="form-label">Foto de Perfil (URL)</label>
                        <input type="url" class="form-control" id="foto_perfil" name="foto_perfil" value="<?= htmlspecialchars($informacoesPessoais['foto_perfil'] ?? '') ?>">
                         <div class="form-text">URL para a foto de perfil. Deixe em branco para manter a foto atual ou usar a padrão.</div>
                    </div>

                    <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                </form>
            </div>
        </div>
    </section>
</main>