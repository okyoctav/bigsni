  <style type="text/css">
th, td { white-space: nowrap; }
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
                  <a href="javascript:" data-toggle="modal" data-target="#modal_add" onClick="btn_modal_add()" class="btn btn-sm btn-flat btn-primary" style="background:#0771ae;"><i class="fa fa-plus"></i> Add <?php echo $title_head; ?></a>
                  <a href="javascript:" onClick="reload_table()" class="btn btn-sm btn-flat btn-default"><i class="fa fa-refresh"></i> Reload</a>
                </h3>
            </div>
            
            <div class="box-body">
              <table id="table" class="table table-bordered table-striped">
              <thead>
                  <tr>
                  <th>No</th>
                  <th>Nomor SNI</th>
                  <th>Tahun</th>
                  <th>ICS</th>
                  <th>Judul SNI</th>
                  <th>Konsensus</th>
                  <th>&nbsp;</th>
                  <th>Status</th>
                  <th width="190px"><i class="fa fa-cog"></i> Tools</th>
                  </tr>
              </thead>
              <tbody>

              </tbody>
              </table>
            </div>
          </div>
      </section>

</div>


<!-- MODAL CSS -->

<div class="modal fade" id="modal_add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div id="mark_addform"></div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal_view" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div id="mark_viewform"></div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal_edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div id="mark_editform"></div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal_tahapan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document" style="width:90%;">
    <div class="modal-content">
        <div id="mark_addtahapan"></div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal_view" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div id="mark_viewform"></div>
    </div>
  </div>
</div>

<!-- END MODAL CSS -->


<script type="text/javascript">
var save_method; //for save method string
var table;
 
$(document).ready(function() {

    table = $('#table').DataTable({ 
    dom:'<"row"<"col-sm-6"l><"col-sm-6"f>>rt<"bottom"i>p<"clear">',
        "processing": true,
        "serverSide": true,
        "scrollX" :true,

        "ajax": {
            "url": "<?php echo base_url().$this->uri->segment(1); ?>/ajax_list",
            "type": "POST"
        },
        fixedColumns:   {
            rightColumns: 3
        },
        "columnDefs": [
        { 
            "targets": [ -1,-2,-3 ],
            "orderable": false,
            "className":"text-center",
        },
        { 
            "targets": [0],
            "className":"text-center",
        },
        ],
        "lengthMenu" : [[10, 25, 100, 1000, -1], [10, 25, 100,1000, "All"]],
        });

});

function reload_table()
{
    table.ajax.reload(null,false); //reload datatable ajax 
}

/*FUNCTION MODAL*/

function btn_modal_add()
{
    $.ajax({
        url: base_url+"<?php echo $this->uri->segment(1); ?>/modal_add",
        cache: false,
        indicatorId: '#load_ajax',
        beforeSend: function(){
              $('#load_ajax').fadeIn(100);
            },
        success: function(msg){
              $('#modal_add').modal('show');
              $('#load_ajax').fadeOut(100);
              $("#mark_addform").html(msg);
            }
      });
}

function btn_modal_edit(id)
{
    $.ajax({
        url: base_url+"<?php echo $this->uri->segment(1); ?>/modal_edit/"+id,
        cache: false,
        indicatorId: '#load_ajax',
        beforeSend: function(){
              $('#load_ajax').fadeIn(100);
            },
        success: function(msg){
              $('#modal_edit').modal('show');
              $('#load_ajax').fadeOut(100);
              $("#mark_editform").html(msg);
            }
      });
}

function btn_modal_delete(id)
{    
    var r = confirm("Anda Yakin Hapus !");

    if (r == true) {
        btn_save_delete(id);
    } else {
        popup("Batal");
    } 
}

/*FUNCTION ACTION*/

function btn_save_add()
{
    
    /*Nama Form ID*/
    var frm = $('#form_add');
    /*Ajax Model*/
    $.ajax({
        type: "POST",
        url:  base_url+"<?php echo $this->uri->segment(1); ?>/save",
        data: frm.serialize(),
              beforeSend: function(){
                $('#load_ajax').fadeIn(100);
              },
              success: function (data){
                $('#modal_add').modal('hide');
                $("#load_ajax").fadeOut(100);
                reload_table();
                popup("Data Tersimpan");
              }
    });
}

function btn_save_edit()
{
    /*Nama Form ID*/
    var frm = $('#form_edit');
    /*Ajax Model*/
    $.ajax({
        type: "POST",
        url:  base_url+"<?php echo $this->uri->segment(1); ?>/edit",
        data: frm.serialize(),
              beforeSend: function(){
                $('#load_ajax').fadeIn(100);
              },
              success: function (data){
                $('#modal_edit').modal('hide');
                $("#load_ajax").fadeOut(100);
                reload_table();
                popup("Data Edit Tersimpan");
              }
    });
}

function btn_save_delete(id)
{
    $.ajax({
        url: base_url+"<?php echo $this->uri->segment(1); ?>/delete/"+id,
        cache: false,
        indicatorId: '#load_ajax',
        beforeSend: function(){
              $('#load_ajax').fadeIn(100);
            },
        success: function(msg){
              $('#load_ajax').fadeOut(100);
              reload_table();
              popup("Data Terhapus");
            }
      });
}

function btn_modal_tahap(id)
{
    $.ajax({
      url: base_url+"<?php echo $this->uri->segment(1); ?>/stagesni/"+id,
      cache: false,
      indicatorId: '#load_ajax',
      beforeSend: function(){
          $('#load_ajax').fadeIn(100);
          },
      success: function(msg){
          $('#load_ajax').fadeOut(100);
          //$('#modal_tahapan').modal('show');
          $("#badan_isi").html(msg);
      }
    });
}

function btn_modal_view(id)
{
  $.ajax({
          url: base_url+"<?php echo $this->uri->segment(1); ?>/modal_view/"+id,
          cache: false,
          indicatorId: '#load_ajax',
          beforeSend: function(){
              $('#load_ajax').fadeIn(100);
              },
          success: function(msg){
              $('#load_ajax').fadeOut(100);
              $('#modal_view').modal('show');
              $("#mark_viewform").html(msg);
          }
        });
}

</script>