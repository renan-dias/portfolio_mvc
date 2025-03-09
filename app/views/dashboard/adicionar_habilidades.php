<?php

// app/views/dashboard/adicionar_habilidade.php

// Garante que $msg está definida, mesmo que vazia
$msg = $msg ?? '';

?>

<main class="container">
    <section class="py-5">
        <h1 class="display-5 fw-bold">Adicionar Nova Habilidade</h1>
        <p class="lead">
            Preencha o formulário abaixo para adicionar uma nova habilidade ao seu portfólio.
        </p>

        <?php if (!empty($msg)): ?>
            <div class="alert alert-info" role="alert">
                <?= htmlspecialchars($msg) ?>
            </div>
        <?php endif; ?>

        <div class="card">
            <div class="card-body">
                <form action="/dashboard/salvarHabilidade" method="post">
                    <div class="mb-3">
                        <label for="nome_habilidade" class="form-label">Nome da Habilidade <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="nome_habilidade" name="nome_habilidade" required>
                    </div>
                    <div class="mb-3">
                        <label for="nivel_habilidade" class="form-label">Nível da Habilidade <span class="text-danger">*</span></label>
                        <select class="form-select" id="nivel_habilidade" name="nivel_habilidade" required>
                            <option value="" selected>Selecione o nível</option>
                            <option value="Básico">Básico</option>
                            <option value="Intermediário">Intermediário</option>
                            <option value="Avançado">Avançado</option>
                            <option value="Expert">Expert</option>
                        </select>
                        <div class="form-text">Ex: Básico, Intermediário, Avançado, Expert.</div>
                    </div>

                    <button type="submit" class="btn btn-primary">Salvar Habilidade</button>
                    <a href="/dashboard/listarHabilidades" class="btn btn-secondary ms-2">Cancelar</a>
                </form>
            </div>
        </div>
    </section>
</main>