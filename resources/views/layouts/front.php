<!doctype html>
<html>
	<head>
		<meta charset="utf-8">

        <meta http-equiv="x-ua-compatible" content="ie=edge">

		<title><?= $pxl['page_title'] ?></title>

		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">

		<?= $pxl['css_includes'] ?>
	</head>

  <body>
		<?= $content ?>

		<!--[if lt IE 9]>
			<script src="<?= $pxl['base_url'] . 'libs/bower/jquery-legacy/dist/jquery.min.js' ?>"></script>
		<![endif]-->

		<!--[if gte IE 9]><!-->
			<script src="<?= $pxl['base_url'] . 'libs/bower/jquery/dist/jquery.min.js' ?>"></script>
		<!--<![endif]-->

		<?= $pxl['inline_js'] . $pxl['js_includes'] ?>
	</body>
</html>