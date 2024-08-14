<?php

use yii\helpers\Url; ?>
<nav class="navbar navbar-expand-lg my-lg-4 py-lg-0 border-bottom-lg">
    <div class="container align-items-center">

        <a class="navbar-brand pb-lg-4" href="#">
            <img src="<?= Url::to('@web/img/logo.png') ?>" width="32" height="32" class="img-fluid " alt="logo">
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarStacked_1" aria-controls="navbarStacked_1" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse ms-lg-3" id="navbarStacked_1">

            <ul class="nav nav_underline_1 nav-underline flex-column flex-lg-row gap-lg-4 border-bottom border-lg-0 mb-3 mb-lg-0 ">

                <li class="nav-item">
                    <a class="nav-link pb-lg-4" href="<?= Url::to(['dashboard/index']) ?>">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link pb-lg-4" href="#">Projects</a>
                </li>
            </ul>

            <div class="d-flex ms-lg-auto align-items-baseline align-items-lg-center justify-content-between gap-2 ">

                <div class="dropdown me-3">

                    <a data-bs-toggle="dropdown" aria-expanded="false" class="dropdown-toggle text-decoration-none">
                        <i class="icon icon-settings"></i>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="<?= Url::to(['users/index']) ?>">Users</a></li>
                    </ul>
                </div>

                <div class="dropdown">
                    <a data-bs-toggle="dropdown" aria-expanded="false" class="dropdown-toggle text-decoration-none">
                        <i class="icon icon-account"></i>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#">Profile</a></li>
                        <li><a class="dropdown-item" href="<?= Url::to(['site/logout']) ?>" data-method="post">Log Out</a></li>
                    </ul>
                </div>



            </div>
        </div>
    </div>
</nav>