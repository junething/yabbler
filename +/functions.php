<?php
function runSQL($lCon,$lQuery) {
	$r = mysqli_query($lCon,$lQuery);
	return $r;
}
function clean($lCon,$lString) {
	$r = mysqli_real_escape_string($lCon, strip_tags($lString));
	return $r;
	}
?>