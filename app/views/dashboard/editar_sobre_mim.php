<?php

// app/views/dashboard/editar_sobre_mim.php

// Garante que $sobreMim e $msg estão definidas, mesmo que vazias
$sobreMim = $sobreMim ?? [];
$msg = $msg ?? '';

?>

<main class="container">
    <section class="py-5">
        <h1 class="display-5 fw-bold">Editar Seção "Sobre Mim"</h1>
        <p class="lead">
            Edite o texto da seção "Sobre Mim" que será exibida no seu portfólio.
        </p>

        <?php if (!empty($msg)): ?>
            <div class="alert alert-info" role="alert">
                <?= htmlspecialchars($msg) ?>
            </div>
        <?php endif; ?>

        <div class="card">
            <div class="card-body">
                <form action="/dashboard/atualizarSobreMim" method="post">
                    <div class="mb-3">
                        <label for="texto_sobre" class="form-label">Texto "Sobre Mim" <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="texto_sobre" name="texto_sobre" rows="8" required><?= htmlspecialchars($sobreMim['texto_sobre'] ?? '') ?></textarea>
                        <div class="form-text">
                            Escreva um texto conciso e interessante sobre você, suas paixões, objetivos e o que mais quiser compartilhar com os visitantes do seu portfólio.
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                </form>
            </div>
        </div>
    </section>
</main>