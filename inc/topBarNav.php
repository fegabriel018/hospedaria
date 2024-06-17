<style>
  /* Navbar */
  #top-Nav {
    background-color: #343a40;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  }

  #top-Nav .navbar-brand {
    color: #fff;
    font-size: 1.5rem;
    font-weight: bold;
  }

  #top-Nav .navbar-brand img {
    height: 40px;
    width: auto;
    margin-right: 10px;
  }

  #top-Nav .navbar-nav .nav-item .nav-link {
    color: #fff;
    font-weight: 500;
  }

  #top-Nav .navbar-nav .nav-item .nav-link.active {
    color: #007bff;
    font-weight: 700;
  }

  #top-Nav .navbar-toggler {
    border: none;
    outline: none;
    background-color: transparent;
  }

  #top-Nav .navbar-toggler-icon {
    background-color: #fff;
  }

  #top-Nav .dropdown-menu {
    background-color: #343a40;
    border: none;
  }

  #top-Nav .dropdown-item {
    color: #fff;
  }

  #top-Nav .dropdown-item:hover {
    background-color: #007bff;
    color: #fff;
  }

  #top-Nav .user-img {
    height: 30px;
    width: 30px;
    object-fit: cover;
    border-radius: 50%;
    margin-right: 10px;
  }

  #top-Nav .navbar-nav .nav-item .nav-link {
    transition: color 0.3s ease;
  }

  #top-Nav .navbar-nav .nav-item .nav-link:hover {
    color: #007bff;
  }
</style>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light" id='top-Nav'>
  <div class="container">
    <a href="./" class="navbar-brand">
      <img src="<?php echo validate_image($_settings->info('logo'))?>" alt="Site Logo">
      <span><?= $_settings->info('short_name') ?></span>
    </a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarCollapse">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a href="./" class="nav-link <?= isset($page) && $page =='home' ? "active" : "" ?>">Início</a>
        </li>
        <li class="nav-item">
          <a href="./?page=rooms" class="nav-link <?= isset($page) && $page =='rooms' ? "active" : "" ?>">Quartos</a>
        </li>
        <li class="nav-item">
          <a href="./?page=activities" class="nav-link <?= isset($page) && $page =='activities' ? "active" : "" ?>">Recreação</a>
        </li>
        <li class="nav-item">
          <a href="./?page=about" class="nav-link <?= isset($page) && $page =='about' ? "active" : "" ?>">Sobre Nós</a>
        </li>
        <li class="nav-item">
          <a href="./?page=contact_us" class="nav-link <?= isset($page) && $page =='contact_us' ? "active" : "" ?>">Contacte-nos</a>
        </li>
        <?php if($_settings->userdata('id') > 0): ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <img src="<?= validate_image($_settings->userdata('avatar')) ?>" alt="User Avatar" class="user-img">
              Olá, <?= !empty($_settings->userdata('username')) ? $_settings->userdata('username') : $_settings->userdata('email') ?>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
              <?php if($_settings->userdata('login_type') == 1): ?>
                <a class="dropdown-item" href="<?= base_url.'classes/Login.php?f=logout' ?>">Sair</a>
              <?php else: ?>
                <a class="dropdown-item" href="<?= base_url.'classes/Login.php?f=client_logout' ?>">Sair</a>
              <?php endif; ?>
            </div>
          </li>
        <?php else: ?>
          <li class="nav-item">
            <a href="./admin" class="nav-link"> <img src="dist/img/login.png" alt=""> Entrar</a>
          </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>
<!-- /.navbar -->
