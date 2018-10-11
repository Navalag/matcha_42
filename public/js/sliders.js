// ------------------------------------------------------ //
// Input range sliders for discovery settings page
// ------------------------------------------------------ //

// console.log(JSON.stringify(userSettings));

/*
** max distance
*/
$(document).ready(function() {
	var rangeDistance = document.getElementById('slider-distance');
	noUiSlider.create(rangeDistance, {
		start: [userSettings.max_distanse],
		step: 5,
		connect: [true, false],
		range: {
			'min': [10],
			'max': [100]
		},
		format: wNumb({
        decimals: 0
    })
	});
	
	// Set visual min and max values and also update value hidden form inputs
	rangeDistance.noUiSlider.on('update', function(values, handle) {
		document.getElementById('value-distanse').innerHTML = values[handle];
		document.getElementsByName('max-distanse')[0].value = values[handle];
	});
});

/*
** age gap
*/
$(document).ready(function() {
	var rangeAge = document.getElementById('slider-age-gap');
	noUiSlider.create(rangeAge, {
		start: [userSettings.min_age, userSettings.max_age],
		// step: 1,
		padding: [1, 1],
		margin: 5,
		range: {
			'min': [17],
			'max': [56]
		},
		format: wNumb({
        decimals: 0
    }),
		connect: true
	});
	
	// Set visual min and max values and also update value hidden form inputs
	rangeAge.noUiSlider.on('update', function(values, handle) {
		document.getElementById('value-age-min').innerHTML = values[0];
		if (values[1] == 55) {
			document.getElementById('value-age-max').innerHTML = values[1] + '+';
		} else {
			document.getElementById('value-age-max').innerHTML = values[1];
		}
		document.getElementsByName('min-age')[0].value = values[0];
		document.getElementsByName('max-age')[0].value = values[1];
	});
});

/*
** fame rating gap
*/
$(document).ready(function() {
	var rangeRating = document.getElementById('slider-rating-gap');
	noUiSlider.create(rangeRating, {
		start: [userSettings.min_rating, userSettings.max_rating],
		// step: 1,
		padding: [1, 1],
		margin: 20,
		range: {
			'min': [-1],
			'max': [101]
		},
		format: wNumb({
        decimals: 0
    }),
		connect: true
	});
	
	// Set visual min and max values and also update value hidden form inputs
	rangeRating.noUiSlider.on('update', function(values, handle) {
		document.getElementById('value-rating-min').innerHTML = values[0];
		document.getElementById('value-rating-max').innerHTML = values[1];
		document.getElementsByName('min-rating')[0].value = values[0];
		document.getElementsByName('max-rating')[0].value = values[1];
	});
});

// ------------------------------------------------------ //
// Multyselect interests on discovery settings
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
		var url = '/user/search/discovery_settings_add_interest';
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
		var url = '/user/search/discovery_settings_remove_interest';
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












































