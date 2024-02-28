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
				                        <h4 class="modal-title">Apakah anda yakin ingin menambah data ini?</h4>
				                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
				                    </div>
				                    <form id="imageForm" class="form-horizontal form-label-left" action="<?= base_url('Barang/tambah_pendataan_barang')?>" method="post">
				                        <div class="modal-body">
				                            <div class="row">
									            <div class="mb-3 col-md-6">
												    <label class="form-label">Nama Barang<span style="color: black;"> :</span></label>
												    <select name="id_barang" class="form-control text-capitalize" id="id_barang" required autocomplete="on" onchange="updateTotalHarga()">
												        <option disabled selected>Pilih Nama Barang</option>
												        <?php foreach ($p as $barang) {?>
												            <option class="text-capitalize" value="<?php echo $barang->id_barang ?>"><?php echo $barang->nama_barang ?></option>
												        <?php } ?>
												    </select>
												</div>
				                                <div class="mb-3 col-md-6">
												    <label class="form-label">Stok Masuk<span style="color: black;"> :</span></label>
												    <input type="text" id="stok" name="stok" class="form-control text-capitalize" placeholder="Stok Masuk" autocomplete="on">
												</div>
												<script>
												    var inputStok = document.getElementById('stok');

												    inputStok.addEventListener('input', function(event) {
												        var inputValue = event.target.value;

												        var numericValue = inputValue.replace(/\D/g, '');

												        event.target.value = numericValue;
												    });
												</script>
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
							<th style="text-align: center;">Nama Barang</th>
							<th style="text-align: center;">Stok Masuk</th>
							<th style="text-align: center;">Maker</th>
							<th style="text-align: center;">Action</th>
						</tr>
					</thead>
					<tbody>
					<?php
                    $no=1;
                    foreach ($data as $dataa){?>
						<tr>
							<td style="text-align: center;" class="text-capitalize"><?php echo $dataa->nama_barang?></td>
							<td style="text-align: center;" class="text-capitalize"><?php echo $dataa->stok?></td>
							<td style="text-align: center;" class="text-capitalize"><?php echo $dataa->username?>/<?php echo $dataa->tanggal_pb?></td>
							<td>
							<div class="text-center mb-1">
							    <a onclick="openDeleteModal('<?= base_url('/Barang/hapus_pendataan_barang/'.$dataa->id_pendataan_barang)?>')" class="mx-2">
							        <button type="button" class="btn btn-danger">
							            <i class="fa-solid fa-trash"></i>
							        </button>
							    </a>
							</div>
                            </td>
							<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
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
