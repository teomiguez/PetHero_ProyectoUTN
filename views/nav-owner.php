<nav class="navbar navbar-expand-lg nav-color border-bottom border-dark">
    <div class="container-fluid d-flex align-items-center">
        <h2 class="navbar-brand fs-3 pt-2">
            <strong>
                Pet Hero
            </strong>
        </h2>

        <div class="navbar-nav position-absolute top-50 start-50 translate-middle">
            <a href="<?php echo FRONT_ROOT . "Owner/ShowHome_Owner" ?>" class="nav-link active text-decoration-none">
                <h2 class="text-center">
                    <i class="bi bi-house-door"></i>
                    <p class="h6 lead"> Home </p>
                </h2>
            </a>
        </div>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav position-absolute top-50 end-0 translate-middle-y">
                <li class="nav-item">
                    <a href="<?php echo FRONT_ROOT . "Pet/ShowList" ?>" class="nav-link text-decoration-none"> 
                        <h2>
                            <i class="bi bi-list-stars text-dark"></i>
                        </h2>    
                    </a>
                </li>

                <li class="nav-item me-2">
                    <button class="btn btnsecondary" type="button" 
                        data-bs-toggle="dropdown" aria-expanded="false"
                    >
                    <h2>
                        <i class="bi bi-person-circle"></i>
                    </h2>    
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="<?php echo FRONT_ROOT . "Owner/ShowProfile_Owner" ?>">Ver Perfil</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="<?php echo FRONT_ROOT . "Auth/Logout" ?>">Cerrar Sesion</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
