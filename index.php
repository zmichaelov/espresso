<!DOCTYPE html>
<html>
	<head>
		<title>Espresso</title>
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/style.css">		
		<script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
		<script type="text/javascript" src="js/espresso.js"></script>
	</head>
	<body>
		<div class="topbar">
		  <div class="fill">
			<div class="container">
			  <a class="brand" href="index.php">Espresso</a>
			  <ul class="nav">
				<li class="active"><a href="index.php">Home</a></li>
				<li><a href="#about">About</a></li><!--Make these popouts-->
				<li><a href="#contact">Contact</a></li>
			  </ul>
			</div>
		  </div>
		</div><!-- topbar-->
	<div class="container">
      <div class="content">
        <div class="page-header">
          <h2>Espresso<small> the web-based logic minimizer</small></h2>
        </div>
        <div class="row">
        	<h3>Inputs</h3>
			<div class="span10">
				<form action="" id="inputForm" method="post">
					<p>Number of input variables:</p><input type="text" name="inputs" value=""/>
					<p>Minterms (separated by spaces):</p><input type="text" name="minterms" value=""/>
					<p>Don't Cares (leave blank if none):</p><input type="text" name="dontcares" value=""/>
					<input type="submit" value="Submit" />
				</form>
			  </div>
        </div>
        <div class="row">
			<h3>Output</h3>
				<div class="span10" id="output"></div>
        </div>
      </div>

      <footer>
        <p>&copy; Zach Michaelov 2011</p>
      </footer>

    </div> <!--container -->
	</body>
</html>

