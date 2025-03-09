<?php

// app/views/portfolio/index.php

?>

<main class="container">
    <section class="py-5 text-center">
        <h1 class="display-5 fw-bold">Bem-vindo ao Portfólio!</h1>
        <div class="col-lg-6 mx-auto">
            <p class="lead">
                Este é um portfólio web básico construído com PHP, MVC, Bootstrap e um toque de Glassmorphism.
            </p>
        </div>
    </section>

    <div class="row g-4 py-5 row-cols-1 row-cols-lg-3">
        <div class="col d-flex align-items-start">
            <div class="icon-square text-body-emphasis bg-body-secondary d-inline-flex align-items-center justify-content-center fs-4 flex-shrink-0 me-3">
                <svg class="bi" width="1em" height="1em"><use xlink:href="#geo-fill"/></svg>
            </div>
            <div>
                <h3 class="fw-bold mb-0 fs-4">Informações Pessoais</h3>
                <p>Aqui você poderá cadastrar e exibir suas informações pessoais.</p>
            </div>
        </div>

        <div class="col d-flex align-items-start">
            <div class="icon-square text-body-emphasis bg-body-secondary d-inline-flex align-items-center justify-content-center fs-4 flex-shrink-0 me-3">
                <svg class="bi" width="1em" height="1em"><use xlink:href="#tools"/></svg>
            </div>
            <div>
                <h3 class="fw-bold mb-0 fs-4">Experiência e Projetos</h3>
                <p>Mostre sua experiência acadêmica, profissional e seus projetos.</p>
            </div>
        </div>

        <div class="col d-flex align-items-start">
            <div class="icon-square text-body-emphasis bg-body-secondary d-inline-flex align-items-center justify-content-center fs-4 flex-shrink-0 me-3">
                <svg class="bi" width="1em" height="1em"><use xlink:href="#person-bounding-box"/></svg>
            </div>
            <div>
                <h3 class="fw-bold mb-0 fs-4">Cursos e Habilidades</h3>
                <p>Liste seus cursos, certificações e habilidades técnicas.</p>
            </div>
        </div>
    </div>
</main>