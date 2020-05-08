<script src="https://code.jquery.com/jquery-1.12.0.min.js"></script> 
 
<?php    
echo '<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">';
	echo "<thead>
		<tr>        
			<th>Phone</th>
			<th>Địa chỉ</th>        
			<th>Thông tin</th>        
		  </tr> 
		  </thead>";
 echo "<tbody id='myTable'>";  
  //$i = 1;   
		$dt = json_decode($data['dulieu'],true);  
		  if(!$dt)  { $dt = array(); }  
		foreach($dt as $row) {     
				echo "<tr>";  
					echo "<td align='center'> {$row['phone']} </td>";     
					echo "<td> {$row['diachi']} </td>";     
					echo $row['thongtinkhachhang'] ? "<td>{$row['thongtinkhachhang']}</td>" : "<td><a id='thongtinkhachhang'>chưa cập nhật</a></td>" ;
				echo "</tr>";  
		}		
echo "</tbody></table> "; 

?>	 
 
