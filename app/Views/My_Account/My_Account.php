<div class="row d-flex align-items-stretch">
    <div class="col-md-5 col-sm-5 col-xs-5">
        <div class="card h-100">
            <div class="card-bg" style="background-image: url('/account/bg.jpg');">
                <div class="card-body">
                    <div style="text-align: center;">
                        <img src="<?= base_url('/assets/images/profile/default-profile-photo.jpeg')?>" width="80" style="border-radius: 50%; border: 1px solid #ccc;"  alt=""/>
                        <h5 class="text-capitalize"><?= $use->username ?></h5>
                        <hr>
                    </div>

                    <table class="table">
                        <tr>
                            <th>Username :</th>
                            <td class="text-capitalize"><?= $use->username ?></td>
                        </tr>
                        <tr>
                            <th>Nama petugas :</th>
                            <td class="text-capitalize"><?= $petugas->nama_petugas ?></td>
                        </tr>
                        <tr>
                            <th>Alamat :</th>
                            <td class="text-capitalize"><?= $petugas->alamat ?></td>
                        </tr>
                        <tr>
                            <th>No Telepon :</th>
                            <td class="text-capitalize"><?= $petugas->no_telp ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <style>
    .card {
        border: 1px solid #e5e5e5;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
        overflow: hidden; 
    }

    .card-bg {
        background-size: 100% 100%;
        height: 150px;
        position: relative;
    }

    .card-body {
        padding: 20px;
    }

    table {
        width: 100%;
        margin-bottom: 0;
        border-collapse: collapse; 
    }

    th, td {
        border: none;
        padding: 4px; 
        text-align: left;
    }

    th {
        width: 40%;
        font-weight: normal;
    }

    .form-group {
        margin-bottom: 15px;
    }

    hr {
        margin-top: 15px;
        margin-bottom: 20px;
        border: 0;
        border-top: 1px solid #000000;
    }
    </style>

    <div class="col-md-7 col-sm-7 col-xs-7">
        <div class="card h-100">
            <div class="card-body">
                <form class="form-horizontal form-label-left" novalidate  action="<?= base_url('My_Account/ganti_password')?>" method="post">
                <div class="item form-group">
                      <label class="control-label col-md-12 col-sm-12 col-xs-12">Password<span style="color: black;"> :</span>
                      </label>
                      <div class="col-md-12 col-sm-12 col-xs-12">
                        <input id="password" class="form-control col-md-12 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="password" placeholder="Password" required="required" type="text" value="<?= $use->password?>" disabled>
                    </div>
                </div>
                <div class="item form-group">
                  <label class="control-label col-md-12 col-sm-12 col-xs-12">Ganti Password Baru<span style="color: black;"> :</span>
                  </label>
                  <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="input-group">
                      <input type="password" placeholder="Ganti Password Baru" name="p1" class="form-control col-md-12 col-xs-12" data-validate-length-range="6" data-validate-words="2" id="newPassword" >
                      <span class="input-group-text" id="togglePassword"><i class="fa fa-eye" aria-hidden="true"></i></span>
                  </div>
              </div>
          </div>
          <div class="item form-group">
              <label class="control-label col-md-12 col-sm-12 col-xs-12">Verifikasi Password Baru<span style="color: black;"> :</span>
              </label>
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="input-group">
                    <input type="password" placeholder="Verifikasi Password Baru" name="pw" class="form-control col-md-12 col-xs-12" data-validate-length-range="6" data-validate-words="2" id="verifyPassword">
                    <span class="input-group-text" id="togglePasswordVerify"><i class="fa fa-eye" aria-hidden="true"></i></span>
                </div>
            </div>
        </div>
        <small class="form-text text-danger" id="passwordMismatchAlert" style="display: none;">Password yang anda masukkan harus sama.</small>
        <div class="ln_solid"></div>
        <div class="form-groupp">
            <div class="col-md-12 float-right">
                <button id="submitButton" type="submit" class="btn btn-info" disabled>Ganti Password</button>
            </div>
        </div>
        <style>
            .form-groupp .col-md-12 {
                text-align: right;
            }
        </style>
  </form>
</div>
</div>
</div>
</div>
<script>
    const newPasswordInput = document.getElementById('newPassword');
    const verifyPasswordInput = document.getElementById('verifyPassword');
    const submitButton = document.getElementById('submitButton');
    const passwordMismatchAlert = document.getElementById('passwordMismatchAlert');
    
    verifyPasswordInput.addEventListener('input', function() {
        if (verifyPasswordInput.value === newPasswordInput.value) {
            submitButton.disabled = false;
            passwordMismatchAlert.style.display = 'none';
        } else {
            submitButton.disabled = true;
            passwordMismatchAlert.style.display = 'block';
        }
    });

    const togglePassword = document.getElementById('togglePassword');
    togglePassword.addEventListener('click', function () {
        const type = newPasswordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        newPasswordInput.setAttribute('type', type);
    });

    const togglePasswordVerify = document.getElementById('togglePasswordVerify');
    togglePasswordVerify.addEventListener('click', function () {
        const type = verifyPasswordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        verifyPasswordInput.setAttribute('type', type);
    });
</script>