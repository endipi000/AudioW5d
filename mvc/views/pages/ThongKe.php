<?php 
$doanhthu = json_decode($data['doanhthu'],true);
$lichsu_chiphi = json_decode($data['lichsu_chiphi'],true);
$lichsu_nhaphang = json_decode($data['lichsu_nhaphang'],true);
$order_nhieunhat = json_decode($data['order_nhieunhat'],true); 
$chiphi = json_decode($data['chiphi'],true);   
foreach($order_nhieunhat as $arr_order) {
	$arrs[] = $arr_order['thoigiangiao'];
} 
$sms = json_decode($data['sms'],true)[0]['giatri'];
		// echo '<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">';
		echo '<div class="container">'; 
		echo "<h2>Stats</h2>";
		?>
		<link href="https://kemsuadua.com/public/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
 		<style type="text/css">
 			.giua { 
 				text-align:center;
 			}
 			.delete {
 				color:red;
 			}
 		</style>
 		<div class="row">
	        <div class="form-group col-sm-3 giua"> <strong>Today</strong><br>
	            <?php 
              			echo number_format($doanhthu['homnay'][0]['sodonhang'],0)." đơn: <font color='red'>".number_format($doanhthu['homnay'][0]['tongtien'],0)."  </font> (".$doanhthu['homnay'][0]['soluongban']." cây) <br>Lợi nhuận: ".number_format($doanhthu['homnay'][0]['tongtien']-(GIA_KEM_GOC*1000*$doanhthu['homnay'][0]['soluongban'] + $chiphi['homnay'][0]['tongtien']),0);
              	?>
	        </div>
	        <div class="form-group col-sm-3 giua"> <strong>28 days</strong><br>
	            <?php 
              			echo number_format($doanhthu['lastmonth'][0]['sodonhang'],0)." đơn: <font color='red'>".number_format($doanhthu['lastmonth'][0]['tongtien'],0)."  </font>(".$doanhthu['lastmonth'][0]['soluongban']." cây) <br>Lợi nhuận: ".number_format($doanhthu['lastmonth'][0]['tongtien']-(GIA_KEM_GOC*1000*$doanhthu['lastmonth'][0]['soluongban'] + $chiphi['lastmonth'][0]['tongtien']),0);
      			?>		 
	        </div>
	        <div class="form-group col-sm-3 giua"> <strong>All</strong><br>
	            <?php 
              			echo number_format($doanhthu['all'][0]['sodonhang'],0)." đơn: <font color='red'>".number_format($doanhthu['all'][0]['tongtien'],0)."  </font>(".$doanhthu['all'][0]['soluongban']." cây) <br>Lợi nhuận: ".number_format($doanhthu['all'][0]['tongtien']-(GIA_KEM_GOC*1000*$doanhthu['all'][0]['soluongban'] + $chiphi['all'][0]['tongtien']),0);
      			?>
	        </div>
	        <div class="form-group col-sm-3 giua"> <strong>Số dư tài khoản</strong><br>
	            Tài khoản: <font color='red'><a id="balance">$$$$$</a> </font> <br>Tồn kho: <font color='red'><a id='tonkho'><?=$doanhthu['tongsokem'];?></a></font>
	        </div> 
   		 </div>	  
		<?php  
		if($sms == 'off') {
			echo "<h3>Nguyễn Đình Phú</h3>"; 
		} else {
			echo "<h3>Nguyễn Hữu Hiền</h3>"; 
		}
		?>

		<div id="result"></div>
		<div id="wait" style="display:none;"><p><img src="https://i.stack.imgur.com/FhHRx.gif" /> Đang xử lý</p></div> 
		<div class="row" align="center">
	        <div class="form-group col-xs-4"> 
	            <input type="text" class="form-control" style="width: 120px !important;" name="info" id="info" placeholder="*********" autocomplete="off"> 
	        </div>
	        <div class="form-group col-xs-4"> 
	            <input type="number" class="form-control" style="width: 80px !important;" name="otp" id="otp" placeholder="****" autocomplete="off"> 
	        </div>
	        <div class="form-group col-xs-4">
	            <button type="submit" name="chuyentien" class="btn btn-success" id="chuyentien">Thực hiện</button>
	        </div>
   		 </div>	

		<?php 
				

		echo "<h2>Lịch sử nhập hàng</h2>";

		echo '
<form class="form-horizontal" action="/Kem" method="POST">  
	<div class="form-group"> 
	   <div class="col-sm-12">
     	 <input name="nhapkem" type="text" class="form-control" placeholder="Nhập SL nhập rồi Enter"> 
	   </div> 
    </div> 
  </form>';  
		?> 
		


		<div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>  
					<th>Date</th> 
					<th>Bill</th>  
                </tr>
              </thead> 
              <tbody>
              	
              		<?php 

						foreach($lichsu_nhaphang as $nhaphang) {
							echo "<tr>";
							if(!strstr(strtolower($nhaphang['mota']),"tf")) {
								echo "<td>{$nhaphang['created_time']} <br><i class='delete' id='del_".$nhaphang['id']."'>Delete</i> </td><td> {$nhaphang['giatri']} cây <br> <font color='red'><span>CK".($nhaphang['giatri'] * GIA_KEM_GOC*1000)."/{$nhaphang['mota']}</span></font></td>";
							} else {
								echo "<td>{$nhaphang['created_time']} <br><i class='delete' id='del_".$nhaphang['id']."'>Delete</i> </td><td>  {$nhaphang['giatri']} cây <br> {$nhaphang['mota']}</td>";
							}
							echo "</tr>" ;
						} 
              		?> 
              	 
              </tbody>
          </table>
      </div> 

<?php
		echo "<h2>Chi phí</h2>";

		echo '
<form class="form-horizontal" action="/Kem/Info" method="POST">  
	<div class="form-group"> 
	   <div class="col-sm-12">
     	 <input name="chiphi" type="text" class="form-control" placeholder="Số tiền|Mô tả"> 
	   </div> 
    </div> 
  </form>';  
		?>  
		<div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>  
					<th>Date</th> 
					<th>Bill</th>  
                </tr>
              </thead> 
              <tbody>
              	
              		<?php 

						foreach($lichsu_chiphi as $chiphi) {
							echo "<tr>";
							echo "<td><i class='delete' id='del_".$chiphi['id']."'>Delete</i>  {$chiphi['created_time']}</td><td>".number_format($chiphi['giatri'],0).": {$chiphi['mota']}</td>";
							echo "</tr>" ;
						} 
              		?> 
              	 
              </tbody>
          </table>
      </div> 

      <h2>Order nhiều nhất</h2> 
     <?php  
     echo '<ul>';
     $a = array_count_values($arrs);
     krsort($a);
	    foreach($a as $key=>$value) {
		 	echo "<li>$key: $value</li>";
	    }
	 echo '</ul>';  
     ?>

 



<script src="https://code.jquery.com/jquery-1.12.0.min.js"></script> 
<script type="text/javascript"> 
	$(document).ready(function() {   
	$('#chuyentien, #otp, #info, h3').hide();
		$('h2').addClass('giua');

		$("#sl").on('input', function() { 
		  $(this).next('.range-value').html(this.value); 
		});  

		$("#balance").click(function() { 
			$.ajax({ 
	              url: '/Kem/Card/',
	              type: "get",     
	              success: function(data, status) {   
	              	$('#balance').text(data);
	              } 
	      		});  
		});  

		$("span").click(function() {  
			var dt = $(this).html().replace("CK","");   
			var r = prompt("Xác nhận chuyển khoản số tiền", dt);
		   if (r != null) {
		   	$('h3').show();  
		     	$.ajax({ 
		              url: '/Kem/GetOTP/'+r,
		              type: "get",    
		              beforeSend: function() { $('#wait').show(); },
		              success: function(data, status) {    
		              	$('#wait').hide();
		              	$('#chuyentien, #otp, #info').show();
		              	$('#otp, #info, #chuyentien').prop("disabled", false);  
		              	$("#info").val(data);
		              	$("#otp").focus(); 
		              },
		            error: function(x, t, m){ 
		              
		            }
		      }); 
		   }  
	   });  

		$("#chuyentien").click(function() {   
		// $("#otp").change(function() {  
			var dt = $("#info").val()+"/"+$("#otp").val();   
			 $.ajax({ 
		              url: '/Kem/Commit/'+dt,
		              type: "get",    
		              beforeSend: function() { $('#wait').show(); },
		              success: function(data, status) {  
		              	$("#result").html(data);
		              	$('#wait, #otp, #info, #chuyentien').hide();  
		              	$('#otp, #info').val('');
		              	$('#otp, #info, #chuyentien').prop("disabled", true); 
		              },
		            error: function(x, t, m){ 
		              
		            }
		      });  
	    	return false;
	   });



			 // Delete 
		 $('.delete').click(function(){
		   var el = this;
		   var id = this.id;
		   var splitid = id.split("_");

		   // Delete id
		   var deleteid = splitid[1];
		 
		   // AJAX Request
		   $.ajax({
		     url: '/Kem/TrangThai/Xoa/kem_config',
		     type: 'POST',
		     data: { id:deleteid },
		     success: function(response){

	        if(response == 1){
			 // Remove row from HTML Table
			 $(el).closest('tr').css('background','tomato');
			 $(el).closest('tr').fadeOut(500,function(){
			    $(this).remove();
			 });
		      }else{
			 alert('Invalid ID.');
		      }

		    }
		   }); 
		 }); 



	var oriVal;
	$("#tonkho").click(function() {   
		 oriVal = $(this).text();
	     $(this).text("");
	     $("<input type='text' id='giatritonkho'>").appendTo(this).focus();
   });

	$("#tonkho").focusout(function () { 
   	if($("#giatritonkho").val()) {
		  $.ajax({
		     url: '/Kem/TrangThai/Update/'+$("#giatritonkho").val()+'/tongsokem',
		     type: 'GET', 
		     success: function(response){ 
		     	console.log("OK");
		   	 }
  		 }); 
   	} 
 	var $this = $(this);  
    $this.parent().text($("#giatritonkho").val() || oriVal); // Use current or original val.
    $this.remove();                      // Don't just hide, remove the element.
});




 		

	}); 
</script>