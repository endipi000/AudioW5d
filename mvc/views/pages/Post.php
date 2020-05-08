<?php    
echo "<p align='center'>Trạng thái SMS: <span id='sms'>$sms</span></p>";    
echo '<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">';
	echo "<thead>
		<tr>        
			<th>#</th>
			<th>Thông tin ĐH</th>        
			<th>Action</th>        
		  </tr> 
		  </thead>";
 echo "<tbody id='myTable'>";  
  //$i = 1;   
		$dt = json_decode($data['dulieu'],true);  
			  if(!$dt)  { $dt = array(); }  
		// foreach($dt as $row) {     
				echo "<tr>";  
					echo "<td> #</td>";
					echo "<td> Thông tin </td>
						  <td> <span class='action btn btn-success' id='1'>pause</span> <span class='action' id='1'>remove</span> </td>";   
				echo "</tr>";  

				echo "<tr>";  
					echo "<td> #</td>";
					echo "<td> Thông tin </td>
						  <td> <span class='action btn btn-success' id='2'>pause</span> <span class='action' id='2'>remove</span> </td>";   
				echo "</tr>";  

				echo "<tr>";  
					echo "<td> #</td>";
					echo "<td> Thông tin </td>
						  <td> <span class='action btn btn-success' id='3'>pause</span> <span class='action' id='3'>remove</span> </td>";   
				echo "</tr>";  

				echo "<tr>";  
					echo "<td> #</td>";
					echo "<td> Thông tin </td>
						  <td> <span class='action btn btn-success' id='4'>pause</span> <span class='action' id='4'>remove</span> </td>";   
				echo "</tr>";  
		// }		
echo "</tbody></table> "; 

?>	 