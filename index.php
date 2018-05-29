
<?php
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
}
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
<div class="footer">
        &nbsp;
</div>
</body>
</html><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0'/>
    <title>COB E-Pay App</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans">
    <link rel="stylesheet" href="assets/css/modify-style.css">
    <link rel="stylesheet" href="assets/css/bs-custom-theme.css">
    <link rel="stylesheet" href="assets/css/custom.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

        <link rel="manifest" href="manifest.json" />
<script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>
<script>
  var OneSignal = window.OneSignal || [];
  OneSignal.push(function() {
    OneSignal.init({
      appId: "7f307638-b25d-4d0c-ac41-7ac7fc35cfde",
      autoRegister:false,
    });
  });
</script>
</head>
<body><script>
$(document).ready(function () {
    // toggle sidebar when button clicked
    $("#toggle-menu").click(function () {
        $(".menu").toggleClass("open");
        $("#menu-overlay").toggleClass("show");
        if($("#submenu-user").hasClass("in")){
            $("#submenu-user").removeClass("in");
        }
        toggleBodyScroll();
    });
});

$(document).on("touchmove mouseup", function(e)
{

    if($("#menu").hasClass("open")){
        //e.preventDefault();
        var container = $(".menu");
        //if the target of the click isn't the container,a descendant of the container or the menu icon
        if (!container.is(e.target) && container.has(e.target).length === 0 && e.target.id != "toggle-menu")
        {
            container.removeClass("open");
            $("#menu-overlay").removeClass("show");
            toggleBodyScroll();
        }
    }
});

var currentScrollPos; //track the current window position when menu opened to avoid window reseting to top when menu closed

function toggleBodyScroll(){
    winPos = $(window).scrollTop();
    if($("#menu").hasClass("open")){
        $("body").addClass("no-scroll");
        $("body").css("top", - winPos + "px");
        $("#main").addClass("fixed-content");
        currentScrollPos = winPos;
    }else{
        $("body").removeClass("no-scroll");
        $("#main").removeClass("fixed-content");
        $(window).scrollTop(currentScrollPos);
        //return false;
    }
}
</script>

<style>
#toggle-menu{
    cursor:pointer;
}
#menu-overlay{
    position:fixed;
    z-index:998;
    display:none;
    top:50px;
    left:0;
    content:" ";
    width:100%;
    height:100%;
    background-color:rgba(0,0,0,0.5);
}

#menu-overlay.show{
    display:block;
}

.menu{
    position:fixed;
    top:50px;
    left:0;
    width:250px;
    min-width: 250px;
    max-width: 250px;
    padding:15px 0px 50px 0px;
    height:100vh;
    min-height: calc(100vh - 56px);
    z-index:999;
    background-color:#EAEDF2;
    border:solid;
    border-color:#C2CBD8;
    border-width:0px 1px 0px 0px;
    -webkit-box-shadow: 0px 0px 50px 0px rgba(0,0,0,0.5);
    -moz-box-shadow: 0px 0px 50px 0px rgba(0,0,0,0.5);
    box-shadow: 0px 0px 50px 0px rgba(0,0,0,0.5);
    -webkit-transform: translateX(-250%);
			transform: translateX(-250%);
	transition: transform 200ms linear;
    will-change: transform;
    overflow-y:auto;
}

.menu.open{
    -webkit-transform: none;
            transform: none;
    transition: transform 200ms linear;
}

.menu ul li a {
    display: block;
    padding: 1.5rem 1.2rem 1.5rem 2.5rem;
    color: #374355;
    text-decoration: none;
}

.menu ul li a:focus{
    background-color: rgba(0,0,0,0.07);
}
.menu ul li a:hover, .menu ul .active a {
    color: #374355;
}

.menu ul ul a {
    padding-left:5.5rem;
}

.menu [data-toggle="collapse"] {
    position: relative;
}

.menu [data-toggle="collapse"]:before {
    content: "\f078";
    font-family: "FontAwesome";
    font-weight: 900;
    position: absolute;
    right: 1rem;
}

.menu .fa{
    margin-right:10px;
}

.menu .nav-link{
    margin-bottom:15px;
}

.menu .divider {
    height: 0;
    margin: 0.5rem 0;
    overflow: hidden;
    border-top: 1px solid #C2CBD8;
}

@media (max-width:768px) {
    .no-scroll{
        position:fixed;
        overflow-y:hidden;
    }

    .fixed-content{
        position:fixed;
    }
}
</style>

<!-- Sign Out  Modal -->
<div class="modal fade" id="signOutModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Sign out</h4>
        </div>
        <div class="modal-body">
            <p>Are you sure you want to sign out?</p>
        </div>
        <div class="modal-footer">
            <a href="signout.php" class="btn btn-success">Sign out</a>
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        </div>
        </div>
    </div>
</div>

<div id="menu-overlay"> </div>

<nav id="menu" class="menu">
    <ul class="list-unstyled">
        <li>
            <a href="#submenu-user" data-toggle="collapse"><i cl+ass="fa fa-user-circle"></i>  </a>
            <ul id="submenu-user" class="list-unstyled collapse">
                <li><a href="#" data-toggle="modal" data-target="#signOutModal" ><i class="fa fa-fw fa-sign-out"></i> Sign Out </a></li>
            </ul>
        </li>

        <div class="divider"></div>

        <li><a href="home.php"><i class="fa fa-fw fa-tachometer"></i> My Account </a></li>
        <li><a href="associatedaccountlist.php"><i class="fa fa-fw fa-history"></i> Account History </a></li>
        <li><a href="billerselection2.php"><i class="fa fa-fw fa-credit-card"></i> Pay Bills </a></li>
        <li><a href="topup.php"><i class="fa fa-fw fa-mobile" style="font-size:1.5em; width:1em"></i>Top Up Mobile </a></li>
        <li><a href="transfer.php"><i class="fa fa-fw fa-exchange"></i> Transfer Funds </a></li>
        <li><a href="request.php"><i class="fa fa-fw fa-money"></i> Request Funds </a></li>
        <li><a href="pospayment.php"><i class="fa fa-fw fa-shopping-bag"></i> Pay Merchant </a></li>

        <li><a href="nearbyagents.php"><i class="fa fa-fw fa-location-arrow"></i> Nearby Agents </a></li>

        <div class="divider"></div>

        <li><a href="notifications.php"><i class="fa fa-fw fa-bell-o"></i> Notifications </a></li>
        <li><a href="settings.php"><i class="fa fa-fw fa-cog"></i> Settings </a></li>
        <li><a href="help.php"><i class="fa fa-fw fa-question"></i> Help </a></li>
    </ul>
</nav>
