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
	// ------------------------------------------------------ //
	$('.external').on('click', function (e) {

		e.preventDefault();
		window.open($(this).attr("href"));
	});

	// ------------------------------------------------------- //
	// Highlight current page menu item
	// ------------------------------------------------------ //

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

// function showMessage(messageHTML) {
// 	$('#new-message').html(messageHTML);
// }

var websocket = new WebSocket("ws://localhost:8090/demo/php-socket.php");
websocket.onopen = function(event) {
	// console.log(event);
	console.log('Connection is established!');
	// showMessage("<div class='chat-connection-ack'>Connection is established!</div>");
}
//window.msgAttr
// console.log(globalUser.user.id);
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
				let msgCount = $('#new-message').text();
				msgCount++;
				$('#new-message').html(msgCount);
				sendNotificationToServer(Msg);
			}
		}
	}
};

websocket.onerror = function(event) {
	console.log('Please check if socket server is running');
	// showMessage("<div class='error'>Please check if socket server is running</div>");
};

websocket.onclose = function(event) {
	console.log('Connection Closed');
	// showMessage("<div class='chat-connection-ack'>Connection Closed</div>");
};

function sendNotificationToServer(data) {
	var url = '/chat/addMessage';
	var tokenName = $('input[name="csrf_name"]');
	var tokenValue = $('input[name="csrf_value"]');
	var messageText = $('#chat-message').val();

	$.post(url, ajaxMsg, function(response) {
		console.log(response);
		var obj = JSON.parse(response);
		tokenName.val(obj.csrf_name);
		tokenValue.val(obj.csrf_value);
	});
}
// $('#frmChat').on("submit",function(event){
// 	event.preventDefault();
// 	var url = '/chat/addMessage';
// 	var tokenName = $('input[name="csrf_name"]');
// 	var tokenValue = $('input[name="csrf_value"]');
// 	var messageText = $('#chat-message').val();

// 	var socketMsg = {
// 		"chat_id": msgAttr.chat_id,
// 		"active_user_id": msgAttr.active_user_id,
// 		"active_user_name": msgAttr.active_username,
// 		"dest_user_id": msgAttr.dest_user_id,
// 		"dest_user_name": msgAttr.dest_username,
// 		"chat_message": messageText
// 	};
// 	websocket.send(JSON.stringify(socketMsg));

// 	var ajaxMsg = {
// 		"chat_id": msgAttr.chat_id,
// 		"active_user_id": msgAttr.active_user_id,
// 		"dest_user_id": msgAttr.dest_user_id,
// 		"chat_message": messageText,
// 		"csrf_name" : tokenName.attr('value'),
// 		"csrf_value" : tokenValue.attr('value')
// 	};
// 	console.log(ajaxMsg);
// 	$.post(url, ajaxMsg, function(response) {
// 		console.log(response);
// 		var obj = JSON.parse(response);
// 		tokenName.val(obj.csrf_name);
// 		tokenValue.val(obj.csrf_value);
// 	});
// });











