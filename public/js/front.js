$(document).ready(function () {

	'use strict';

	// ------------------------------------------------------- //
	// Search Box
	// ------------------------------------------------------ //
	$('#search').on('click', function (e) {
		e.preventDefault();
		$('.search-box').fadeIn();
	});
	$('.dismiss').on('click', function () {
		$('.search-box').fadeOut();
	});

	// ------------------------------------------------------- //
	// Card Close
	// ------------------------------------------------------ //
	$('.card-close a.remove').on('click', function (e) {
		e.preventDefault();
		$(this).parents('.card').fadeOut();
	});

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
			} else {
				$('.navbar-header .brand-small').show();
				$('.navbar-header .brand-big').hide();
			}
		}

		if ($(window).outerWidth() < 1183) {
			$('.navbar-header .brand-small').show();
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
    // Chat start
    // ------------------------------------------------------ //


    var websocket = new WebSocket("ws://localhost:8090/demo/php-socket.php");
    websocket.onopen = function(event) {
        showMessage("<div class='chat-connection-ack'>Connection is established!</div>");
    }
    websocket.onmessage = function(event) {
        var Data = JSON.parse(event.data);
        showMessage("<div class='"+Data.message_type+"'>"+Data.message+"</div>");
        $('#chat-message').val('');
    };

    websocket.onerror = function(event){
        showMessage("<div class='error'>Problem due to some Error</div>");
    };
    websocket.onclose = function(event){
        showMessage("<div class='chat-connection-ack'>Connection Closed</div>");
    };

    $('#frmChat').on("submit",function(event){
        event.preventDefault();
        $('#chat-user').attr("type","hidden");
        var messageJSON = {
            chat_user: $('#chat-user').val(),
            chat_message: $('#chat-message').val()
        };
        websocket.send(JSON.stringify(messageJSON));
    });

    // ------------------------------------------------------- //
    // Chat end
    // ------------------------------------------------------ //

});




// google maps api key
// AIzaSyBfXFjp3bYD9ZVLAn61pokhELgCOwYKsEE












