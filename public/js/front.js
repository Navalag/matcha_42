$(document).ready(function () {

	// 'use strict';

	// ------------------------------------------------------- //
	// Tooltips init
	// ------------------------------------------------------ //    
	$('[data-toggle="tooltip"]').tooltip()    

	// ------------------------------------------------------- //
	// Adding fade effect to dropdowns
	// ------------------------------------------------------ //
	$('.dropdown').on('show.bs.dropdown', function () {
		$(this).find('.dropdown-menu').first().stop(true, true).fadeIn();
	});
	$('.dropdown').on('hide.bs.dropdown', function () {
		$(this).find('.dropdown-menu').first().stop(true, true).fadeOut();
	});


	// ------------------------------------------------------- //
	// Sidebar Functionality
	// ------------------------------------------------------ //
	$('#toggle-btn').on('click', function (e) {
		e.preventDefault();
		$(this).toggleClass('active');

		$('.side-navbar').toggleClass('shrinked');
		$('.content-inner').toggleClass('active');
		$(document).trigger('sidebarChanged');

		if ($(window).outerWidth() > 1183) {
			if ($('#toggle-btn').hasClass('active')) {
				$('.navbar-header .brand-small').hide();
				$('.navbar-header .brand-big').show();
				$('.navbar-brand').show();
			} else {
				$('.navbar-header .brand-small').show();
				$('.navbar-header .brand-big').hide();
				$('.navbar-brand').hide();
			}
		}

		if ($(window).outerWidth() < 1183) {
			// $('.navbar-header .brand-small').show();
			$('.navbar-brand').hide();
		}
	});

	// ------------------------------------------------------- //
	// Universal Form Validation
	// ------------------------------------------------------ //

	$('.form-validate').each(function() {  
		$(this).validate({
			errorElement: "div",
			errorClass: 'is-invalid',
			validClass: 'is-valid',
			ignore: ':hidden:not(.summernote, .checkbox-template, .form-control-custom),.note-editable.card-block',
			errorPlacement: function (error, element) {
				// Add the `invalid-feedback` class to the error element
				error.addClass("invalid-feedback");
				console.log(element);
				if (element.prop("type") === "checkbox") {
					error.insertAfter(element.siblings("label"));
				} 
				else {
					error.insertAfter(element);
				}
			}
		});

	});    

	// ------------------------------------------------------- //
	// Material Inputs
	// ------------------------------------------------------ //
	var materialInputs = $('input.input-material');

	// activate labels for prefilled values
	materialInputs.filter(function() { return $(this).val() !== ""; }).siblings('.label-material').addClass('active');

	// move label on focus
	materialInputs.on('focus', function () {
		$(this).siblings('.label-material').addClass('active');
	});

	// remove/keep label on blur
	materialInputs.on('blur', function () {
		$(this).siblings('.label-material').removeClass('active');

		if ($(this).val() !== '') {
			$(this).siblings('.label-material').addClass('active');
		} else {
			$(this).siblings('.label-material').removeClass('active');
		}
	});

	// ------------------------------------------------------- //
	// Footer 
	// ------------------------------------------------------ //   
	var contentInner = $('.content-inner');

	$(document).on('sidebarChanged', function () {
		adjustFooter();
	});

	$(window).on('resize', function () {
		adjustFooter();
	})

	function adjustFooter() {
		var footerBlockHeight = $('.main-footer').outerHeight();
		contentInner.css('padding-bottom', footerBlockHeight + 'px');
	}

	// ------------------------------------------------------- //
	// External links to new window
	// ------------------------------------------------------- //
	$('.external').on('click', function (e) {

		e.preventDefault();
		window.open($(this).attr("href"));
	});

	// ------------------------------------------------------- //
	// Highlight current page menu item
	// ------------------------------------------------------- //
	$(function () {
		var url = window.location.pathname; 
		var activePage = url.substring(url.lastIndexOf('/') + 1);

		$('.main-menu li a').each(function() {
				var linkPage = this.href.substring(this.href.lastIndexOf('/') + 1); 

				if (activePage == linkPage) { 
						$(this).closest("li").addClass("active"); 
				}
		});
		/*
		** it's a shame, I know :( but I had to do it fast
		*/
		if (url.includes('/user-page')) {
			$('.main-menu li').eq(4).addClass("active");
		}
		if (url.includes('/auth/edit/user')) {
			$('.main-menu li').eq(0).addClass("active");
		}
	});

});

// google maps api key
// AIzaSyBfXFjp3bYD9ZVLAn61pokhELgCOwYKsEE

// ------------------------------------------------------ //
// Notifications
// ------------------------------------------------------ //

var url = window.location.pathname; 
var websocket = new WebSocket("ws://localhost:8090/demo/php-socket.php");

websocket.onopen = function(event) {
	console.log('Connection is established!');
}
websocket.onerror = function(event) {
	console.log('Please check if socket server is running');
};
websocket.onclose = function(event) {
	console.log('Connection Closed');
};

//window.msgAttr
websocket.onmessage = function(event) {
	var Msg = JSON.parse(event.data);
	/*
	** check if user is not on current event chat page
	*/
	if (!url.includes(Msg.chat_id)) {
		/*
		** check if this is message event
		*/
		if (Msg.chat_id) {
			/*
			** check if current user should receive this message
			*/
			if (Msg.dest_user_id == globalUser.user.id) {
				console.log(Msg);
				sendNotificationToServer(Msg);
			}
		}
	}
};

function sendNotificationToServer(data) {
	var url = '/notifications/new-message';
	var tokenName = $('input[name="csrf_name"]');
	var tokenValue = $('input[name="csrf_value"]');
	var ajaxMsg = {
		"socket_array" : data,
		"csrf_name" : tokenName.attr('value'),
		"csrf_value" : tokenValue.attr('value')
	};

	$.post(url, ajaxMsg, function(response) {
		var obj = JSON.parse(response);
		console.log(obj);
		/*
		** update csrf
		*/
		tokenName.val(obj.csrf.csrf_name);
		tokenValue.val(obj.csrf.csrf_value);
		if (!obj.new_msg) {
			/*
			** update unread messages
			*/
			$('.nav-menu ul#message-list').prepend(
				'<li class="new-message-block">' +
					'<a rel="nofollow" data-id="'+ obj.user.user_id +'" data-chatlink="/chat/'+ obj.user.chat_id +'" href="#" class="dropdown-item d-flex">' +
						'<div class="avatar" style="background-image: url('+ obj.user.avatar +')"></div>' +
						'<div class="msg-body">' +
							'<h3 class="h5">'+ obj.user.username +'</h3><span>Sent You Message</span>' +
						'</div>' +
					'</a>' +
				'</li>'
			);
			/*
			** increase counter for unread messages
			*/
			let msgCount = $('#new-message').text();
			msgCount++;
			$('#new-message').html(msgCount);
		}
	});
}

/*
** when user click on open message
*/
$('.nav-menu ul#message-list').on('click', function(event) {
	event.preventDefault();
	var url = '/notifications/open-message';
	var tokenName = $('input[name="csrf_name"]');
	var tokenValue = $('input[name="csrf_value"]');
	var userId = event.target.closest('a').getAttribute('data-id');
	var chatLink = event.target.closest('a').getAttribute('data-chatlink');
	var ajaxMsg = {
		"action_user_id" : userId,
		"csrf_name" : tokenName.attr('value'),
		"csrf_value" : tokenValue.attr('value')
	};

	$.post(url, ajaxMsg, function(response) {
		console.log(response);
		window.location.replace(chatLink);
	});
});

/*
** load notification box on page load
*/
$(window).on("load", function() {
	var url = '/notifications/load-messages';
	var tokenName = $('input[name="csrf_name"]');
	var tokenValue = $('input[name="csrf_value"]');
	var ajaxMsg = {
		"csrf_name" : tokenName.attr('value'),
		"csrf_value" : tokenValue.attr('value')
	};

	$.post(url, ajaxMsg, function(response) {
		var obj = JSON.parse(response);
		// console.log(obj);
		/*
		** increase counter for unread messages
		*/
		if (obj.notif_count != 0){
			$('#new-message').html(obj.notif_count);
		}
		/*
		** update csrf
		*/
		tokenName.val(obj.csrf.csrf_name);
		tokenValue.val(obj.csrf.csrf_value);
		/*
		** update unread messages
		*/
		$.each(obj, function (key, val) {
			if (key == 'notif_count' || key == 'csrf') {
				return ;
			}
			$('.nav-menu ul#message-list').prepend(
				'<li class="new-message-block">' +
					'<a rel="nofollow" data-id="'+ val.user_id +'" data-chatlink="/chat/'+ val.chat_id +'" href="#" class="dropdown-item d-flex">' +
						'<div class="avatar" style="background-image: url('+ val.avatar +')"></div>' +
						'<div class="msg-body">' +
							'<h3 class="h5">'+ val.username +'</h3><span>Sent You Message</span>' +
						'</div>' +
					'</a>' +
				'</li>'
			);
			console.log(key, val);
		});
	});
});



























