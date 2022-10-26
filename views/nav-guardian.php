<nav class="navbar navbar-expand-lg nav-color border-bottom border-dark">
    <div class="container-fluid">

        <h2 class="navbar-brand fs-3 pt-2">
            <strong>
                Pet Hero
            </strong>
        </h2>

        <div class="navbar-nav position-absolute top-50 start-50 translate-middle">
            <a href="<?php echo FRONT_ROOT . "Guardian/HomeGuardian" ?>" class="nav-link active text-decoration-none"> *Home* </a>
        </div>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav position-absolute top-50 end-0 translate-middle-y">
                <li class="nav-item">
                    <a href="<?php echo FRONT_ROOT . "Guardian/ShowProfile" ?>" class="nav-link text-decoration-none"> *Mi Perfil*</a>
                </li>

                <li class="nav-item me-3">
                    <a href="<?php echo FRONT_ROOT . "Auth/Logout" ?>" class="nav-link text-decoration-none"> *Salir*</a>
                </li>
            </ul>
        </div>
    </div>
</nav>