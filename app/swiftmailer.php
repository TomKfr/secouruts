<?php
// swiftmailer.php configuration de swiftmailer

$app->register(new Silex\Provider\SwiftmailerServiceProvider()); // Peut être l'appeler avant de configurer les options ...

$app['swiftmailer.options'] = array(
	'transport'  => "smtp",
    'encryption' => "ssl",
    'auth_mode'  => "login",
    'host'       => "smtp.gmail.com",
    'port'		=> '465',
    'username' => 'tkieffer67@gmail.com',
    'password' => 'OFLjul74',
);

$app['swiftmailer.use_spool'] = false; // Sans ça, ça marche pas mais je sais pas pourquoi ...

?>