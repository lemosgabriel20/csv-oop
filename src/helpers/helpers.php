<?php
	function getColor($str) {
		return $str[0] === '-' ? "red" : "green";
	}

	function formatValue($value) {
		$value = number_format((float)$value, 2, '.', ',');
		return '$'. $value;
	}
?>