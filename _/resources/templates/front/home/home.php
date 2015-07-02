<div id="sign_in_container" class="ui segment">
	<h1><?= trans('front.home.home.heading') ?></h1>

	<p id="intro_text"><?= trans('front.home.home.intro_text') ?></p>

	<form id="sign_in_form" action="<?= URL::route('sign-in') ?>" method="post" class="ui warning form">
		<div id="email_field" class="field">
			<label><?= trans('front.email') ?></label>
			<input type="text" name="email" id="email">
		</div>

		<div id="password_field" class="field">
			<label><?= trans('front.password') ?></label>
			<input type="password" name="password" id="password">
		</div>

		<button type="submit" id="sign_in_button" class="ui submit button"><?= trans('front.home.home.sign_in') ?></button>
	</form>
</div>