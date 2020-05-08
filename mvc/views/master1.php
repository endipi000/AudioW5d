<?php 
if($_SERVER['REQUEST_SCHEME'] == 'http') {
  header("Location: https://kemsuadua.com"); 
}     
?>
<!DOCTYPE html>
<html lang='vi' > 
<head>
    <title>KEM Sữa Dừa Huế- Đặt hàng Online</title> 
    <meta content='index, follow' name='robots'/>  
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0,user-scalable=0"/>
    <meta id="metaDescription" name="description" content="Đặt hàng Kem sữa dừa, kem flan, đồ ăn vặt Online TP Huế. Giao hàng tận nơi. Hotline: 0905692090">
    <meta property="og:title" content="KEM Sữa Dừa Huế- Đặt hàng Online" />
    <meta property="og:description" content="Đặt hàng Kem sữa dừa, kem flan, đồ ăn vặt Online TP Huế. Giao hàng tận nơi. Hotline: 0905692090" />
    <meta property="og:type" content="website" />  
    <meta property="og:url" content="https://kemsuadua.com/" /> 
    <meta property='og:image' content='https://kemsuadua.com/thumb.jpg' />
    <meta property="og:image:width" content="1280" />
    <meta property="og:image:height" content="720" /> 
    <meta property="og:image:type" content="image/jpeg" />   
    <meta property="fb:app_id" content="511870092184380" />
    <meta charset="UTF-8">  
    <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css"> 
<style>
*{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale;text-rendering:optimizeLegibility;box-sizing:border-box}body{background-color:gray}.container{display:flex;flex-direction:column;max-width:400px;position:absolute;left:50%;transform:translate(-50%,0);-webkit-transform:translate(-50%,0);-ms-transform:translate(-50%,0);transition:1s all ease-in-out;-webkit-transition:1s all ease-in-out;-moz-transition:1s all ease-in-out}.box{display:flex;flex-direction:column}#crickets{width:100px;display:block;margin-left:auto;margin-right:auto}table td:nth-child(1){width:34px}table td:nth-child(3){width:65px}.bold{font-weight:700;font-size:20px}input:not([type]),input[type=date]:not(.browser-default),input[type=datetime-local]:not(.browser-default),input[type=datetime]:not(.browser-default),input[type=email]:not(.browser-default),input[type=number]:not(.browser-default),input[type=password]:not(.browser-default),input[type=search]:not(.browser-default),input[type=tel]:not(.browser-default),input[type=text]:not(.browser-default),input[type=time]:not(.browser-default),input[type=url]:not(.browser-default),textarea.materialize-textarea{border:1px solid #ccc;border-radius:4px;padding-left:6px;width:100%}.logo img{position:relative;top:0;left:290px;width:60px;filter:invert(1);-moz-filter:invert(1);-webkit-filter:invert(1)}.checkout{margin:0}.btn-large{margin:10px 0}.btn-floating.btn-small{width:20px;height:20px}.btn-small{line-height:20px;font-size:13px}.help{text-align:center}.bottom-contact{display:block;position:absolute;bottom:0;background:red;width:100%;z-index:99;padding:5px;box-shadow:2px 1px 9px #dedede;border-top:1px solid #eaeaea;opacity:.3}.bottom-contact p{text-align:center;font-size:14px;color:#fff;font-weight:700}
</style> 
</head>

<body>  
 
<div class='container'>
  <?php 
  // if(isset($_SESSION['user']) == "bankemdao") { 
  if(is_admin()) { 
    require_once "./mvc/views/header.php";
  }
  ?>
  <p class='help' style='color:#ffffff;'></p>
  <div class='box card-panel z-depth-3'>
    <form action="" method="POST" id="dat-hang">
    <div class='merchant'>
      <!-- <img id='crickets' src='https://i.etsystatic.com/17285564/r/il/7fc88f/1475715922/il_570xN.1475715922_aqq3.jpg' /> -->
      <h5 class='center-align'>Đặt hàng Online</h5>
      <div id="wait" align="center"></div> 
      <div id="result"></div> 
    </div>
    <div class='invoice'>
      <table class='highlight'>
        <thead>
          <tr>
            <th>SL</th>
            <th>SẢN PHẨM</th>
            <th class='right-align'>GIÁ</th>
          </tr>
        </thead>
        <tbody> 
          <tr>
            <td><span id="showsl">10</span></td>
            <td> 
              <button class="quantity-left-minus btn-floating btn-small red">-</button>
              Kem sữa dừa 
               <button class="quantity-right-plus btn-floating btn-small blue">+</button>

              
            </td>
            <td class='right-align'><span id="tt">30,000</span></td><br> 
          </tr>
          <tr>
            <td></td>
            <td class='right-align'>Phí giao hàng</td>
            <td class='right-align'><span id='fr'><?=number_format(GIA_SHIP*1000,0);?></span></td>
          </tr>
          <tr>
            <td></td>
            <td class='right-align bold'>Tổng cộng</td>
            <?php 
           if(GIA_SHIP == 10) {
           ?> 
            <td class='right-align bold'><span id='price'>40,000</span></td>
            <?php 
           } else {
             ?>
            <td class='right-align bold'><span id='price'>35,000</span></td>
            <?php 
           }
           ?> 
          </tr>
        </tbody>
      </table>
    </div>
    <div class='payment'> 
      <div class='slide-left'>
         <div class="form-group">  
    <input type="number" class="form-control" id="phone" name="phone" placeholder="Số điện thoại" value="<?php if($data['datlai']) {echo $data['datlai']['phone'];} ?>" required>
  </div>
  <div class="form-group"> 
    <input type="text" class="form-control" id="diachi" name="diachi" placeholder="Nhập địa chỉ nhận hàng" value="<?php if($data['datlai']) {echo str_replace('huế','',$data['datlai']['diachi_raw']);} ?>" required>
    <input type="hidden" class="form-control fr" name="phigiaohang" placeholder="Phí giao hàng" value="<?=GIA_SHIP*1000;?>">
  </div> 
    
    <div class="form-group"> 
       <input type="text" class="form-control" id="ghichu" name="ghichu" placeholder="Ghi chú giao hàng (nếu có)" value="<?php if($data['datlai']) {echo $data['datlai']['note'];} ?>">  
    </div> 


      <div class="form-group" id="slllllllll">  
          <div class="input-group">  
              <input class="form-control" type="text" id="soluong" name="soluong" value="10" min="10" max="<?=$data['max'];?>" step="<?=BUOC_SO;?>" style="text-align:center;display: none;">    
          </div>
    </div> 


      </div>
    </div>

    <div class='button checkout row'>
      <button type="submit" name="submit" id="dathang" class="col s12 btn-large green btn waves-effect waves-dark register">ĐẶT HÀNG</button> 
    </div> 
  </form>
  </div>
  <!-- <div class="bottom-contact overlay"></div> --> 







 


</div>



  <!-- Modal Structure -->
  <div id="modal1" class="modal">
    <div class="modal-content" align="center"> 
    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-close waves-effect waves-green btn-flat">Đồng ý</a>
    </div>
  </div>
 
<script type="application/ld+json">
        {
"@context" : "https://schema.org/",
"@type" : "Organization",
"name" : "Kem Sữa Dừa",
"alternateName" : "Kem Sữa Dừa Huế",
"telephone" : "+(84) 905692090",
"email" : "info@kemsuadua.com",
"url" : "https://kemsuadua.com/",
"logo" : "https://kemsuadua.com/thumb.jpg",
                    "sameAs" : [
                        "https://www.facebook.com/khitocdo/", 
                    ],
"address": {
    "@type": "PostalAddress",
    "addressLocality": "Thừa Thiên Huế ",
    "addressRegion":"VN",
    "streetAddress": "41 Trần Nguyên Hãn, Thuận Hoà, Thành phố Huế, Thừa Thiên Huế, Vietnam"
                }
    }
</script>


<script defer type="text/javascript">  
 

 $(document).ready(function() {   
 var max=<?=$data['max'];?>;
  var quantitiy=10;

   $('.quantity-right-plus').click(function(e){  
        e.preventDefault(); 
        var quantity = parseInt($('#soluong').val());  
        if(quantity<max){ 
          $('#soluong').val(quantity + <?=BUOC_SO;?>);     
          var s=<?=GIA_SHIP;?>;if($("#soluong").val() > 25) {s=0;}
          var cay = $("#soluong").val() * <?=GIA_KEM;?> + s;   
          var tt = $("#soluong").val() * <?=GIA_KEM;?>;
          $('#fr').text(s+",000"); 
          $('.fr').val(s*1000); 
          $('#tt').text(tt+",000"); 
          $('#showsl').text($("#soluong").val()); 
          $('#price').text(cay + ",000");  
        }
    });

     $('.quantity-left-minus').click(function(e){ 
        e.preventDefault(); 
        var quantity = parseInt($('#soluong').val()); 
        if(quantity>10){ 
          $('#soluong').val(quantity - <?=BUOC_SO;?>);
          var s=<?=GIA_SHIP;?>;if($("#soluong").val() > 25) {s=0;}
          var cay = $("#soluong").val() * <?=GIA_KEM;?> + s;   
          var tt = $("#soluong").val() * <?=GIA_KEM;?>;
          $('#fr').text(s+",000"); 
          $('.fr').val(s*1000); 
          $('#tt').text(tt+",000"); 
          $('#showsl').text($("#soluong").val()); 
          $('#price').text(cay + ",000"); 
        }
    });
     

 var d = new Date();    
 $.ajax({
      type : 'GET', 
      dataType: "json",
      url : '/Home/Order/Check/' + Math.floor(Math.random() * 9999999999)+d.getTime(),  
      success : function(data)
      {   
        if(data.status == 'soldout') {    
            /* $('#outstock').html('<p><img src="https://kemsuadua.com/2963191.gif" /></p>');  */
            $('#phone,#diachi,#soluong,#dathang,#ghichu,#soluong').prop("disabled", true);
            $('#ctdh,#dathang,#slllllllll').hide();
            /* $('.bottom-contact').html(data.mess);  */ 
            $('.modal-content').html(data.mess);  
            $('.modal').modal().modal('open');
        } if(data.status == 'timeout') {    
            /* $('#outstock').html('<p><img src="https://kemsuadua.com/2963191.gif" width="100%" /></p>');   */
            /* $('.bottom-contact').html(data.mess);  */
            $('.modal-content').html(data.mess);  
            $('.modal').modal().modal('open');
        } 
      }
  }); 

   var submit = $("button[type='submit']");
   submit.click(function()
            {   
               if(!$('#phone').val()) {
                alert("Chưa nhập số điện thoại");return;
               } if(!$('#diachi').val()) {
                alert("Chưa nhập địa chỉ giao hàng");return;
               } if($('#soluong').val() < 0) {
                alert("Số lượng âm là răng?");return;
               }
                var data = $('form#dat-hang').serialize();  
                $.ajax({
                    type : 'POST', 
                    url : '/Home/Order',
                    crossDomain : true,
                    data : data,
                    beforeSend: function() { $('#wait').html('<div class="progress"><div class="indeterminate"></div></div>'); },
                    success : function(data)
                    { 
                    if(data ) 
                    {
                       $('#wait,#dh').hide(); 
                       $('#ctdh').removeClass ('col-xs-7'); 
                       $('#ctdh').toggleClass ('col-md-6 col-md-offset-3'); 
                       $('#phone, #diachi').val(''); 
                       $('#soluong').val('10'); 
                       $('div#result').html(data);
                       $('.btn,#soluong').prop("disabled", true);
                    } 
              }
          });       
    return false;
   });  

    $("#soluong").on('change', function() {
    if($('#soluong').val() < 0) {
        $('#soluong').val('10'); 
        alert("Số lượng âm là răng?");return;
       } 
      var s=<?=GIA_SHIP;?>;if(this.value >= 30) {s=0;}
      var cay = this.value * 3 + s;   
      var tt = this.value * 3;
      $('#fr').text(s+",000"); 
      $('.fr').val(s*1000); 
      $('#tt').text(tt+",000"); 
      $('#showsl').text(this.value); 
      $('#price').text(cay + ",000"); 
    }); 


 });
</script> 

</body>

</html>



























<?php 
die();
?>
<!DOCTYPE html>
<!-- Code By Webdevtrick ( https://webdevtrick.com ) -->
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>JS Shopping Cart | Webdevtrick.com</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
<link rel='stylesheet' href='https://cdn.jsdelivr.net/foundation/5.0.2/css/foundation.css'> 

</head>
<body>

<div class="row"> 
    <div class="medium-4  columns">
        <div class="cart">
            <h1>Cart items</h1>
            <div class="row">
                <div class="medium-6 columns">
                    <button class="tiny secondary" id="clear">Clear the cart</button>
                </div>
                <div class="medium-6 columns">
                    <button class="tiny" id="checkout" title="Work in progress">Checkout</button>
                </div>
            </div>
            <div id="cartItems">Loading cart...</div>
            Tổng cộng: <strong id="totalPrice">0 đ</strong>
        </div>
      
    </div>
    <div class="medium-8 columns">
        <h1>Products List</h1>
        <div class="products">
           <input type="text" id="sdt" value="0905692090" />
           <input type="text" id="diachi" value="41 Trần Nguyên Hãn" />
            <div class="product medium-4 columns" data-name="Kem sữa dừa" data-price="30000" data-id="0">
                <img src="https://webdevtrick.com/wp-content/uploads/vivobook.jpg" alt="" />
                <h3>Kem sữa dừa</h3>
                <input type="hidden" class="count" value="1" />
                <button class="tiny">Thêm</button>
            </div>
            <div class="product medium-4 columns" data-name="Kem chuối mít" data-price="40000" data-id="1">
                <img src="https://webdevtrick.com/wp-content/uploads/surface.jpg" alt="" />
                <h3>Kem chuối mít</h3>
                <input type="hidden" class="count" value="1" />
                <button class="tiny">Thêm</button>
            </div>
            <div class="product medium-4 columns" data-name="Kem Flan" data-price="5000" data-id="2">
                <img src="https://webdevtrick.com/wp-content/uploads/predator.jpg" alt="" />
                <h3>Kem Flan</h3>
                <input type="hidden" class="count" value="1" />
                <button class="tiny">Thêm</button>
            </div>
        </div>
    </div>
</div>
<script type="text/template" id="cartT">
  <% _.each(items, function (item) { %> 
  <div> 
    <div style="float:left;">(<%= item.count %>) <%= item.name %> </div>    

    <div style="float:right;"><%= item.total %>đ</div><br> 
  </div>
<% }); %>
</script>

<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.5.2/underscore-min.js'></script>
<script  src="https://kemsuadua.com/public/js/function.js"></script> 
<style type="text/css"> 
nav {
  margin-bottom: 1em !important;
}
h1 {
  color: #ff6d34;
}
.cart {
  box-shadow: 0 0 5px #DDD;
  padding: 20px;
}
.tiny {
  background-color: #ff6d34;
}
#clear:hover {
  background-color: #ff6d34;
  color: #fff;
}
</style>
<script type="text/javascript">
   $(document).ready(function(){   

});
 

   $("#checkout").click(function(){   
    console.log(localStorage.pitishop);  
     var sdt = $("#sdt").val();
      var diachi = $("#diachi").val();
      console.log(sdt);
      console.log(diachi);
   });

</script>
</body>
</html> 