    <!-- <ul class="navbar-nav bg-primary sidebar sidebar-dark custom" id="accordionSidebar"> -->
    <ul class="navbar-nav sidebar sidebar-dark custom" id="accordionSidebar" style="background-color:#fff">


      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <!-- <div class="sidebar-brand-icon rotate-n-15"> -->
        <div class="sidebar-brand-icon">
          <!-- <i class="fas fa-laugh-wink"></i> -->
          <img src="<?= base_url('upload/product/IST Pak Canon.jpg'); ?>" alt="" width="50px" height="50px" style="border-radius:30px;margin:20px 0 0 2px;" class="img-circle">
          <i class="fas fa-data"></i>
        </div>
        <!-- <div class="sidebar-brand-text mx-2">ERP PAK CANON</div> -->
        <div class="sidebar-brand-text">INOVASI SINAR TERANG</div>
        <!-- <sup>CANON</sup> -->
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="<?= base_url('dashboard2'); ?>">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>
      <!-- Nav Item - Dashboard -->
      <li class="nav-item active ml-3">
        <div class="custom-control custom-switch">
          <input type="checkbox" class="custom-control-input" id="darkSwitch">
          <label class="custom-control-label" for="darkSwitch">Dark Mode</label>
        </div>
      </li>
      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Interface
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-cog"></i>
          <span>Master</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Custom Master:</h6>

            <?php
            if ($this->session->userdata('id_role') == 2) {
              $cek_akses = $this->db->get_where('tbl_akses', ['id_role' => 2])->result_array();
              // ===================fungsi list akses menu user=================================
              function list_akses_user($id_menu, $value, $id_akses, $value_akses, $url, $nama)
              {
                if ($id_menu == $value && $id_akses == $value_akses) {
                  echo '<a class="collapse-item" href="' . base_url($url) . '">' . $nama . '</a>';
                }
              }
              foreach ($cek_akses as $cek) {
                list_akses_user($cek['id_sub_menu'], 1, $cek['akses'], 1, 'barang2', 'Barang');
                list_akses_user($cek['id_sub_menu'], 8, $cek['akses'], 1, 'pengiriman2', 'Pengiriman');
                list_akses_user($cek['id_sub_menu'], 3, $cek['akses'], 1, 'daftar2', 'Mitra');
                list_akses_user($cek['id_sub_menu'], 28, $cek['akses'], 1, 'team2', 'Team');
                list_akses_user($cek['id_sub_menu'], 4, $cek['akses'], 1, 'profil2', 'Profil Perusahaan');
              }
            } else {
              echo '<>Kamu Tidak Ada Akses</>';
            } ?>
          </div>
        </div>
      </li>

      <!-- <div class="jumbotron">
        <h1 class="display-3">Hello World</h1>
        <p class="lead-3">Lore</p>
      </div> -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseTwo">
          <!-- <i class="fas fa-fw fa-cog"></i> -->
          <i class="fas fa-fw fa-money-bill-alt"></i>
          <span>Weekly</span>
        </a>
        <div id="collapseThree" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Custom Weekly:</h6>

            <?php
            if ($this->session->userdata('id_role') == 2) {
              $cek_akses = $this->db->get_where('tbl_akses', ['id_role' => 2])->result_array();
              foreach ($cek_akses as $cek) {
                list_akses_user($cek['id_sub_menu'], 18, $cek['akses'], 1, 'manager2', 'Manager');
                list_akses_user($cek['id_sub_menu'], 19, $cek['akses'], 1, 'win2_manager2', 'Win2 Manager');
                list_akses_user($cek['id_sub_menu'], 20, $cek['akses'], 1, 'asst_manager2', 'Asst Manager');

                list_akses_user($cek['id_sub_menu'], 24, $cek['akses'], 1, 'top_lead2', 'Top Leader');
                list_akses_user($cek['id_sub_menu'], 25, $cek['akses'], 1, 'top_asmen2', 'Top Asmen');
                list_akses_user($cek['id_sub_menu'], 26, $cek['akses'], 1, 'hot_news2', 'Hot News');
                list_akses_user($cek['id_sub_menu'], 26, $cek['akses'], 1, 'product_chart2', 'Production Chart');
              }
            } else {
              echo '<>Kamu Tidak Ada Akses</>';
            }
            ?>

          </div>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-book"></i>
          <span>Akutansi</span>
        </a>
        <div id="collapseFour" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <!-- ======menampilkan list menu dengan kondisi hak akses============ -->

            <?php
            if ($this->session->userdata('id_role') == 2) {
              $cek_akses = $this->db->get_where('tbl_akses', ['id_role' => 2])->result_array();
              foreach ($cek_akses as $cek) {
                list_akses_user($cek['id_sub_menu'], 15, $cek['akses'], 1, 'jurnalumum2', 'Jurnal Umum');
                list_akses_user($cek['id_sub_menu'], 16, $cek['akses'], 1, 'neraca2', 'Neraca');
                list_akses_user($cek['id_sub_menu'], 17, $cek['akses'], 1, 'bukubesar2', 'Buku Besar');
              }
            } else {
              echo '<>Kamu Tidak Ada Akses</>';
            }
            ?>

          </div>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFive" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-arrow-alt-circle-down"></i>
          <span>Bulletin</span>
        </a>
        <div id="collapseFive" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Sub Menu Bulletin:</h6>

            <!-- ======menampilkan list sub menu dengan kondisi hak akses============ -->

            <?php
            if ($this->session->userdata('id_role') == 2) {
              $cek_akses = $this->db->get_where('tbl_akses', ['id_role' => 2])->result_array();
              foreach ($cek_akses as $cek) {
                list_akses_user($cek['id_sub_menu'], 29, $cek['akses'], 1, 'juice2_4u', 'Juice 4U');
                list_akses_user($cek['id_sub_menu'], 30, $cek['akses'], 1, 'juice_distri2', 'Juice Distributor');
                list_akses_user($cek['id_sub_menu'], 24, $cek['akses'], 1, 'top_lead2', 'Top Leader');
                list_akses_user($cek['id_sub_menu'], 25, $cek['akses'], 1, 'top_asmen2', 'Top Asmen');
                list_akses_user($cek['id_sub_menu'], 26, $cek['akses'], 1, 'hot_news2', 'Hot News');
                list_akses_user($cek['id_sub_menu'], 27, $cek['akses'], 1, 'product_chart2', 'Production Chart');
              }
            } else {
              echo '<>Kamu Tidak Ada Akses</>';
            }
            ?>
            <!-- ==================end======================= -->
          </div>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSix" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-list"></i>
          <span>Laporan</span>
        </a>
        <div id="collapseSix" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Sub Menu Laporan:</h6>

            <!-- ======menampilkan list sub menu dengan kondisi hak akses============ -->

            <?php
            if ($this->session->userdata('id_role') == 2) {
              $cek_akses = $this->db->get_where('tbl_akses', ['id_role' => 2])->result_array();
              foreach ($cek_akses as $cek) {
                list_akses_user($cek['id_sub_menu'], 31, $cek['akses'], 1, 'penjualan2', 'Penjualan');
                list_akses_user($cek['id_sub_menu'], 18, $cek['akses'], 1, 'manager2', 'Manager P & L');
                list_akses_user($cek['id_sub_menu'], 19, $cek['akses'], 1, 'asst_manager2', 'Asst Win2 Manager');
                list_akses_user($cek['id_sub_menu'], 20, $cek['akses'], 1, 'win2_manager2', 'Win2 Manager');
                list_akses_user($cek['id_sub_menu'], 21, $cek['akses'], 1, 'deposit2', 'Total Deposit');
                list_akses_user($cek['id_sub_menu'], 32, $cek['akses'], 1, 'stok2', 'Stok');
                list_akses_user($cek['id_sub_menu'], 33, $cek['akses'], 1, 'kartu_stok2', 'Kartu Stok');
                list_akses_user($cek['id_sub_menu'], 34, $cek['akses'], 1, 'adjust_stok2', 'Adjuct Stok');
                list_akses_user($cek['id_sub_menu'], 35, $cek['akses'], 1, 'detail_stok2', 'Detail Stok');
              }
            } else {
              echo '<>Kamu Tidak Ada Akses</>';
            }
            ?>
            <!-- ==================end======================= -->

          </div>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-user"></i>
          <span>User Account</span>
        </a>
        <div id="collapseSeven" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Sub Menu User Account:</h6>
            <a class="collapse-item" href="<?= base_url('users2/changepassword'); ?>">Ganti Password</a>
          </div>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseEight" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-paperclip"></i>
          <span>Utility</span>
        </a>
        <div id="collapseEight" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header"></h6>

            <a class="collapse-item" href="<?= base_url('about2'); ?>">About</a>
          </div>
        </div>
      </li>


      <!-- Nav Item -Logout -->


      <li class="nav-item">
        <a class="nav-link" href="<?= base_url('auth/logout') ?>">
          <i class="fas fa-sign-out-alt fa-sm fa-fw"></i>
          <span>Log Out</span></a>
      </li>
      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>