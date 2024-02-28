<div class="col-12">
	<div class="card">
		<div class="card-body">
			<div class="table-responsive">
				<div class="container mt-4">
				    <div class="d-flex justify-content-between align-items-center mb-3">
				        <h1></h1>
				        <button type="button" class="btn btn-success mb-2" data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg">
				            <i class="fa-solid fa-plus"></i> Tambah
				        </button>

				        <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
				            <div class="modal-dialog modal-xl">
				                <div class="modal-content">
				                    <div class="modal-header">
				                        <h4 class="modal-title">Apakah anda yakin ingin menambah data petugas?</h4>
				                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
				                    </div>
				                    <form id="imageForm" class="form-horizontal form-label-left" action="<?= base_url('Petugas/tambah')?>" method="post">
				                        <div class="modal-body">
				                            <div class="row">
				                                <div class="mb-3 col-md-6">
				                                    <label class="form-label">Nama Pegawai<span style="color: black;"> :</span></label>
				                                    <input type="text" id="nama_petugas" name="nama_petugas" class="form-control text-capitalize" placeholder="Nama Pegawai" autocomplete="on">
				                                </div>
				                                <div class="mb-3 col-md-6">
				                                    <label class="form-label">Alamat<span style="color: black;"> :</span></label>
				                                    <input type="text" id="alamat" name="alamat" class="form-control text-capitalize" placeholder="Alamat" autocomplete="on">
				                                </div>
				                                <div class="mb-3 col-md-6">
				                                    <label class="form-label">No Telepon<span style="color: black;"> :</span></label>
				                                    <input type="text" id="no_telp" name="no_telp" class="form-control text-capitalize" placeholder="No Telepon" oninput="validateNumberInput(this)" autocomplete="on">
				                                </div>
				                                <script>
						                        function validateNumberInput(input) {
						                            input.value = input.value.replace(/\D/g, '');

						                            if (input.value.length > 13) {
						                                input.value = input.value.slice(0, 13);
						                            }
						                        }
							                    </script>
				                                <div class="mb-3 col-md-6">
				                                    <label class="form-label">Username<span style="color: black;"> :</span></label>
				                                    <input type="text" id="username" name="username" class="form-control text-capitalize" placeholder="Username" autocomplete="on">
				                                </div>
				                                <div class="mb-3 col-md-12">
				                                    <label class="form-label">Level<span style="color: black;"> :</span></label>
				                                    <select id="level" class="form-control col-12" data-validate-length-range="6" data-validate-words="2" name="level" required="required">
					                                  <option>Pilih Level</option>
					                                  <option value="1">Adminstrator</option>
					                                  <option value="2">Petugas Kasir</option>
					                              	</select>
				                                </div>
			                        	</div>
				                        <div class="modal-footer">
				                            <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Kembali</button>
				                            <button type="submit" class="btn btn-success">Iya, Tambah</button>
				                        </div>
				                    </form>
				                </div>
				            </div>
				        </div>
				    </div>
				</div>

				<table id="example" class="table items-table table table-bordered table-striped verticle-middle table-responsive-sm" style="min-width: 100%">
					<thead>
						<tr>
							<th style="text-align: center;">Nama Petugas</th>
							<th style="text-align: center;">Alamat</th>
							<th style="text-align: center;">No Telepon</th>
							<th style="text-align: center;">Action</th>
						</tr>
					</thead>
					<tbody>
					<?php
                    $no=1;
                    foreach ($data as $dataa){?>
						<tr>
							<td style="text-align: center;" class="text-capitalize"><?php echo $dataa->nama_petugas?></td>
							<td style="text-align: center;" class="text-capitalize"><?php echo $dataa->alamat ?></td>
							<td style="text-align: center;" class="text-capitalize"><?php echo $dataa->no_telp ?></td>
							<td>
							<div class="text-center mb-1">
							    <a onclick="openResetModal('<?= base_url('/Petugas/reset_password/'.$dataa->id_user_petugas)?>')" class="mx-2">
							        <button type="button" class="btn btn-info">
							            <i class="fa-solid fa-key"></i>
							        </button>
							    </a>
							    <a href="<?= base_url('/Petugas/edit/'.$dataa->id_user_petugas)?>" class="mx-2">
							        <button class="btn btn-warning">
							            <i class="fa-regular fa-pen-to-square"></i>
							        </button>
							    </a>
							    <a onclick="openDeleteModal('<?= base_url('/Petugas/hapus/'.$dataa->id_user_petugas)?>')" class="mx-2">
							        <button type="button" class="btn btn-danger">
							            <i class="fa-solid fa-trash"></i>
							        </button>
							    </a>
							</div>
                            </td>
							<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
                            <div class="modal fade" id="reset_password" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
							    <div class="modal-dialog modal-dialog-centered" role="document">
							        <div class="modal-content">
							            <div class="modal-header">
							                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
							            </div>
							            <div class="modal-body text-center">
							                <i class="fa-solid fa-triangle-exclamation" style="font-size: 80px; color: #FFA500;"></i>
							                <h1></h1><br>
							                <h5>Apakah anda yakin ingin mereset password pada data ini?</h5>
							            </div>
							            <div class="modal-footer">
							                <button type="button" class="btn btn-secondary light" data-bs-dismiss="modal">Kembali</button>
							                <a id="ResetLinkPetugas" href="#">
							                    <button type="button" class="btn btn-info">Iya, Reset Password</button>
							                </a>
							            </div>
							        </div>
							    </div>
							</div>
							<script>
							    function openResetModal(resetLink) {
							        document.getElementById('ResetLinkPetugas').href = resetLink;
							        $('#reset_password').modal('show');
							    }
							</script>

                            <div class="modal fade" id="delete_petugas" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
							    <div class="modal-dialog modal-dialog-centered" role="document">
							        <div class="modal-content">
							            <div class="modal-header">
							                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
							            </div>
							            <div class="modal-body text-center">
							                <i class="fa-solid fa-triangle-exclamation" style="font-size: 80px; color: #FFA500;"></i>
							                <h1></h1><br>
							                <h5>Apakah anda yakin ingin menghapus data ini?</h5>
							            </div>
							            <div class="modal-footer">
							                <button type="button" class="btn btn-secondary light" data-bs-dismiss="modal">Kembali</button>
							                <a id="deleteLinkPetugas" href="#">
							                    <button type="button" class="btn btn-danger">Iya, Hapus</button>
							                </a>
							            </div>
							        </div>
							    </div>
							</div>
							<script>
							    function openDeleteModal(deleteLink) {
							        document.getElementById('deleteLinkPetugas').href = deleteLink;
							        $('#delete_petugas').modal('show');
							    }
							</script>
						</tr>
                    <?php }?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
