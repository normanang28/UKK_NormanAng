<div class="row">
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
                                    $stokColor = ($brg->jumlah <= 0) ? 'color: red;' : '';             
                                ?>
                                <option class="text-capitalize" value="<?php echo $brg->id_barang ?>" style="<?php echo $stokColor; ?>">
                                    <?php echo $brg->nama_barang ?>, Tersedia  <?php echo $brg->jumlah ?>  - (Rp <?php echo number_format($brg->harga_barang, 2, ',', '.') ?>/BRG)
                                </option>
                            <?php } ?>
                        </select>
                    </div>

                    <span id="stok_message" style="color: red;"></span>

                    <script>
                        document.getElementById("id_barang").addEventListener("change", function() {
                            var selectedOption = this.options[this.selectedIndex];
                            var stokColor = selectedOption.style.color;

                            if (stokColor === "red") {
                                document.getElementById("stok_message").innerText = "Stok barang tidak tersedia!";
                            } else {
                                document.getElementById("stok_message").innerText = "";
                            }
                        });
                    </script>
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

<div class="col-md-7 col-sm-7 col-xs-7">
    <div class="row" id="tableBody">
        <?php foreach ($p as $dataa): ?>       
            <div class="col-7 col-sm-7 col-md-7 col-lg-3 mb-5 mb-lg-0" data-aos="fade-left" data-aos-delay="100">
                <div class="media-1 position-relative">
                    <img src="/barang/default_brg.jpg" alt="Image" class="img-fluid"><h1></h1>
                    <div class="d-flex align-items-center">
                        <div>
                            <h6 class="text-capitalize"><?php echo $dataa->nama_barang ?></h6>
                            <span class="text-uppercase">Rp <?php echo number_format($dataa->harga_barang, 2, ',', '.') ?></span>
                            <span class="text-capitalize" style="color: <?php echo ($dataa->jumlah < 0) ? 'red' : (($dataa->jumlah == 0) ? 'red' : 'inherit'); ?>">
                                Tersedia <?php echo $dataa->jumlah; ?>
                            </span>
                        </div>
                    </div>
                </div><br>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="d-flex justify-content-end gap-2">
        <div class="pagination">
            <nav>
                <ul class="pagination pagination-sm">
                    <li class="page-item page-indicator" id="previousPageButton">
                        <a class="page-link" href="javascript:void(0)">
                            <i class="la la-angle-left"></i></a>
                    </li>
                    <li class="page-item" id="currentPageNumber">1</li>
                    <li class="page-item page-indicator" id="nextPageButton">
                        <a class="page-link" href="javascript:void(0)">
                            <i class="la la-angle-right"></i></a>
                    </li>
                </ul>
            </nav>
        </div>
        <style>
            .pagination {
                display: flex;
                justify-content: flex-end; 
                align-items: center; 
            }

            .page-numbers button {
                margin-left: 5px; 
                font-size: 14px; 
                padding: 5px 10px;
            }

            .center-column {
                display: flex;
                flex-direction: column;
                align-items: center;
            }

            .center-column .btn {
                margin-top: 5px; 
            }

            .button-container {
                display: flex;
                justify-content: space-between;
                align-items: center;
            }

            .media-1 img {
                border-radius: 10px; 
            }
            .img-fluid {
                box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.4); 
            }
        </style>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const tableBody = document.getElementById('tableBody');
                const currentPageNumber = document.getElementById('currentPageNumber');
                const previousPageButton = document.getElementById('previousPageButton');
                const nextPageButton = document.getElementById('nextPageButton');

                const data = <?= json_encode($p) ?>;
                console.log(data);
 
                const itemsPerPage = 8;
                let currentPage = 1;
                const totalPages = Math.ceil(data.length / itemsPerPage);

                function displayDataOnPage(page) {
                        tableBody.innerHTML = '';

                        const startIndex = (page - 1) * itemsPerPage;
                        const endIndex = startIndex + itemsPerPage;

                        for (let i = startIndex; i < endIndex && i < data.length; i++) {
                            const currentData = data[i];
                            const row = `
                                <div class="col-7 col-sm-7 col-md-7 col-lg-3 mb-5 mb-lg-0" data-aos="fade-left" data-aos-delay="100">
                                    <div class="media-1 position-relative">
                                        <img src="/barang/default_brg.jpg" alt="Image" class="img-fluid">
                                        <h1></h1>
                                        <div class="d-flex align-items-center">
                                            <div>
                                                <h6 class="text-capitalize">${currentData.nama_barang}</h6>
                                                <span class="text-uppercase">Rp ${number_format(currentData.harga_barang, 2, ',', '.')}</span>
                                                <span class="text-capitalize" style="color: ${currentData.jumlah < 0 ? 'red' : (currentData.jumlah == 0 ? 'red' : 'inherit')}">
                                                    Tersedia ${currentData.jumlah}
                                                </span>
                                            </div>
                                        </div>
                                    </div><br>
                                </div>
                            `;
                            tableBody.innerHTML += row;
                        }
                    }


                function number_format(number, decimals, decPoint, thousandsSep) {
                    decimals = decimals || 0;
                    number = parseFloat(number);

                    if (!decPoint || !thousandsSep) {
                        decPoint = '.';
                        thousandsSep = ',';
                    }

                    var roundedNumber = Math.round(Math.abs(number) * ('1e' + decimals)) + '';
                    var numbersString = (decimals ? roundedNumber.slice(0, decimals * -1) : roundedNumber) +
                        (decimals ? decPoint + roundedNumber.slice(decimals * -1) : '');

                    var formattedNumber = numbersString.replace(/\B(?=(\d{3})+(?!\d))/g, thousandsSep);

                    return (number < 0 ? '-' : '') + formattedNumber;
                }

                function updatePageNumbers() {
                    currentPageNumber.textContent = currentPage;
                }

                previousPageButton.addEventListener('click', function () {
                    if (currentPage > 1) {
                        currentPage--;
                        displayDataOnPage(currentPage);
                        updatePageNumbers();
                    }
                });

                nextPageButton.addEventListener('click', function () {
                    if (currentPage < totalPages) {
                        currentPage++;
                        displayDataOnPage(currentPage);
                        updatePageNumbers();
                    }
                });

                displayDataOnPage(currentPage);
                updatePageNumbers();
            });
        </script>
</div>
</div><br>

<div class="col-12">
	<div class="card">
		<div class="card-body">
			<div class="table-responsive">
                <div class="text-end">
                    <a href="<?= base_url('/kasir/clear')?>">
                        <button type="button" class="btn btn-info mb-2">
                            <i class="fa-solid fa-check"></i> Clear Data
                        </button>
                    </a>
                    <a href="<?= base_url('/Laporan/print_nota')?>">
                        <button type="button" class="btn btn-info mb-2">
                            <i class="fa-solid fa-print"></i> Print Nota
                        </button>
                    </a>
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
