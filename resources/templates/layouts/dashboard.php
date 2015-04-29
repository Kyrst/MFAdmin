	<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">

		<title><?= $page_title ?></title>

		<?php foreach ( $assets[\App\Http\Controllers\CoreController::ASSET_CSS] as $css_file ): ?>
			<?php if ( $css_file['delayed'] === false ): ?>
				<link href="<?= ($css_file['external'] === false ? $base_url : '') . $css_file['path'] ?>" rel="stylesheet">
			<?php endif ?>
		<?php endforeach ?>

		<?php foreach ( $assets[\App\Http\Controllers\CoreController::ASSET_CSS] as $css_file ): ?>
			<?php if ( $css_file['delayed'] === true ): ?>
				<link href="<?= ($css_file['external'] === false ? $base_url : '') . $css_file['path'] ?>" rel="stylesheet">
			<?php endif ?>
		<?php endforeach ?>
	</head>

	<body id="<?= $page_id ?>">
		<?php if ( $current_page !== 'dashboard/auth/sign-in' ): ?>
			<div class="ui page grid">
				<header id="header" class="row">
					<div class="four wide column">
						<a href="<?= URL::route('home') ?>" id="logo" class="ui header">MFAdmin</a>
					</div>

					<div class="twelve wide column" style="text-align:right">
						<div id="header_dropdown" class="ui selection dropdown">
							<i class="dropdown icon"></i>
							<div class="text"><?= $user->getName() ?></div>
							<div class="menu">
								<a href="<?= $user->getURL(\App\Models\User::PROFILE_PAGE) ?>" class="item">Profile</a>

								<a class="ui dropdown item">
									<i class="dropdown icon"></i>Export
									<div class="menu">
										<div class="item">PDF</div>
									</div>
								</a>

								<a href="<?= URL::route('dashboard/sign-out') ?>" class="item">Sign Out</a>
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
		<?php else: ?>
			<?= $content ?>
		<?php endif ?>

		<?= $jquery . $inline_js ?>

		<?php foreach ( $assets[\App\Http\Controllers\CoreController::ASSET_JS] as $js_file ): ?>
			<?php if ( $js_file['delayed'] === false ): ?>
				<script src="<?= ($js_file['external'] === false ? $base_url : '') . $js_file['path'] ?>"></script>
			<?php endif ?>
		<?php endforeach ?>

		<?php foreach ( $assets[\App\Http\Controllers\CoreController::ASSET_JS] as $js_file ): ?>
			<?php if ( $js_file['delayed'] === true ): ?>
				<script src="<?= ($js_file['external'] === false ? $base_url : '') . $js_file['path'] ?>"></script>
			<?php endif ?>
		<?php endforeach ?>
	</body>
</html>