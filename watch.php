<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta content="IE=edge"http-equiv="X-UA-Compatible">
      <meta content="width=device-width,initial-scale=1,shrink-to-fit=no"name="viewport">
      <meta content="yes"name="apple-mobile-web-app-capable">
      <meta content="black"name="apple-mobile-web-app-status-bar-style">
<meta content="Free Online IPTV Player"name="author">
<title>Free Online IPTV Player.</title>



 <link href="vendor/bootstrap.min.css"rel="stylesheet">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">


<link href="vendor/owl.theme.css"rel="stylesheet">



<script>
document.addEventListener("contextmenu", function(event){
event.preventDefault();
}, false);
</script>
<script>
   function gizleGoster(ID) {
     var secilenID = document.getElementById(ID);
     if (secilenID.style.display == "none") {
       secilenID.style.display = "";
     } else {
       secilenID.style.display = "none";
     }
   }
   </script>
<script src="vendor/clappr.min.js"type="text/javascript"></script>
<!-- <script src="https://cdn.jsdelivr.net/clappr.chromecast-plugin/latest/clappr-chromecast-plugin.min.js"type="text/javascript"></script> -->
<script src="vendor/level-selector.min.js"type="text/javascript"></script>
<script src="vendor/player-error.js"type="text/javascript"></script>


</head><style type="text/css">.list{overflow-y:auto;-webkit-overflow-scrolling:touch}</style>
<body id="page-top">
   <script>function clickIE4(){if(2==event.button)return!1}function clickNS4(e){if((document.layers||document.getElementById&&!document.all)&&(2==e.which||3==e.which))return!1}var message="Function Disabled!";document.layers?(document.captureEvents(Event.MOUSEDOWN),document.onmousedown=clickNS4):document.all&&!document.getElementById&&(document.onmousedown=clickIE4),document.oncontextmenu=new Function("return false")</script>
   <nav class="bg-white navbar navbar-expand navbar-light osahan-nav static-top sticky-top">
      <button onclick="gizleGoster('lists');"  class="btn btn-link btn-sm order-1 order-sm-0 text-secondary">
         <i class="fas fa-bars"></i></button>

<!--
<ul class="ml-auto ml-md-0 navbar-nav osahan-right-navbar" style="background-color: RED;">
    <li class="nav-item mx-1">
    
    <a class="nav-link"href="/"><i class="fas fa-fw fa-plus-circle"></i>Home / New </a></li>
    
    
    
    </ul> -->
    </nav>
    
        <div id="wrapper">
          <div id="lists">
		  <div id="wmdk">
         <div class="ml-auto d-md-inline-block d-none form-inline mr-0 mr-md-5 my-2 my-md-0 osahan-navbar-search"><div class="input-group">
    <input class="form-control search" placeholder="Search for..."onkeyup="bait(this)" style="color:#6c757d;font-weight: bolder;">

<div class="input-group-append">
    <button class="btn btn-light sort"type="button">
        <i class="fas fa-search"></i></button>
        </div></div></div></div>
		
		
		
		  
         <!-- Sidebar -->
         <ul id="list" class="sidebar navbar-nav list">
		 
           <?php

$url = @$_GET["url"];

if(isset($url)) {
  $m3ufile = file_get_contents($url);
} else {
 // $m3ufile = file_get_contents('https://iptv-org.github.io/iptv/categories/movies.m3u');
 $m3ufile = file_get_contents('https://raw.githubusercontent.com/twodragon/iptv/master/streams/tr.m3u');
}

//$m3ufile = str_replace('tvg-', 'tvg_', $m3ufile);
$m3ufile = str_replace('group-title', 'tvgroup', $m3ufile);
$m3ufile = str_replace("tvg-", "tv", $m3ufile);

//$re = '/#(EXTINF|EXTM3U):(.+?)[,]\s?(.+?)[\r\n]+?((?:https?|rtmp):\/\/(?:\S*?\.\S*?)(?:[\s)\[\]{};"\'<]|\.\s|$))/';
$re = '/#EXTINF:(.+?)[,]\s?(.+?)[\r\n]+?((?:https?|rtmp):\/\/(?:\S*?\.\S*?)(?:[\s)\[\]{};"\'<]|\.\s|$))/';
$attributes = '/([a-zA-Z0-9\-]+?)="([^"]*)"/';

preg_match_all($re, $m3ufile, $matches);

// Print the entire match result
//print_r($matches);

$i = 1;

$items = array();

 foreach($matches[0] as $list) {
    
     //echo "$list <br>";
	 
   preg_match($re, $list, $matchList);

   //$mediaURL = str_replace("\r\n","",$matchList[4]);
   //$mediaURL = str_replace("\n","",$matchList[4]);
   //$mediaURL = str_replace("\n","",$mediaURL);
   $mediaURL = preg_replace("/[\n\r]/","",$matchList[3]);
   $mediaURL = preg_replace('/\s+/', '', $mediaURL);
   //$mediaURL = preg_replace( "/\r|\n/", "", $matches[4] );
    $lastMediaURL = $mediaURL;
  $channelName = $matchList[2];
 $channelName =  str_replace(' [Not 24/7]', '', $channelName);
$channelName =  str_replace(' [Geo-blocked]', '', $channelName);
  $channelName =  str_replace('(1080p)', '', $channelName);
    $channelName =  str_replace('(720p)', '', $channelName);
	  $channelName =  str_replace('(480p)', '', $channelName);
	  	  $channelName =  str_replace('(360p)', '', $channelName);
	    $channelName =  str_replace('(576p)', '', $channelName);


   $newdata =  array (
    //'ATTRIBUTE' => $matchList[2],
    'id' => $i++,
    'tvtitle' => $matchList[2],
    'tvmedia' => $mediaURL
    );
    
    preg_match_all($attributes, $list, $matches, PREG_SET_ORDER);
    
    foreach ($matches as $match) {
       $newdata[$match[1]] = $match[2];
    }
    
    //array_push($newdata,$attribute);
    //$newdata[] = $attribute;
	 
	 $items[] = $newdata;
	 //$items[] = $matchList[2];
    @$htmlOutput .= '<li class="nav-item"><a class="channel nav-link" data-value="' . $mediaURL . '" href="#">' . $channelName . '</a></li>' . PHP_EOL;
	
	}
	echo $htmlOutput;

?>		   
         </ul>
         </div>
         <div id="content-wrapper">
            <div class="container-fluid pb-0">
            <!--   <div class="top-mobile-search">
                  <div class="row">
                     <div class="col-md-12">
                        <form class="mobile-search">
                           <div class="input-group">
                             <input type="text" placeholder="Search for..." class="form-control" style="color:#ffffff;font-weight: bolder;">
                               <div class="input-group-append">
                                 <button type="button" class="btn btn-dark"><i class="fas fa-search"></i></button>
                               </div>
                           </div>
                        </form>
                     </div>
                  </div>
               </div> -->
               <div class="video-block ">
                  <div class="row">
                     <div class="col-md-12">
                            <div id="moko"></div>
                            <script>
                                var playerElement = document.getElementById("moko");
                                var player = new Clappr.Player({
                                    source: "<?php echo $lastMediaURL; ?>",
                                    mimeType: 'application/x-mpegURL',
                                    width: '100%',
                                    height: 'calc(100vh - 75px)',
                                    autoPlay: false,
                                    position: 'bottom-right',
                                    mediacontrol: {seekbar: "BLACK", buttons: "#FFFFFF"},
                                    mute: false,
                                  
                                    disableErrorScreen: true, // Disable the internal error screen plugin
                                    plugins: [ErrorPlugin,LevelSelector],
                                  /*  chromecast: {
                                        appId: "9DFB77C0",
                                        contentType: "video/m3u8",
                                        media: {
                                            type: ChromecastPlugin.None,
                                            title:"Free online IPTV player",
                                            subtitle:"Free online IPTV m3u Streaming player"
                                        }
                                    },*/
                                    errorPlugin: {
                                        onRetry: function(e) {
                                        }
                                      },
                                    disableVideoTagContextMenu: false,
                                    playbackNotSupportedMessage: 'Your browser is not supported.'
                                });
                                player.attachTo(playerElement);
                            </script>
                     </div>
                  </div>
               </div>
               <hr class="mt-0">
            </div>
         </div>
         <!-- /.content-wrapper -->
      </div>
<!-- -->


      <!-- /#wrapper -->
      <!-- Bootstrap core JavaScript-->
      <script src="vendor/jquery.min.js"></script>
      <script src="vendor/bootstrap.bundle.min.js"></script>
      <!-- Core plugin JavaScript-->
      <script src="vendor/jquery.easing.min.js"></script>
      <!-- Owl Carousel -->
      <script src="vendor/owl.carousel.js"></script>
      <script src="vendor/list.min.js"></script>
      <!-- Custom scripts for all pages-->
      <script src="vendor/main.js"></script>
	  <script>
	  document.addEventListener('DOMContentLoaded', function() {
  // Tüm kanal linklerini seçiyoruz
  const channelLinks = document.querySelectorAll('.channel.nav-link');

  // Event listener ekliyoruz
  channelLinks.forEach(link => {
    link.addEventListener('click', function() {
      const channelName = this.innerText;
      updateTitle(channelName);
    });
  });

  function updateTitle(channelName) {
    document.title = channelName;
  }
});

	  </script>
   </body>
</html>