window.addEvent('load', function() {
 
	var swiffy = new FancyUpload2($('demo-status'), $('demo-list'), {
		'url': $('form-demo').action,
		'fieldName': 'photoupload',
		'path': 'js/fancyupload/Swiff.Uploader.swf',
		'onLoad': function() {
			$('demo-status').removeClass('hide');
			$('demo-fallback').destroy();
		}
	});
 
	/**
	 * Various interactions
	 */
 
	$('demo-browse-all').addEvent('click', function() {
		swiffy.browse();
		return false;
	});
 
	$('demo-browse-images').addEvent('click', function() {
		swiffy.browse({'Images (*.jpg, *.jpeg, *.gif, *.png)': '*.jpg; *.jpeg; *.gif; *.png'});
		return false;
	});
 
	$('demo-clear').addEvent('click', function() {
		swiffy.removeFile();
		return false;
	});
 
	$('demo-upload').addEvent('click', function() {
		swiffy.upload();
		return false;
	});
 
});