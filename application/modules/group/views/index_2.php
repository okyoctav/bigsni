    <!-- breadcrumb -->
        <ol class="breadcrumb bgcrumb">
            <li><a href="#">Home</a></li>
            <li>Manajemen Groups</li>
        </ol>
        <!-- end breadcrumb -->
     <div id="openhak" style="display:none; overflow-y: hidden;" >
    </div>
        <h1 style="font-size:20pt" class="text-center">Manajemen Groups</h1>
        <br />
        <?php if($can_add == 1){?>
        <button class="btn btn-success" onclick="add_person()"><i class="glyphicon glyphicon-plus"></i> Tambah Group</button>
      <?php } ?>
        <button class="btn btn-default" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
        <br />
        <br />
        <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                  <th class="text">Nama Group</td>
                  <th class="text">Deskripsi</td>
                  <th class="text-center" width="5%"></td>
                  <th class="text-center" width="5%"></td>
                  <th class="text-center" width="5%"></td>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>

    <!-- Datatables , jika tidak digunakan silahkan dihapus -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/components/datatables/media/css/jquery.dataTables.min.css" >
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/components/datatables/Buttons/css/buttons.dataTables.min.css" >
    <script src="<?php echo base_url();?>assets/components/datatables/media/js/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>assets/components/datatables/Buttons/js/dataTables.buttons.min.js"></script>
    <script src="<?php echo base_url();?>assets/components/datatables/Buttons/js/buttons.flash.min.js"></script>
    <script src="<?php echo base_url();?>assets/components/datatables/Buttons/js/buttons.html5.min.js"></script>
    <script src="<?php echo base_url();?>assets/components/datatables/Buttons/js/buttons.colVis.min.js"></script>

    
    <!-- End Data tables -->
    
<script type="text/javascript">
 
var save_method; //for save method string
var table;
 
$(document).ready(function() {
 
    //datatables
    table = $('#table').DataTable({ 
    dom:"Blfrtip",
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        
 
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('group/ajax_list')?>",
            "type": "POST"
        },
 
        //Set column definition initialisation properties.
        "columnDefs": [
        { 
            "targets": [ 2,3,4 ], //last column
            "orderable": false, //set not orderable
            "className":"text-center",
        },
        ],
        "lengthMenu" : [[10, 25, 100, 1000, -1], [10, 25, 100,1000, "All"]],
        "buttons" : [
                {   extend: 'excelFlash',
                  text: 'Eksport Excel(E)',
                  key: { key: 'e', altkey: true },
                  title:"Data Groups",
                  exportOptions: {
                       columns: [0,1]
                      }

              },
                /*{   extend: 'pdf',
                  text: 'Export Pdf(F)',
                  key: { key: 'f', altkey: true },
                  title:"Data Groups",
                  exportOptions: {
                       columns: [0,1]
                      }
              },*/
                { extend: 'colvis', text: 'Show/Hide columns(H)',key: { key: 'h', altkey: true }}
              ],
 
    });
    $('#psv').change(function(){
      $(this).attr('value', $('#psv').val());
    });
    $('#pev').change(function(){
      $(this).attr('value', $('#pev').val());
    });
    $('#psed').change(function(){
      $(this).attr('value', $('#psed').val());
    });
    $('#peed').change(function(){
      $(this).attr('value', $('#peed').val());
    });
});
 
 function openform(id) {
  $.ajax({
        url: "<?php echo base_url('group/hak_akses')?>/"+id,
        beforeSend: function() 
        { $("#load_ajax").show(); },
        complete: function() 
        { $("#load_ajax").hide(); },
        cache: false,
        success: function(msg){
          $("#openhak").html(msg);
          $("#openhak").show("fast"); 
        }
    
    });
  }

function tutuphak()
  {
    $("#openhak").hide("fast");
  }

 function savehak() {
  var form=$("#hak");
  $.ajax({
        type:"POST",
        url:form.attr("action"),
        dataType:"JSON",
        beforeSend: function() 
        { $("#load_ajax").show(); },
        complete: function() 
        { $("#load_ajax").hide(); },
        data:form.serialize(),
        success: function(msg){
          
          if(msg.status) //if success close modal and reload ajax table
            {
                tutuphak();
                popup();
                reload_table();
            }else{
              popup(msg.msg);
                reload_table();
            }
        }
    
    });
  }

function add_person()
{
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form').modal('show'); // show bootstrap modal
    $('.modal-title').text('Add Group'); // Set Title to Bootstrap modal title
}
 
function edit_person(id)
{
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
 
    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('group/ajax_edit/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
 
            $('[name="id"]').val(data.id);
            $('[name="group_nama"]').val(data.name);
            $('[name="des_group"]').val(data.description);

            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Group'); // Set title to Bootstrap modal title
 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}
 
function reload_table()
{
    table.ajax.reload(null,false); //reload datatable ajax 
}
 
function save()
{
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable 
    var url;
 
    if(save_method == 'add') {
        url = "<?php echo site_url('group/ajax_add')?>";
    } else {
        url = "<?php echo site_url('group/ajax_update')?>";
    }
 
    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: $('#form').serialize(),
        dataType: "JSON",
        success: function(data)
        {
 
            if(data.status) //if success close modal and reload ajax table
            {
                popup();
                $('#modal_form').modal('hide');
                reload_table();
            }else{
              popup(data.msg);
                reload_table();
            }
 
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 
        }
    });
}
 
function delete_person(id)
{
    if(confirm('Are you sure delete this data?'))
    {
        // ajax delete data to database
        $.ajax({
            url : "<?php echo site_url('group/ajax_delete')?>/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
               if(data.status) //if success close modal and reload ajax table
              {
                  $('#modal_form').modal('hide');
                  popup();
                  reload_table();
              }else{
                popup(data.msg);
                  reload_table();
              }
            }
        });
 
    }
}
function popup(ms = null) {
  if(ms == null)
  {
    $().toasty({
        message: "Berhasil",
        autoHide: 3000
    }); 
  }else{
    $().toasty({
        message: ms,
        autoHide: 3000
    }); 
  } 
  
}
</script>
 
<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Tambah Group</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal" name="formnih">
                    <input type="hidden" value="" name="id"/> 
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">Nama Group</label>
                            <div class="col-md-9">
                                <input type="text" name="group_nama" class="form-control" placeholder="Nama Group">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Deskripsi Group</label>
                            <div class="col-md-9">
                                <input type="text" name="des_group" class="form-control" placeholder="Deskripsi Group">
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->
