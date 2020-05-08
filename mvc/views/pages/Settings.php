<?php 
$settings = json_decode($data['settings'],true);
?> 
  
 <div class="container">  
<form method="post" action="" id="dat-hang">   

    <div class="form-group">
    <label class="" for="ghichu">Thông báo hết kem</label> 
      <textarea class="form-control" id="thongbao" name="thongbao" placeholder="Thông báo hết kem"><?=$settings[2]['mota'];?></textarea> 
    </div>  

    <div class="form-group">
    <label class="" for="ghichu">Thông báo hết giờ làm việc</label> 
      <textarea class="form-control" id="thongbao" name="hetgio" placeholder="Thông báo hết giờ"><?=$settings[3]['mota'];?></textarea> 
    </div>  

    <div class="form-group">
      <label for="usr">Bắt đầu:</label>
      <input type="number" class="form-control" name="batdau" value="<?=$settings[4]['mota'];?>">  
      <label for="usr">Đóng cửa:</label>
      <input type="number" class="form-control" name="dongcua" value="<?=$settings[5]['mota'];?>">
    </div>

    <div class="form-group">
      <label for="usr">Thông báo: <span id='guitin'><?=$settings[6]['giatri'];?></span></label>
      <input type="text" class="form-control" name="guitin" value="<?=$settings[6]['mota'];?>">   
    </div>  
      <div class="form-group col-xs-5" align="center" id='dh'>  
        <button type="submit" name="submit" id="dathang" class="btn btn-success input-lg">Submit</button>
      </div>

</form>
 </div>
<script src="https://code.jquery.com/jquery-1.12.0.min.js"></script> 
 <script type="text/javascript">
  function settt(tt)  {
     $.ajax({ 
                url: '/Kem/TrangThai/Update/'+tt+"/guitin",
                type: "get",    
                success: function(data, status) {  

                },
              error: function(x, t, m){ 
                
              }
        });  
  }
  $(document).ready(function() {
    $("#guitin").click(function() {   
      if($("#guitin").text() == "off") { 
        settt("on");
        $("#guitin").text("on");
      } else {  
        settt("off");
        $("#guitin").text("off");
      }
        return false;
     }); 
  });
 </script>
