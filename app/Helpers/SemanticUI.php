<?php
namespace App\Helpers;

class SemanticUI
{
	public static function segmentLoadingContainer($id, $loading_text = null)
	{
		if ( $loading_text === null )
		{
			$loading_text = trans('dashboard.loading');
		}

		return '<div id="' . $id . '" class="ui segment loading-container is-loading"><div class="ui active inverted dimmer"><div class="ui small text loader">' . $loading_text . '...</div></div></div>';
	}
}