<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script type="text/javascript" src="jquery-2.2.4.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
   <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>
<style type="">
    input.form-control {
        width: 192px;
    }
</style>
<div class="container">

<h3>Set the config</h3>
<p>
    <i>
        Small note:<br>
        Since tiles are squares, the videos are scaled to fit the smallest dimension. The videos are centered in each tile, and the rest is hidden out of view. 

    </i>
</p>
<form action="show.php" method="POST">
    <div class="form-group">
    <label>Items per row</label>
    <input class="form-control" type="number" name="itemsPerRow" value=4 >
    </div>
    <div class="form-group">
    <label>Item width</label>
    <input class="form-control" type="number" name="itemWidth" value=300>
    </div>
    <div class="form-group">
    <label>Performance limit (how many videos will be loaded at most)</label>
    <input class="form-control" type="number" name="performanceLimit" value=80>
    </div>
    <div class="form-group">
    <label>Custom videos list (separated by line-breaks)</label> 
    <textarea class="form-control" name="list" cols=80 rows=16></textarea>
    </div>
    
    
    
    
    <button class="btn btn-success" type="submit">Submit</button>
</form>

</div>


</body>
</html>