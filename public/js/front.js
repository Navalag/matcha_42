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

});

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

// ------------------------------------------------------ //
// Custom carousel on user homepage
// ------------------------------------------------------ //

const next = document.querySelector('.next');
const prev = document.querySelector('.prev');
const slider = document.querySelector('.slider');

if (next && prev && slider) {
	let elementsCount = userPhoto.length;
	let current = 1;
	let slideWidth = 533;
	let shift = 0;

	next.addEventListener('click', () => {
		if (current < elementsCount) {
			slider.classList.toggle('move');
			shift += slideWidth;
			slider.style.transform = `translateX(-${shift}px)`;
			current++;
		} else {
			shift = 0;
			current = 1;
			slider.style.transform = `translateX(${shift}px)`;
		};
	});

	prev.addEventListener('click', () => {
		if (current > 1) {
			slider.classList.toggle('move');
			shift -= slideWidth;
			current--;
			slider.style.transform = `translateX(-${shift}px)`;
		} else if (current === 1) {
			shift = elementsCount * slideWidth - slideWidth;
			slider.classList.toggle('move');
			slider.style.transform = `translateX(-${shift}px)`;
			current = elementsCount;
		};
	});
}



// google maps api key
// AIzaSyBfXFjp3bYD9ZVLAn61pokhELgCOwYKsEE












