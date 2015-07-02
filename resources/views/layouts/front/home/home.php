<div id="sign-in-container" class="ui segment">
	<h1><?= trans('front.home.home.heading') ?></h1>

	<p id="intro-text"><?= trans('front.home.home.intro_text') ?></p>

	<form action="<?= route('sign-in') ?>" id="sign-in-form" method="post" class="ui warning form">
		<div id="email-field" class="field">
			<label for="email"><?= trans('front.email') ?></label>
			<input type="text" name="email" id="email">
		</div>

		<div id="password-field" class="field">
			<label for="password"><?= trans('front.password') ?></label>
			<input type="password" name="password" id="password">
		</div>

		<button type="submit" id="sign-in-button" class="ui submit button"><?= trans('front.home.home.sign_in') ?></button>
	</form>
</div>