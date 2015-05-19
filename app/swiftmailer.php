<?php
// swiftmailer.php configuration de swiftmailer

$app['swiftmailer.options'] = array(
	'transport' => 'smtp',
    'host' => 'smtp.gmail.com',
    'port' => '465',
    'username' => 'tkieffer67@gmail.com',
    'password' => 'OFLjul74',
    'encryption' => null,
    'auth_mode' => 'ssl'
);

$app->register(new Silex\Provider\SwiftmailerServiceProvider());

?>