<?php
include "partials/header.php";//include header file containing stylesheets js and fonts
include 'Timer.php';

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

    $result = curl_exec($ch);j
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

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="css/message.css">
<link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha384-tsQFqpEReu7ZLhBV2VZlAu7zcOV+rXbYlF2cqB8txI/8aZajjp4Bqd+V6D5IgvKT" crossorigin="anonymous"></script>
<script src="js/message.js"></script>
<link rel="stylesheet" href="assets/css/modify-style.css">
<link rel="stylesheet" href="assets/css/bs-custom-theme.css">
<link rel="stylesheet" href="assets/css/custom.css">
<title>General Notifications</title>
<style>
h2 {
    display: block;
    font-size: 1.5em;
    margin-top: 0.67em;
    margin-bottom: 0.67em;
    margin-left: 0;
    margin-right: 0;
    font-weight: bold;
}
</style>
<style>

body { background-color: #fafafa; font-family: 'Roboto'; }
h1 { margin: 150px auto 50px auto; }
</style>

<script>
  $(function(){
    MessagePlugin.init({
        elem: "#message",
               msgData: [
              {text: "New Message", FundsRequestID: 1, FundsRequestsStatusID: 2},
              {text: "New Message", FundsRequestID: 2, FundsRequestsStatusID: 2},
              {text: "New Funds Request", FundsRequestID: 3, FundsRequestsStatusID: 1},
              {text: "New Funds Request", FundsRequestID: 4, FundsRequestsStatusID: 1},
              {text: "New Message", FundsRequestID: 5, FundsRequestsStatusID: 2},
              {text: "New Message", FundsRequestID: 6, FundsRequestsStatusID: 2}],

              msgUnReadData: 5,
              noticeUnReadData: 5,
              msgClick: function(obj) {
              alert("Click Read Notifications");
              },
              noticeClick: function(obj) {
              alert("Messages Read!");
              },
              allRead: function(obj) {
              alert("Messages Read!");
              },
              getNodeHtml: function(obj, node) {
              if (obj.FundsRequestsStatusID == 1) {
              node.isRead = true;
              } else {
              node.isRead = false;
              }
              var html = "<p>"+ obj.text +"</p>";
              node.html = html;
              return node;
              }
            });
        });
    </script>

    <script>
    <a onclick="msgclick()" href="notifications.php">
    </script>
</head>

<body>
  <nav class="navbar navbar-default navbar-fixed-top">
  	<div class="container">
  		<ul class="nav navbar-nav">
  			<li><a href="javascript:window.history.back()"><i class="glyphicon glyphicon-menu-left"></i> </a></li>
  		</ul>

  		<ul class="nav navbar-nav navbar-right">
  			<!--<li><a href="javascript:location.reload();"><i class="fa fa-refresh theme-color-two"></i></a></li>-->
  							<li><a href="home.php"><i class="fa fa-home"></i></a></li>
  							<li><a><i class="fa fa-bars" id="toggle-menu"></i></a></li>
  							<div id="message"></div>
  		</ul>
  	</div>
  </nav>

<script type="text/javascript"
src="https://pagead2.googlesyndication.com/pagead/show_ads.js">
</script></div>

<div class="jquery-script-clear"></div>
</div>
</div>
<div id="message"></div>

  <h2><center><b>Personal Notification </b></center></h2>
  <p><center><?php echo $_POST["notification_id"]; ?><br /> &ensp;&ensp;<p id="demo"></p>
   <script>
   var d = new Date();
   document.getElementById("demo").innerHTML = d;
   </script></center></p>

   <form id="generalnotifications" action="generalnotifications.php" method="POST">

       <input type="hidden" name="notification_id" value="<?php echo $_POST["notification_id"]; ?>" />
       <input type="hidden" name="user_id" value="<?php echo $_POST["user_id"]; ?>" />
       <input type="hidden" name="email" value="<?php echo $_POST["email"]; ?>" />
       <input type="hidden" name="subject" value="<?php echo $_POST["subject"]; ?>" />
       <input type="hidden" name="message" value="<?php echo $_POST["message"]; ?>" />
       <input type="hidden" name="generalnotifications" value="true" readonly>

       <li class="list-group-item list-card list-card-slim padding-top-0">
         <h6> &ensp; &nbsp;<i class="fa fa-exclamation-circle" aria-hidden="true"></i>&ensp; Subject </h6>

         <p><?php echo $_POST["subject"]; ?></p>
       </li>
      <br />

      <li class="list-group-item list-card unread personal">
      <p style="display:inline-block; width:85%" class="status-dot single-line">
      &ensp; &nbsp;<i class="fa fa-exclamation-circle" aria-hidden="true"></i>&ensp; Message</p>
      <a href="generalnotifications.php?message_id=43901940319414">
      <p style="width:5%; display:inline-block; float:right;">
      <span class="pull-right" style="cursor:pointer;">
      <i class="glyphicon glyphicon-menu-right theme-color-two"></i></span></p></a>
      </li></ul>
</div>
</div>
</div>

<div id="notification-filter" style="" class="row">
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
<div class="btn-group btn-group-justified secondary-link">
<div class="btn-group"><button id="all" class="btn btn-sm btn-link focused"> All</button></div>
<div class="btn-group"><button id="filter-personal" class="btn btn-sm btn-link"> Personal </button></div>
<div class="btn-group"><button id="filter-general" class="btn btn-sm btn-link"> General </button></div>
<div class="btn-group"><button id="filter-unread" class="btn btn-sm btn-link"> Unread</button></div>
</div>
</div>

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
