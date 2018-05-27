<!DOCTYPE html>
<html>
  <script src="<?php echo base_url(); ?>assets/temaalus/plugins/jQuery/jquery-2.2.3.min.js"></script>
<head>
  <title>asd</title>
</head>
<body>
<script type="text/javascript">
  function encg()
    {
      var txt = $("#enc").val();
     $.ajax({
          type:"POST",
          url: "<?php echo base_url('enc/encrypt2')?>/",
          data:{"teks":txt},
          dataType:"JSON",
          success: function(json){
            $("#dec").val(json)

          }
      });
    }
    function decs()
    {
      var as = $("#dec").val();
     $.ajax({
          type:"POST",
          url: "<?php echo base_url('enc/decrypt2')?>",
          data:{"teks":as},
          dataType:"JSON",
          success: function(s){
            $("#hsl").val(s)
          }
      });
    }

    function hash()
    {
      var pw = $("#pw").val();
      var slt = $("#slt").val();
     $.ajax({
          type:"POST",
          url: "<?php echo base_url('enc/hspas')?>",
          data:{"pw":pw, "slt":slt},
          dataType:"JSON",
          success: function(s){
            $("#hslpw").val(s)
          }
      });
    }

</script>
<input type="text" name="encrypt" id="enc" ><button onclick="encg()">ENCRYPT</button>

<input type="text" name="dec" id="dec">
<button onclick="decs()">dec</button>

<input type="text" name="hsl" id="hsl">

<hr/>
<input type="text" name="pw" id="pw" >
<input type="text" name="slt" id="slt" ><button onclick="hash()">HASH</button>

<input type="text" name="hslpw" id="hslpw">
</body>
</html>