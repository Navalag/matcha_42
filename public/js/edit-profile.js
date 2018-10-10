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










