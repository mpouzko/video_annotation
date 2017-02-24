<!DOCTYPE html>
<html>
<head>
	<title></title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<!-- <script type="text/javascript" src="jquery-2.2.4.min.js"></script> -->
</head>
<body style="padding:0 10px;">
<p>
<a href="index.php">Back to config</a><br><br>
    <button class="btn btn-success" onclick="play_videos();"> play videos </button>
    
    <button class="btn btn-warning" onclick="pause_videos();"> pause videos </button>

    <label for="result">Result</label> <input class="form-control" style="width:200px;display: inline-block;" type="text" id="result">
</p>

<div style="position: fixed; left:auto; right:0; width:50px; top:0; background: rgba(0,0,0,.25);padding:10px;">
     <button class="btn btn-success" onclick="play_videos();"> <span class="glyphicon glyphicon-play-circle"></span> </button>
     <br>
     <br>
    
    <button class="btn btn-warning" onclick="pause_videos();"><span class="glyphicon glyphicon-pause"></span> </button>

</div>

<?php
 /*
 if ($_POST) {
   //var_dump($_POST);
    //var_dump($_FILES);
    if (!$_POST['items-per-row'] || !$_POST['item-width'] || !$_FILES['ufile'] ) {
        echo "ERROR form";
        die; 
    }

    
    $uploadfile = __DIR__ . "/" . basename($_FILES['ufile']['name']);
    

     if ( move_uploaded_file($_FILES['ufile']['tmp_name'], $uploadfile) ) {
        echo "ok";
    } else {
        echo "ERROR file";
        die; 
    }

 }
*/  
   

    //set defaults

    $itemsPerRow = ((int)$_POST['itemsPerRow']<1) ? 4:(int)$_POST['itemsPerRow'];
    $itemSize = ((int)$_POST['itemWidth']<1) ? 320 : (int)$_POST['itemWidth']; 
    $videos = ($_POST['list'])?:file_get_contents(__DIR__."/video_example_urls.txt");
    $limit = 20; // performance limit        
    $countvideos=0;
    $str = '';
    foreach (explode("\r\n",$videos) as $key => $value) {
        if ($key>($limit-1)) break;
        if (strlen($value)<1) break;
        $countvideos++;

?>
<div class="container" id="container<?php echo $key;?>" onClick="select(<?php echo $key;?>);">
    <div id="vc<?php echo $key;?>">
                <video id="video<?php echo $key;?>" onCanPlay="video_ready(<?php echo $key;?>);" style='display:block' muted="true">
                     <source src="<?php echo $value;?>" type="video/mp4">
                </video>
                               
    </div>
    <label id="label<?php echo $key;?>"></label>
</div>            

<?php
    if (($key+1) % $itemsPerRow == 0) {
        ?>
        <br>
        <?php
    }
}
?>
<script type="text/javascript">
    var videosReady = 0;
    var PLAY = false;
    /*var urls = [ <?php echo $str;?> ];
    urls.forEach(function(item, i, arr) {
        var v = document.getElementById("video"+i);
        v.innerHTML = "<source src='" + item + "' type='video/mp4'>";
    });*/
    function select(key) {
        var target = document.getElementById("container"+key);
        var input = document.getElementById("result");
        if ( target.classList.contains('active') ) {
                  target.classList.remove('active');
                  input.value = input.value.replace('['+key + '],',"");
              }
        else {
            target.classList.add('active');
            input.value = input.value +'[' +key + '],';
        }
    }

    function video_ready(x) {
        var l = document.getElementById("label"+x);
        l.innerHTML="Ready";
        videosReady++;
        var v = document.getElementById("video"+x);
        if (v.offsetWidth < v.offsetHeight) {
            v.width=<?php echo $itemSize; ?>;
            //center element
            var offset = (v.offsetHeight - <?php echo $itemSize; ?>)/2;
            if (offset>0) {
                v.style.marginTop = "-" + offset + "px";
            }

        }
        else {
            v.height=<?php echo $itemSize; ?>;
             //center element
            var offset = (v.offsetWidth - <?php echo $itemSize; ?>)/2;
            if (offset>0) {
                v.style.marginLeft = "-" + offset + "px";
            }

        }

        v.onplay =  function(){
            console.log ("Video N"+x+" playing");
        }
        v.onpause =  function(){
            console.log ("Video N"+x+" paused");
        }
        v.onended = function(){
            console.log("Video N"+x+" reached the end (and started over)");
            this.play();
        }
    }
    
    function checkVisible(elm) {
      var rect = elm.getBoundingClientRect();
      var viewHeight = Math.max(document.documentElement.clientHeight, window.innerHeight);
      return !(rect.bottom < 0 || rect.top - viewHeight >= 0);
    }

    function play_videos() {
        if (videosReady< <?php echo $countvideos;?>) {alert ("not all the videos are loaded yet");return;}
        PLAY = true;
        z = document.getElementsByTagName("video");

        for (i=0;i<z.length;i++) {
            if (checkVisible(z[i])) {
                z[i].play();
            }

        }


    }
/*
    function play_videos() {
        if (videosReady< <?php echo $countvideos;?>) {alert ("not all the videos are loaded yet");return;}
        z = document.getElementsByTagName("video");

        for (i=0;i<z.length;i++) {
            z[i].play();
        }

    }*/
    function pause_videos() {
        z = document.getElementsByTagName("video");
        for (i=0;i<z.length;i++) {
            z[i].pause();
        }
        PLAY = false;
    }





 window.onscroll = function() {
        if (!PLAY) {return;}
        
        z = document.getElementsByTagName("video");
        for (i=0;i<z.length;i++) {
            if (checkVisible(z[i])) {
                z[i].play();
                 
            }
            else {
                z[i].pause();
                         
            } 

        }

 };


      /*  z = document.getElementsByTagName("video");
        
        for (i=0;i<z.length;i++) {       
     if (checkVisible(z[i])) {
                z[i].play();
            }
        }*/
</script>

<style type="text/css">
    .container {
        display: inline-block;
        width:<?php echo $itemSize; ?>px;
        height:calc( <?php echo $itemSize; ?>px + 20px );
        border:1px solid #DDD;
        overflow:hidden;
        text-align: center;
        margin:10px;

    }
    .container > div {
         
        vertical-align: middle;
        text-align: center;
        overflow: hidden;
        width:<?php echo $itemSize; ?>px;
        height:<?php echo $itemSize; ?>px;

    }

    .container.active {
        background: #ffe500;
    }
</style>
</body>
</html>