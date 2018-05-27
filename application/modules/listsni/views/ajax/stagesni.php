<?php
    $get_sni = $this->db->query("SELECT * FROM m_bigsni WHERE mbs_id = '".$id."'");
    foreach ($get_sni->result() as $key => $value_sni);
?>
<!-- DEfine Group -->
<?php
    $group = $this->session->userdata('group');
    $namagroup = $group[0]->name;
?>
  <style type="text/css">
th, td { white-space:inherit; }
#table_paginate{
  margin-top: 10px;
}

</style>
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
                  <a href="<?php echo base_url(); ?>listsni" class="btn btn-sm btn-flat btn-default"><i class="fa fa-caret-left"></i> Back</a>
                </h3>
            </div>
            
            <div class="box-body">
              <table id="table" class="table table-bordered table-striped">
              <thead>
                  <tr>
                  <th width="1%">No</th>
                  <th>Tahap</th>
                  <th width="100px">Status</th>
                  <th width="100px">Tools</th>
                  </tr>
              </thead>
              <tbody>
              	<?php
                  $no=1;
                  $query_file = $this->db->query("SELECT * FROM m_tahap_sni A
LEFT JOIN (SELECT * FROM t_access_systems WHERE tas_groupsession = '".$namagroup."') B ON A.mts_id = B.tas_mts_id
LEFT JOIN (SELECT mfs_mts_id,COUNT(*) as jml_c FROM m_file_sni WHERE mfs_mbs_id = '".$id."' GROUP BY mfs_mts_id) C ON A.mts_id = C.mfs_mts_id
LEFT JOIN (SELECT mfs_mts_id,COUNT(*) as jml_d FROM m_file_sni WHERE mfs_mbs_id = '".$id."' and mfs_file = 'selesai' GROUP BY mfs_mbs_id) D ON A.mts_id = D.mfs_mts_id
WHERE mts_aktif = '0' and mts_type='".$value_sni->mbs_type."'");
                  foreach ($query_file->result() as $key => $value) {
                     ?>
                    <tr>
                        <td><?php echo $no; ?></td>
                        <td><span style="font-family:arial;"><?php echo $value->mts_name; ?></span><hr style="margin:1px;"><span style="color:#979797;font-size:12px;font-family:arial;"><i class="fa fa-chevron-circle-right"></i> <?php echo $value->mts_ket; ?></span></td>
                        <td>
                          <?php if($value->jml_d) { ?>
                            <span class="label label-danger" style="background-color:#00bd75 !important;">Done</span>
                          <?php }else{ ?>
                             <!-- JIKA TIDAK --> 
                             <?php if($value->jml_c) { ?>
                             <span class="label label-danger" style="background-color:#f39c12 !important;">Progress</span>
                             <?php } else { ?>
                             <span class="label label-danger" style="background-color:#a6a6a6 !important;">No Progress</span>
                             <?php } ?>
                             <!-- END JIKA TIDAK -->
                          <?php } ?>
                        </td>
                        <td>
                          <?php if($value->tas_groupsession) { ?>
                            <?php if($value->jml_c || $value->jml_d) { ?>
                              <a href="<?php echo base_url(); ?>listsni/stagesni_tahap/<?php echo $id; ?>/<?php echo $value->mts_id; ?>" class="btn btn-xs btn-flat btn-primary">Lihat Proses</a>
                            <?php } else { ?>
                              <!-- INISIAL GROUP SEKRETARIAT -->
                              <?php if($namagroup=='GS02') { ?>
                                <a href="<?php echo base_url(); ?>listsni/stagesni_tahap/<?php echo $id; ?>/<?php echo $value->mts_id; ?>" class="btn btn-xs btn-flat btn-primary">Lihat Proses</a>
                              <?php } else { ?>
                              <!-- EXX MOMEN -->
                              <a href="javascript:" class="btn btn-xs btn-flat btn-default" style="background-color:#acacac !important;"><i class="fa fa-lock"></i> Lihat Proses</a>
                              <!-- EXX MOMEN END -->
                              <?php } ?>
                              <!-- INISIAL GROUP SEKRETARIAT -->
                            <?php } ?>
                          <?php } else { ?>
                          <a href="javascript:" class="btn btn-xs btn-flat btn-default" style="background-color:#acacac !important;"><i class="fa fa-lock"></i> Lihat Proses</a>
                          <?php } ?>
                        </td>
                    </tr>
                    <?php  $no++; }  ?>
              </tbody>
              </table>
            </div>
          </div>
      </section>

</div>

<script type="text/javascript">

</script>