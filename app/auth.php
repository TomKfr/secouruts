<?php

require_once './vendor/jasig/phpcas/config.php';
    // Enable debugging
phpCAS::setDebug();
	// Initialize phpCAS
phpCAS::client(CAS_VERSION_2_0, $cas_host, $cas_port, $cas_context);

phpCAS::setNoCasServerValidation();

	// force CAS authentication
phpCAS::forceAuthentication();
$GLOBALS['user'] = phpCAS::getUser();
$user = $GLOBALS['user'];



?>