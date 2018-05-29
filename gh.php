<?php/*
$ch = curl_init('http://desktop-2ofkvje:998/api/FundsRequests/');
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CAINFO, getcwd() . "/CAcerts/GoDaddyRootCertificateAuthority-G2.crt");
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
  'Content-Type: application/json',
  'Content-Length: ' . strlen($jsonData),
  'Authorization: Bearer ' . $_SESSION["token"])
);

$postResult = curl_exec($ch);
$pos = strpos($postResult,"OKITC");
if($pos === false){
$message = $postResult;
}
else{
  header("Location: fundsrequest.php");
    }
}

else{
//Get General Associated Accounts (Destination Accounts)
$ch = curl_init('https://e-solutionsgroup.com:8080/api/AssociatedAccounts/');
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CAINFO, getcwd() . "/CAcerts/GoDaddyRootCertificateAuthority-G2.crt");
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
  'Authorization: Bearer ' . $_SESSION["token"])
);

$result = curl_exec($ch);
$jsonResult = json_decode($result);
curl_close($ch);

//Get Source Associated Accounts
$sourcech = curl_init('https://e-solutionsgroup.com:8080/api/SourceAccounts/');
curl_setopt($sourcech, CURLOPT_CUSTOMREQUEST, "GET");
curl_setopt($sourcech, CURLOPT_RETURNTRANSFER, true);
curl_setopt($sourcech, CURLOPT_CAINFO, getcwd() . "/CAcerts/GoDaddyRootCertificateAuthority-G2.crt");
curl_setopt($sourcech, CURLOPT_HTTPHEADER, array(
  'Authorization: Bearer ' . $_SESSION["token"])
);

$sourceResult = curl_exec($sourcech);
$jsonSourceResult = json_decode($sourceResult);
curl_close($sourcech);
}*/
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="assets/css/message.css">
<link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha384-tsQFqpEReu7ZLhBV2VZlAu7zcOV+rXbYlF2cqB8txI/8aZajjp4Bqd+V6D5IgvKT" crossorigin="anonymous"></script>
<script src="js/message.js"></script>
<link rel="stylesheet" href="assets/css/modify-style.css">
<link rel="stylesheet" href="assets/css/bs-custom-theme.css">
<link rel="stylesheet" href="assets/css/custom.css">
<title>Notifications</title>
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

<!--See all notifications -->
<style>
#heading {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-align: start;
  -ms-flex-align: start;
  align-items: flex-start;
  display: -ms-grid;
  display: grid;
  padding: 0.5rem 1rem;
  border-bottom: 0.01rem solid #eee;
}

.notification-link {
  position: absolute;
  margin: 0.4rem 0;
}

.heading-left, .img-left {
  -ms-flex-preferred-size: auto;
  flex-basis: auto;
  -webkit-box-flex: 0;
  -ms-flex-positive: 0;
  flex-grow: 0;
  -ms-flex-negative: 0;
  flex-shrink: 0;
  -ms-grid-row: 1;
  grid-row: 1;
  margin: 0 1rem 0 0;
}

.heading-left, .user-content {
  grid-column: span 9;
  width: 14rem;
}

.heading-right, .img-left {
  grid-column: auto;
}

.heading-right, .user-content {
  -ms-flex-preferred-size: auto;
  flex-basis: auto;
  -webkit-box-flex: 1;
  -ms-flex-positive: 1;
  flex-grow: 1;
  -ms-flex-negative: 1;
  flex-shrink: 1;
  -ms-grid-row: 1;
  grid-row: 1;
}

.heading-right {
  width: 2.5rem;
}
</style>
<!--See all notifications -->

<form id="fundrequestform" action="" method="POST">


<div class="row" style="margin-top:20px;">
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                <ul id="notifications" class="list-group">
                  <!--Notification List loads here -->
                <li class="list-group-item list-card unread personal">
                <p style="display:inline-block; width:85%" class="status-dot single-line">
                &ensp; &nbsp;<i class="fa fa-exclamation-circle" aria-hidden="true"></i>&ensp;
                Fund Request Notification
                                </p>
                <a href="generalnotifications.php?message_id=43901940319414">
                <p style="width:5%; display:inline-block; float:right;">
                <span class="pull-right" style="cursor:pointer;">
                <i class="glyphicon glyphicon-menu-right theme-color-two"></i></span></p></a>
                <p class="text-light-grey"><a href="FundsRequest.php"> Tap to read notificaiton </a></p></li></ul>

                <li class="list-group-item list-card unread personal">
                <p style="display:inline-block; width:85%" class="status-dot single-line">
                &ensp; &nbsp;<i class="fa fa-exclamation-circle" aria-hidden="true"></i>&ensp;
                General Notification </p>
                <a href="generalnotifications.php?message_id=43901940319414">
                <p style="width:5%; display:inline-block; float:right;">
                <span class="pull-right" style="cursor:pointer;">
                <i class="glyphicon glyphicon-menu-right theme-color-two"></i></span></p></a>
                <p class="text-light-grey"><a href="generalnotifications.php"> Tap to read notificaiton </a></p></li></ul>

                                <li class="list-group-item list-card unread personal">
                                <p style="display:inline-block; width:85%" class="status-dot single-line">
                                &ensp; &nbsp;<i class="fa fa-exclamation-circle" aria-hidden="true"></i>&ensp;
                                Personal Notification </p>
                                <a href="generalnotifications.php?message_id=43901940319414">
                                <p style="width:5%; display:inline-block; float:right;">
                                <span class="pull-right" style="cursor:pointer;">
                                <i class="glyphicon glyphicon-menu-right theme-color-two"></i></span></p></a>
                                <p class="text-light-grey"><a href="personalnotifications.php"> Tap to read notificaiton </a></p></li></ul>
      </div>
  </div>
</div>


<div id="notification-filter" style="" class="row">
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
              <div class="btn-group btn-group-justified secondary-link">
                      <div class="btn-group"><button id="all" class="btn btn-sm btn-link focused"> All</button></div>
                      <div class="btn-group"><button id="filter-personal" class="btn btn-sm btn-link"><a href="FundsRequest.php"> Personal </a> </button></div>
                      <div class="btn-group"><button id="filter-general" class="btn btn-sm btn-link"><a href="generalnotifications.php"> General </a></button></div>
                      <div class="btn-group"><button id="filter-unread" class="btn btn-sm btn-link"> Unread</button></div>
              </div>
      </div>
</div>
</form>


<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-36251023-1']);
  _gaq.push(['_setDomainName', 'jqueryscript.net']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

</body></html>
<?php
include "partials/footer.php";//include footer
include "partials/header.php";//include footer
include "partials/menu.php";//include footer
?>
