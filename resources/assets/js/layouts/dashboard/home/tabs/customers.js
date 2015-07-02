var $customers_container = $('#customers-container'),
	customers_container_loading_html = $customers_container.html();

var $add_customer_button = $('#add-customer-button'),
	$search_customers = $('#search-customers'),
	$search_customers_button = $('#search-customers-button'),
	search_customers_button_original_text = $search_customers_button.text();

var customer_search_query = '';

var customer_dialog = $pxl.modal.create(
{
	title: 'Add Customer',
	getURL: $pxl.uri.urlize('dashboard/customers/modal'),
	width: 640,
	height: 480,
	buttons:
	[
		{
			text: 'Add',
			click: function()
			{

			}
		},
		{
			text: 'Close',
			click: function()
			{
				customer_dialog.close();
			}
		}
	]
});

function refresh_customers()
{
	$customers_container.addClass('is-loading').html(customers_container_loading_html);

	$pxl.ajax.get
	(
		$pxl.uri.urlize('dashboard/customers/get'),
		{
			search_query: customer_search_query
		},
		{
			success: function(result)
			{
				$customers_container.html(result.data.html).removeClass('is-loading');

				customers_table_binds();
			},
			always: function()
			{
				reset_customers_gui();
			}
		}
	);
}

refresh_customers();

$add_customer_button.on('click', function()
{
	customer_dialog.open('add');
});

$search_customers_button.on('click', function()
{
	search();
});

function reset_customers_gui()
{
	$search_customers_button.text(search_customers_button_original_text).prop('disabled', false);
}

function customers_table_binds()
{
	$customers_container.find('.item.prev').on('click', function()
	{
		alert('prev');
	});

	$customers_container.find('.item.next').on('click', function()
	{
		alert('next');
	});
}

$('#filter-form').on('submit', function()
{
	search();

	return false;
});

function search()
{
	$search_customers_button.prop('disabled', true).text($search_customers_button.data('loading_text'));

	customer_search_query = $search_customers.val();

	refresh_customers();
}