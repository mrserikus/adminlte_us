<?php if($user->isLoggedIn()){ ?>
  <li class="nav-item">
    <a href="#" class="nav-link">
      <i class="nav-icon fas fa-tachometer-alt"></i>
      <p>
        Demo cat
        <i class="right fas fa-angle-left"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">
      <li class="nav-item">
        <a href="#" class="nav-link">
          <i class="far fa-circle nav-icon"></i>
          <p>Demo Link</p>
        </a>
      </li>
    </ul>
  </li>
  <li class="nav-header">Development</li>
  <li class="nav-item">
    <a href="https://adminlte.io/docs/3.1/" class="nav-link">
      <i class="nav-icon fas fa-file"></i>
      <p>Documentation</p>
    </a>
  </li>     
				<?php } //end of conditional for menu display ?>
