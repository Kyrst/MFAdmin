<?php namespace App\Helpers\Core;

class Markup
{
	public static function noImageURL()
	{
		return asset('libs/bower/semantic/examples/images/wireframe/image.png');
	}

	public static function noImage($size = NULL, $rounded = FALSE)
	{
		return '<img src="' . self::noImageURL() . '" class="ui image' . ($size !== NULL ? ' ' . $size : '') . ($rounded === TRUE ? ' rounded' : '') . '" alt="">';
	}
}