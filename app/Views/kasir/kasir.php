<div class="row d-flex">
<div class="col-md-5 col-sm-5 col-xs-5">
    <div class="card">
        <div class="card-body">
            <div class="basic-form">
                <form id="userForm" class="form-horizontal form-label-left" novalidate action="<?= base_url('Kasir/tambah_kasir') ?>" method="post">
                	
                    <h3 class="text-center"><b>Kasir Baju</b></h3><br>
                    <div style="display: flex; justify-content: space-between;">
                        <span class="text-capitalize">Nama Kasir : <?= session()->get('nama_petugas') ?></span>
                    </div>

                    <hr>
                    <div class="mb-3 col-md-12">
                        <label class="form-label">Nama Barang<span style="color: black;"> :</span></label>
                        <select name="id_barang" class="form-control text-capitalize" id="id_barang" required autocomplete="on">
                            <option disabled selected>Pilih Nama Barang</option>
                            <?php foreach ($p as $brg) { ?>
                                <?php
                                    $stokColor = ($brg->jumlah <= 0) ? 'color: red;' : '';             ?>
                                <option class="text-capitalize" value="<?php echo $brg->id_barang ?>" style="<?php echo $stokColor; ?>">
                                    <?php echo $brg->nama_barang ?>, Tersedia  <?php echo $brg->jumlah ?>  - (Rp <?php echo number_format($brg->harga_barang, 2, ',', '.') ?>/BRG)
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="mb-3 col-md-12">
                        <label class="form-label">QTY<span style="color: black;"> :</span></label>
                        <input type="text" id="qty" name="qty" class="form-control text-capitalize" placeholder="QTY" oninput="validateNumberInput(this)" autocomplete="on">
                    </div>
                    <script>
                        function validateNumberInput(input) {
                            input.value = input.value.replace(/\D/g, '');
                        }
                    </script>
                    <div class="mb-3 col-md-12">
                        <label class="form-label">Dibayar<span style="color: black;"> :</span></label>
                        <input type="text" id="dibayar" name="dibayar" class="form-control text-capitalize" placeholder="Dibayar" oninput="validateDibayarInput(this)" autocomplete="on">
                    </div>
                    <script>
                        function validateDibayarInput(input) {
                            input.value = input.value.replace(/\D/g, '');
                        }
                    </script>
                    <div class="mb-3 col-md-12">
                        <label class="form-label">Kembalian<span style="color: black;"> :</span></label>
                        <input type="text" id="kembalian" name="kembalian" class="form-control text-capitalize" placeholder="Total Kembalian Rp 0,00" autocomplete="on" readonly style="background-color: #dddddd;">
                    </div>
                    
                    <button type="submit" id="updateButton" class="btn btn-success" disabled>Total Pembayaran Rp 0,00</button>
                    <style>
                        #updateButton {
                            width: 100%;
                            text-align: center;
                            margin: 0 auto;
                        }
                    </style>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function () {
    function updateTotalPayment() {
        var selectedItemId = document.getElementById('id_barang').value;
        var selectedQty = document.getElementById('qty').value;
        var selectedPrice = getPriceById(selectedItemId);
        var totalPayment = selectedQty * selectedPrice;
        var cashInput = parseFloat(document.getElementById('dibayar').value);
        var kembalian = cashInput - totalPayment;

        document.getElementById('updateButton').innerHTML = 'Total Pembayaran Rp ' + totalPayment.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
        
        var kembalianField = document.getElementById('kembalian');
        kembalianField.value = kembalian.toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, '');
        
        if (kembalian < 0) {
            kembalianField.classList.add('text-danger');
        } else {
            kembalianField.classList.remove('text-danger');
        }

        // Check if cash input is sufficient for payment, then enable/disable updateButton accordingly
        var updateButton = document.getElementById('updateButton');
        if (cashInput >= totalPayment) {
            updateButton.removeAttribute('disabled');
        } else {
            updateButton.setAttribute('disabled', 'disabled');
        }
    }

    function getPriceById(itemId) {
        var items = <?php echo json_encode($p); ?>;
        var selectedPrice = 0;

        items.forEach(function (item) {
            if (item.id_barang == itemId) {
                selectedPrice = item.harga_barang;
            }
        });

        return selectedPrice;
    }

    document.getElementById('id_barang').addEventListener('change', updateTotalPayment);
    document.getElementById('qty').addEventListener('input', updateTotalPayment);
    document.getElementById('dibayar').addEventListener('input', updateTotalPayment);

    updateTotalPayment();
});
</script>

<div class="col-md-7 col-sm-7 col-xs-7 text-start">
    <div class="card">
        <div class="card-body">
            
        </div>
    </div>
</div>
</div>

<div class="col-12">
	<div class="card">
		<div class="card-body">
			<div class="table-responsive">
                <div class="text-end">
                    <a href="<?= base_url('/Laporan/print_nota')?>"><button type="button" class="btn btn-info mb-2 float-end">
                        <i class="fa-solid fa-print"></i> Print Nota
                    </button></a>
                </div>

				<table id="example" class="table items-table table table-bordered table-striped verticle-middle table-responsive-sm" style="min-width: 100%">
					<thead>
						<tr>
							<th style="text-align: center;">Nama Barang</th>
							<th style="text-align: center;">QTY</th>
                            <th style="text-align: center;">Total Harga</th>
							<th style="text-align: center;">Action</th>
						</tr>
					</thead>
					<tbody>
					<?php
                    $no=1;
                    foreach ($data as $dataa){?>
						<tr>
							<td style="text-align: center;" class="text-capitalize"><?php echo $dataa->nama_barang?></td>
							<td style="text-align: center;" class="text-capitalize"><?php echo $dataa->qty ?></td>
							<td style="text-align: center;" class="text-capitalize">Rp <?php echo number_format($dataa->total_harga, 2, ',', '.') ?></td>
                            <td>
                            <div class="text-center mb-1">
                                <a onclick="openDeleteModal('<?= base_url('/Kasir/hapus/'.$dataa->id_penjualan_barang)?>')" class="mx-2">
                                    <button type="button" class="btn btn-danger">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </a>
                            </div>
                            </td>
						</tr>
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
                    <?php }?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
