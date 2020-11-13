<?php
// src/Services/NumGenerator.php
namespace App\Services;

class NumGenerator
{
	public function genInteger() : int
	{
		$randomInt = random_int(10000000000000, 99999999999999);
		return $randomInt;
	}
}