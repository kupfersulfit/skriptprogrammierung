#!/bin/sh
#Script to properly generate our documentation
rm -r ../documentation/html
rm -r ../documentation/latex
chmod +x ../doc/filter.php
doxygen ../Doxyfile
