var $pxl = new pxlCore(
{
	debug: debug,
	notification:
	{
		engines:
		[
			'SweetAlert'
		]
	}
});

var $forms = $('form');

$forms.find('select').dropdown(
{
	transition: 'slide down',
	duration: 125
});

$('#header-dropdown').dropdown(
{
	transition: 'slide down',
	duration: 125
});