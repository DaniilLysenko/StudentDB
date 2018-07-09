<?php

class Db 
{
	public static function getConnection() 
	{
		return new PDO("mysql:host=localhost:3306;dbname=students",
			"root", "minato2016");
	}
}