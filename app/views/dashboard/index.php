<?php

// app/views/dashboard/index.php

?>

<main class="container">
    <section class="py-5 text-center container">
        <div class="row py-lg-5">
            <div class="col-lg-6 col-md-8 mx-auto">
                <h1 class="fw-light">Dashboard do Portfólio</h1>
                <p class="lead text-muted">
                    Bem-vindo ao painel de controle do seu portfólio online.
                    Aqui você pode gerenciar todas as seções do seu portfólio de forma fácil e intuitiva.
                </p>
            </div>
        </div>
    </section>

    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">

                <div class="col">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Informações Pessoais</h5>
                            <p class="card-text">
                                Gerencie suas informações pessoais, como nome, profissão, foto de perfil e links de contato.
                            </p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <a href="/dashboard/editarInformacoesPessoais" class="btn btn-sm btn-outline-secondary">
                                        <i class="bi bi-pencil-square"></i> Editar
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Experiência Acadêmica</h5>
                            <p class="card-text">
                                Adicione, edite e remova suas experiências acadêmicas, como formação e cursos.
                            </p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <a href="/dashboard/listarExperienciasAcademicas" class="btn btn-sm btn-outline-secondary">
                                        <i class="bi bi-list-task"></i> Gerenciar
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Projetos</h5>
                            <p class="card-text">
                                Liste seus projetos, adicione novos, edite os existentes e remova os que não deseja exibir.
                            </p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <a href="/dashboard/listarProjetos" class="btn btn-sm btn-outline-secondary">
                                        <i class="bi bi-list-task"></i> Gerenciar
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Habilidades</h5>
                            <p class="card-text">
                                Adicione e gerencie suas habilidades e competências.
                            </p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <a href="/dashboard/listarHabilidades" class="btn btn-sm btn-outline-secondary">
                                        <i class="bi bi-list-task"></i> Gerenciar
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Cursos</h5>
                            <p class="card-text">
                                Liste e gerencie seus cursos e certificações.
                            </p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <a href="/dashboard/listarCursos" class="btn btn-sm btn-outline-secondary">
                                        <i class="bi bi-list-task"></i> Gerenciar
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Sobre Mim</h5>
                            <p class="card-text">
                                Edite o texto da seção "Sobre Mim" do seu portfólio.
                            </p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <a href="/dashboard/editarSobreMim" class="btn btn-sm btn-outline-secondary">
                                        <i class="bi bi-pencil-square"></i> Editar
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</main>