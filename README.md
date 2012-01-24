Espresso Web App
================
© Zach Michaelov, 2011
About
-----
Espresso is a web-frontend for the ESPRESSO logic minimization tool originally developed at IBM.
You can read more about it at the following links:

* http://en.wikipedia.org/wiki/Espresso_heuristic_logic_minimizer
* http://diamond.gem.valpo.edu/~dhart/ece110/espresso/tutorial.html

Features
--------

* Client-side input validation and error-checking
* Standard ESPRESSO and LaTeX output

Usage
-----
1. Enter the number of logic variables
2. Enter the minterms separated by spaces or commas (e.g. 0 2 5 7 or 0, 2, 5, 7)
3. Enter don't cares separated by spaces or commas (leave blank if none)

Installation
------------
To run your own instance of Espresso:

1.  Download the source code from https://github.com/zmichaelov/espresso to your web server's directory.
    For most *nix-based Apache installations this will be somewhere under /var/www/.
2.  Download the ESPRESSO source code from ftp://ftp.cs.man.ac.uk/pub/amulet/balsa/other-software/espresso-ab-1.0.tar.gz
3.  Extract the archive. Then,

        cd espresso-ab-1.0/
        ./configure
        make    
4.  Copy the espresso *nix executable under espresso-ab-1.0/src to espresso/bin
5.  Point your web browser to the web app's index.php (espresso/index.php)

Coming Soon
-----------
* Maxterm minimization
