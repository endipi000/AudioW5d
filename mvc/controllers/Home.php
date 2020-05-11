<?php  
class Home extends Controller{ 
	public $Home_Models; 

	public function __construct() {
		$this->Home_Models = $this->model("Home_Models");    
	}
  

    function Index(){     
		ob_start(function($b){return preg_replace(['/\>[^\S ]+/s','/[^\S ]+\</s','/(\s)+/s'],['>','<','\\1'],$b);}); 
        $loi = "";
        $link = array();
        if(isset($_POST['submit']) && isset($_POST['id'])) {  
            if(count($_POST['id'])<6) {  
                $data= $this->Chuanbi($_POST['id']);
                $check = $this->Home_Models->db->where("bai",implode("*",$_POST['id']))->get('log');
                if(!empty($check)) {
                    $link['1x'] = $check[0]['file'];
                    $link['06x'] = $check[1]['file'];
                } else {
                    $name1x = $this->Join1x($data); 
                    if($name1x) {
                        $this->Home_Models->db->insert('log',['file'=>$name1x,'bai'=>implode('*',$_POST['id'])]);  
                        $link['1x'] = $name1x;
                    } 
                    $name06x = $this->Join06x($data); 
                    if($name06x) {
                        $this->Home_Models->db->insert('log',['file'=>$name06x,'bai'=>implode('*',$_POST['id'])]);  
                         $link['06x'] = $name06x;
                    } 
                }
            } else {
                $loi = "Chỉ nên học tối đa 5 câu mỗi ngày.";
            }  
        }  
        $this->view("master1", [
            "Page" => "Home",
            "title" => "Trang chủ",
            "data" => json_encode($this->Home_Models->db->get('data')) ,
            "loi" => $loi,
            "link" => $link
        ]);
    }  
    function Chuanbi($arr) {
        foreach($arr as $id) {
            $list[] = $this->Home_Models->db->where('id',$id)->get('data','dir')[0]['dir'];
        }
        return $list;
    } 
    function Import(){   
    	$folder_data = "";
    	$html = trim(file_get_contents('http://w5n.dinhthienbao.com/Data/file.txt'));
    	foreach(explode("\n",$html) as $cau) {
    		$tach = explode("*",$cau);
    		$file_name = $folder_data.str_replace(" ","_",str_replace("?","",$tach[0])).".mp3";
    		$arr = ['eng'=>$tach[0],'vie'=>$tach[1],'dir'=>$file_name];
    		$this->Home_Models->db->insert('data',$arr);  
    	} 
    }
    function DoiTen() {
    	// $dir = "/home/w5n.dinhthienbao.com/public_html/Data/DocCham024/"; 
    	// $temp_files = glob($dir.'*'); foreach($temp_files as $file) {
    	// 	rename($file,str_replace(" ","_",$file));
    	// } 	
    } 
    function Join1x($data="") {     
        $name = "HocTiengAnh_".date('d-m-Y').'_1x_'.mt_rand();  
    	$dir ="/home/w5n.dinhthienbao.com/public_html/Data/DocBinhThuong/"; 
    	foreach($data as $file) {
    		$arr[] = $dir.$file; 
    	}
        foreach($data as $file) {
            for($i=1;$i<6;$i++) {
                $arr[] = $dir.$file; 
            }  
        }  
    	$concat = "concat:".implode("|", $arr); 

    	$code = 'ffmpeg -i "'.$concat.'" -acodec copy /home/w5n.dinhthienbao.com/public_html/Data/Temp/'.$name.'.mp3 -y';
    	shell_exec($code);
        return $name;
    }

     function Join06x($data="") {     
        $name = "HocTiengAnh_".date('d-m-Y').'_0.6x_'.mt_rand();  
        $dir ="/home/w5n.dinhthienbao.com/public_html/Data/DocCham024/";
        foreach($data as $file) {
            $arr[] = $dir.$file; 
        } 
        foreach($data as $file) {
            for($i=1;$i<6;$i++) {
                $arr[] = $dir.$file; 
            }  
        }     
        $concat = "concat:".implode("|", $arr); 

        $code = 'ffmpeg -i "'.$concat.'" -acodec copy /home/w5n.dinhthienbao.com/public_html/Data/Temp/'.$name.'.mp3 -y';
        shell_exec($code);
        return $name;
    }

    function Download1($file) {   
        $file = "/home/w5n.dinhthienbao.com/public_html/Data/Temp/".$file.".mp3";   
        header('Content-Description: File Transfer');
        header('Content-Disposition: attachment; filename='.basename($file));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file));
        header("Content-Type: audio/mp3");
        readfile($file);
    }
  	function Download($file) {   
        $file = "/home/w5n.dinhthienbao.com/public_html/Data/Temp/".$file.".mp3";   
        if(strstr(basename($file),"_1x_")) {
        	$xuat_ten = "1x_HocAnhVan_".date('d-m-Y').".mp3";
        } else {
        	$xuat_ten = "0_6x_HocAnhVan_".date('d-m-Y').".mp3";
        } 
        header('Content-Description: File Transfer');
        header('Content-Disposition: attachment; filename='.$xuat_ten);
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file));
        header("Content-Type: audio/mp3");
        readfile($file);
    }

    function ShowAll() {
    	$list = $this->Home_Models->db->get('log');
    	foreach($list as $file) {
    		echo "{$file['created_time']}: {$file['file']} => {$file['bai']}<br>";
    	}
    }

    function thongbao($info,$uid="") {  
		$url = 'http://kemsuadua.com/webhook.php?mess='.urlencode($info)."&uid=".$uid; 
		@file_get_contents($url); 
	} 


}
?> 