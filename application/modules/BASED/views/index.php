  <!-- Full Width Column -->
  <div class="content-wrapper" style="min-height: 901px;">
    <div class="container-fluid">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          BASED
        </h1>
      </section>

      <!-- Main content -->
      <section class="content">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"> Manajemen BASED</h3>
            </div>
            <!-- /.box-header -->
            <div class="col-sm-12 btn-group form-group">
                <?php if($can_add == 1){?>
                <button class="btn btn-xs btn-success" onclick="add_person()"><i class="glyphicon glyphicon-plus"></i> Add New</button>
                <?php } ?>
                <button class="btn btn-xs btn-default" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
            </div>
            <div class="box-body">
              <table id="table" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th class="text">First Name</th>
                  <th class="text">Last Name</th>
                  <th class="text">Email</th>
                  <th class="text">Groups</th>
                  <th class="text" width="1px">HT</th>
                  <th class="text-center" width="15%">Tools</th>
                </tr>
                </thead>
                <tbody>

                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.container -->
  </div>
  <!-- /.content-wrapper -->

<!--Modal -->
<div class="modal fade" id="modal_form" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Tambah BASED</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal" name="formnih">
                    <input type="hidden" value="" name="id"/> 
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">Username</label>
                            <div class="col-md-9">
                                <input type="text" name="username" class="form-control" placeholder="username">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Job title</label>
                            <div class="col-md-9">
                                <input type="text" name="job" class="form-control" placeholder="Job title">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Email</label>
                            <div class="col-md-9">
                                <input type="email" name="email" class="form-control" placeholder="Email">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Password</label>
                            <div class="col-md-9">
                                <input type="password" name="password" class="form-control" placeholder="Password" id="pw">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Re-Type Password</label>
                            <div class="col-md-9">
                                <input type="password" name="re_password" class="form-control" placeholder="Re-Type Password" id="repw">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">First Name</label>
                            <div class="col-md-9">
                                <input type="text" name="first_name" class="form-control" placeholder="First Name">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Last Name</label>
                            <div class="col-md-9">
                                <input type="text" name="last_name" class="form-control" placeholder="Last Name">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Phone Number</label>
                            <div class="col-md-9">
                                <input type="text" name="phone" class="form-control" placeholder="Phone Number">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Active</label>
                            <div class="col-md-9">
                            <select name="active" class="form-control">
                                <option value="1">Active</option>
                                <option value="0">Deactive</option>
                            </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">HT</label>
                            <div class="col-md-9">
                            <select name="ht" class="form-control">
                                <option value="1">Active</option>
                                <option value="0">Deactive</option>
                            </select>
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
            "url": "<?php echo site_url('BASED/ajax_list')?>",
            "type": "POST"
        },
 
        //Set column definition initialisation properties.
        "columnDefs": [
        { 
            "targets": [ -1 ], //last column
            "orderable": false, //set not orderable
            "className":"text-center",
        },
        ],
        "lengthMenu" : [[10, 25, 100, 1000, -1], [10, 25, 100,1000, "All"]],
    });

});
 
function add_person()
{
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form').modal('show'); // show bootstrap modal
    $('.modal-title').text('Add'); // Set Title to Bootstrap modal title
}
 
function edit_person(id)
{
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
 
    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('BASED/ajax_edit/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="id"]').val(data.data.id);
            $('[name="elama"]').val(data.email);
            $('[name="username"]').val(data.data.username);
            $('[name="job"]').val(data.data.job_title);
            $('[name="email"]').val(data.email);
            $('[name="password"]').val();
            $('[name="re_password"]').val();
            $('[name="first_name"]').val(data.data.first_name);
            $('[name="last_name"]').val(data.data.last_name);
            $('[name="phone"]').val(data.data.phone);
            $('[name="active"]').val(data.data.active);
            $('[name="ht"]').val(data.data.ht);
            $('#form').find(':checkbox[name^="group"]').each(function () {
                    $(this).prop("checked", ($.inArray($(this).val(), data.grup) != -1));
                });
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit'); // Set title to Bootstrap modal title
 
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
        url = "<?php echo site_url('BASED/ajax_add')?>";
    } else {
        url = "<?php echo site_url('BASED/ajax_update')?>";
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
            url : "<?php echo site_url('BASED/ajax_delete')?>/"+id,
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

</script>