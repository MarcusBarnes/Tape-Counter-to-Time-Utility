<?php
// T is time 
// n is the tape counter number
// (n_1,T_1), (n_2,T_2) - two data points of tape counter number and time that must be manually collected.

// T = An^2 + Bn 
// where
// A = (T_2/n_2 - T_1/n_1)/(n_2 - n_1) and B = T_2/n_2 - An_2

if(isset($_GET['tapeCount1']) && is_numeric($_GET['tapeCount1'])){
$tapeCount1 = $_GET['tapeCount1'];
} else {
$tapeCount1 = "";
}

if(isset($_GET['time1']) && is_numeric($_GET['time1'])){
$time1 = $_GET['time1'];
} else {
$time1 = "";
}

if(isset($_GET['tapeCount2']) && is_numeric($_GET['tapeCount2'])){
$tapeCount2 = $_GET['tapeCount2'];
} else {
$tapeCount2 = "";
}


if(isset($_GET['time2']) && is_numeric($_GET['time2'])){
$time2 = $_GET['time2'];
} else {
$time2 = "";
}


if(isset($_GET['counterNum']) && is_numeric($_GET['counterNum'])){
$counterNum = $_GET['counterNum'];
} else {
$counterNum = "";
}


$A = calculateParameterA($tapeCount1, $time1, $tapeCount2, $time2);
$B = calculateParameterB($tapeCount2, $time2, $A);
$n = calculateTimeFromCounterNum($A, $B, $counterNum);
function calculateParameterA($n1, $T1, $n2, $T2){
	if($n1 != "" && $T1 != "" && $n2 != "" && $T2 != ""){
		return ($T2/$n2 - $T1/$n1)/($n2 - $n1);
	}
	else {
		return "[There was a problem: Please check that there are proper values for your data points.]";
	}
}

function calculateParameterB($n2, $T2, $A){
	if($n2 != "" && $T2 != "" && is_numeric($A)){
		return ($T2/$n2) - ($A*$n2);
	} else {
		return "[There was a problem: Please check that there are proper values for your data points and that parameter A was calculated.]";
	}
}

function calculateTimeFromCounterNum($A,$B,$n){
	if(is_numeric($A) && is_numeric($B) && is_numeric($n)){
		return ($A*$n*$n) + ($B*$n);
	}
	else {
		return "[There was a problem: Please check the parameters A and B were calculated and the value of the Counter Number.]";
	}
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
	"http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>Tape Counter to Time Utility</title>
	<script type="text/javascript" src="http://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML"></script>
	<style type="text/css">
		.topSpace {
			padding-top: 2em;
		}
	</style>
</head>
<body>
<h2>Tape Counter to Time Utility - About </h2>
<p>The purpose of this utility is to convert cassette tape counter numbers to time elapsed.  For example, you may have an index of an audio cassette that uses tape counters and after converting the audio tape to a digital format, would like to rewrite the index using time.</p>

<p>Unfortunately, tape counters have always been unreliable & vary tremendously from cassette player to cassette player.  As a result, this utility can only provide approximations.  Additionally, it depends on two data points for the given cassette & player.  Even among a given cassette design & a given player model, there is a lot of variation.  Regardless, it's hoped that this tool will be useful for some people.</p>

<p>Here, we employ the model developed in this paper:</p>

<blockquote>Arnold J. Insel: "Cassette Tape: Predicting
Recording Time," <em>The UMAP Journal</em>, Vol. V, No. 2, 1984, pp. 200–214.</blockquote>
<form method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<div class="space">
Data Points:<br/>
\( (n_{1}, T_{1}) =  \) ( <input type="text" name="tapeCount1" value="<?php echo $tapeCount1; ?>" > ,   <input type="text" name="time1" value="<?php echo $time1; ?>"> )<br/>
\( (n_{2}, T_{2}) =  \) ( <input type="text" name="tapeCount2" value="<?php echo $tapeCount2; ?>"> , <input type="text" name="time2" value="<?php echo $time2; ?>"> )<br/>
n (Tape Counter Number) = <input type="text" name="counterNum" value="<?php echo $counterNum; ?>"><br/>
<input type="submit" name="submit">
</div>
</form>
<div class="topSpace">
\( A = \frac{T_{2}/n_{2} - T_{1}/n_{1}}{n_{2} - n_{1}} =\) <?php echo $A; ?>
</div>
<div class="topSpace">
\( B = T_{2}/n_{2} - An_{2} = \) <?php echo $B; ?>
</div>
<div class="topSpace">
\( T = An^{2} + Bn =  \) <?php echo $n. " min."; ?>
</div>
</body>
</html>
