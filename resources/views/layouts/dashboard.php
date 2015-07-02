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
		<div class="ui page grid">
			<header id="header" class="row">
				<div class="four wide column">
					<a href="<?= URL::route('home') ?>" id="logo" class="ui header">MFAdmin</a>
				</div>

				<div class="twelve wide column" style="text-align:right">
					<div id="header-dropdown" class="ui selection dropdown">
						<i class="dropdown icon"></i>
						<div class="text"><?= $user->getName() ?></div>
						<div class="menu">
							<a href="javascript:" class="item">Profile</a>

							<a class="ui dropdown item">
								<i class="left dropdown icon"></i>Export
								<div class="left menu">
									<div class="item">PDF</div>
								</div>
							</a>

							<a href="<?= route('dashboard/sign-out') ?>" class="item">Sign Out</a>
						</div>
					</div>
				</div>
			</header>

			<div class="row">
				<div class="sixteen wide column">
					<?php if ( isset($breadcrumb) ): ?>
						<?= $breadcrumb ?>
					<?php endif ?>

					<?= $content ?>
				</div>
			</div>
		</div>

		<!--[if lt IE 9]>
			<script src="<?= $pxl['base_url'] . 'libs/bower/jquery-legacy/dist/jquery.min.js' ?>"></script>
		<![endif]-->

		<!--[if gte IE 9]><!-->
			<script src="<?= $pxl['base_url'] . 'libs/bower/jquery/dist/jquery.min.js' ?>"></script>
		<!--<![endif]-->

		<?= $pxl['inline_js'] . $pxl['js_includes'] ?>
	</body>
</html>