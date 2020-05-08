<style>
	span.an,a.an {display:none;}
</style>
<script src="https://code.jquery.com/jquery-1.12.0.min.js"></script> 
<script type="text/javascript">
	// setTimeout(function(){ location.reload(); }, 5000);
	function settt(tt)  {
		 $.ajax({ 
	              url: '/Kem/TrangThai/Update/'+tt,
	              type: "get",    
	              success: function(data, status) {  

	              },
	            error: function(x, t, m){ 
	              
	            }
	      }); 
	}
	$(document).ready(function() {  
		$("#sms").click(function() {   
			if($("#sms").text() == "off") { 
				settt("on");
				$("#sms").text("on");
			} else {  
				settt("off");
				$("#sms").text("off");
			}
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
		     url: '/Kem/TrangThai/Xoa/kem',
		     type: 'POST',
		     data: { id:deleteid },
		     success: function(response){

	        if(response == 1){
			 // Remove row from HTML Table
			 $(el).closest('tr').css('background','tomato');
			 $(el).closest('tr').fadeOut(100,function(){
			    $(this).remove();
			 });
		      }else{
			 alert('Invalid ID.');
		      }

		    }
		   }); 
		 }); 


	 // cHECK ip
	$('.ip').click(function(){
		   var el = this;
		   var id = this.id; 
		   var splitid = id.split("_"); 
		   // Delete id
		   var ip = splitid[1];
		 
		   // AJAX Request
		   $.ajax({
		     url: 'http://ip-api.com/json/'+ip,
		     type: 'GET', 
		     success: function(response){  
		        if(response.status == 'success'){  
				 $(el).html(response.city+", "+response.country);
			    }
		    }
		   }); 
		 }); 	 
 
 // cHECK ip
	$('.xong').click(function(){
		   var el = this;
		   var id = this.id; 
		   var splitid = id.split("_"); 
		   // Delete id
		   var ip = splitid[1]; 
		   // AJAX Request
		   $.ajax({
		     url: '/Kem/Capnhat/'+ip,
		     type: 'GET', 
		     success: function(response){   
				 $(el).closest('tr').css('background','tomato');
				 $(el).closest('tr').fadeOut(500,function(){
				    $(this).remove();
				 });
				 location.href = response;
		    }
		   }); 
		 }); 	
 // cHECK ip
	$('.fee').click(function(){
		   var el = this;
		   var id = this.id; 
		   var splitid = id.split("_"); 
		   // Delete id
		   var ip = splitid[1];  
		   // AJAX Request
		   $.ajax({
		     url: '/Kem/FreeVC/'+ip,
		     type: 'GET', 
		     success: function(response){   
				 $(el).closest('tr').css('background','tomato');
				 $(el).closest('tr').fadeOut(500,function(){
				    $(this).remove();
				 });
				 location.href = response;
		    }
		   }); 
		 }); 	 
	});


</script>
<?php   
$sms = json_decode($data['sms'],true)[0]['giatri'];
echo "<p align='center'>Trạng thái SMS: <span id='sms'>$sms</span></p>";    
echo '<p align="center"><a class="btn btn-info" href="/Kem/Index/1">Order Cũ</a></p>';     
echo '<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">';
	echo "<thead>
		<tr>        
			<th>#</th>
			<th>Phone</th>
			<th>Thông tin ĐH</th>        
		  </tr> 
		  </thead>";
 echo "<tbody id='myTable'>";  
  //$i = 1;   
		$dt = json_decode($data['dulieu'],true); 
		$tsk = json_decode($data['tongsokem'],true);  
		
			  if(!$dt)  { $dt = array(); }  
		foreach($dt as $row) {   
			$hid ="";
			$sdt = $row['phone']; 
			$Capnhat = "<a class='btn btn-danger' href='".SITE_URL."/Kem/Capnhat_TTKH/{$sdt}'>Cập nhật</a>";
			if($row['thongtinkhachhang']) {
				$sdt = $row['thongtinkhachhang'];$Capnhat="";
			}
			if($row['status'] == 1) {
				$xong = "<a href='https://kemsuadua.com/Home/Index/{$row['phone']}' class='btn btn-warning'>Đặt lại</a>"; 
				$hid = "an";
			} else {
				$xong = "<a href='#!' id='xong_{$row['id']}' class='btn btn-success xong'>Xong</a>"; 
			}
				echo "<tr>";  

					echo "<td align='center'>".$row['id']."</td>";
					echo "<td align='center'> 
					<a href='tel:".$row['phone']."' class='btn btn-info $hid'>Gọi</a> 
					$xong 
					<a href='".SITE_URL."/Kem/Chan/".$row['id']."/".$row['soluong']."/".$row['phone']."/".$tsk."' onclick='return confirm(\"Xác nhận chặn ?\")' class='btn btn-danger $hid'>Chặn</a> <span class='btn btn-warning delete' id='del_".$row['id']."'>Delete</span>
					</td>";  

					echo "<td width='80%'> 
					- <strong>".$row['diachi']."</strong> (".Map($row['diachi_raw']).")<br>
					- Số lượng: <strong>".$row['soluong']." cây</strong> <br>
					- Điện thoại: <a href='tel:".$row['phone']."'>".$sdt."</a> $Capnhat <br>
					- Thời gian đặt: ".$row['created_time']."<br>
					- Tổng cộng: <font color='red'>".(($row['soluong']*GIA_KEM)*1000+$row['phigiaohang'])." </font>(<span class='fee' id = 'fee_{$row['id']}'>".$row['phigiaohang']."</span>)<br>
					- IP: <span class='ip' id='ip_{$row['ip']}'>".($row['ip'])."</span><br>
					- Ghi chú: <span class='ip' id='ip_{$row['ip']}'>".($row['note'])."</span>
					</td>";   
				echo "</tr>";  
		}		
echo "</tbody></table> "; 

?>	 
 
