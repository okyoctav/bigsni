<script type="text/javascript" src="<?php echo base_url('assets/temaalus/dist/js/chat.js');?>"></script>

  <!-- Full Width Column -->
  <div class="content-wrapper" style="min-height: 901px;">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Chats
          <small>Let's Chat </small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Chats</a></li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"> chats</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="col-md-12">
                <div class="col-md-4">
                  <div class="box box-warning direct-chat direct-chat-warning">
                    <div class="box-header with-border">
                      <h3 class="box-title">Daftar User</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                      <!-- Conversations are loaded here -->
                      <ul class="users-list clearfix">
                      <li >
                        <img src="<?php echo base_url('assets/temaalus/dist/img/avatar04.png');?>" alt="Public">
                        <a class="users-list-name" href="#" onclick="chatwith('ZZ','Public','ZZ')" title="Chat Room Public">Public</a>
                        <span class="users-list-date" title="Public">Public</span>
                      </li>
                      <?php 
                      $namanya = $this->session->userdata('first_name').' '.$this->session->userdata('last_name');
                      $listusers = $this->alus_auth->users()->result();
                      foreach ($listusers as $list) { 
                        if($list->id == $this->session->userdata('user_id')){
                          }else{;?>
                        <li >
                          <img src="<?php echo base_url('assets/temaalus/dist/img/avatar5.png');?>" alt="<?php echo $list->first_name." ".$list->last_name;?>">
                          <a class="users-list-name" href="#" onclick="chatwith('<?php echo $this->session->userdata('user_id').$list->id;?>','<?php echo $list->first_name.' '.$list->last_name;?>','<?php echo $list->id.$this->session->userdata('user_id');?>')" title="<?php echo $list->first_name." ".$list->last_name;?>"><?php echo $list->first_name." ".$list->last_name;?></a>
                          <span class="users-list-date" title="<?php echo $list->job_title;?>"><?php echo $list->job_title;?></span>
                        </li>
                      <?php 
                        };}
                      ?>
                      </ul>
                     <!-- /.direct-chat-pane -->
                    </div>
                <!-- /.box-body -->
                  </div>
                </div>
                <div class="col-md-8" id="chatrom">
                  <div class="box box-success direct-chat direct-chat-warning">
                    <div class="box-header with-border">
                      <center><h3 class="box-title" id="boxtitlechat">-- Chat Room with Public --</h3></center>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                      <!-- Conversations are loaded here -->
                      <div class="direct-chat-messages">
                        <div id="chat-wrap">
                          <div id="chat-area">
                          </div>
                        </div>
                      </div>
                     <!-- /.direct-chat-pane -->
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                      <form id="send-message-area">
                        <div class="input-group">
                          <input type="text" name="message" id="sendie" maxlength = '100' placeholder="Type Message ..." class="form-control">
                              <span class="input-group-btn">
                                <button type="button" onclick="sendnih()" class="btn btn-success btn-flat">Send</button>
                              </span>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
      </section>
      <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


<script type="text/javascript">
var chat =  new Chat();
tipe = "ZZ";
tipedua = "ZZ";
name = "<?php echo $this->session->userdata('first_name').' '.$this->session->userdata('last_name');?>";
$(document).ready(function(){
  
  chat.getState(tipe,tipedua); 

  setInterval(function(){
    chat.update(tipe,tipedua); 
  },1000);

  $('#sendie').keypress(function (e) {
  if (e.which == 13) {
    e.preventDefault();
    chat.send($('#sendie').val(),name, tipe,tipedua);
    $("#sendie").val('');
  }
  });
});

function sendnih() {
    chat.send($('#sendie').val(),name,tipe,tipedua);
    $("#sendie").val('');
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

function chatwith(iduser,namauser,iduserbalik) {
  popup("Memulai Percakapan ...");
  tipe = iduser;
  tipedua = iduserbalik
  chat.getState(tipe,tipedua); 
  $("#chat-area").empty();
  $("#boxtitlechat").text('Chat Room with '+namauser);
}
</script>


