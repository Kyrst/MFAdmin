<?php
namespace App\Helpers;

class Nordea
{
	public static function readTotalINBas()
	{
		$file_path = base_path('resources/nordea/PG_TESTFIL_TL1_med_refsok.txt');
		$file_contents = file_get_contents($file_path);

		$post_type = self::parsePostType($file_contents);

		die(var_dump($post_type));
	}

	private static function parsePostType($file_contents)
	{
		return substr($file_contents, 0, 2);
	}

	private static function parseTotalIN
}