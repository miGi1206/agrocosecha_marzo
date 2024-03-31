<aside class="sidebar-nav-wrapper">
  <div class="navbar-logo">
    <img class="logo" src="<?php echo SERVERURL; ?>view/img/logomaiz1.png" />
  </div>
  <nav class="sidebar-nav">
    <ul>
      <div class="text-center">
        <b><span class="logo_name text-center" >Administrador</span></b>
      </div>
      <li class="nav-item nav-item-has-children">
        <a href="" class="dropdown-toggle" data-bs-toggle="collapse" data-bs-target="#ddmenu_1" aria-controls="ddmenu_1" aria-expanded="false" aria-label="Toggle navigation">
          <i class="bi bi-house-door lead px-2 iconos-color"></i>
          <span class="text">Home</span>
        </a>
        <ul id="ddmenu_1" class="collapse show dropdown-nav">
          
          <li>
            <a href="<?php echo SERVERURL; ?>home-agro/" class="active">Principal</a>
          </li>
        </ul>
      </li>
      <li class="nav-item nav-item-has-children">
        <a href="" class="collapsed dropdown-toggle" data-bs-toggle="collapse" data-bs-target="#ddmenu_45" aria-controls="ddmenu_45" aria-expanded="false" aria-label="Toggle navigation">
          <i class="bi bi-people px-2 iconos-color"></i>
          <span class="text">Personas</span>
        </a>
        <ul id="ddmenu_45" class="collapse dropdown-nav">
          <li>
            <a href="<?php echo SERVERURL;?>personas-list/">Lista de Personas</a>
          </li>
          <li>
            <a href="<?php echo SERVERURL;?>personas/">Crear persona</a>
          </li>
          <li>
            <a href="<?php echo SERVERURL;?>personas-search/">Buscar persona</a>
          </li>
        </ul>
      </li>
      <li class="nav-item nav-item-has-children">
        <a href="" class="collapsed dropdown-toggle" data-bs-toggle="collapse" data-bs-target="#ddmenu_46" aria-controls="ddmenu_46" aria-expanded="false" aria-label="Toggle navigation">
          <i class="bi bi-box-seam   px-2 iconos-color"></i>
          <span class="text">Productos</span>
        </a>
        <ul id="ddmenu_46" class="collapse dropdown-nav">
          <li>
            <a href="<?php echo SERVERURL;?>producto-list/">Lista de productos</a>
          </li>
          <li>
            <a href="<?php echo SERVERURL;?>producto/">Crear productos</a>
          </li>
          <li>
            <a  href="<?php echo SERVERURL;?>producto-search/">Buscar productos</a>
          </li>
        </ul>
      </li>
      <li class="nav-item nav-item-has-children">
        <a href="" class="collapsed dropdown-toggle" data-bs-toggle="collapse" data-bs-target="#ddmenu_49" aria-controls="ddmenu_49" aria-expanded="false" aria-label="Toggle navigation">
          <i class="bi bi-person-lines-fill px-2 iconos-color"></i>
          <span class="text">Servicio</span>
        </a>
        <ul id="ddmenu_49" class="collapse dropdown-nav">
          <li>
            <a href="<?php echo SERVERURL;?>servicio-list/">Lista de servicio</a>
          </li>
          <li>
            <a href="<?php echo SERVERURL;?>servicio/">Crear servicio</a>
          </li>
          <li>
            <a  href="<?php echo SERVERURL;?>servicio-search/">Buscar servicio</a>
          </li>
        </ul>
      </li>
      <li class="nav-item nav-item-has-children">
        <a href="" class="collapsed dropdown-toggle" data-bs-toggle="collapse" data-bs-target="#ddmenu_47" aria-controls="ddmenu_47" aria-expanded="false" aria-label="Toggle navigation">
          <i class="bi bi-person-circle px-2 iconos-color"></i>
          <span class="text">Usuarios</span>
        </a>
        <ul id="ddmenu_47" class="collapse dropdown-nav">
          <li>
            <a href="<?php echo SERVERURL;?>usuario-list/">Lista de Usuarios</a>
          </li>
          <li>
            <a href="<?php echo SERVERURL;?>usuario/">Crear usuario</a>
          </li>
          <li>
            <a href="<?php echo SERVERURL;?>usuario-search/">Buscar usuario</a>
          </li>
        </ul>
      </li>
      <li class="nav-item nav-item-has-children">
        <a href="" class="collapsed dropdown-toggle" data-bs-toggle="collapse" data-bs-target="#ddmenu_48" aria-controls="ddmenu_48" aria-expanded="false" aria-label="Toggle navigation">
          <i class="bi bi-truck px-2 iconos-color"></i>
          <span class="text">Proveedores</span>
        </a>
        <ul id="ddmenu_48" class="collapse dropdown-nav">
          <li>
            <a href="<?php echo SERVERURL;?>proveedor-list/">Lista de proveedores</a>
          </li>
          <li>
            <a href="<?php echo SERVERURL;?>proveedor/">Crear proveedor</a>
          </li>
          <li>
            <a href="<?php echo SERVERURL;?>proveedor-search/">Buscar proveedor</a>
          </li>
        </ul>
      </li>
      <li class="nav-item nav-item-has-children">
        <a href="" class="collapsed dropdown-toggle" data-bs-toggle="collapse" data-bs-target="#ddmenu_51" aria-controls="ddmenu_51" aria-expanded="false" aria-label="Toggle navigation">
        <i class="bi bi-currency-dollar px-2 iconos-color"></i>
          <span class="text">Ventas</span>
        </a>
        <ul id="ddmenu_51" class="collapse dropdown-nav">
          <li>
            <a href="<?php echo SERVERURL;?>detalles/">Lista de detalles</a>
          </li>
          <li>
            <a href="<?php echo SERVERURL;?>ventas/">lista de ventas</a>
          </li>
        </ul>
      </li>
      <li class="nav-item">
          <a href="<?php echo SERVERURL;?>correos/" >
            <i class="bi bi-envelope-fill px-2 iconos-color"></i>
              <span class="text">Enviar correos</span>
          </a>
      </li>
      <span class="divider">
      <hr />
      </span>
      
      <li class="nav-item">
        <a href="" class="exit-system-cerrar">
          <i class="bi bi-box-arrow-left lead px-2 iconos-color" data-bs-toggle="tooltip" data-bs-placement="right" title="Reportes"></i>
          <span class="text">Cerrar sesion</span>
        </a>
      </li>
    </ul>
  </nav>
</aside>
<div class="overlay"></div>