<?php 
if($_SERVER['REQUEST_SCHEME'] == 'http') {
  header("Location: https://kemsuadua.com".$_SERVER['REQUEST_URI']);
}
// if(!isset($_SESSION['user']) && $_SESSION['user'] !== "bankemdao") {
if(!is_admin()) {
  header("HTTP/1.1 404 Not Found");
  exit();
}
?>
<!DOCTYPE html>
<html lang="vi"> 
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <META name="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0,user-scalable=0"/>
  <meta name="description" content="">
  <meta name="author" content="">
  <title>AdminCP | <?=$data["title"];?></title> 
</head>

<body id="page-top">  
   
 <?php require_once "./mvc/views/header.php" ?>       

   <!---------- index ---------------> 
 <?php require_once "./mvc/views/pages/".$data["Page"].".php" ?>       
  <!---------- index ---------------> 
   
  
  <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
    <footer >
      <div class="container">
        <div class="text-center">
          <small>Since &copy 2017 by DINHTHIENBAO.COM</small>
        </div>
      </div>
    </footer>   

   <!-- Bootstrap core JavaScript-->
  
    <script src="https://kemsuadua.com/public/vendor/jquery/jquery.min.js"></script>
    <script src="https://kemsuadua.com/public/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="https://kemsuadua.com/public/vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Page level plugin JavaScript-->
    <script src="https://kemsuadua.com/public/vendor/datatables/jquery.dataTables.js"></script>
    <script src="https://kemsuadua.com/public/vendor/datatables/dataTables.bootstrap4.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="https://kemsuadua.com/public/js/sb-admin.min.js"></script>
    <!-- Custom scripts for this page-->
    <script src="https://kemsuadua.com/public/js/sb-admin-datatables.min.js"></script>
      <!-- Bootstrap core CSS-->
    <link href="https://kemsuadua.com/public/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom fonts for this template-->
    <link href="https://kemsuadua.com/public/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- Page level plugin CSS-->
    <link href="https://kemsuadua.com/public/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="https://kemsuadua.com/public/css/sb-admin.css" rel="stylesheet"> 
    <!-- chart --> 
</body>

</html>

  