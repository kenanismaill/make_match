<!DOCTYPE html>
<html>
<head>
    <title>{{ __('welcome_email.subject') }}</title>
</head>
<body>
<h2>{{ __('welcome_email.welcome_message', ['userName' => $userName]) }}</h2>
<p>{{ __('welcome_email.thank_you') }}</p>
<p>{{ __('welcome_email.best_regards') }}</p>
</body>
</html>
