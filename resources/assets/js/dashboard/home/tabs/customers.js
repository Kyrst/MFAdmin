/*var $customers_container = $('#customers_container'),
	customers_loading_html = $customers_container.html();

function refresh_customers()
{
	$customers_container.css(
	{
		'min-height': $customers_container.outerHeight(true)
	});

	$customers_container.html(customers_loading_html).removeClass('no-data').addClass('is-loading');

	$core.ajax.get
	(
		$core.uri.urlize('dashboard/get-customers'),
		{
		},
		{
			success: function(result)
			{
				$customers_container.html(result.data.html).removeClass('is-loading');

				if ( result.data.num_customers === 0 )
				{
					$customers_container.addClass('no-data');
				}

				$customers_container.css(
				{
					'height': 'auto'
				});

				customers_container_binds();
			},
			error: function()
			{
			}
		}
	);
}

function customers_container_binds()
{
	//$customers_container.find('.customer')
}

refresh_customers();*/