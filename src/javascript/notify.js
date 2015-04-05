function create( template, vars, opts ){
	return $container.notify("create", template, vars, opts);
}

function notification(){
	$container = $("#notif_container").notify();
	var text = $('#notif_text').html();
	
	create("withIcon", { title:'Notification', text:text , icon:'../../secouruts/css/images/check.png'
	});
}
