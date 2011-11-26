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

			<div class="span8">
				<h3>Inputs</h3>
				<form action="" id="inputForm" method="post">
					<div class="clearfix">
						<label for="inputs"># of input variables</label>
						<div class="input">
							<input id="inputs" type="text" name="inputs" value=""/>
						</div>
					</div>
					<div class="clearfix">
						<label for="minterms">Minterms</label>
						<div class="input">
							<input id="minterms" type="text" name="minterms" value=""/>
						</div>
					</div>
					<div class="clearfix">
						<label for="dontcares">Don't Cares</label>
						<div class="input">
							<input id="dontcares" type="text" name="dontcares" value=""/>
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
        </div>
        <div class="row">
			<div class="span8"><h3>Standard Output</h3>
				<div id="output""></div>
			</div>
			<div class="span8"><h3>MathML Output</h3>
				<math>
					<msub>
						<mover><mi>x</mi><mo>&macr;</mo></mover>
						<mn>1</mn>
					</msub>
				</math>
			</div>
        </div>
		<div class="row">
			<div class="span16"><h3>Console</h3>
			<textarea class="xxlarge"></textarea>
			</div>
		</div>
      </div>

      <footer>
        <p>&copy; Zach Michaelov 2011</p>
      </footer>

    </div> <!--container -->
	</body>
</html>

