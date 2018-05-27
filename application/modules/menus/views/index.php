  <!-- Full Width Column -->
  <div class="content-wrapper" style="min-height: 901px;">
    <div class="container-fluid">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Menus
          <small>Manajemen Users </small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Menus</a></li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="callout callout-info">
          <p>Gunakan Panel Admin sebagaimana anda bertanggung jawab dalam memutuskan tindakan yang anda lakukan .</p>
        </div>
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"> Manajemen Menus</h3>
            </div>
            <!-- /.box-header -->
            <div class="col-sm-12 btn-group form-group">
                <?php if($can_add == 1){?>
                <button class="btn btn-xs btn-success" onclick="add_person()"><i class="glyphicon glyphicon-plus"></i> Tambah</button>
                <?php } ?>
                <button class="btn btn-xs btn-default" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
            </div>
            <div class="box-body">
              <table id="table" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Nama Menu</th>
                  <th>URI</th>
                  <th>Order</th>
                  <th>Tools</th>
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
<div class="modal" id="modal_form">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Tambah Menu</h4>
              </div>
              <div class="modal-body">
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
                    <label class="control-label col-md-3" ></label>
                    <div style="border:0px solid #ccc; width:98% ; height: 170px; overflow-y: scroll; padding-left: 10px;">
                      <div class="contain">
                          <table class="table table-bordered table-striped"> 
                            <thead>
                              <tr>
                                <th width="2%"></th>
                                <th class="text-left">Menu</th>
                              </tr>
                            </thead>
                          <tbody id="treenih">
                      <tr>
                       <td class="text-right">
                        <input type="radio" class="radio" name="parent" value="0" checked>
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
                        <td>
                          <?php echo $tre->menu_nama;?>
                        </td>
                      </tr>
                       <?php }; ?>
                       </tbody>                       
                      </table>
                  </div>
                  </div>
              </div>
              <div style="overflow:scroll; height: 200px;">
  <div class="form-group">
                <label class="col-sm-12">Icon Menu</label>
              <div class="col-sm-1"><input type="radio" name="icon" value="" checked><strong>None</strong></div>
             <div class="col-sm-1"><input type="radio" name="icon" value="fa fa-home fa-fw"><i class="fa fa-home xxx" aria-hidden="true"></i></div>
             <div class="col-sm-1"><input type="radio" name="icon" value="fa fa-book fa-fw"><i class="fa fa-book xxx" aria-hidden="true"></i></div>
             <div class="col-sm-1"><input type="radio" name="icon" value="fa fa-users fa-fw"><i class="fa fa-users xxx" aria-hidden="true"></i></div>
             <div class="col-sm-1"><input type="radio" name="icon" value="fa fa-fax fa-fw"><i class="fa fa-fax xxx" aria-hidden="true"></i></div>
             <div class="col-sm-1"><input type="radio" name="icon" value="fa fa-folder fa-fw"><i class="fa fa-folder xxx" aria-hidden="true"></i></div>
             <div class="col-sm-1"><input type="radio" name="icon" value="fa fa-folder-open  fa-fw"><i class="fa fa-folder-open  xxx" aria-hidden="true"></i></div>
             <div class="col-sm-1"><input type="radio" name="icon" value="fa fa-folder-o fa-fw"><i class="fa fa-folder-o xxx" aria-hidden="true"></i></div>
             <div class="col-sm-1"><input type="radio" name="icon" value="fa fa-user fa-fw"><i class="fa fa-user xxx" aria-hidden="true"></i></div>
             <div class="col-sm-1"><input type="radio" name="icon" value="fa fa-cloud fa-fw"><i class="fa fa-cloud xxx" aria-hidden="true"></i></div>
             <div class="col-sm-1"><input type="radio" name="icon" value="fa fa-calendar fa-fw"><i class="fa fa-calendar xxx" aria-hidden="true"></i></div>
             <div class="col-sm-1"><input type="radio" name="icon" value="fa fa-building fa-fw"><i class="fa fa-building xxx" aria-hidden="true"></i></div>
             <div class="col-sm-1"><input type="radio" name="icon" value="fa fa-bars fa-fw"><i class="fa fa-bars xxx" aria-hidden="true"></i></div>
             <div class="col-sm-1"><input type="radio" name="icon" value="fa fa-archive fa-fw"><i class="fa fa-archive xxx" aria-hidden="true"></i></div>
             <div class="col-sm-1"><input type="radio" name="icon" value="fa fa-briefcase fa-fw"><i class="fa fa-briefcase xxx" aria-hidden="true"></i></div>
             <div class="col-sm-1"><input type="radio" name="icon" value="  fa fa-bank fa-fw"><i class=" fa fa-bank xxx" aria-hidden="true"></i></div>
             <div class="col-sm-1"><input type="radio" name="icon" value="  fa fa-bar-chart fa-fw"><i class=" fa fa-bar-chart xxx" aria-hidden="true"></i></div>
            <div class="col-sm-1"><input type="radio" name="icon" value="fa fa-bell fa-fw"><i class="fa fa-bell xxx" aria-hidden="true"></i></div>
            <div class="col-sm-1"><input type="radio" name="icon" value="fa fa-bookmark fa-fw"><i class="fa fa-bookmark xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-bookmark-o fa-fw"><i class="fa fa-bookmark-o xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-bug fa-fw"><i class="fa fa-bug xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-bullhorn fa-fw"><i class="fa fa-bullhorn xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-check-square fa-fw"><i class="fa fa-check-square xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-cogs fa-fw"><i class="fa fa-cogs xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-comments fa-fw"><i class="fa fa-comments xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-cube fa-fw"><i class="fa fa-cube xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-cubes fa-fw"><i class="fa fa-cubes xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-database fa-fw"><i class="fa fa-database xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-desktop fa-fw"><i class="fa fa-desktop xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-diamond fa-fw"><i class="fa fa-diamond xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-envelope fa-fw"><i class="fa fa-envelope xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-exclamation-circle fa-fw"><i class="fa fa-exclamation-circle xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-exclamation-triangle fa-fw"><i class="fa fa-exclamation-triangle xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-eye fa-fw"><i class="fa fa-eye xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-graduation-cap fa-fw"><i class="fa fa-graduation-cap xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-heart fa-fw"><i class="fa fa-heart xxx" aria-hidden="true"></i></div> 
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-laptop fa-fw"><i class="fa fa-laptop xxx" aria-hidden="true"></i></div> 
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-recycle fa-fw"><i class="fa fa-recycle xxx" aria-hidden="true"></i></div> 
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-rss fa-fw"><i class="fa fa-rss xxx" aria-hidden="true"></i></div> 
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-rss-square fa-fw"><i class="fa fa-rss-square xxx" aria-hidden="true"></i></div> 
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-server fa-fw"><i class="fa fa-server xxx" aria-hidden="true"></i></div> 
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-shield fa-fw"><i class="fa fa-shield xxx" aria-hidden="true"></i></div> 
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-signal fa-fw"><i class="fa fa-signal xxx" aria-hidden="true"></i></div> 
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-star fa-fw"><i class="fa fa-star xxx" aria-hidden="true"></i></div> 
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-thumb-tack fa-fw"><i class="fa fa-thumb-tack xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-warning fa-fw"><i class="fa fa-warning xxx" aria-hidden="true"></i></div> 
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-user-secret fa-fw"><i class="fa fa-user-secret xxx" aria-hidden="true"></i></div> 
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-user-plus fa-fw"><i class="fa fa-user-plus xxx" aria-hidden="true"></i></div> 
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-unlock-alt fa-fw"><i class="fa fa-unlock-alt xxx" aria-hidden="true"></i></div> 
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-trash fa-fw"><i class="fa fa-trash xxx" aria-hidden="true"></i></div> 
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-thumbs-o-up fa-fw"><i class="fa fa-thumbs-o-up xxx" aria-hidden="true"></i></div> 
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-tags fa-fw"><i class="fa fa-tags xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-address-book fa-fw"><i class="fa fa-address-book xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-address-book-o fa-fw"><i class="fa fa-address-book-o xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-address-card fa-fw"><i class="fa fa-address-card xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-address-card-o fa-fw"><i class="fa fa-address-card-o xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-adjust fa-fw"><i class="fa fa-adjust xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-american-sign-language-interpreting fa-fw"><i class="fa fa-american-sign-language-interpreting xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-anchor fa-fw"><i class="fa fa-anchor xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-archive fa-fw"><i class="fa fa-archive xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-area-chart fa-fw"><i class="fa fa-area-chart xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-arrows fa-fw"><i class="fa fa-arrows xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-arrows-h fa-fw"><i class="fa fa-arrows-h xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-arrows-v fa-fw"><i class="fa fa-arrows-v xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-asl-interpreting fa-fw"><i class="fa fa-asl-interpreting xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-assistive-listening-systems fa-fw"><i class="fa fa-assistive-listening-systems xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-asterisk fa-fw"><i class="fa fa-asterisk xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-at fa-fw"><i class="fa fa-at xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-automobile fa-fw"><i class="fa fa-automobile xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-audio-description fa-fw"><i class="fa fa-audio-description xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-balance-scale fa-fw"><i class="fa fa-balance-scale xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-ban fa-fw"><i class="fa fa-ban xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-bank fa-fw"><i class="fa fa-bank xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-bar-chart fa-fw"><i class="fa fa-bar-chart xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-bar-chart-o fa-fw"><i class="fa fa-bar-chart-o xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-barcode fa-fw"><i class="fa fa-barcode xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-bars fa-fw"><i class="fa fa-bars xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-bath fa-fw"><i class="fa fa-bath xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-bathtub fa-fw"><i class="fa fa-bathtub xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-battery-0 fa-fw"><i class="fa fa-battery-0 xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-battery-1 fa-fw"><i class="fa fa-battery-1 xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-battery-2 fa-fw"><i class="fa fa-battery-2 xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-battery-3 fa-fw"><i class="fa fa-battery-3 xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-battery-4 fa-fw"><i class="fa fa-battery-4 xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-battery-empty fa-fw"><i class="fa fa-battery-empty xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-battery-full fa-fw"><i class="fa fa-battery-full xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-battery-half fa-fw"><i class="fa fa-battery-half xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-battery-quarter fa-fw"><i class="fa fa-battery-quarter xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-battery-three-quarters fa-fw"><i class="fa fa-battery-three-quarters xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-bed fa-fw"><i class="fa fa-bed xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-beer fa-fw"><i class="fa fa-beer xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-bell fa-fw"><i class="fa fa-bell xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-bell-o fa-fw"><i class="fa fa-bell-o xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-bell-slash fa-fw"><i class="fa fa-bell-slash xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-bell-slash-o fa-fw"><i class="fa fa-bell-slash-o xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-bicycle fa-fw"><i class="fa fa-bicycle xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-binoculars fa-fw"><i class="fa fa-binoculars xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-birthday-cake fa-fw"><i class="fa fa-birthday-cake xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-blind fa-fw"><i class="fa fa-blind xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-bolt fa-fw"><i class="fa fa-bolt xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-bomb fa-fw"><i class="fa fa-bomb xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-book fa-fw"><i class="fa fa-book xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-bookmark fa-fw"><i class="fa fa-bookmark xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-bookmark-o fa-fw"><i class="fa fa-bookmark-o xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-braille fa-fw"><i class="fa fa-braille xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-briefcase fa-fw"><i class="fa fa-briefcase xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-bug fa-fw"><i class="fa fa-bug xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-building fa-fw"><i class="fa fa-building xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-building-o fa-fw"><i class="fa fa-building-o xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-bullhorn fa-fw"><i class="fa fa-bullhorn xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-bullseye fa-fw"><i class="fa fa-bullseye xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-bus fa-fw"><i class="fa fa-bus xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-cab fa-fw"><i class="fa fa-cab xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-calculator fa-fw"><i class="fa fa-calculator xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-calendar fa-fw"><i class="fa fa-calendar xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-calendar-o fa-fw"><i class="fa fa-calendar-o xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-calendar-check-o fa-fw"><i class="fa fa-calendar-check-o xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-calendar-minus-o fa-fw"><i class="fa fa-calendar-minus-o xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-calendar-plus-o fa-fw"><i class="fa fa-calendar-plus-o xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-calendar-times-o fa-fw"><i class="fa fa-calendar-times-o xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-camera fa-fw"><i class="fa fa-camera xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-camera-retro fa-fw"><i class="fa fa-camera-retro xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-car fa-fw"><i class="fa fa-car xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-caret-square-o-down fa-fw"><i class="fa fa-caret-square-o-down xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-caret-square-o-left fa-fw"><i class="fa fa-caret-square-o-left xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-caret-square-o-right fa-fw"><i class="fa fa-caret-square-o-right xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-caret-square-o-up fa-fw"><i class="fa fa-caret-square-o-up xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-cart-arrow-down fa-fw"><i class="fa fa-cart-arrow-down xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-cart-plus fa-fw"><i class="fa fa-cart-plus xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-cc fa-fw"><i class="fa fa-cc xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-certificate fa-fw"><i class="fa fa-certificate xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-check fa-fw"><i class="fa fa-check xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-check-circle fa-fw"><i class="fa fa-check-circle xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-check-circle-o fa-fw"><i class="fa fa-check-circle-o xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-check-square fa-fw"><i class="fa fa-check-square xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-check-square-o fa-fw"><i class="fa fa-check-square-o xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-child fa-fw"><i class="fa fa-child xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-circle fa-fw"><i class="fa fa-circle xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-circle-o fa-fw"><i class="fa fa-circle-o xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-circle-o-notch fa-fw"><i class="fa fa-circle-o-notch xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-circle-thin fa-fw"><i class="fa fa-circle-thin xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-clock-o fa-fw"><i class="fa fa-clock-o xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-clone fa-fw"><i class="fa fa-clone xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-close fa-fw"><i class="fa fa-close xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-cloud fa-fw"><i class="fa fa-cloud xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-cloud-download fa-fw"><i class="fa fa-cloud-download xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-cloud-upload fa-fw"><i class="fa fa-cloud-upload xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-code fa-fw"><i class="fa fa-code xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-code-fork fa-fw"><i class="fa fa-code-fork xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-coffee fa-fw"><i class="fa fa-coffee xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-cog fa-fw"><i class="fa fa-cog xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-cogs fa-fw"><i class="fa fa-cogs xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-comment fa-fw"><i class="fa fa-comment xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-comment-o fa-fw"><i class="fa fa-comment-o xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-comments fa-fw"><i class="fa fa-comments xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-comments-o fa-fw"><i class="fa fa-comments-o xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-commenting fa-fw"><i class="fa fa-commenting xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-commenting-o fa-fw"><i class="fa fa-commenting-o xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-compass fa-fw"><i class="fa fa-compass xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-copyright fa-fw"><i class="fa fa-copyright xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-credit-card fa-fw"><i class="fa fa-credit-card xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-credit-card-alt fa-fw"><i class="fa fa-credit-card-alt xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-creative-commons fa-fw"><i class="fa fa-creative-commons xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-crop fa-fw"><i class="fa fa-crop xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-crosshairs fa-fw"><i class="fa fa-crosshairs xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-cube fa-fw"><i class="fa fa-cube xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-cubes fa-fw"><i class="fa fa-cubes xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-cutlery fa-fw"><i class="fa fa-cutlery xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-dashboard fa-fw"><i class="fa fa-dashboard xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-database fa-fw"><i class="fa fa-database xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-deaf fa-fw"><i class="fa fa-deaf xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-deafness fa-fw"><i class="fa fa-deafness xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-desktop fa-fw"><i class="fa fa-desktop xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-diamond fa-fw"><i class="fa fa-diamond xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-dot-circle-o fa-fw"><i class="fa fa-dot-circle-o xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-download fa-fw"><i class="fa fa-download xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-drivers-license fa-fw"><i class="fa fa-drivers-license xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-drivers-license-o fa-fw"><i class="fa fa-drivers-license-o xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-edit fa-fw"><i class="fa fa-edit xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-ellipsis-h fa-fw"><i class="fa fa-ellipsis-h xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-ellipsis-v fa-fw"><i class="fa fa-ellipsis-v xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-envelope fa-fw"><i class="fa fa-envelope xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-envelope-o fa-fw"><i class="fa fa-envelope-o xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-envelope-open fa-fw"><i class="fa fa-envelope-open xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-envelope-open-o fa-fw"><i class="fa fa-envelope-open-o xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-envelope-square fa-fw"><i class="fa fa-envelope-square xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-eraser fa-fw"><i class="fa fa-eraser xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-exchange fa-fw"><i class="fa fa-exchange xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-exclamation fa-fw"><i class="fa fa-exclamation xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-exclamation-circle fa-fw"><i class="fa fa-exclamation-circle xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-exclamation-triangle fa-fw"><i class="fa fa-exclamation-triangle xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-external-link fa-fw"><i class="fa fa-external-link xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-external-link-square fa-fw"><i class="fa fa-external-link-square xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-eye fa-fw"><i class="fa fa-eye xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-eye-slash fa-fw"><i class="fa fa-eye-slash xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-eyedropper fa-fw"><i class="fa fa-eyedropper xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-fax fa-fw"><i class="fa fa-fax xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-female fa-fw"><i class="fa fa-female xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-fighter-jet fa-fw"><i class="fa fa-fighter-jet xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-file-archive-o fa-fw"><i class="fa fa-file-archive-o xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-file-audio-o fa-fw"><i class="fa fa-file-audio-o xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-file-code-o fa-fw"><i class="fa fa-file-code-o xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-file-excel-o fa-fw"><i class="fa fa-file-excel-o xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-file-image-o fa-fw"><i class="fa fa-file-image-o xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-file-movie-o fa-fw"><i class="fa fa-file-movie-o xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-file-pdf-o fa-fw"><i class="fa fa-file-pdf-o xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-file-photo-o fa-fw"><i class="fa fa-file-photo-o xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-file-picture-o fa-fw"><i class="fa fa-file-picture-o xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-file-powerpoint-o fa-fw"><i class="fa fa-file-powerpoint-o xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-file-sound-o fa-fw"><i class="fa fa-file-sound-o xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-file-video-o fa-fw"><i class="fa fa-file-video-o xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-file-word-o fa-fw"><i class="fa fa-file-word-o xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-file-zip-o fa-fw"><i class="fa fa-file-zip-o xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-film fa-fw"><i class="fa fa-film xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-filter fa-fw"><i class="fa fa-filter xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-fire fa-fw"><i class="fa fa-fire xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-fire-extinguisher fa-fw"><i class="fa fa-fire-extinguisher xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-flag fa-fw"><i class="fa fa-flag xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-flag-checkered fa-fw"><i class="fa fa-flag-checkered xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-flag-o fa-fw"><i class="fa fa-flag-o xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-flash fa-fw"><i class="fa fa-flash xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-flask fa-fw"><i class="fa fa-flask xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-folder fa-fw"><i class="fa fa-folder xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-folder-o fa-fw"><i class="fa fa-folder-o xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-folder-open fa-fw"><i class="fa fa-folder-open xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-folder-open-o fa-fw"><i class="fa fa-folder-open-o xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-frown-o fa-fw"><i class="fa fa-frown-o xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-futbol-o fa-fw"><i class="fa fa-futbol-o xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-gamepad fa-fw"><i class="fa fa-gamepad xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-gavel fa-fw"><i class="fa fa-gavel xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-gear fa-fw"><i class="fa fa-gear xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-gears fa-fw"><i class="fa fa-gears xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-genderless fa-fw"><i class="fa fa-genderless xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-gift fa-fw"><i class="fa fa-gift xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-glass fa-fw"><i class="fa fa-glass xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-globe fa-fw"><i class="fa fa-globe xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-graduation-cap fa-fw"><i class="fa fa-graduation-cap xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-group fa-fw"><i class="fa fa-group xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-hard-of-hearing fa-fw"><i class="fa fa-hard-of-hearing xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-hdd-o fa-fw"><i class="fa fa-hdd-o xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-handshake-o fa-fw"><i class="fa fa-handshake-o xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-hashtag fa-fw"><i class="fa fa-hashtag xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-headphones fa-fw"><i class="fa fa-headphones xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-heart fa-fw"><i class="fa fa-heart xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-heart-o fa-fw"><i class="fa fa-heart-o xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-heartbeat fa-fw"><i class="fa fa-heartbeat xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-history fa-fw"><i class="fa fa-history xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-home fa-fw"><i class="fa fa-home xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-hotel fa-fw"><i class="fa fa-hotel xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-hourglass fa-fw"><i class="fa fa-hourglass xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-hourglass-1 fa-fw"><i class="fa fa-hourglass-1 xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-hourglass-2 fa-fw"><i class="fa fa-hourglass-2 xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-hourglass-3 fa-fw"><i class="fa fa-hourglass-3 xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-hourglass-end fa-fw"><i class="fa fa-hourglass-end xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-hourglass-half fa-fw"><i class="fa fa-hourglass-half xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-hourglass-o fa-fw"><i class="fa fa-hourglass-o xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-hourglass-start fa-fw"><i class="fa fa-hourglass-start xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-i-cursor fa-fw"><i class="fa fa-i-cursor xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-id-badge fa-fw"><i class="fa fa-id-badge xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-id-card fa-fw"><i class="fa fa-id-card xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-id-card-o fa-fw"><i class="fa fa-id-card-o xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-image fa-fw"><i class="fa fa-image xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-inbox fa-fw"><i class="fa fa-inbox xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-industry fa-fw"><i class="fa fa-industry xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-info fa-fw"><i class="fa fa-info xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-info-circle fa-fw"><i class="fa fa-info-circle xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-institution fa-fw"><i class="fa fa-institution xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-key fa-fw"><i class="fa fa-key xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-keyboard-o fa-fw"><i class="fa fa-keyboard-o xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-language fa-fw"><i class="fa fa-language xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-laptop fa-fw"><i class="fa fa-laptop xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-leaf fa-fw"><i class="fa fa-leaf xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-legal fa-fw"><i class="fa fa-legal xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-lemon-o fa-fw"><i class="fa fa-lemon-o xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-level-down fa-fw"><i class="fa fa-level-down xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-level-up fa-fw"><i class="fa fa-level-up xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-life-bouy fa-fw"><i class="fa fa-life-bouy xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-life-buoy fa-fw"><i class="fa fa-life-buoy xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-life-ring fa-fw"><i class="fa fa-life-ring xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-life-saver fa-fw"><i class="fa fa-life-saver xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-lightbulb-o fa-fw"><i class="fa fa-lightbulb-o xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-line-chart fa-fw"><i class="fa fa-line-chart xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-location-arrow fa-fw"><i class="fa fa-location-arrow xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-lock fa-fw"><i class="fa fa-lock xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-low-vision fa-fw"><i class="fa fa-low-vision xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-magic fa-fw"><i class="fa fa-magic xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-magnet fa-fw"><i class="fa fa-magnet xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-mail-forward fa-fw"><i class="fa fa-mail-forward xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-mail-reply fa-fw"><i class="fa fa-mail-reply xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-mail-reply-all fa-fw"><i class="fa fa-mail-reply-all xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-male fa-fw"><i class="fa fa-male xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-map fa-fw"><i class="fa fa-map xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-map-o fa-fw"><i class="fa fa-map-o xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-map-pin fa-fw"><i class="fa fa-map-pin xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-map-signs fa-fw"><i class="fa fa-map-signs xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-map-marker fa-fw"><i class="fa fa-map-marker xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-meh-o fa-fw"><i class="fa fa-meh-o xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-microchip fa-fw"><i class="fa fa-microchip xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-microphone fa-fw"><i class="fa fa-microphone xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-microphone-slash fa-fw"><i class="fa fa-microphone-slash xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-minus fa-fw"><i class="fa fa-minus xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-minus-circle fa-fw"><i class="fa fa-minus-circle xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-minus-square fa-fw"><i class="fa fa-minus-square xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-minus-square-o fa-fw"><i class="fa fa-minus-square-o xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-mobile fa-fw"><i class="fa fa-mobile xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-mobile-phone fa-fw"><i class="fa fa-mobile-phone xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-money fa-fw"><i class="fa fa-money xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-moon-o fa-fw"><i class="fa fa-moon-o xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-mortar-board fa-fw"><i class="fa fa-mortar-board xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-motorcycle fa-fw"><i class="fa fa-motorcycle xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-mouse-pointer fa-fw"><i class="fa fa-mouse-pointer xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-music fa-fw"><i class="fa fa-music xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-navicon fa-fw"><i class="fa fa-navicon xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-newspaper-o fa-fw"><i class="fa fa-newspaper-o xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-object-group fa-fw"><i class="fa fa-object-group xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-object-ungroup fa-fw"><i class="fa fa-object-ungroup xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-paint-brush fa-fw"><i class="fa fa-paint-brush xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-paper-plane fa-fw"><i class="fa fa-paper-plane xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-paper-plane-o fa-fw"><i class="fa fa-paper-plane-o xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-paw fa-fw"><i class="fa fa-paw xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-pencil fa-fw"><i class="fa fa-pencil xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-pencil-square fa-fw"><i class="fa fa-pencil-square xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-pencil-square-o fa-fw"><i class="fa fa-pencil-square-o xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-percent fa-fw"><i class="fa fa-percent xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-phone fa-fw"><i class="fa fa-phone xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-phone-square fa-fw"><i class="fa fa-phone-square xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-photo fa-fw"><i class="fa fa-photo xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-picture-o fa-fw"><i class="fa fa-picture-o xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-pie-chart fa-fw"><i class="fa fa-pie-chart xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-plane fa-fw"><i class="fa fa-plane xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-plug fa-fw"><i class="fa fa-plug xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-plus fa-fw"><i class="fa fa-plus xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-plus-circle fa-fw"><i class="fa fa-plus-circle xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-plus-square fa-fw"><i class="fa fa-plus-square xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-plus-square-o fa-fw"><i class="fa fa-plus-square-o xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-podcast fa-fw"><i class="fa fa-podcast xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-power-off fa-fw"><i class="fa fa-power-off xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-print fa-fw"><i class="fa fa-print xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-puzzle-piece fa-fw"><i class="fa fa-puzzle-piece xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-qrcode fa-fw"><i class="fa fa-qrcode xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-question fa-fw"><i class="fa fa-question xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-question-circle fa-fw"><i class="fa fa-question-circle xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-question-circle-o fa-fw"><i class="fa fa-question-circle-o xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-quote-left fa-fw"><i class="fa fa-quote-left xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-quote-right fa-fw"><i class="fa fa-quote-right xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-random fa-fw"><i class="fa fa-random xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-recycle fa-fw"><i class="fa fa-recycle xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-refresh fa-fw"><i class="fa fa-refresh xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-registered fa-fw"><i class="fa fa-registered xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-remove fa-fw"><i class="fa fa-remove xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-reorder fa-fw"><i class="fa fa-reorder xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-reply fa-fw"><i class="fa fa-reply xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-reply-all fa-fw"><i class="fa fa-reply-all xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-retweet fa-fw"><i class="fa fa-retweet xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-road fa-fw"><i class="fa fa-road xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-rocket fa-fw"><i class="fa fa-rocket xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-rss fa-fw"><i class="fa fa-rss xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-rss-square fa-fw"><i class="fa fa-rss-square xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-s15 fa-fw"><i class="fa fa-s15 xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-search fa-fw"><i class="fa fa-search xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-search-minus fa-fw"><i class="fa fa-search-minus xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-search-plus fa-fw"><i class="fa fa-search-plus xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-send fa-fw"><i class="fa fa-send xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-send-o fa-fw"><i class="fa fa-send-o xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-server fa-fw"><i class="fa fa-server xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-share fa-fw"><i class="fa fa-share xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-share-alt fa-fw"><i class="fa fa-share-alt xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-share-alt-square fa-fw"><i class="fa fa-share-alt-square xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-share-square fa-fw"><i class="fa fa-share-square xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-share-square-o fa-fw"><i class="fa fa-share-square-o xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-shield fa-fw"><i class="fa fa-shield xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-ship fa-fw"><i class="fa fa-ship xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-shopping-bag fa-fw"><i class="fa fa-shopping-bag xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-shopping-basket fa-fw"><i class="fa fa-shopping-basket xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-shopping-cart fa-fw"><i class="fa fa-shopping-cart xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-shower fa-fw"><i class="fa fa-shower xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-sign-in fa-fw"><i class="fa fa-sign-in xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-sign-out fa-fw"><i class="fa fa-sign-out xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-sign-language fa-fw"><i class="fa fa-sign-language xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-signal fa-fw"><i class="fa fa-signal xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-signing fa-fw"><i class="fa fa-signing xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-sitemap fa-fw"><i class="fa fa-sitemap xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-sliders fa-fw"><i class="fa fa-sliders xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-smile-o fa-fw"><i class="fa fa-smile-o xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-snowflake-o fa-fw"><i class="fa fa-snowflake-o xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-soccer-ball-o fa-fw"><i class="fa fa-soccer-ball-o xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-sort fa-fw"><i class="fa fa-sort xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-sort-alpha-asc fa-fw"><i class="fa fa-sort-alpha-asc xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-sort-alpha-desc fa-fw"><i class="fa fa-sort-alpha-desc xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-sort-amount-asc fa-fw"><i class="fa fa-sort-amount-asc xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-sort-amount-desc fa-fw"><i class="fa fa-sort-amount-desc xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-sort-asc fa-fw"><i class="fa fa-sort-asc xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-sort-desc fa-fw"><i class="fa fa-sort-desc xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-sort-down fa-fw"><i class="fa fa-sort-down xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-sort-numeric-asc fa-fw"><i class="fa fa-sort-numeric-asc xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-sort-numeric-desc fa-fw"><i class="fa fa-sort-numeric-desc xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-sort-up fa-fw"><i class="fa fa-sort-up xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-space-shuttle fa-fw"><i class="fa fa-space-shuttle xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-spinner fa-fw"><i class="fa fa-spinner xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-spoon fa-fw"><i class="fa fa-spoon xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-square fa-fw"><i class="fa fa-square xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-square-o fa-fw"><i class="fa fa-square-o xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-star fa-fw"><i class="fa fa-star xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-star-half fa-fw"><i class="fa fa-star-half xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-star-half-empty fa-fw"><i class="fa fa-star-half-empty xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-star-half-full fa-fw"><i class="fa fa-star-half-full xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-star-half-o fa-fw"><i class="fa fa-star-half-o xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-star-o fa-fw"><i class="fa fa-star-o xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-sticky-note fa-fw"><i class="fa fa-sticky-note xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-sticky-note-o fa-fw"><i class="fa fa-sticky-note-o xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-street-view fa-fw"><i class="fa fa-street-view xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-suitcase fa-fw"><i class="fa fa-suitcase xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-sun-o fa-fw"><i class="fa fa-sun-o xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-support fa-fw"><i class="fa fa-support xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-tablet fa-fw"><i class="fa fa-tablet xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-tachometer fa-fw"><i class="fa fa-tachometer xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-tag fa-fw"><i class="fa fa-tag xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-tags fa-fw"><i class="fa fa-tags xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-tasks fa-fw"><i class="fa fa-tasks xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-taxi fa-fw"><i class="fa fa-taxi xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-television fa-fw"><i class="fa fa-television xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-terminal fa-fw"><i class="fa fa-terminal xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-thermometer fa-fw"><i class="fa fa-thermometer xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-thermometer-0 fa-fw"><i class="fa fa-thermometer-0 xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-thermometer-1 fa-fw"><i class="fa fa-thermometer-1 xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-thermometer-2 fa-fw"><i class="fa fa-thermometer-2 xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-thermometer-3 fa-fw"><i class="fa fa-thermometer-3 xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-thermometer-4 fa-fw"><i class="fa fa-thermometer-4 xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-thermometer-empty fa-fw"><i class="fa fa-thermometer-empty xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-thermometer-full fa-fw"><i class="fa fa-thermometer-full xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-thermometer-half fa-fw"><i class="fa fa-thermometer-half xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-thermometer-quarter fa-fw"><i class="fa fa-thermometer-quarter xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-thermometer-three-quarters fa-fw"><i class="fa fa-thermometer-three-quarters xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-thumb-tack fa-fw"><i class="fa fa-thumb-tack xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-thumbs-down fa-fw"><i class="fa fa-thumbs-down xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-thumbs-o-up fa-fw"><i class="fa fa-thumbs-o-up xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-thumbs-up fa-fw"><i class="fa fa-thumbs-up xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-ticket fa-fw"><i class="fa fa-ticket xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-times fa-fw"><i class="fa fa-times xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-times-circle fa-fw"><i class="fa fa-times-circle xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-times-circle-o fa-fw"><i class="fa fa-times-circle-o xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-times-rectangle fa-fw"><i class="fa fa-times-rectangle xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-times-rectangle-o fa-fw"><i class="fa fa-times-rectangle-o xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-tint fa-fw"><i class="fa fa-tint xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-toggle-down fa-fw"><i class="fa fa-toggle-down xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-toggle-left fa-fw"><i class="fa fa-toggle-left xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-toggle-right fa-fw"><i class="fa fa-toggle-right xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-toggle-up fa-fw"><i class="fa fa-toggle-up xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-toggle-off fa-fw"><i class="fa fa-toggle-off xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-toggle-on fa-fw"><i class="fa fa-toggle-on xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-trademark fa-fw"><i class="fa fa-trademark xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-trash fa-fw"><i class="fa fa-trash xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-trash-o fa-fw"><i class="fa fa-trash-o xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-tree fa-fw"><i class="fa fa-tree xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-trophy fa-fw"><i class="fa fa-trophy xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-truck fa-fw"><i class="fa fa-truck xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-tty fa-fw"><i class="fa fa-tty xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-tv fa-fw"><i class="fa fa-tv xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-umbrella fa-fw"><i class="fa fa-umbrella xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-universal-access fa-fw"><i class="fa fa-universal-access xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-university fa-fw"><i class="fa fa-university xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-unlock fa-fw"><i class="fa fa-unlock xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-unlock-alt fa-fw"><i class="fa fa-unlock-alt xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-unsorted fa-fw"><i class="fa fa-unsorted xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-upload fa-fw"><i class="fa fa-upload xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-user fa-fw"><i class="fa fa-user xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-user-circle fa-fw"><i class="fa fa-user-circle xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-user-circle-o fa-fw"><i class="fa fa-user-circle-o xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-user-o fa-fw"><i class="fa fa-user-o xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-user-plus fa-fw"><i class="fa fa-user-plus xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-user-secret fa-fw"><i class="fa fa-user-secret xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-user-times fa-fw"><i class="fa fa-user-times xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-users fa-fw"><i class="fa fa-users xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-vcard fa-fw"><i class="fa fa-vcard xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-vcard-o fa-fw"><i class="fa fa-vcard-o xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-video-camera fa-fw"><i class="fa fa-video-camera xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-volume-control-phone fa-fw"><i class="fa fa-volume-control-phone xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-volume-down fa-fw"><i class="fa fa-volume-down xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-volume-off fa-fw"><i class="fa fa-volume-off xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-volume-up fa-fw"><i class="fa fa-volume-up xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-warning fa-fw"><i class="fa fa-warning xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-wheelchair fa-fw"><i class="fa fa-wheelchair xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-wheelchair-alt fa-fw"><i class="fa fa-wheelchair-alt xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-window-close fa-fw"><i class="fa fa-window-close xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-window-close-o fa-fw"><i class="fa fa-window-close-o xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-window-maximize fa-fw"><i class="fa fa-window-maximize xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-window-minimize fa-fw"><i class="fa fa-window-minimize xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-window-restore fa-fw"><i class="fa fa-window-restore xxx" aria-hidden="true"></i></div>
<div class="col-sm-1"><input type="radio" name="icon" value="fa fa-wifi fa-fw"><i class="fa fa-wifi xxx" aria-hidden="true"></i></div>
        </div>
        </div>
                    </div>
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btnSave" onclick="save()" >Save</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
<!-- / Modal -->

<script type="text/javascript">
 
var save_method; //for save method string
var table;
 
$(document).ready(function() {
 
    //datatables
    table = $('#table').DataTable({ 
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "scrollX" : true,
    
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

function refresh_menu_list() {
     $.ajax({
          type:"POST",
          url: "<?php echo base_url('menus/refresh_menu_list/');?>",
          data: {"das":"das"},
          dataType:"JSON",
          beforeSend: function() 
          { 
           },
          success: function(json){
            $('#treenih').append('<tr><td class="text-right"><input type="radio" class="radio" name="parent" value="0" checked></td><td>Ini Parent Menu</td></tr>');
            $.each(json['data'], function(j, value) {
                  $('#treenih').append('<tr><td class="text-right"><input type="radio" class="radio" name="parent" value="'+value.menu_id+'"></td><td>'+value.menu_nama+'</td></tr>');
                });
          }
      });
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
                $("#treenih").empty();
                refresh_menu_list();
            }else{
              popup(data.msg);
                reload_table();
                $("#treenih").empty();
                refresh_menu_list();
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
function popup(ms = null,timess = null) {
  if(timess == null)
  {
    timess = 3000;
  }
  if(ms == null)
  {
    $().toasty({
        message: "Berhasil",
        autoHide: timess
    }); 
  }else{
    $().toasty({
        message: ms,
        autoHide: timess
    }); 
  } 
}
</script>