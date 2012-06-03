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
        <script type="text/javascript" src="js/bootstrap.min.js"></script>

	</head>
	<body onload="prettyPrint()">
		<div class="topbar">
            <a href="https://github.com/zmichaelov/espresso"><img style="position: absolute; top: 0; right: 0; border: 0;" src="https://s3.amazonaws.com/github/ribbons/forkme_right_orange_ff7600.png" alt="Fork me on GitHub"></a>
		</div><!-- topbar-->
		<div class="container">		  
                    <div class="page-header">
                        <h2>Espresso</h2>
                        <small>Your web-based logic minimizer</small><br/>
                        <small><a href="#about-modal" data-toggle="modal">About</a></small>
                    </div>
                    <div id="alert-bar" class="row"></div>
			<div class="row">
	
				<div class="span16">
					<h3>Inputs</h3>
					<form action="" id="inputForm" method="post" class="form-inline">
						<div class="row">
                            <div class="control-group span4" id="variables">
                                    <input id="variables" type="text" class="span2" value="" placeholder="# of variables">
                                    <span class="help-block" id="variables"></span>
                            </div>
						</div>
						<div class="row">
                            <div class="control-group span6" id="minterms">
                                    \(f({x}_{1},...,{x}_{n}) = \sum m(\)
                                    <input id="minterms" class="span4" type="text" value="" placeholder="Minterms">
                                    \()+\)
                                    <div class="help-block offset2" id="minterms"></div>
                            </div>
                            <div class="control-group span6" id="dontcares">
                                    \(D(\)							
                                    <input id="dontcares" class="span4" type="text" value="" placeholder="Don't Cares">
                                    \()\)
                                    <div class="help-block offset1" id="dontcares"></div>
                            </div>	
                        </div>				
                        <div class="row form-actions">
                            <button id="reset" class="btn" type="reset">Reset</button>
                            <input id="submit" class="btn btn-primary " disabled="disabled" type="submit" value="Submit" />
                        </div>

					</form>
				  </div>
			</div>
                <div class="row">
                    <div class="span8"><h3>Standard Output</h3>
                        <div id="output"></div>
                    </div>
                    <div class="span8"><h3>Latex</h3>
                        <div id="latex_rendered"></div>
                    </div>
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
				<p>To use Espresso:
				<ul>
                    <li>Enter the number of logic variables</li>
                    <li>Enter the minterms separated by spaces or commas (e.g. 0 2 5 7 or 0, 2, 5, 7)</li>
                    <li>Enter don't cares separated by spaces or commas (leave blank if none)</li>
                </ul>
				<p>You can read more about Espresso at the following links:</p>
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

