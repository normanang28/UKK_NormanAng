<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
           <div class="table-responsive">
                <table id="example" class="table items-table table table-bordered table-striped verticle-middle table-responsive-sm" style="min-width: 100%">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Username</th>
                        <th class="text-center">Aktifitas</th>
                        <th class="text-center">Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no=1;
                    foreach ($data as $dataa){
                      ?>
                      <tr>
                          <th class="text-center"><?php echo $no++ ?></th>
                          <td class="text-capitalize text-center"><?php echo $dataa->username?></td>      
                          <td class="text-capitalize text-center"><?php echo $dataa->aktifitas?></td>
                          <td class="text-capitalize text-center"><?php echo $dataa->waktu?></td>
                      </tr>
                  <?php }?>
                  
              </tbody>
          </table>
      </div>
</div>
</div>
</div>