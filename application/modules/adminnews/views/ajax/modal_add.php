<script src="<?php echo base_url(); ?>assets/temaalus/plugins/ckeditor/ckeditor.js"></script>

<div class="modal-content">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="myModalLabel"><?php echo $title; ?></h4>
  </div>
  <div class="modal-body">
    <!-- FORM -->
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
    <!-- END FORM -->
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    <button type="button" onClick="btn_save_add()" class="btn btn-primary">Save changes</button>
  </div>
</div>
<script>
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('editor1')
    //bootstrap WYSIHTML5 - text editor
    //$('.textarea').wysihtml5()
  })
</script>