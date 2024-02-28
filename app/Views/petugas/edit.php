<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="card">
        <div class="card-body">
            <div class="basic-form">
                <form id="userForm" class="form-horizontal form-label-left" novalidate  action="<?= base_url('Petugas/aksi_edit')?>" method="post">
                 <input type="hidden" name="id" value="<?= $data->id_user ?>">

                 <div class="row">
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Nama Petugas<span style="color: red;">*</span></label>
                        <input type="text" id="nama_petugas" name="nama_petugas" 
                        class="form-control text-capitalize" placeholder="Nama Petugas" value="<?= $data->nama_petugas?>">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Alamat<span style="color: red;">*</span></label>
                        <input type="text" id="alamat" name="alamat" 
                        class="form-control text-capitalize" placeholder="Alamat" value="<?= $data->alamat?>">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label">No Telepon<span style="color: red;">*</span></label>
                        <input type="text" id="no_telp" name="no_telp" 
                        class="form-control text-capitalize" placeholder="No Telepon" oninput="validateNumberInput(this)" autocomplete="on" value="<?= $data->no_telp?>">
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
                    <label class="form-label">Username<span style="color: red;">*</span></label>
                    <input type="text" id="username" name="username" 
                    class="form-control text-capitalize" placeholder="Username" maxlength="50" value="<?= $data->username?>">
                </div>
                <div class="mb-3 col-md-12">
                    <label class="form-label">Level<span style="color: red;">*</span></label>
                    <div class="col-12">
                        <select id="level" class="form-control col-12" data-validate-length-range="6" data-validate-words="2" name="level" required="required">
                          <?php if ($data->level == 1): ?>
                            <option value="1" selected>Adminstrator</option>
                            <option value="2">Petugas Kasir</option>
                          <?php elseif ($data->level == 2): ?>
                            <option value="1">Adminstrator</option>
                            <option value="2" selected>Petugas Kasir</option>
                          <?php endif; ?>
                      </select>
                  </div>
              </div>
          </div>
          <a href="<?= base_url('/Petugas')?>" type="submit" class="btn btn-primary">Kembali</a></button>
          <button type="submit" class="btn btn-success">Edit Data</button>
      </form>
  </div>
</div>
</div>
</div>