<div class="deznav">
    <div class="deznav-scroll">
        <ul class="metismenu" id="menu">
  <?php  if(session()->get('id')>0) { ?>
        <li><a href="<?= base_url('/Dashboard')?>" class="ai-icon" aria-expanded="false">
                <i class="fa-solid fa-house-lock" title="Dashboard"></i>
                <span  class="nav-text">Dashboard</span>
            </a>
        </li>
  <?php }else{} ?>
  <?php  if(session()->get('level')== 1) { ?>
        <li><a href="<?= base_url('/Petugas')?>" class="ai-icon" aria-expanded="false">
            <i class="fa-solid fa-chalkboard-user" title="User"></i>
                <span  class="nav-text">Data Petugas</span>
            </a>
        </li>
  <?php }else{} ?>
  <?php  if(session()->get('level')== 1 || session()->get('level')== 2) { ?>
        <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
            <i class="fa-solid fa-truck-fast" title="Barang"></i>
            <span class="nav-text">Barang</span>
        </a>
        <ul aria-expanded="false">
            <li><a href="<?= base_url('/Barang/data_barang')?>">Data Barang</a></li>
            <li><a href="<?= base_url('/Barang/pendataan_barang')?>">Pendataan Barang</a></li>
            <li><a href="<?= base_url('/Barang/stok_barang')?>">Stok Barang</a></li>
        </ul>
        </li>
  <?php }else{} ?>
  <?php  if(session()->get('level')== 1 || session()->get('level')== 2) { ?>
        <li><a href="<?= base_url('/Kasir')?>" class="ai-icon" aria-expanded="false">
            <i class="fa-solid fa-cart-shopping" title="Kasir"></i>
                <span  class="nav-text">Kasir</span>
            </a>
        </li>
  <?php }else{} ?>
  <?php  if(session()->get('level')== 1) { ?>
        <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
            <i class="fa-solid fa-laptop-file" title="Laporan"></i>
            <span class="nav-text">Laporan</span>
        </a>
        <ul aria-expanded="false">
            <li><a href="<?= base_url('/Laporan/laporan_penjualan')?>">Laporan Penjualan</a></li>
        </ul>
        </li>
  <?php }else{} ?>
        <hr class="sidebar-divider">
  <?php  if(session()->get('id')>0) { ?>
        <li><a href="<?= base_url('/My_Account')?>" class="ai-icon" aria-expanded="false">
            <i class="fa-solid fa-user-secret" title="My Account"></i>
            <span class="nav-text">My Account</span>
        </a>
        </li>
  <?php }else{} ?>
  <?php  if(session()->get('level')== 1) { ?>
        <li><a href="<?= base_url('/LogActivity')?>" class="ai-icon" aria-expanded="false">
            <i class="fa-solid fa-user-tag" title="Log Activity"></i>
            <span class="nav-text">Log Activity</span>
        </a>
        </li>
  <?php }else{} ?>
        <li><a href="<?= base_url('/LogOut')?>" class="ai-icon" aria-expanded="false">
            <i class="fa-solid fa-right-from-bracket" title="Log Out"></i>
            <span class="nav-text">Log Out</span>
        </a>
        </li>
        </ul>
    </div>
</div>

<div class="content-body">
    <div class="container-fluid">
        <div class="form-head d-flex mb-3 align-items-start">
        <div class="me-auto d-none d-lg-block">
            <?php
            $level = session()->get('level'); 
            $nama_petugas = session()->get('nama_petugas');

            $userLevelText = "";

            if ($level == 1) {
                $userLevelText = "Adminstrator";
            } elseif ($level == 2) {
                $userLevelText = "Petugas Kasir";
            } else {
                $userLevelText = "";
            }

            $namaToShow = $nama_petugas ? $nama_petugas : "";

            echo "<p class='mb-0 text-capitalize'>Welcome <b>$namaToShow - $userLevelText</b> to Kasir Digital" . session()->get('nama_website') . "!</p>";
            ?>
        </div>
        <b><span id="currentDateTime"></span></b>
    </div>


    <script>
        function updateDateTime() {
            const dateTimeElement = document.getElementById('currentDateTime');
            const options = {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric',
                hour: 'numeric',
                minute: '2-digit',
                second: '2-digit',
                hour12: true, 
            };

            const currentDateTime = new Date().toLocaleString(undefined, options);
            dateTimeElement.textContent = currentDateTime.replace(',', ' at');
        }

        setInterval(updateDateTime, 1000);

        updateDateTime();
    </script>


