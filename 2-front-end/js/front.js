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

	// ------------------------------------------------------ //
	// For demo purposes, can be deleted
	// ------------------------------------------------------ //

	var stylesheet = $('link#theme-stylesheet');
	$("<link id='new-stylesheet' rel='stylesheet'>").insertAfter(stylesheet);
	var alternateColour = $('link#new-stylesheet');

	if ($.cookie("theme_csspath")) {
		alternateColour.attr("href", $.cookie("theme_csspath"));
	}

	$("#colour").change(function () {

		if ($(this).val() !== '') {

			var theme_csspath = 'css/style.' + $(this).val() + '.css';

			alternateColour.attr("href", theme_csspath);

			$.cookie("theme_csspath", theme_csspath, {
				expires: 365,
				path: document.URL.substr(0, document.URL.lastIndexOf('/'))
			});

		}

		return false;
	});



});

// ------------------------------------------------------ //
// Prevent user img carusel to change slides
// ------------------------------------------------------ //
$('.carousel').carousel({
  interval: 0
});

// ------------------------------------------------------ //
// Upload Photo
// ------------------------------------------------------ //
// vars
let result = document.querySelector('.result'),
img_result = document.querySelector('.img-result'),
img_w = document.querySelector('.img-w'),
img_h = document.querySelector('.img-h'),
options = document.querySelector('.options'),
save = document.querySelector('.save'),
cropped = document.querySelector('.cropped'),
dwn = document.querySelector('.download'),
upload = document.querySelector('#file-input'),
cropper = '';

// on change show image with crop options
upload.addEventListener('change', (e) => {
  if (e.target.files.length) {
		// start file reader
	const reader = new FileReader();
	reader.onload = (e)=> {
	  if(e.target.result){
				// create new image
				let img = document.createElement('img');
				img.id = 'image';
				img.src = e.target.result
				// clean result before
				result.innerHTML = '';
				// append new image
				result.appendChild(img);
				// show save btn and options
				save.classList.remove('hide');
				options.classList.remove('hide');
				// init cropper
				cropper = new Cropper(img);
	  }
	};
	reader.readAsDataURL(e.target.files[0]);
  }
});

// save on click
save.addEventListener('click',(e)=>{
  e.preventDefault();
  // get result to data uri
  let imgSrc = cropper.getCroppedCanvas({
		width: img_w.value // input value
	}).toDataURL();
  // remove hide class of img
  cropped.classList.remove('hide');
	img_result.classList.remove('hide');
	// show image cropped
  cropped.src = imgSrc;
  dwn.classList.remove('hide');
  dwn.download = 'imagename.png';
  dwn.setAttribute('href',imgSrc);
});


// ------------------------------------------------------ //
// Edit profile photo preview
// ------------------------------------------------------ //
var slideIndex = 1;
showDivs(slideIndex);

// function plusDivs(n) {
//   showDivs(slideIndex += n);
// }

function currentDiv(n) {
  showDivs(slideIndex = n);
}

function showDivs(n) {
  var i;
  var x = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("demo");
  if (n > x.length) {slideIndex = 1}
  if (n < 1) {slideIndex = x.length}
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
    dots[i].setAttribute("style", "opacity: .6;");
  }
  x[slideIndex-1].style.display = "block";
  dots[slideIndex-1].setAttribute("style", "opacity: 1;");
}

// ------------------------------------------------------ //
// CUSTOM FILE INPUTS FOR IMAGES
// Custom file inputs with image preview and 
// image file name on selection.
// ------------------------------------------------------ //

$(document).load(function() {
	$('input[type="file"]').each(function(){
	  // Refs
	  var $file = $(this),
	      $label = $file.next('label'),
	      $labelText = $label.find('span'),
	      labelDefault = $labelText.text();
	  console.log("check");
	  // When a new file is selected
	  $file.on('change', function(event){
	    var fileName = $file.val().split( '\\' ).pop(),
	        tmppath = URL.createObjectURL(event.target.files[0]);
	    //Check successfully selection
			if( fileName ){
	      $label
	        .addClass('file-ok')
	        .css('background-image', 'url(' + tmppath + ')');
				$labelText.text(fileName);
	    }else{
	      $label.removeClass('file-ok');
				$labelText.text(labelDefault);
	    }
	  });
	  
	// End loop of file input elements  
	});
	// End ready function
});

























