<style type="text/css">
thead, tbody { display: block; }

tbody {
    /* height: 100px; */       /* Just for the demo          */
    overflow-y: auto;    /* Trigger vertical scroll    */
    overflow-x: auto;  /* Hide the horizontal scroll */
}
</style>
  <!-- Full Width Column -->
  <div class="content-wrapper" style="min-height: 901px;">
      <!-- Main content -->
      <section class="content">
       <div class="row">
        <div class="col-md-12 text-center">
            <br/>
            <br/>
            <br/>
            <div class="error-template">
                <h1>
                    Oops!
                </h1>
                <h2>
                    404 Not Found</h2>
                <div class="error-details">
                    Sorry, an error has occured, Requested page not found!
                </div>
                <br/>
                <div class="error-actions">
                    <a href="<?php echo base_url();?>" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-home"></span>
                        Take Me Home </a>

                </div>
            </div>
        </div>
    </div>

      </section>
      <!-- /.content -->
  </div>

