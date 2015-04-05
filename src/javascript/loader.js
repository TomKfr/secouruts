function setLoader(){
	jQuery.blockUI({ 
		message: 'Chargement...',
		showOverlay: false,
		centerY: false, 
		css: { 
			width: '200px', 
			top: '10px', 
			left: '', 
			right: '43%', 
			border: 'none', 
			padding: '10px', 
			borderRadius: '10px',
			backgroundColor: '#000', 
			'-webkit-border-radius': '10px', 
			'-moz-border-radius': '10px', 
			opacity: .7, 
			color: '#fff' 
		} 
	}); 
}

function unsetLoader(){
	setTimeout(jQuery.unblockUI,0);
}
