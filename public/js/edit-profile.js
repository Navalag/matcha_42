// ------------------------------------------------------ //
// Select interests on edit profile
// ------------------------------------------------------ //

$(document).ready(function() {

	var select = $('select[multiple]');
	var options = select.find('option');

	var div = $('<div />').addClass('selectMultiple');
	var active = $('<div />');
	var list = $('<ul />');
	var placeholder = select.data('placeholder');

	var span = $('<span />').text(placeholder).appendTo(active);

	options.each(function() {
		var text = $(this).text();
		if($(this).is(':selected')) {
			active.append($('<a />').html('<em>' + text + '</em><i></i>'));
			span.addClass('hide');
		} else {
			list.append($('<li />').html(text));
		}
	});

	active.append($('<div />').addClass('arrow'));
	div.append(active).append(list);

	select.wrap(div);

	/*
	** add interest
	*/
	$(document).on('click', '.selectMultiple ul li', function(e) {
		var select = $(this).parent().parent();
		var li = $(this);
		var url = '/user/edit/interests_add';
		var interestName = li.text();
		var tokenName = $('input[name="csrf_name"]');
		var tokenValue = $('input[name="csrf_value"]');
		var data = {
			"interest" : interestName,
			"csrf_name" : tokenName.attr('value'),
			"csrf_value" : tokenValue.attr('value')
		};
		// console.log(data);
		$.post(url ,data, function(response) {
			// console.log(response);
			li.prev().addClass('beforeRemove');
			li.next().addClass('afterRemove');
			li.addClass('remove');
			var a = $('<a />').addClass('notShown').html('<em>' + li.text() + '</em><i></i>').hide().appendTo(select.children('div'));
			a.slideDown(400, function() {
				setTimeout(function() {
					a.addClass('shown');
					select.children('div').children('span').addClass('hide');
					select.find('option:contains(' + li.text() + ')').prop('selected', true);
				}, 500);
			});
			setTimeout(function() {
				if(li.prev().is(':last-child')) {
					li.prev().removeClass('beforeRemove');
				}
				if(li.next().is(':first-child')) {
					li.next().removeClass('afterRemove');
				}
				setTimeout(function() {
					li.prev().removeClass('beforeRemove');
					li.next().removeClass('afterRemove');
				}, 200);

				li.slideUp(400, function() {
					li.remove();
				});
			}, 600);
			/*
			** handel respond from server
			*/
			console.log(response);
			var obj = JSON.parse(response);
			tokenName.val(obj.csrf_name);
			tokenValue.val(obj.csrf_value);
		});
	});

	/*
	** remove interest
	*/
	$(document).on('click', '.selectMultiple > div a', function(e) {
		var select = $(this).parent().parent();
		var self = $(this);
		var url = '/user/edit/interests_delete';
		var interestName = self.children('em').text();
		var tokenName =  $('input[name="csrf_name"]');
		var tokenValue =  $('input[name="csrf_value"]');
		var data = {
			"interest" : interestName,
			"csrf_name" : tokenName.attr('value'),
			"csrf_value" : tokenValue.attr('value')
		};
		$.post(url ,data, function(response) {
			self.removeClass().addClass('remove');
			select.addClass('open');
			setTimeout(function() {
				self.addClass('disappear');
				setTimeout(function() {
					self.animate({
						width: 0,
						height: 0,
						padding: 0,
						margin: 0
					}, 300, function() {
						var li = $('<li />').text(self.children('em').text()).addClass('notShown').appendTo(select.find('ul'));
						li.slideDown(400, function() {
							li.addClass('show');
							setTimeout(function() {
								select.find('option:contains(' + self.children('em').text() + ')').prop('selected', false);
								if(!select.find('option:selected').length) {
									select.children('div').children('span').removeClass('hide');
								}
								li.removeClass();
							}, 400);
						});
						self.remove();
					})
				}, 300);
			}, 400);
			/*
			** handel respond from server
			*/
			console.log(response);
			var obj = JSON.parse(response);
			tokenName.val(obj.csrf_name);
			tokenValue.val(obj.csrf_value);
		});
	});

	$(document).on('click', '.selectMultiple > div .arrow, .selectMultiple > div span', function(e) {
		$(this).parent().parent().toggleClass('open');
	});

});

// ------------------------------------------------------ //
// Check user geolocation
// ------------------------------------------------------ //

var tokenName =  $('input[name="csrf_name"]');
var tokenValue =  $('input[name="csrf_value"]');

function getLocation() {
	if (navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(showPosition, showError);
	} else {
		console.log("Geolocation is not supported by this browser.");
	}
}

function showPosition(position) {
	console.log(position.coords.latitude);
	console.log(position.coords.longitude);

	$.ajax({
		url: '/user/edit/set_geolocation',
		data: {
			'latitude': position.coords.latitude, 
			'longitude': position.coords.longitude, 
			'csrf_name' : tokenName.attr('value'), 
			'csrf_value' : tokenValue.attr('value')
		},
		type: 'POST',
		success: function(response)
		{
			console.log(response);
			var obj = JSON.parse(response);
			tokenName.val(obj.csrf_name);
			tokenValue.val(obj.csrf_value);
		},
		error: function(error)
		{
			console.log(error);
		}
	});
}

function showError(error) {
	$.getJSON('https://json.geoiplookup.io', function(data) {
		console.log(data.latitude);
		console.log(data.longitude);

		$.ajax({
			url: '/user/edit/set_geolocation',
			data: {
				'latitude': data.latitude, 
				'longitude': data.longitude,
				'csrf_name' : tokenName.attr('value'), 
				'csrf_value' : tokenValue.attr('value')
			},
			type: 'POST',
			success: function(response)
			{
				console.log(response);
				var obj = JSON.parse(response);
				tokenName.val(obj.csrf_name);
				tokenValue.val(obj.csrf_value);
			},
			error: function(error)
			{
				console.log(error);
			}
		});
	});
}

window.onload = getLocation();

// ------------------------------------------------------ //
// CUSTOM FILE INPUTS FOR IMAGES
// Custom file inputs with image preview and 
// image file name on selection.
// ------------------------------------------------------ //

$(document).ready(function() {
	var i = 0;
	$('input[type="file"]').each(function(){
		var $file = $(this),
			$label = $file.next('label'),
			$labelCloseLink = $label.find('a'),
			$labelText = $label.find('span'),
			labelDefault = $labelText.text();
		if (userPhoto && userPhoto[i]) {
			$label
				.addClass('file-ok')
				.css('background-image', 'url(' + userPhoto[i] + ')');
			$labelCloseLink.css('display', 'block');
			$file.prop('disabled', true);
			i++;
		}
		// When a new file is selected
		$file.on('change', function(event){
			var	tmppath = event.target.files[0];
			var bg_img = URL.createObjectURL(tmppath);
			var data = new FormData();
			var tokenName =  $('input[name="csrf_name"]');
			var tokenValue =  $('input[name="csrf_value"]');
			data.append("photo", tmppath);
			data.append("csrf_name", tokenName.attr('value'));
			data.append("csrf_value", tokenValue.attr('value'));
			// console.log(data);
			$.ajax({
				url: '/user/edit/photo_upload',
				type: 'POST',
				method: 'POST',
				data: data,
				cache: false,
				// dataType: 'json',
				processData: false, // Don't process the files
				contentType: false, // Set content type to false as jQuery will tell the server its a query string request
				success: function(data, textStatus, jqXHR)
				{
					console.log('success');
					var obj = JSON.parse(data);
					tokenName.val(obj[0].csrf_name);
					tokenValue.val(obj[0].csrf_value);
					// STOP LOADING SPINNER
					$label
						.addClass('file-ok')
						.css('background-image', 'url(' + obj.file_name + ')');
					$labelCloseLink.css('display', 'block');
					$file.prop('disabled', true);
				},
				error: function(jqXHR, textStatus, errorThrown)
				{
					// Handle errors here
					console.log('ERRORS: ' + textStatus);
					// STOP LOADING SPINNER
				}
			});

			//   $label
			// 	.addClass('file-ok')
			// 	.css('background-image', 'url(' + bg_img + ')');
			// 		$labelText.text(fileName);
			// } else {
			// 	$label.removeClass('file-ok');
			// 	$labelText.text(labelDefault);
			// }
		});

		// When close link is clicked
		$labelCloseLink.on('click', function(event) {
			var imgSrc = $(this).parent().css('background-image');
			imgSrc = imgSrc.replace('url(','').replace(')','').replace(/\"/gi, "");
			var data = new FormData();
			var tokenName =  $('input[name="csrf_name"]');
			var tokenValue =  $('input[name="csrf_value"]');
			data.append(imgSrc, "delphoto");
			data.append("csrf_name", tokenName.attr('value'));
			data.append("csrf_value", tokenValue.attr('value'));
			// console.log(data);
			$.ajax({
				url: '/user/edit/photo_delete',
				type: 'POST',
				method: 'POST',
				data: data,
				cache: false,
				// dataType: 'json',
				processData: false, // Don't process the files
				contentType: false, // Set content type to false as jQuery will tell the server its a query string request
				success: function(data, textStatus, jqXHR)
				{
					console.log(data);
					var obj = JSON.parse(data);
					tokenName.val(obj.csrf_name);
					tokenValue.val(obj.csrf_value);
					$label.removeClass('file-ok')
					.css('background-image', '');
					$labelText.text(labelDefault);
					$labelCloseLink.css('display', 'none');
					$file.prop('disabled', false);
					// STOP LOADING SPINNER
				},
				error: function(jqXHR, textStatus, errorThrown)
				{
					// Handle errors here
					console.log('ERRORS: ' + textStatus);
					// STOP LOADING SPINNER
				}
			});
		});
		
	// End loop of file input elements  
	});
	// End ready function
});

// ------------------------------------------------------ //
// Control char amount in textarea
// ------------------------------------------------------ //
var textlimit = 250;

$('textarea.form-control').keyup(function() {
	var tlength = $(this).val().length;
	$(this).val($(this).val().substring(0,textlimit));
	var tlength = $(this).val().length;
	remain = parseInt(tlength);
	$('#remain').text(remain);
});








