<?php
    $get_sni = $this->db->query("SELECT * FROM m_bigsni WHERE mbs_id = '".$id."'");
    foreach ($get_sni->result() as $key => $value_sni);
?>
<?php
    $group = $this->session->userdata('group');
    $namagroup = $group[0]->name;
?>
<div class="content-wrapper" style="min-height: 901px;">
      
      <section class="content-header">
        <h1>
           <?php echo $title; ?>
          <small></small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-home"></i>  <?php echo $title_head; ?></a></li>
        </ol>
      </section>

      <section class="content">
        <div class="box box-success" style="border-top:#0771ae 6px solid;">
            <div class="box-header">
                <h3 class="box-title">
                  <!-- <a href="javascript:" data-toggle="modal" data-target="#modal_add" onClick="btn_modal_add()" class="btn btn-sm btn-flat btn-primary" style="background:#0771ae;"><i class="fa fa-plus"></i> Add <?php echo $title_head; ?></a>
                  <a href="javascript:" onClick="reload_table()" class="btn btn-sm btn-flat btn-default"><i class="fa fa-refresh"></i> Reload</a> -->
                  <a href="<?php echo base_url(); ?>listnonsni/stagesni/<?php echo $id; ?>" class="btn btn-sm btn-flat btn-default"><i class="fa fa-caret-left"></i> Back</a>

                </h3>
            </div>
            
            <div class="box-body">
              <table id="table" class="table table-bordered table-striped">
              <thead>
                  <tr>
                  <th>Tahap</th>
                  </tr>
              </thead>
              <tbody>
              	<?php
                  $no=1;
              		$query_file = $this->db->query("SELECT * FROM m_tahap_sni WHERE mts_aktif = '0' and mts_type='".$value_sni->mbs_type."' and mts_id='".$idtahap."'");
                  foreach ($query_file->result() as $key => $value) {
                     ?>
                    <tr>
                        <td><span style="font-family:arial;"><?php echo $value->mts_name; ?></span><hr style="margin:1px;"><span style="color:#979797;font-size:12px;font-family:arial;"><i class="fa fa-chevron-circle-right"></i> <?php echo $value->mts_ket; ?></span></td>
                    </tr>
                    <?php  $no++; }  ?>
              </tbody>
              </table>

              <hr style="margin:10px 0px">

              <a href="javascript:" onClick="uploadfile()" class="btn btn-sm btn-flat btn-primary" style="margin-bottom:10px;"><i class="fa fa-circle-o-notch"></i> Upload File</a>


              <?php if($namagroup=='GS02') { ?>
                <?php
                  $getfile_status = $this->db->query("SELECT * FROM m_file_sni WHERE mfs_mbs_id='".$id."' and mfs_mts_id='".$idtahap."' and mfs_file = 'selesai'");
                  if($getfile_status->num_rows() > 0) {
                ?>
                  <a href="javascript:" onClick="batalselesai()" class="btn btn-sm btn-flat btn-danger" style="margin-bottom:10px;"><i class="fa fa-minus-square"></i> Batal Selesai</a>
                <?php } else { ?>
                  <a href="javascript:" onClick="selesai()" class="btn btn-sm btn-flat btn-success" style="margin-bottom:10px;"><i class="fa fa-check-square"></i> Tahap Selesai</a>
                <?php } ?>
              <?php } ?>

              <table id="table" class="table table-bordered table-striped">
              <thead>
                  <tr>
                  <th>No</th>
                  <th style="width:100px;">Jenis File</th>
                  <th>Keterangan File</th>
                  <th style="width:120px;">User</th>
                  <th style="width:100px;">Tanggal</th>
                  <th style="width:60px;">Waktu</th>
                  <th style="width:100px;">File</th>
                  <th style="width:100px;">Status</th>
                  <th style="width:130px;">Tools</th>
                  </tr>
              </thead>
              <tbody>
                  <?php $no=1; $get_file = $this->db->query("SELECT * FROM m_file_sni A
LEFT JOIN m_bigsni B ON A.mfs_mbs_id = B.mbs_id
LEFT JOIN m_bigsni_jenis C ON A.mfs_mbsj_id = C.mbsj_id
LEFT JOIN m_tahap_sni D ON A.mfs_mts_id = D.mts_id
LEFT JOIN alus_u E ON A.mfs_user = E.id
WHERE A.mfs_mbs_id='".$id."' and A.mfs_mts_id='".$idtahap."' and mts_aktif='0' and mfs_file != 'selesai'");
                  if($get_file->num_rows() > 0) {
                  foreach ($get_file->result() as $key => $value) { ?>
                    <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $value->mbsj_name; ?></td>
                        <td><?php echo $value->mfs_keterangan; ?></td>
                        <td style="font-size:12px;font-family:arial;text-transform: capitalize;"><?php echo $value->first_name; ?> <?php echo $value->last_name; ?></td>
                        <td><?php echo date("d M Y",strtotime($value->mfs_date)); ?></td>
                        <td><?php echo date("h:s:i",strtotime($value->mfs_date)); ?></td>
                        <td>
                          <a href="<?php echo base_url(); ?>uploads/<?php echo str_replace('/','',$value->mbs_syscode); ?>/<?php echo $value->mfs_file; ?>" target="_blank" class="btn btn-xs btn-primary"><i class="fa fa-cloud-download"></i> Download</a>
                        </td>
                        <td>
                            <?php if($value->mfs_status=='0') { ?>
                            <span class="label label-danger" style="background-color:#acacac !important;">No Publish</span>
                            <?php } else { ?>
                            <span class="label label-danger" style="background-color:#00b584  !important;">Publish</span>
                            <?php } ?>
                        </td>
                        <td>
                            <?php if($this->session->userdata('user_id')==$value->mfs_user) { ?>
                            <a href="javascript:" onClick="savedelete('<?php echo $value->mfs_id; ?>')" class="btn btn-xs btn-flat btn-danger">Delete</a>
                            <?php } else { ?>
                            <a href="javascript:" class="btn btn-xs btn-flat btn-default" disabled>Delete</a>
                            <?php } ?>

                            <?php if($this->session->userdata('user_id')==$value->mfs_user) { ?>

                            <?php if($value->mfs_status=='0') { ?>
                            <a href="javascript:" onClick="savepublish('<?php echo $value->mfs_id; ?>',1)" class="btn btn-xs btn-flat btn-success">Publish</a>
                            <?php } else { ?>
                            <a href="javascript:" onClick="savepublish('<?php echo $value->mfs_id; ?>',0)" class="btn btn-xs btn-flat btn-danger">Unpublish</a>
                            <?php } ?>

                            <?php } ?>

                        </td>
                    </tr>
                  <?php $no++; } }else { ?>
                  <tr>
                    <td colspan="8">Tidak Ada Data</td>
                  </tr>
                  <?php } ?>
              </tbody>
              </table>
            </div>
          </div>
      </section>

</div>

<div class="modal fade" id="modal_add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div id="mark_addform"></div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal_info" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-info" role="document">
    <div class="modal-content">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-info"></i> Information</h4>
              </div>
              <div class="modal-body">
                Anda Harus Upload 2 File
              </div>
            </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  function uploadfile()
  {
            $.ajax({
                    url: base_url+"listnonsni/modal_uploadfile/<?php echo $idtahap; ?>/<?php echo $id; ?>",
                    cache: false,
                    indicatorId: '#load_ajax',
                    beforeSend: function(){
                        $('#load_ajax').fadeIn(100);
                        },
                    success: function(msg){
                        $('#load_ajax').fadeOut(100);
                        $('#modal_add').modal('show');
                        $("#mark_addform").html(msg);
                    }
                  });
  }

  function savepublish(id,status)
    {
        var r = confirm("Are you sure, Publish file ?");
        if (r == true) {
                  $.ajax({
                      url: base_url+"listnonsni/savepublish/"+id+"/"+status,
                      cache: false,
                      indicatorId: '#load_ajax',
                      beforeSend: function(){
                          $('#load_ajax').fadeIn(100);
                          },
                      success: function(msg){
                          $('#load_ajax').fadeOut(100);
                          location.reload();
                      }
                  });
        } else {
            //alert("Cancel");
        } 
    }

    function savedelete(id)
    {
        var r = confirm("Are you sure, Delete ?");
        if (r == true) {
                  $.ajax({
                      url: base_url+"listnonsni/savedelete/"+id,
                      cache: false,
                      indicatorId: '#load_ajax',
                      beforeSend: function(){
                          $('#load_ajax').fadeIn(100);
                          },
                      success: function(msg){
                          $('#load_ajax').fadeOut(100);
                          location.reload();
                      }
                  });
        } else {
            //alert("Cancel");
        } 
    }

    function selesai()
    {
        var r = confirm("Are you sure, Done ?");
        if (r == true) {
                  $.ajax({
                      url: base_url+"listnonsni/saveselesai/<?php echo $idtahap; ?>/<?php echo $id; ?>",
                      cache: false,
                      indicatorId: '#load_ajax',
                      beforeSend: function(){
                          $('#load_ajax').fadeIn(100);
                          },
                      success: function(msg){
                          if(msg=='FALSE')
                          {
                            $('#load_ajax').fadeOut(100);
                            //alert("Anda Harus Upload 2 Jenis File");
                            $('#modal_info').modal('show');
                          }
                          else
                          {
                            $('#load_ajax').fadeOut(100);
                            location.reload();
                          }
                      }
                  });
        } else {
            //alert("Cancel");
        } 
    }

    function batalselesai()
    {
        var r = confirm("Are you sure, Cancel ?");
        if (r == true) {
                  $.ajax({
                      url: base_url+"listnonsni/savebatalselesai/<?php echo $idtahap; ?>/<?php echo $id; ?>",
                      cache: false,
                      indicatorId: '#load_ajax',
                      beforeSend: function(){
                          $('#load_ajax').fadeIn(100);
                          },
                      success: function(msg){
                          $('#load_ajax').fadeOut(100);
                          location.reload();
                      }
                  });
        } else {
            //alert("Cancel");
        } 
    }
</script>