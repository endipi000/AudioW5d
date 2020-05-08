<?php  
class Home extends Controller{ 
	public $Home_Models; 

	public function __construct() {
		$this->Home_Models = $this->model("Home_Models");    
	}


	function PostQR($sotien) { // goo.gl
		$data = "2|99|0905692090|NGUYEN DINH PHU|endipi000@gmail.com|0|0|$sotien"; 
		$img_qr = "https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=$data&choe=UTF-8";
		echo '<img src="'.$img_qr.'"/>';
	} 




	function Index($reorder=""){    
		echo 123;
		
		// if(isset($reorder)) { 
		// 	$qr_check = $this->Home_Models->db->limit(1)->where(['phone'=>$reorder,'status'=>1])->get('kem');  
		// 	$info_old = "";
		// 	if($qr_check) {
		// 		$info_old = $qr_check; 
		// 	} 
		// }
		// ob_start(function($b){return preg_replace(['/\>[^\S ]+/s','/[^\S ]+\</s','/(\s)+/s'],['>','<','\\1'],$b);});
		// $this->view("master1", [
		// 	"Page" => "Home",
		// 	"title" => "Trang chủ", 
		// 	"max" => $this->Home_Models->db->where('chucnang','tongsokem')->get('kem_config')[0]['giatri'],
		// 	"datlai" => $info_old,
		// 	"hetgio" => $this->Home_Models->db->where('chucnang','hetgio')->get('kem_config')[0]['mota']
		// ]);
    }	
    function Index1($reorder=""){    
		if(isset($reorder)) { 
			$qr_check = $this->Home_Models->db->limit(1)->where(['phone'=>$reorder,'status'=>1])->get('kem'); 
			$info_old = "";
			if($qr_check) {
				$info_old = $qr_check;
			} 
		}
		ob_start(function($b){return preg_replace(['/\>[^\S ]+/s','/[^\S ]+\</s','/(\s)+/s'],['>','<','\\1'],$b);});
		$this->view("master2", [
			"Page" => "Home",
			"title" => "Trang chủ", 
			"max" => $this->Home_Models->db->where('chucnang','tongsokem')->get('kem_config')[0]['giatri'],
			"datlai" => $info_old,
			"hetgio" => $this->Home_Models->db->where('chucnang','hetgio')->get('kem_config')[0]['mota']
		]);
    }
    function Order($check=FALSE) {    
 		$qr = $this->Home_Models->db->get('kem_config'); 
 		$guitin = $qr[6]['giatri'];   

    	if($check == true) { 
    		if(isset($_SESSION['user']) && $_SESSION['user'] == "bankemdao") { echo 1;return; } 
 
			$tongsokem = $qr[0]['giatri']; 
			$status_site = $qr[1]['giatri']; 
			$thongbao = $qr[2]['mota'];  
			$khongship = $qr[3]['mota'];  
			$batdau = $qr[4]['mota'];  
			$dongcua = $qr[5]['mota'];  
			
			if($tongsokem == 0 || $status_site == "off") {
				$arr['status'] = 'soldout';
				$arr['mess'] = $thongbao;
				echo json_encode($arr);
				return;
			} if(date("H") > $dongcua || (date("H") < $batdau)) {
				$arr['status'] = 'timeout';
				$arr['mess'] = $khongship;
				echo json_encode($arr);
				return;
			}  else { 
				echo 1;return;
			} 
    	}   
    	// XU LY ORDER // 
    	if(isset($_POST['soluong'])) {

			if($_POST['soluong'] < 0) { 
				die ("<div style='margin-top: 15px; padding: 10px;' class='card-panel red lighten-2' align='center'><p>Mua kem số âm?</p></div>");
			} 
			if(!$_POST['phone']) { 
				die ("<div style='margin-top: 15px; padding: 10px;' class='card-panel red lighten-2' align='center'><p>Thiếu thông tin</p></div>");
			}  
			// CHECK SỐ KEM CÒN // 
				$qr = $this->Home_Models->db->get('kem_config'); 
				$tongsokem = $qr[0]['giatri']; 
				if($_POST['soluong'] > $tongsokem) {
					die("<div style='margin-top: 15px; padding: 10px;' class='card-panel red lighten-2' align='center'><p>Hết hàng :(</p></div>");
				} 
			// CHECK SỐ KEM CÒN //   
			$diachi = $_POST['diachi'] . " huế";   
			$api = "https://maps.googleapis.com/maps/api/geocode/json?address=".str_replace(' ', '+', $diachi)."&key=AIzaSyC4EWZ0AIh-AuENhKWbyYTZRJtP46M48RQ"; 

			$data = @json_decode(@file_get_contents($api));
			$status = $data->status;
			$dadat = "";
			$thongtinkhachhang = "";
			if($status=="OK"){   
			// API OK  
				$location = $data->results[0]->formatted_address;  

				if(SHIP_RANGE !== "ALL") { 
					if(!strstr($location,"Thành phố Huế")) { 
						die("<div style='margin-top: 15px; padding: 10px;' class='card-panel red lighten-2' align='center'><p>Chưa hỗ trợ ship tới khu vực này</p></div>");
					}
				}

				$qr_check = $this->Home_Models->db->where(['phone'=>$_POST['phone'],'status'=>1])->get('kem'); 
				if($this->Home_Models->db->num_rows()>0) {
					$dadat = "[Đã mua ".$this->Home_Models->db->num_rows()." lần] ";
					$thongtinkhachhang = $qr_check[0]['thongtinkhachhang'];
				} 

				$thongtin = $this->getDistance(ADRR_STORE, $location);  

				$info =  "$dadat\n{$_POST['phone']} {$thongtinkhachhang} đặt {$_POST['soluong']} cây\nGiao tới $diachi\nGhi chú: {$_POST['ghichu']}";  

				$this->thongbao($info);  
				if($guitin == "on") {
					$this->thongbao($info,$qr[6]['mota']); 
				}

				// Thêm order và cập nhật số lượng tồn

				$diachi_full = str_replace(array(", Thành phố Huế, Thừa Thiên Huế, Vietnam",", Thành phố Huế, Huế, Vietnam",", Thành phố Huế, Thừa Thiên Huế 530000, Vietnam"),"",$location);
				$tachdc = explode(",",$diachi_full);
				$phuong = trim(end($tachdc)); 
				$arr_ins = array(
							'phone'=>$_POST['phone'],
							'diachi_raw'=>$diachi,
							'diachi'=> $diachi_full,
							'soluong'=>$_POST['soluong'],
							'phigiaohang'=>$_POST['phigiaohang'],
							'note'=>$_POST['ghichu'],
							'khoangcach'=>$thongtin['khoangcach'],
							'thoigiangiao'=>$phuong,
							'thongtinkhachhang'=>$thongtinkhachhang,
							'ip'=>$_SERVER['REMOTE_ADDR']
							);

				$this->Home_Models->db->insert('kem',$arr_ins);
				$this->Home_Models->db->where('chucnang','tongsokem')->update('kem_config',['giatri'=>$tongsokem - $_POST['soluong']]); 
				
				// Thêm order và cập nhật số lượng tồn
 
				die("<div style='margin-top: 15px; padding: 10px;'  class='card-panel green lighten-3' align='center'><p >Cảm ơn bạn đã đặt hàng</p></div>");  
			} else {  

			// API TGDD DIE
			// VÔ https://tgddapp2016.thegioididong.com/SystemStore/SystemStoreDetail GET LẠI 
			$this->Home_Models->db->where(['phone'=>$_POST['phone'],'status'=>1])->get('kem');
			if($this->Home_Models->db->num_rows()>0) {
				$dadat = "[Đã mua ".$this->Home_Models->db->num_rows()." lần] ";
				$thongtinkhachhang = $qr_check[0]['thongtinkhachhang'];
			}  
			$info =  "(API DIE)\nThông tin đơn hàng\n$dadat\n{$_POST['phone']} {$thongtinkhachhang} đặt {$_POST['soluong']} cây\nGiao tới $diachi\nGhi chú: {$_POST['ghichu']}";  


			$this->thongbao($info); 
			if($guitin == "on") {
				$this->thongbao($info,$qr[6]['mota']); 
			}
			

			// Thêm order và cập nhật số lượng tồn 
			$arr_ins = array(
						'phone'=>$_POST['phone'],
						'diachi_raw'=>$diachi, 
						'soluong'=>$_POST['soluong'],
						'phigiaohang'=>$_POST['phigiaohang'], 
						'ip'=>$_SERVER['REMOTE_ADDR']
						);

			$this->Home_Models->db->insert('kem',$arr_ins);
			$this->Home_Models->db->where('chucnang','tongsokem')->update('kem_config',['giatri'=>$tongsokem - $_POST['soluong']]); 
			
			// Thêm order và cập nhật số lượng tồn


			die("<div style='margin-top: 15px; padding: 10px;'  class='card-panel green lighten-3' align='center'><p >Cảm ơn bạn đã đặt hàng</p></div>");
			} 
		}

    	// XU LY ORDER // 
    }



	function getDistance($addressFrom, $addressTo){
	    // Google API key
	    $apiKey = 'AIzaSyC4EWZ0AIh-AuENhKWbyYTZRJtP46M48RQ'; 
	    
	    // Change address format
	    $formattedAddrFrom    = str_replace(' ', '+', $addressFrom);
	    $formattedAddrTo     = str_replace(' ', '+', $addressTo);  
	    // Geocoding API request with start address
	    $geocodeFrom = @file_get_contents('https://maps.googleapis.com/maps/api/directions/json?origin='.$formattedAddrFrom.'.&destination='.$formattedAddrTo.'&key='.$apiKey);
	    $outputFrom = @json_decode($geocodeFrom,true);  
	    $arr['khoangcach'] = @$outputFrom['routes'][0]['legs'][0]['distance']['text'];
	    $arr['duration'] = round(($outputFrom['routes'][0]['legs'][0]['duration']['value'])/60) ." phút";

	    return $arr;
	}


	function thongbao($info,$uid="") { 
		$title = urlencode("BOT thông báo");
		$url = 'http://kemsuadua.com/webhook.php?mess='.urlencode($info)."&uid=".$uid; 
		@file_get_contents($url);
		// @file_get_contents('https://notifymydevice.com/push?ApiKey=72IYWVJD9H9WAVT6IG7XCZ80C&PushTitle='.$title.'&PushText='.urlencode($info));
	}  





	function curlGet($url)
	{
		$ch = @curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		$head[] = "Connection: keep-alive";
		$head[] = "Keep-Alive: 300";
		$head[] = "Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7";
		$head[] = "Accept-Language: en-us,en;q=0.5";
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.122 Safari/537.36');
		curl_setopt($ch, CURLOPT_ENCODING, '');
		curl_setopt($ch, CURLOPT_REFERER, 'www.thegioididong.com');
		curl_setopt($ch, CURLOPT_HTTPHEADER, $head);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_TIMEOUT, 10);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		'Expect:'
		));
		$page = curl_exec($ch);
		curl_close($ch);
		return $page;
	}  
}
?> 