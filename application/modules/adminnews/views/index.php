<script src="<?php echo base_url(); ?>assets/temaalus/plugins/ckeditor/ckeditor.js"></script>
<div class="content-wrapper" style="min-height: 901px;">
      
      <section class="content-header">
        <h1>
           <?php echo $title_head; ?>
          <small></small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-home"></i>  <?php echo $title_head; ?></a></li>
        </ol>
      </section>
    

      <section class="content">
        <div class="box box-info" id="marknews" style="display:none;">
            <div class="box-header">
              <h3 class="box-title">Add News
                <small></small>
              </h3>
              <!-- tools box -->
              <div class="pull-right box-tools">
                <!-- <button type="button" class="btn btn-info btn-sm" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                  <i class="fa fa-plus"></i></button> -->
                <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove">
                  <i class="fa fa-times"></i></button>
              </div>
              <!-- /. tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body pad" id="mark_editview">
                <form id="form_add">
                <!-- KONTEN -->
                <div class="form-group">
                <label>Judul Berita</label>
                <input type="text" class="form-control" name="tb_judul">
                </div>
                <div class="form-group">
                <label>Kategori Berita</label>
                <select name="tb_mkb_id" class="form-control">
                <option>Pilih Kategori</option>
                <?php $get_kategori = $this->db->query("SELECT * FROM m_kategori_berita WHERE mkb_status = '0'");
                  foreach ($get_kategori->result() as $key => $value_kategori) { ?>
                <option value="<?php echo $value_kategori->mkb_id; ?>"><?php echo $value_kategori->mkb_nama; ?></option>
                <?php } ?>
                </select>
                </div>
                <div class="form-group">
                <label>Isi Berita</label>
                <textarea id="editor1" name="tb_isi" rows="10" cols="80"></textarea>
                </div>
                <div class="form-group">
                <label>Tag/Keyword Berita</label>
                <input type="text" class="form-control" name="tb_tag">
                </div>
                <!-- END KONTEN -->
                </form>

                <button type="button" onClick="btn_save_add()" class="btn btn-primary">Save changes</button>
                <a href="javascript:" onClick="btn_batal()" class="btn btn-default">Cancel</a>
            </div>
          </div>

        <div class="box box-success" style="border-top:#0771ae 6px solid;">
            <div class="box-header">
                <h3 class="box-title">
                  <a href="javascript:" onClick="btn_modal_add_aksi()" class="btn btn-sm btn-flat btn-primary" style="background:#0771ae;"><i class="fa fa-plus"></i> Add <?php echo $title_head; ?></a>
                  <!-- <a href="javascript:" data-toggle="modal" data-target="#modal_add" onClick="btn_modal_add()" class="btn btn-sm btn-flat btn-primary" style="background:#0771ae;"><i class="fa fa-plus"></i> Add <?php echo $title_head; ?></a> -->
                  <a href="javascript:" onClick="reload_table()" class="btn btn-sm btn-flat btn-default"><i class="fa fa-refresh"></i> Reload</a>
                </h3>
            </div>
            
            <div class="box-body">
              <table id="table" class="table table-bordered table-striped">
              <thead>
                  <tr>
                  <th width="1%">No</th>

                  <th>Judul Berita</th>

                  <th width="100px">Tools</th>
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
  <div class="modal-dialog" style="width:90%;" role="document">
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
        "columnDefs": [
        { 
            "targets": [ -1 ],
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

function btn_modal_add_offline()
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

function btn_modal_edit_offline(id)
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


function btn_modal_add()
{
    $.ajax({
            url: base_url+"adminnews/showadd",
            cache: false,
            indicatorId: '#load_ajax',
            beforeSend: function(){
                $('#load_ajax').fadeIn(100);
                },
            success: function(msg){
                $('#load_ajax').fadeOut(100);
                $("#mark_editview").html(msg);
                $('#marknews').fadeIn(1000);
            }
          });
}

function btn_modal_edit(id)
{
    $.ajax({
            url: base_url+"adminnews/showedit/"+id,
            cache: false,
            indicatorId: '#load_ajax',
            beforeSend: function(){
                $('#load_ajax').fadeIn(100);
                },
            success: function(msg){
                $('#load_ajax').fadeOut(100);
                $("#mark_editview").html(msg);
                $('#marknews').fadeIn(1000);
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
    var art_body = CKEDITOR.instances.editor1.getData();
    /*Nama Form ID*/
    var frm = $('#form_add');
    /*Ajax Model*/
    $.ajax({
        type: "POST",
        url:  base_url+"<?php echo $this->uri->segment(1); ?>/save",
        data: frm.serialize()+"&postartickel="+art_body,
              beforeSend: function(){
                $('#load_ajax').fadeIn(100);
              },
              success: function (data){
                //$('#modal_add').modal('hide');
                $("#load_ajax").fadeOut(100);
                reload_table();
                popup("Data Tersimpan");
                $('#marknews').fadeOut(100);
              }
    });
}

function btn_save_edit()
{
  var art_body = CKEDITOR.instances.editor2.getData();
    /*Nama Form ID*/
    var frm = $('#form_edit');
    /*Ajax Model*/
    $.ajax({
        type: "POST",
        url:  base_url+"<?php echo $this->uri->segment(1); ?>/edit",
        data: frm.serialize()+"&postartickel="+art_body,
              beforeSend: function(){
                $('#load_ajax').fadeIn(100);
              },
              success: function (data){
                //$('#modal_edit').modal('hide');
                $("#load_ajax").fadeOut(100);
                reload_table();
                popup("Data Edit Tersimpan");
                $('#marknews').fadeOut(100);
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

function btn_modal_add_aksi()
{
    $('#marknews').fadeIn(1000);
    btn_modal_add();
}

function btn_batal()
{
    $('#marknews').fadeOut(100); 
}

</script>

