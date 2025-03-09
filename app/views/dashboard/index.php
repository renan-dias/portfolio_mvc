<?php

// app/views/dashboard/index.php

?>

<main class="container">
    <section class="py-5 text-center">
        <h1 class="display-5 fw-bold">Painel de Controle do Portfólio</h1>
        <div class="col-lg-6 mx-auto">
            <p class="lead">
                Bem-vindo ao seu painel de controle. Aqui você poderá gerenciar todo o conteúdo do seu portfólio.
            </p>
        </div>
    </section>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Ações Rápidas</h5>
                    <div class="d-grid gap-2 d-md-block">
                        <a href="/dashboard/editarInformacoesPessoais" class="btn btn-primary" type="button">Editar Informações Pessoais</a>
                        <button class="btn btn-secondary" type="button">Gerenciar Projetos</button>
                        <button class="btn btn-success" type="button">Adicionar Experiência Acadêmica</button>
                        <button class="btn btn-outline-primary" type="button">Configurações do Portfólio</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>