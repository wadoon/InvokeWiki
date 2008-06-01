window.addEvent('load', function() {
 
	var swiffy = new FancyUpload2($('fancy-status'), $('fancy-list'), {
		'url': $('fancy-upload').action,
		'fieldName': 'fileupload',
		'path': 'js/fancyupload/Swiff.Uploader.swf',
		'onLoad': function() {
		    $('fancy-status').removeClass('hide');
		    $('fancy-fallback').destroy();		   
		}
	});
 
	/**
	 * Various interactions
	 */
 
	$('fancy-browse-all').addEvent('click', function() {	       
		swiffy.browse();
		return false;
	});
 
	$('fancy-browse-images').addEvent('click', function() {
		swiffy.browse({'Images (*.jpg, *.jpeg, *.gif, *.png)': '*.jpg; *.jpeg; *.gif; *.png'});
		return false;
	});
 
	$('fancy-clear').addEvent('click', function() {
		swiffy.removeFile();
		return false;
	});
 
	$('fancy-upload').addEvent('click', function() {
		swiffy.upload();
		return false;
	});
 
});
