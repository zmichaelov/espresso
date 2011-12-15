<!DOCTYPE html>
<html>
	<head>
		<title>Espresso</title>
		<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css"/>
		<link rel="stylesheet" href="css/style.css" type="text/css"/>
		<link rel="stylesheet" href="css/prettify.css" type="text/css"/>
		<script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
		<script type="text/javascript" src="js/espresso.js"></script>
		<script type="text/javascript" src="js/prettify.js"></script>
		<script type="text/javascript" src="js/lang-tex.js"></script>
	</head>
	<body onload="prettyPrint()">
		<div class="topbar">
		  <div class="fill">
			<div class="container">
			  <a class="brand" href="index.php">Espresso</a>
			  <ul class="nav">
				<li class="active"><a href="index.php">Home</a></li>
				<li><a href="#about">About</a></li>
				<li><a href="#contact">Contact</a></li>
			  </ul>
			</div>
		  </div>
		</div><!-- topbar-->
	<a href="https://github.com/zmichaelov/espresso"><img style="position: absolute; top: 0; right: 0; border: 0;" src="https://a248.e.akamai.net/assets.github.com/img/30f550e0d38ceb6ef5b81500c64d970b7fb0f028/687474703a2f2f73332e616d617a6f6e6177732e636f6d2f6769746875622f726962626f6e732f666f726b6d655f72696768745f6f72616e67655f6666373630302e706e67" alt="Fork me on GitHub"></a>
	<div class="container">
      <div class="content">
        <div class="page-header">
          <h2>Espresso<small> Your web-based logic minimizer</small></h2>
        </div>
        <div class="row">

			<div class="span8">
				<h3>Inputs</h3>
				<form action="" id="inputForm" method="post">
					
					<div class="clearfix" id="variables">
						<label for="variables"># of variables</label>
						<div class="input" id="variables">
							<input id="variables" type="text" value=""/>
							<span class="help-inline" id="variables"></span>
						</div>
					</div>
					
					<div class="clearfix" id="clearfix_minterms">
						<label for="minterms">Minterms</label>
						<div class="input">
							<input id="minterms" type="text" value=""/>
							<span class="help-inline" id="minterms_help"></span>
						</div>
					</div>
					<div class="clearfix" id="clearfix_dontcares">
						<label for="dontcares">Don't Cares</label>
						<div class="input">
							<input id="dontcares" type="text" value=""/>
							<span class="help-inline"></span>
						</div>
					</div>					
					<div class="row">
						<div class="span4 offset4">
							<input class="btn primary" type="submit" value="Submit" />
							<button class="btn" type="reset">Reset</button>
						</div>
					</div>
				</form>
			  </div>
<!-- 
			  <div class="span8">
					<h3>Additional Options</h3>
			  </div>
 -->
        </div>
        <div class="row">
			<div class="span8"><h3>Standard Output</h3>
				<div id="output"></div>
			</div>
			<div class="span8"><h3>Latex</h3>
				<div id="latex_rendered"></div>
			</div>
        </div>
		<div class="row">
			<div class="span16"><h3>Console</h3>
				<textarea class="xxlarge" id="console"></textarea>
			</div>
		</div>
      </div>

      <footer>
        <p>&copy; Zach Michaelov 2011</p>
      </footer>

    </div> <!--container -->
	</body>
</html>

