<?php

/**
** Класс конфигурации базы данных
*/
class DB{

	const USER = "u0315220_bj";
	const PASS = "X7x0B4k3";
	const HOST = "localhost";
	const DB   = "u0315220_bj";

	public static function connToDB() {

		$user = self::USER;
		$pass = self::PASS;
		$host = self::HOST;
		$db   = self::DB;

		$conn = new PDO("mysql:dbname=$db;host=$host", $user, $pass);
                $conn->exec('SET NAMES utf8');
		return $conn;

	}
}