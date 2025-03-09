<?php

// app/views/dashboard/editar_habilidade.php

// Garante que $habilidade e $msg estão definidas, mesmo que vazias
$habilidade = $habilidade ?? [];
$msg = $msg ?? '';

?>

<main class="container">
    <section class="py-5">
        <h1 class="display-5 fw-bold">Editar Habilidade</h1>
        <p class="lead">
            Preencha o formulário abaixo para editar a habilidade.
        </p>

        <?php if (!empty($msg)): ?>
            <div class="alert alert-info" role="alert">
                <?= htmlspecialchars($msg) ?>
            </div>
        <?php endif; ?>

        <div class="card">
            <div class="card-body">
                <form action="/dashboard/atualizarHabilidade" method="post">
                    <input type="hidden" name="id_habilidade" value="<?= htmlspecialchars($habilidade['id'] ?? '') ?>">
                    <div class="mb-3">
                        <label for="nome_habilidade" class="form-label">Nome da Habilidade <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="nome_habilidade" name="nome_habilidade" value="<?= htmlspecialchars($habilidade['nome_habilidade'] ?? '') ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="nivel_habilidade" class="form-label">Nível da Habilidade <span class="text-danger">*</span></label>
                        <select class="form-select" id="nivel_habilidade" name="nivel_habilidade" required>
                            <option value="" <?= empty($habilidade['nivel_habilidade']) ? 'selected' : '' ?>>Selecione o nível</option>
                            <option value="Básico" <?= ($habilidade['nivel_habilidade'] ?? '') === 'Básico' ? 'selected' : '' ?>>Básico</option>
                            <option value="Intermediário" <?= ($habilidade['nivel_habilidade'] ?? '') === 'Intermediário' ? 'selected' : '' ?>>Intermediário</option>
                            <option value="Avançado" <?= ($habilidade['nivel_habilidade'] ?? '') === 'Avançado' ? 'selected' : '' ?>>Avançado</option>
                             <option value="Expert" <?= ($habilidade['nivel_habilidade'] ?? '') === 'Expert' ? 'selected' : '' ?>>Expert</option>
                        </select>
                        <div class="form-text">Ex: Básico, Intermediário, Avançado, Expert.</div>
                    </div>

                    <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                    <a href="/dashboard/listarHabilidades" class="btn btn-secondary ms-2">Cancelar</a>
                </form>
            </div>
        </div>
    </section>
</main>