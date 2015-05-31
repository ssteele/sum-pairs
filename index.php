<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Sum Pairs</title>
<!--[if lt IE 9]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
</head>
<body>


<?php

use SteveSteele\Validate;
use SteveSteele\FormatPairs;
use SteveSteele\SumPairs;

require_once 'autoload.php';

$validate = new Validate();
$format = new FormatPairs();
$sum_pairs = new SumPairs( $validate, $format );

$sum_pairs->set_sum( 0 );
$sum_pairs->set_range( [-50, 50] );

$pairs = $sum_pairs->calculate();

print_r($pairs);

?>


</body>
</html>
