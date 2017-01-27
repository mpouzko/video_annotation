<!DOCTYPE html>
<html>
<head>
	<title></title>
	<!-- <script type="text/javascript" src="jquery-2.2.4.min.js"></script> -->
</head>
<body>
<p>
<a href="index.php">Back to config</a><br><br>
    <button onclick="play_videos();"> play videos </button>
    
    <button onclick="pause_videos();"> pause videos </button>

    <label>Result</label><input type="text" id="result">
</p>

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
    $limit = 48; // performance limit        
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
    }
    
    function checkVisible(elm) {
      var rect = elm.getBoundingClientRect();
      var viewHeight = Math.max(document.documentElement.clientHeight, window.innerHeight);
      return !(rect.bottom < 0 || rect.top - viewHeight >= 0);
    }

    function play_videos() {
        if (videosReady< <?php echo $countvideos;?>) {alert ("not all the videos are loaded yet");return;}
        
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
    }
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