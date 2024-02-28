<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="keywords" content="" />
	<meta name="author" content="" />
	<meta name="robots" content="" />
	<meta name="description" content="Davur - Restaurant Bootstrap Admin Dashboard + FrontEnd" />
	<meta property="og:title" content="Davur - Restaurant Bootstrap Admin Dashboard + FrontEnd" />
	<meta property="og:description" content="Davur - Restaurant Bootstrap Admin Dashboard + FrontEnd" />
	<meta property="og:image" content="https://davur.dexignzone.com/xhtml/page-error-404.html" />
	<meta name="format-detection" content="telephone=no">

	<title>Kasir Baju</title>
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('/logo/logo.png')?>">

	<base href="<?php echo base_url('assets') ?>/">

	<link href="vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
	<link href="vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">

	<link href="vendor/jqvmap/css/jqvmap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="vendor/chartist/css/chartist.min.css">
	<link href="css/style.css" rel="stylesheet">
	<link href="../../cdn.lineicons.com/2.0/LineIcons.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="styles.css">

	<link href="vendor/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" integrity="sha256-4sPX7kXZKlqvNtJOXxZLMRlq7Uc6sCLQ5Ct7N2Q4y6A=" crossorigin="anonymous" />
</head>

<body>

	<div id="main-wrapper">
		<div class="nav-header">
			<a href="index.html" class="brand-logo">
				<img class="logo-abbr" src="<?= base_url('/logo/logo.png')?>" alt="" style="width: 70px; height: 50px;">
				<img class="brand-title" src="<?= base_url('/logo/text.png')?>" alt="" style="margin-top: 2px; height: 65px; width: 100%;">
			</a>

			<div class="nav-control">
				<div class="hamburger">
					<span class="line"></span><span class="line"></span><span class="line"></span>
				</div>
			</div>
		</div>

		<div class="header">
			<div class="header-content">
				<nav class="navbar navbar-expand">
					<div class="collapse navbar-collapse justify-content-between">
						<div class="header-left">
						</div>

						<ul class="navbar-nav header-right">
							
							<li class="nav-item dropdown header-profile">
								<a class="nav-link">
									<div class="header-info">
										<span >Hello, <strong class="text-capitalize"><?= session()->get('nama_petugas')?></strong></span>
									</div>
									<?php if($foto->foto != '' && file_exists(PUBLIC_PATH."/assets/images/profile/".$foto->foto)) { ?>
										<img src="<?= base_url('/assets/images/profile/'.$foto->foto)?>" width="20" alt=""/>
									<?php }else{ ?>
										<img src="<?= base_url('/assets/images/profile/default-profile-photo.jpeg')?>" width="20" alt=""/>
									<?php } ?>
								</a>
							</li>
						</ul>
					</div>
				</nav>
			</div>
		</div>
