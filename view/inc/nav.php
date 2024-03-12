<header class="header">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-5 col-md-5 col-6">
        <div class="header-left d-flex align-items-center">
          <div class="menu-toggle-btn mr-20">
            <button id="menu-toggle" class="main-btn primary-btn btn-hover">
              <i class="bi bi-list-ul lead"></i>
              </button>
          </div>
        </div>
      </div>
      <div class="col-lg-7 col-md-7 col-6">
        <div class="header-right">
          <!-- profil -->
          <div class="profile-box ml-15">
            <button class="dropdown-toggle bg-transparent border-0" type="button" id="profile" data-bs-toggle="dropdown" aria-expanded="false">
              <div class="profile-info">
                <div class="info">
                  <h6><?php echo $_SESSION['primer_nombre_spm'];?></h6>
                  <div class="image">
                    
                    <img src="<?php echo SERVERURL; ?>view/img/logomaiz1.png" />
                    <span class="status"></span>
                  </div>
                </div>
              </div>
              <i class="lni lni-chevron-down"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profile">
              <li>
                <a href="<?php echo SERVERURL; ?>perfil/"><i class="lni lni-user"></i>Mi perfil</a>
              </li>
              <li>
                <a href="<?php echo SERVERURL; ?>home-agro/"><i class="lni lni-user"></i>Home</a>
              </li>
              <li>
                <a href="" class="btn-exit-system2"><i class="lni lni-exit"></i>Cerrar sesion</a>
              </li>
            </ul>
          </div>
          <!-- profile fin -->
        </div>
      </div>
    </div>
  </div>
</header>
<!-- ==========  fin ========== -->