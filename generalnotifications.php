<?php
include "partials/header.php";//include header file containing stylesheets js and fonts
include 'Timer.php';

    session_start();
    if(!isset($_SESSION["token"])){
        header("Location: index.php");
    }
    if(!isset($_POST['generalnotifications'])){
        header("location: notifications.php");
    }
    $ch = curl_init('http://desktop-8J8UQU0:998/api/FundsRequests' . $_POST['generalnotifications']);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CAINFO, getcwd() . "/CAcerts/GoDaddyRootCertificateAuthority-G2.crt");
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Authorization: Bearer ' . $_SESSION["token"])
    );

    $result = curl_exec($ch);
    PHP_Timer::start();
    $time = PHP_Timer::stop();
    //$_SESSION["associatedaccounts_time"] = PHP_Timer::secondsToTimeString($time);
    //print " [associatedaccounts: " . $_SESSION["associatedaccounts_time"] . "] ";
    $jsonResult = json_decode($result);
    curl_close($ch);

    if(isset($_POST["generalnotifications"])){
        $data=array(
            "notification_id"=>$_POST['notification_id'],
            "user_id"=>$_SESSION['user_id'],
            "email"=>$_POST['email'],
            "subject"=> $_POST['subject'],
            "message"=> $_POST['message']
            //"Notes"=>$_POST['Notes'] // TO be checked not in API
        );

        $jsonData = json_encode($data);

        $ch = curl_init('https://e-solutionsgroup.com:8010/api/AssociatedAccounts/');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CAINFO, getcwd() . "/CAcerts/GoDaddyRootCertificateAuthority-G2.crt");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($jsonData),
            'Authorization: Bearer ' . $_SESSION["token"])
        );

        PHP_Timer::start();
        $postResult = curl_exec($ch);
        $time = PHP_Timer::stop();

        $jsonPostResult = json_decode($postResult);
        if($jsonPostResult->Successful){
            $_SESSION["subject"] = $jsonPostResult->subject;
            $_SESSION["message"] = $jsonPostResult->message;
            header("Location: notifications.php");
        }
       else{
          $message = $jsonPostResult->message;
         // $message = "The was an error processing this payment";
       }
    }
?>

<!DOCTYPE html>
<html>
 <head>
  <title>General Notifications </title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 </head>

 <body>
  <br /><br />
  <div class="container">
<!--   <nav class="navbar navbar-inverse">
    <div class="container-fluid">
     <!--<div class="navbar-header">
      <a class="navbar-brand" href="#">Notifications</a>
    </div> 


  </div>
   </nav>
   <br />-->

   <form id="generalnotifications" action="generalnotifications.php" method="POST">
       <input type="hidden" name="notification_id" value="<?php echo $_POST["notification_id"]; ?>" />
       <input type="hidden" name="user_id" value="<?php echo $_POST["user_id"]; ?>" />
       <input type="hidden" name="email" value="<?php echo $_POST["email"]; ?>" />
       <input type="hidden" name="subject" value="<?php echo $_POST["subject"]; ?>" />
       <input type="hidden" name="message" value="<?php echo $_POST["message"]; ?>" />
       <input type="hidden" name="generalnotifications" value="true" readonly>

       <li class="list-group-item list-card list-card-slim padding-top-0">
           <h6>Subject </h6>
           <p><?php echo $_POST["subject"]; ?></p>
       </li>

       <li class="list-group-item list-card list-card-slim">
           <h6>Message </h6>
           <p><h4 class="theme-color-two"><?php echo $_POST["message"]; ?></h4></p>
       </li>

      <!-- <div class="form-group">
       <input type="submit" name="post" id="post" class="btn btn-info" value="Post" />
     </div>-->
       </form>

  </div>
 </body>
</html>

<script>
$(document).ready(function(){

 function load_unseen_notification(view = '')
 {
  $.ajax({
   url:"fetch.php",
   method:"POST",
   data:{view:view},
   dataType:"json",
   success:function(data)
   {
    $('.dropdown-menu').html(data.notification);
    if(data.unseen_notification > 0)
    {
     $('.count').html(data.unseen_notification);
    }
   }
  });
 }

 load_unseen_notification();

 $('#generalnotifications').on('submit', function(event){
  event.preventDefault();
  if($('#subject').val() != '' && $('#message').val() != '')
  {
   var form_data = $(this).serialize();
   $.ajax({
    url:"insert.php",
    method:"POST",
    data:form_data,
    success:function(data)
    {
     $('#generalnotifications')[0].reset();
     load_unseen_notification();
    }
   });
  }
  else
  {
   alert("Both Fields are Required");
  }
 });

 $(document).on('click', '.dropdown-toggle', function(){
  $('.count').html('');
  load_unseen_notification('yes');
 });

 setInterval(function(){
  load_unseen_notification();
 }, 5000);

});
</script>
