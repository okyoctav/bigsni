      <!-- breadcrumb -->
        <ol class="breadcrumb bgcrumb">
            <li><a href="#">Home</a></li>
            <li>Manajemen Menus</li>
        </ol>
        <!-- end breadcrumb -->

        <h1 style="font-size:20pt" class="text-center">Manajemen Menus</h1>
        <br />
        <?php if($can_add == 1){?>
        <button class="btn btn-success" onclick="add_person()"><i class="glyphicon glyphicon-plus"></i> Tambah Menu</button>
      <?php } ?>
        <button class="btn btn-default" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
        <br />
        <br />
        <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                  <th class="text" width="40%">Nama Menu</td>
          <th class="text" width="30%">URI</td>
                <th class="text" width="1%">Order</td>
          <th class="text-center" width="12%">Tools</td>
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
            "url": "<?php echo site_url('menus/ajax_list')?>",
            "type": "POST"
        },
 
        //Set column definition initialisation properties.
        "columnDefs": [
        { 
            "targets": [ -1 ], //last column
            "orderable": false, //set not orderable
            "className":"text-center",
        },
        { 
            "targets": [2], //last column
            "className":"text-center",
        },
        ],
        "lengthMenu" : [[10, 25, 100, 1000, -1], [10, 25, 100,1000, "All"]],
        "buttons" : [
                {   extend: 'excel',
                  className: 'testaja',
                  text: 'Eksport Excel(E)',
                  key: { key: 'e', altkey: true },
                  title:"Data Menus",
                  exportOptions: {
                       columns: [0,1,2]
                      }

              },
                {   extend: 'pdf',
                  text: 'Export Pdf(F)',
                  key: { key: 'f', altkey: true },
                  title:"Data Menus.pdf",
                  exportOptions: {
                       columns: [0,1,2]
                      }
              },
                { extend: 'colvis', text: 'Show/Hide columns(H)',key: { key: 'h', altkey: true }}
              ],
 
    });

});
 
function add_person()
{
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form').modal('show'); // show bootstrap modal
    $('.modal-title').text('Add Menu'); // Set Title to Bootstrap modal title
}
 
function edit_person(id)
{
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
 
    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('menus/ajax_edit/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
 
            $('[name="id"]').val(data.data.menu_id);
            $('[name="name"]').val(data.nama);
            $('[name="uri"]').val(data.uri);
            $('[name="order"]').val(data.data.order_num);
            $('[name="target"]').val(data.data.menu_target);
            document.formnih.parent.value=data.data.menu_parent;
            document.formnih.icon.value=data.data.menu_icon;

            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Person'); // Set title to Bootstrap modal title
 
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
        url = "<?php echo site_url('menus/ajax_add')?>";
    } else {
        url = "<?php echo site_url('menus/ajax_update')?>";
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
            url : "<?php echo site_url('menus/ajax_delete')?>/"+id,
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
                <h3 class="modal-title">Tambah Menu</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal" name="formnih">
                    <input type="hidden" value="" name="id"/> 
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">Nama Menu</label>
                            <div class="col-md-9">
                                <input type="text" name="name" class="form-control" placeholder="Nama">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">URI Menu (controller / folder)</label>
                            <div class="col-md-9">
                                <input type="text" name="uri" class="form-control" placeholder="URI">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Order Number</label>
                            <div class="col-md-9">
                                <input type="number" name="order" class="form-control" placeholder="Order Number">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Target Menu</label>
                            <div class="col-md-9">
                                <select name="target" class="form-control">
                          <option value="">This Page</option>
                          <option value="_blank">New Tab Page</option>
                      </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                    <label class="control-label col-md-3" >Menu Parent</label>
                    <div style="border:0px solid #ccc; width:98% ; height: 170px; overflow-y: scroll; padding-left: 10px;">
                      <div class="contain">
                          <table class="table table-striped table-bordered table-hover"> 
                            <thead>
                              <tr>
                                <th width="2%"></th>
                                <th class="text-left">Menu</th>
                              </tr>
                            </thead>
                          <tbody>
                      <tr>
                       <td class="text-right">
                        <input type="radio" class="radio" name="parent" value="0">
                        </td>
                       <td>Ini Parent Menu</td>
                      </tr>
                  <?php 
                      foreach ($tree as $tre) {
                       ?>
                       <tr>
                       <td class="text-right">
                        <input type="radio" class="radio" name="parent" value="<?php echo $tre->menu_id ;?>">
                        </td>
                       <td><?php echo $tre->menu_nama;?></td>
                      </tr>
                       <?php }; ?>
                       </tbody>
                       
                      </table>
                  </div>
                  </div>
              </div>
                        <div class="form-group">
                <label class="col-sm-12">Icon Menu</label>
              <div class="col-sm-2"><input type="radio" name="icon" value="" checked><strong>None</strong></div>
             <div class="col-sm-2"><input type="radio" name="icon" value="fa fa-home fa-fw"><i class="fa fa-home fa-2x" aria-hidden="true"></i></div>
             <div class="col-sm-2"><input type="radio" name="icon" value="fa fa-book fa-fw"><i class="fa fa-book fa-2x" aria-hidden="true"></i></div>
             <div class="col-sm-2"><input type="radio" name="icon" value="fa fa-users fa-fw"><i class="fa fa-users fa-2x" aria-hidden="true"></i></div>
             <div class="col-sm-2"><input type="radio" name="icon" value="fa fa-fax fa-fw"><i class="fa fa-fax fa-2x" aria-hidden="true"></i></div>
             <div class="col-sm-2"><input type="radio" name="icon" value="fa fa-folder fa-fw"><i class="fa fa-folder fa-2x" aria-hidden="true"></i></div>
             <div class="col-sm-2"><input type="radio" name="icon" value="fa fa-folder-open  fa-fw"><i class="fa fa-folder-open  fa-2x" aria-hidden="true"></i></div>
             <div class="col-sm-2"><input type="radio" name="icon" value="fa fa-folder-o fa-fw"><i class="fa fa-folder-o fa-2x" aria-hidden="true"></i></div>
             <div class="col-sm-2"><input type="radio" name="icon" value="fa fa-user fa-fw"><i class="fa fa-user fa-2x" aria-hidden="true"></i></div>
             <div class="col-sm-2"><input type="radio" name="icon" value="fa fa-cloud fa-fw"><i class="fa fa-cloud fa-2x" aria-hidden="true"></i></div>
             <div class="col-sm-2"><input type="radio" name="icon" value="fa fa-calendar fa-fw"><i class="fa fa-calendar fa-2x" aria-hidden="true"></i></div>
             <div class="col-sm-2"><input type="radio" name="icon" value="fa fa-building fa-fw"><i class="fa fa-building fa-2x" aria-hidden="true"></i></div>
             <div class="col-sm-2"><input type="radio" name="icon" value="fa fa-bars fa-fw"><i class="fa fa-bars fa-2x" aria-hidden="true"></i></div>
             <div class="col-sm-2"><input type="radio" name="icon" value="fa fa-archive fa-fw"><i class="fa fa-archive fa-2x" aria-hidden="true"></i></div>
             <div class="col-sm-2"><input type="radio" name="icon" value="fa fa-briefcase fa-fw"><i class="fa fa-briefcase fa-2x" aria-hidden="true"></i></div>
             <div class="col-sm-2"><input type="radio" name="icon" value="  fa fa-bank fa-fw"><i class=" fa fa-bank fa-2x" aria-hidden="true"></i></div>
             <div class="col-sm-2"><input type="radio" name="icon" value="  fa fa-bar-chart fa-fw"><i class=" fa fa-bar-chart fa-2x" aria-hidden="true"></i></div>
            <div class="col-sm-2"><input type="radio" name="icon" value="fa fa-bell fa-fw"><i class="fa fa-bell fa-2x" aria-hidden="true"></i></div>
            <div class="col-sm-2"><input type="radio" name="icon" value="fa fa-bookmark fa-fw"><i class="fa fa-bookmark fa-2x" aria-hidden="true"></i></div>
<div class="col-sm-2"><input type="radio" name="icon" value="fa fa-bookmark-o fa-fw"><i class="fa fa-bookmark-o fa-2x" aria-hidden="true"></i></div>
<div class="col-sm-2"><input type="radio" name="icon" value="fa fa-bug fa-fw"><i class="fa fa-bug fa-2x" aria-hidden="true"></i></div>
<div class="col-sm-2"><input type="radio" name="icon" value="fa fa-bullhorn fa-fw"><i class="fa fa-bullhorn fa-2x" aria-hidden="true"></i></div>
<div class="col-sm-2"><input type="radio" name="icon" value="fa fa-check-square fa-fw"><i class="fa fa-check-square fa-2x" aria-hidden="true"></i></div>
<div class="col-sm-2"><input type="radio" name="icon" value="fa fa-cogs fa-fw"><i class="fa fa-cogs fa-2x" aria-hidden="true"></i></div>
<div class="col-sm-2"><input type="radio" name="icon" value="fa fa-comments fa-fw"><i class="fa fa-comments fa-2x" aria-hidden="true"></i></div>
<div class="col-sm-2"><input type="radio" name="icon" value="fa fa-cube fa-fw"><i class="fa fa-cube fa-2x" aria-hidden="true"></i></div>
<div class="col-sm-2"><input type="radio" name="icon" value="fa fa-cubes fa-fw"><i class="fa fa-cubes fa-2x" aria-hidden="true"></i></div>
<div class="col-sm-2"><input type="radio" name="icon" value="fa fa-database fa-fw"><i class="fa fa-database fa-2x" aria-hidden="true"></i></div>
<div class="col-sm-2"><input type="radio" name="icon" value="fa fa-desktop fa-fw"><i class="fa fa-desktop fa-2x" aria-hidden="true"></i></div>
<div class="col-sm-2"><input type="radio" name="icon" value="fa fa-diamond fa-fw"><i class="fa fa-diamond fa-2x" aria-hidden="true"></i></div>
<div class="col-sm-2"><input type="radio" name="icon" value="fa fa-envelope fa-fw"><i class="fa fa-envelope fa-2x" aria-hidden="true"></i></div>
<div class="col-sm-2"><input type="radio" name="icon" value="fa fa-exclamation-circle fa-fw"><i class="fa fa-exclamation-circle fa-2x" aria-hidden="true"></i></div>
<div class="col-sm-2"><input type="radio" name="icon" value="fa fa-exclamation-triangle fa-fw"><i class="fa fa-exclamation-triangle fa-2x" aria-hidden="true"></i></div>
<div class="col-sm-2"><input type="radio" name="icon" value="fa fa-eye fa-fw"><i class="fa fa-eye fa-2x" aria-hidden="true"></i></div>
<div class="col-sm-2"><input type="radio" name="icon" value="fa fa-graduation-cap fa-fw"><i class="fa fa-graduation-cap fa-2x" aria-hidden="true"></i></div>
<div class="col-sm-2"><input type="radio" name="icon" value="fa fa-heart fa-fw"><i class="fa fa-heart fa-2x" aria-hidden="true"></i></div> 
<div class="col-sm-2"><input type="radio" name="icon" value="fa fa-laptop fa-fw"><i class="fa fa-laptop fa-2x" aria-hidden="true"></i></div> 
<div class="col-sm-2"><input type="radio" name="icon" value="fa fa-recycle fa-fw"><i class="fa fa-recycle fa-2x" aria-hidden="true"></i></div> 
<div class="col-sm-2"><input type="radio" name="icon" value="fa fa-rss fa-fw"><i class="fa fa-rss fa-2x" aria-hidden="true"></i></div> 
<div class="col-sm-2"><input type="radio" name="icon" value="fa fa-rss-square fa-fw"><i class="fa fa-rss-square fa-2x" aria-hidden="true"></i></div> 
<div class="col-sm-2"><input type="radio" name="icon" value="fa fa-server fa-fw"><i class="fa fa-server fa-2x" aria-hidden="true"></i></div> 
<div class="col-sm-2"><input type="radio" name="icon" value="fa fa-shield fa-fw"><i class="fa fa-shield fa-2x" aria-hidden="true"></i></div> 
<div class="col-sm-2"><input type="radio" name="icon" value="fa fa-signal fa-fw"><i class="fa fa-signal fa-2x" aria-hidden="true"></i></div> 
<div class="col-sm-2"><input type="radio" name="icon" value="fa fa-star fa-fw"><i class="fa fa-star fa-2x" aria-hidden="true"></i></div> 
<div class="col-sm-2"><input type="radio" name="icon" value="fa fa-thumb-tack fa-fw"><i class="fa fa-thumb-tack fa-2x" aria-hidden="true"></i></div>
<div class="col-sm-2"><input type="radio" name="icon" value="fa fa-warning fa-fw"><i class="fa fa-warning fa-2x" aria-hidden="true"></i></div> 
<div class="col-sm-2"><input type="radio" name="icon" value="fa fa-user-secret fa-fw"><i class="fa fa-user-secret fa-2x" aria-hidden="true"></i></div> 
<div class="col-sm-2"><input type="radio" name="icon" value="fa fa-user-plus fa-fw"><i class="fa fa-user-plus fa-2x" aria-hidden="true"></i></div> 
<div class="col-sm-2"><input type="radio" name="icon" value="fa fa-unlock-alt fa-fw"><i class="fa fa-unlock-alt fa-2x" aria-hidden="true"></i></div> 
<div class="col-sm-2"><input type="radio" name="icon" value="fa fa-trash fa-fw"><i class="fa fa-trash fa-2x" aria-hidden="true"></i></div> 
<div class="col-sm-2"><input type="radio" name="icon" value="fa fa-thumbs-o-up fa-fw"><i class="fa fa-thumbs-o-up fa-2x" aria-hidden="true"></i></div> 
<div class="col-sm-2"><input type="radio" name="icon" value="fa fa-tags fa-fw"><i class="fa fa-tags fa-2x" aria-hidden="true"></i></div> 
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