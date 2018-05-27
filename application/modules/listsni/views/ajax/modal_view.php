    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><?php echo $title; ?></h4>
      </div>
      <div class="modal-body">
       <!-- QUERY -->
       <?php
       		$getdata = $this->db->query("SELECT * FROM m_bigsni WHERE mbs_id='".$id."'");
       		foreach ($getdata->result() as $key => $value);
       ?>
       <!-- QUERY END -->

<!-- DATA VIWE -->
		<form id="form_add" class="form-horizontal">
    	<!-- KONTEN -->
    		    <input type="hidden" readonly class="form-control" style="background-color:#fffec7;cursor: not-allowed;" name="mbs_syscode" value="<?php echo $this->alus_auth->get_code('SN-SNI'); ?>">
      
        <div class="form-group">
          <label class="col-sm-12">Nomor SNI</label>
          <div class="col-sm-12">
           <?php echo $value->mbs_kodesni; ?>
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-6">Tahun</label>
          <label class="col-sm-6">ICS</label>
          <div class="col-sm-6">
            <?php echo $value->mbs_tahun; ?>
          </div>
          <div class="col-sm-6">
            <?php echo $value->mbs_ics; ?>
          </div>
        </div>
        
        <div class="form-group">
          <label class="col-sm-12">Judul SNI</label>
          <div class="col-sm-12">
            <?php echo $value->mbs_namesni; ?>
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-12">Judul ISO</label>
          <div class="col-sm-12">
           <?php echo $value->mbs_nameiso; ?>
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-6">PNP</label>
          <label class="col-sm-6">Konsensus</label>
          <div class="col-sm-6">
            <?php echo $value->mbs_pnp; ?>
          </div>
          <div class="col-sm-6">
            <?php echo $value->mbs_konsensus; ?>
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-6">Jajak Pendapat</label>
          <label class="col-sm-6">Tanggal Penetapan</label>
          <div class="col-sm-6">
            <?php echo $value->mbs_jajakpendapat; ?>
          </div>
          <div class="col-sm-6">
            <?php echo date('d F Y',strtotime($value->mbs_tanggalpenetapan)); ?>
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-6">SK Penetapan</label>
          <label class="col-sm-6">Keterangan</label>
          <div class="col-sm-6">
            <?php echo $value->mbs_sk_penetapan; ?>
          </div>
          <div class="col-sm-6">
            <?php echo $value->mbs_keterangan; ?>
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-6">Klasifikasi</label>
          <label class="col-sm-6">Klas</label>
          <div class="col-sm-6">
            <?php echo $value->mbs_klasifikasi; ?>
          </div>
          <div class="col-sm-6">
            <?php echo $value->mbs_klas; ?>
          </div>
        </div>

    	<!-- END KONTEN -->
    </form>
		
<!-- END VIWE -->

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>