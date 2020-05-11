<?php 
$dulieu = json_decode($data['data'],true);  
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <title>Tạo Audio học tiếng anh - Web5Ngay</title> 
    <meta content='index, follow' name='robots'/> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0,user-scalable=0"/> 
    <meta id="metaDescription" name="description" content="Tạo Audio học tiếng anh - Web5Ngay.Com">
    <meta property="og:title" content="Tạo Audio học tiếng anh - Web5Ngay.Com" />
    <meta property="og:description" content="Tạo Audio học tiếng anh - Web5Ngay.Com" />
    <meta property="og:type" content="website" />   
    <meta property='og:url' content='https://w5n.dinhthienbao.com/' />
    <meta property='og:image' content='https://i.ytimg.com/vi/R_oMvB80Vjw/hqdefault.jpg' />
    <meta property="og:image:width" content="480" />
    <meta property="og:image:height" content="360" /> 
    <meta property="og:image:type" content="image/jpeg" />   
    <meta property="fb:app_id" content="511870092184380" />
    <meta charset="UTF-8">   
</head>   
<body> 
 <div class="container"> 
 <h1 class="giua">Tạo Audio học Tiếng Anh</h1>
 <h2 class="giua">_Web5Ngay_</h2>
 <div class="row"> 
  <div id="noidung" class="col-xs-12 col-md-8 col-md-offset-2">   


 
  <form method="post" id="dat-hang">   
  <div class="form-group">
    <label for="id">Chọn mẫu câu muốn học (Max 5 câu)</label>
    <select multiple size='15' name="id[]" class="form-control" id="id"> 
      <?php 
        foreach($dulieu as $show) {
          echo "<option value='{$show['id']}'>{$show['id']}/ {$show['eng']} ({$show['vie']})</option>";
        }
      ?> 
    </select> 
    <div class="form-group">
      <?php 
      if(isset($data['loi'])) { 
        echo $data['loi']; 
      }  
      ?>
    </div>
  </div> 

  <div class="form-group">
    <input type="submit" name="submit" class="form-control btn btn-info" value="Tạo file MP3">
  </div> 

   <div class="form-group">
      <?php  
      if(!empty($data['link'])) { 
        echo "
        <div align='center'> 
          <a href='/Home/Download/{$data['link']['1x']}' class='btn btn-success'>TẢI BÀI HỌC 1X</a>
              <a href='/Home/Download/{$data['link']['06x']}' class='btn btn-success'>TẢI BÀI HỌC 0.6x</a>
        </div>
        ";
      } 
      ?>
    </div>

  </form>   


    <div style="margin: 0px; padding: 10px;border: 2px dashed #ff4500;"> 
      <p class="sold_out">Phương pháp học tại <a href='https://www.youtube.com/watch?v=R_oMvB80Vjw' target="_blank">video này</a></p> 
      <p class="sold_out">Cần hỗ trợ / báo lỗi <a href='https://www.facebook.com/100003990309362' target="_blank">Facebook này</a></p> 
      <p class="sold_out">Nếu dùng iPhone, iPad: Vui lòng <u>sử dụng Safari</u>.</p>
      <p><font color='red'>Mời tớ 1 ly cà phê ☕️ qua Momo / ZaloPay: <strong>♥️ 0905692090 ♥️</strong></font></p> 
    </div> 


<h3 class="giua">Bình luận/ Góp ý</h3>

<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v7.0&appId=1073136673078472&autoLogAppEvents=1"></script>
<div class="fb-comments" data-href="https://w5n.dinhthienbao.com" data-width="100%" data-numposts="5"></div>



</div>  

</div> 




    </div>
 
 
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> 
<style type="text/css">
   body{font-size:14px}#price{color:red;font-weight:700}.giua{text-align:center}.slider{-webkit-appearance:none;width:100%;height:15px;border-radius:5px;background:#d3d3d3;outline:0;opacity:.7;-webkit-transition:.2s;transition:opacity .2s}.slider::-webkit-slider-thumb{-webkit-appearance:none;appearance:none;width:25px;height:25px;border-radius:50%;background:#4caf50;cursor:pointer}.slider::-moz-range-thumb{width:25px;height:25px;border-radius:50%;background:#4caf50;cursor:pointer} 
 .bottom-contact{     display: block;    position: absolute;    bottom: 0;    background: black;     width: 100%;    z-index: 99;    padding: 5px;    box-shadow: 2px 1px 9px #dedede;    border-top: 1px solid #eaeaea; opacity: 0.3;}
.bottom-contact p {       text-align: center;     font-size:14px;    color:white;    font-weight: bold;  }  
</style>   

<script async src="https://www.googletagmanager.com/gtag/js?id=UA-153486367-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-100338371-2');
  gtag('config', 'AW-823096853');
</script>


</body>
</html>
 
<!-- Vài dòng code nhanh để bán hàng thôi, đừng phá mà tội nghiệp em :( -->