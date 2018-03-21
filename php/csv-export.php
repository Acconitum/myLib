<?php

// incldue headers
header("Content-type: text/csv");
header("Content-Disposition: attachment; filename=xaver-projekte.csv");
header("Pragma: no-cache");
header("Expires: 0");

// add informations separated with tabs
// do not indent your data
echo 'title1\ttitle2\ttitle\ttitle';
echo 'bla1\tbla2\tbla3\tbla4';
echo 'bla1\tbla2\tbla3\tbla4';
echo 'bla1\tbla2\tbla3\tbla4';