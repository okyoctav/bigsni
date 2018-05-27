<?php foreach ($data as $key => $value); ?>
<form id="form_edit">
                <!-- KONTEN -->
                <input type="hidden" name="tb_id" value="<?php echo $value->tb_id; ?>">
                <div class="form-group">
                <label>Judul Berita</label>
                <input type="text" class="form-control" name="tb_judul" value="<?php echo $value->tb_judul; ?>">
                </div>
                <div class="form-group">
                <label>Kategori Berita</label>
                <select name="tb_mkb_id" class="form-control">
                <?php $get_kategori = $this->db->query("SELECT * FROM m_kategori_berita WHERE mkb_status = '0'");
                  foreach ($get_kategori->result() as $key => $value_kategori) { ?>
                  <?php if($value->tb_mkb_id==$value_kategori->mkb_id) { ?>
                		<option value="<?php echo $value_kategori->mkb_id; ?>" selected><?php echo $value_kategori->mkb_nama; ?></option>
                  <?php } else { ?>
                  		<option value="<?php echo $value_kategori->mkb_id; ?>"><?php echo $value_kategori->mkb_nama; ?></option>
                  <?php } ?>
                <?php } ?>
                </select>
                </div>
                <div class="form-group">
                <label>Isi Berita</label>
                <textarea id="editor2" name="tb_isi" rows="10" cols="80"><?php echo $value->tb_isi; ?></textarea>
                </div>
                <div class="form-group">
                <label>Tag/Keyword Berita</label>
                <input type="text" class="form-control" name="tb_tag" value="<?php echo $value->tb_tag; ?>">
                </div>
                <!-- END KONTEN -->
                </form>

                <button type="button" onClick="btn_save_edit()" class="btn btn-primary">Save changes</button>
                <a href="javascript:" onClick="btn_batal()" class="btn btn-default">Cancel</a>


                <script>
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('editor2')
    //bootstrap WYSIHTML5 - text editor
    //$('.textarea').wysihtml5()
  })
</script>