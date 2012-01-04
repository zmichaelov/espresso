<!DOCTYPE html>
<html>
	<head>
		<title>Espresso</title>
		<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css"/>
		<link rel="stylesheet" href="css/style.css" type="text/css"/>
		<link rel="stylesheet" href="css/prettify.css" type="text/css"/>
		<link href="img/favicon.ico" type="image/x-icon" rel="shortcut icon">
		<script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
		<script type="text/javascript"src="https://d3eoax9i5htok0.cloudfront.net/mathjax/latest/MathJax.js?config=TeX-AMS_HTML"></script>
		<script type="text/javascript" src="js/espresso.js"></script>
		<script type="text/javascript" src="js/prettify.js"></script>
		<script type="text/javascript" src="js/lang-tex.js"></script>
		<script type="text/javascript" src="js/bootstrap-modal.js"></script>
		<script type="text/javascript" src="js/bootstrap-alerts.js"></script>		
	</head>
	<body onload="prettyPrint()">
		<div class="topbar">
		<a href="https://github.com/zmichaelov/espresso"><img style="position: absolute; top: 0; right: 0; border: 0;" src="https://a248.e.akamai.net/assets.github.com/img/30f550e0d38ceb6ef5b81500c64d970b7fb0f028/687474703a2f2f73332e616d617a6f6e6177732e636f6d2f6769746875622f726962626f6e732f666f726b6d655f72696768745f6f72616e67655f6666373630302e706e67" alt="Fork me on GitHub"></a>
		</div><!-- topbar-->
		<div class="container-fluid">
		  <div class="content">		  
			<div class="page-header">
				<h2>Espresso<small> Your web-based logic minimizer</small></h2>
				<small><a href="#" data-controls-modal="about-modal" data-backdrop="true" >About</a></small>
			</div>
			<div id="alert-bar" class="row"></div>
			<div class="row">
	
				<div class="span16">
					<h3>Inputs</h3>
					<form action="" id="inputForm" method="post">
						
						<div class="clearfix" id="variables">
							<label for="variables"># of variables</label>
							<div class="input" id="variables">
								<input id="variables" type="text" class="span2" value=""/>
								<span class="help-inline" id="variables"></span>
							</div>
						</div>
						
						<div class="clearfix" id="minterms">
							<label for="minterms">Minterms</label>
							<div class="input">
								\(f({x}_{1},...,{x}_{n}) = \sum m(\)
								<input id="minterms" type="text" value=""/>
								\()+\)
								<span class="help-inline" id="minterms"></span>
					
							</div>
						</div>
						<div class="clearfix" id="dontcares">
							<label for="dontcares">Don't Cares</label>
							<div class="input">
								\(D(\)							
								<input id="dontcares" type="text" value=""/>
								\()\)
								<span class="help-inline" id="dontcares"></span>
							</div>
						</div>					
						<div class="row">
							<div class="span4 offset4">
								<input id="submit" class="btn primary" disabled="disabled" type="submit" value="Submit" />
								<button id="reset" class="btn" type="reset">Reset</button>
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
<!-- 
			<div class="row">
				<div class="span16"><h3>Console</h3>
					<textarea class="xxlarge" id="console"></textarea>
				</div>
			</div>
 -->
		  </div>
	
		<footer>
			<p>&copy; Zach Michaelov 2011</p>
		</footer>
	
		</div> <!--container -->

		<!--Modal popups html-->
		<div class="modal hide fade" id="about-modal">
			<div class="modal-header">
				  <a href="#" class="close">&times;</a>
				  <h3>About</h3>
			</div>
			<div class="modal-body">
				<p>Espresso is a web-frontend for the ESPRESSO logic minimization tool originally developed at IBM.</p>
				<p>You can read more about it at the following links:</p>
				<ul>
					<li><a href="http://en.wikipedia.org/wiki/Espresso_heuristic_logic_minimizer">Wikipedia</a></li>
					<li><a href="http://diamond.gem.valpo.edu/~dhart/ece110/espresso/tutorial.html">Tutorial</a></li>
				</ul>
			</div>
			<div class="modal-footer">
				  <a href="" class="btn primary">Close</a>
			</div>
		</div><!--end About modal-->		
	</body>
</html>

