  <!-- Full Width Column -->
  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          <?php //echo $this->lang->line('dashboard');?> Dashboard
          <small></small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
          
          <!-- ini perjanjian -->
              <div class="col-md-8">
                <div class="box box-primary" style="border-top:#59C594 6px solid;box-shadow:  2px 4px 3px #888888; background-color: #f4f8ff;">
                  <div class="box-header with-border" >
                     <h2 class="box-title">Perjanjian Hari Ini </h2>
                     <div class="box-tools pull-right">
                      <span data-toggle="tooltip" title="" class="badge bg-yellow" data-original-title="<?php echo $total_janji;?> Perjanjian"><?php echo $total_janji;?></span>
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <table class="table table-hover table-bordered datatables" style="background-color: white; width:100%" id="table">
                      <thead>
                        <tr>
                          <th  class="text-center" rowspan="2">No</th>
                          <th  class="text-center" colspan="2">Pasien</th>
                          <th  class="text-center" colspan="2">Dokter</th>
                          <th  class="text-center" rowspan="2">Tanggal</th>
                          <th  class="text-center" rowspan="2">Jam</th>
                        </tr>
                        <tr>
                          <th  class="text-center">Nama</th>
                          <th  class="text-center">Telp.</th>
                          <th  class="text-center">Nama</th>
                          <th  class="text-center">Telp</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php 
                      $no = 1;
                      foreach ($janji as $key => $value) {?>
                        <tr>
                          <td class="text-center"><?php echo $no;?></td>
                          <td class="text-center"><?php echo $value->mp_mcu_name;?></td>
                          <td class="text-center"><?php echo $value->mp_mcu_telp;?></td>
                          <td class="text-center"><?php echo $value->mp_mdo_name;?></td>
                          <td class="text-center"><?php echo $value->mp_mdo_telp;?></td>
                          <td class="text-center"><?php echo date('d-m-y',strtotime($value->mp_date));?></td>
                          <td class="text-center"><?php echo date('H:i',strtotime($value->mp_time));?></td>
                        </tr>
                      <?php $no++;};?>  
                      </tbody>
                    </table>
                      
                  </div>
                  <!-- /.box-body -->
                  <div class="box-footer text-center" style="background-color: #f4f8ff;">
                    <a href="<?php echo base_url('janjian/');?>" class="uppercase">Lihat Semua Perjanjian <span class="glyphicon glyphicon-play-circle"></span></a>
                  </div>
                  <!-- box footer -->
                </div>
                <!-- TANGGAL DAN JAM -->
                  <div class="box box-primary" style="border-top:#00897B 6px solid;box-shadow:  2px 4px 3px #888888; background-color: #00897B;">
                  <!-- /.box-header -->
                  <div class="box-body text-center">
                        <span style="color:white;font-size: 60px;" id="txt"></span>
                  </div>
                  <!-- /.box-body -->
                </div>
              <!-- END TANGGAL DAN JAM -->
              <div class="col-md-6">
              <div class="box box-primary" style="border-top:#59C594 6px solid;box-shadow:  2px 4px 3px #888888; background-color: #f4f8ff;">
                  <div class="box-header with-border" >
                     <h2 class="box-title">Total Staff Cuti Hari Ini</h2>
                     <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body text-center">
                        <span style="color:#00897b;font-size: 60px;"><?php echo $total_cuti_staff;?></span>
                  </div>
                  <!-- /.box-body -->
                  <div class="box-footer text-center" style="background-color: #f4f8ff;"><!-- 
                    <a href="<?php echo base_url('dokter/');?>" class="uppercase">Lihat Semua Data Dokter <span class="glyphicon glyphicon-play-circle"></span></a> -->
                  </div>
                  <!-- box footer -->
                </div>

              </div>

              <div class="col-md-6">
              <div class="box box-primary" style="border-top:#59C594 6px solid;box-shadow:  2px 4px 3px #888888; background-color: #f4f8ff;">
                  <div class="box-header with-border" >
                     <h2 class="box-title">Total Dokter Cuti Hari Ini</h2>
                     <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body text-center">
                        <span style="color:#00897b;font-size: 60px;"><?php echo $total_cuti_dokter;?></span>
                  </div>
                  <!-- /.box-body -->
                  <div class="box-footer text-center" style="background-color: #f4f8ff;"><!-- 
                    <a href="<?php echo base_url('dokter/');?>" class="uppercase">Lihat Semua Data Dokter <span class="glyphicon glyphicon-play-circle"></span></a> -->
                  </div>
                  <!-- box footer -->
                </div>

              </div>

            </div>
              <!-- SEELSAI PERJANJIAN -->

              <!-- Total PASIEN -->
              <div class="col-md-4">
                <div class="box box-primary" style="border-top:#59C594 6px solid;box-shadow:  2px 4px 3px #888888; background-color: #f4f8ff;">
                  <div class="box-header with-border" >
                     <h2 class="box-title">Total Pasien Terdaftar</h2>
                     <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body text-center">
                        <span style="color:#00897b;font-size: 60px;"><?php echo $total_pasien;?></span>
                  </div>
                  <!-- /.box-body -->
                  <div class="box-footer text-center" style="background-color: #f4f8ff;">
                    <a href="<?php echo base_url('pasien/');?>" class="uppercase">Lihat Semua Data Pasien <span class="glyphicon glyphicon-play-circle"></span></a>
                  </div>
                  <!-- box footer -->
                </div>
                <div class="box box-primary" style="border-top:#59C594 6px solid;box-shadow:  2px 4px 3px #888888; background-color: #f4f8ff;">
                  <div class="box-header with-border" >
                     <h2 class="box-title">Total Dokter </h2>
                     <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body text-center">
                        <span style="color:#00897b;font-size: 60px;"><?php echo $total_dokter;?></span>
                  </div>
                  <!-- /.box-body -->
                  <div class="box-footer text-center" style="background-color: #f4f8ff;">
                    <a href="<?php echo base_url('dokter/');?>" class="uppercase">Lihat Semua Data Dokter <span class="glyphicon glyphicon-play-circle"></span></a>
                  </div>
                  <!-- box footer -->
                </div>

                
              </div>
              <!-- END TOTAL PASIEN -->
          
      </section>
      <!-- /.content -->
      <script type="text/javascript">
    $(document).ready(function() {
      startTime();
      table = $('#table').DataTable({
        dom:'<"row"<"col-sm-6"l><"col-sm-6"f>>rt<"bottom"i>p<"clear">',
        "processing": true, //Feature control the processing indicator.
        "scrollX" : true,
        "responsive": true,
        "order": [[ 0, "asc" ]],
        "lengthMenu" : [[10, 25, 100, 1000, -1], [10, 25, 100,1000, "All"]],
  });
    });
</script>

<script>
  function startTime() {
      var today = new Date();
      var d = today.getDate();
      var mm = today.getMonth()+1;
      var y = today.getFullYear();
      var h = today.getHours();
      var m = today.getMinutes();
      var s = today.getSeconds();
      m = checkTime(m);
      s = checkTime(s);
      document.getElementById('txt').innerHTML =
      d +"-"+ mm +"-"+ y +" | "+ h + ":" + m + ":" + s;
      var t = setTimeout(startTime, 500);
  }

  function checkTime(i) {
      if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
      return i;
  }
</script>
  </div>
  <!-- /.content-wrapper -->
