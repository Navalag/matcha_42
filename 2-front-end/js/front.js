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

	// $('[data-toggle="tooltip"]').tooltip(); 


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

	// var stylesheet = $('link#theme-stylesheet');
	// $("<link id='new-stylesheet' rel='stylesheet'>").insertAfter(stylesheet);
	// var alternateColour = $('link#new-stylesheet');

	// if ($.cookie("theme_csspath")) {
	// 	alternateColour.attr("href", $.cookie("theme_csspath"));
	// }

	// $("#colour").change(function () {

	// 	if ($(this).val() !== '') {

	// 		var theme_csspath = 'css/style.' + $(this).val() + '.css';

	// 		alternateColour.attr("href", theme_csspath);

	// 		$.cookie("theme_csspath", theme_csspath, {
	// 			expires: 365,
	// 			path: document.URL.substr(0, document.URL.lastIndexOf('/'))
	// 		});

	// 	}

	// 	return false;
	// });



});

// ------------------------------------------------------ //
// Prevent user img carusel to change slides
// ------------------------------------------------------ //
// $('.carousel').carousel({
// 	interval: 0
// });

// ------------------------------------------------------ //
// Upload Photo
// ------------------------------------------------------ //
// vars
// let result = document.querySelector('.result'),
// img_result = document.querySelector('.img-result'),
// img_w = document.querySelector('.img-w'),
// img_h = document.querySelector('.img-h'),
// options = document.querySelector('.options'),
// save = document.querySelector('.save'),
// cropped = document.querySelector('.cropped'),
// dwn = document.querySelector('.download'),
// upload = document.querySelector('#file-input'),
// cropper = '';

// // on change show image with crop options
// upload.addEventListener('change', (e) => {
//   if (e.target.files.length) {
// 		// start file reader
// 	const reader = new FileReader();
// 	reader.onload = (e)=> {
// 	  if(e.target.result){
// 				// create new image
// 				let img = document.createElement('img');
// 				img.id = 'image';
// 				img.src = e.target.result
// 				// clean result before
// 				result.innerHTML = '';
// 				// append new image
// 				result.appendChild(img);
// 				// show save btn and options
// 				save.classList.remove('hide');
// 				options.classList.remove('hide');
// 				// init cropper
// 				cropper = new Cropper(img);
// 	  }
// 	};
// 	reader.readAsDataURL(e.target.files[0]);
//   }
// });

// // save on click
// save.addEventListener('click',(e)=>{
//   e.preventDefault();
//   // get result to data uri
//   let imgSrc = cropper.getCroppedCanvas({
// 		width: img_w.value // input value
// 	}).toDataURL();
//   // remove hide class of img
//   cropped.classList.remove('hide');
// 	img_result.classList.remove('hide');
// 	// show image cropped
//   cropped.src = imgSrc;
//   dwn.classList.remove('hide');
//   dwn.download = 'imagename.png';
//   dwn.setAttribute('href',imgSrc);
// });


// ------------------------------------------------------ //
// Edit profile photo preview
// ------------------------------------------------------ //
// var slideIndex = 1;
// showDivs(slideIndex);

// function currentDiv(n) {
//   showDivs(slideIndex = n);
// }

// function showDivs(n) {
//   var i;
//   var x = document.getElementsByClassName("mySlides");
//   var dots = document.getElementsByClassName("demo");
//   if (n > x.length) {slideIndex = 1}
//   if (n < 1) {slideIndex = x.length}
//   for (i = 0; i < x.length; i++) {
//     x[i].style.display = "none";
//   }
//   for (i = 0; i < dots.length; i++) {
//     dots[i].setAttribute("style", "opacity: .6;");
//   }
//   x[slideIndex-1].style.display = "block";
//   dots[slideIndex-1].setAttribute("style", "opacity: 1;");
// }

// ------------------------------------------------------ //
// CUSTOM FILE INPUTS FOR IMAGES
// Custom file inputs with image preview and 
// image file name on selection.
// ------------------------------------------------------ //

$(document).ready(function() {
	$('input[type="file"]').each(function(){
		// Refs
		var $file = $(this),
			$label = $file.next('label'),
			$labelText = $label.find('span'),
			labelDefault = $labelText.text();
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

	$(document).on('click', '.selectMultiple ul li', function(e) {
		var select = $(this).parent().parent();
		var li = $(this);
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

		console.log(li.text());
	});

	$(document).on('click', '.selectMultiple > div a', function(e) {
		var select = $(this).parent().parent();
		var self = $(this);
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
		
		console.log(self.children('em').text());
	});

	$(document).on('click', '.selectMultiple > div .arrow, .selectMultiple > div span', function(e) {
		$(this).parent().parent().toggleClass('open');
	});

});

// ------------------------------------------------------ //
// Show input[range] slider value on page
// ------------------------------------------------------ //

// var slider = document.getElementById("rangeMaxDistance");
// var output = document.querySelector(".slidecontainer span");
// output.innerHTML = slider.value  + " km"; // Display the default slider value

// // Update the current slider value (each time you drag the slider handle)
// slider.oninput = function() {
// 	output.innerHTML = this.value + " km";
// }

// ------------------------------------------------------ //
// Input range multiple value for age gap
// ------------------------------------------------------ //

// $(document).ready(function() {

//   var parent = document.querySelector("#age-gap");
//   if(!parent) return;

//   var
//     rangeS = parent.querySelectorAll("input[type=range].age"),
//     numberS = parent.querySelectorAll("input[type=number].age");

//   rangeS.forEach(function(el) {
//     el.oninput = function() {
//       var slide1 = parseFloat(rangeS[0].value),
//         	slide2 = parseFloat(rangeS[1].value);

//       if (slide1 > slide2) {
// 				[slide1, slide2] = [slide2, slide1];
//         // var tmp = slide2;
//         // slide2 = slide1;
//         // slide1 = tmp;
//       }

//       numberS[0].value = slide1;
//       numberS[1].value = slide2;
//     }
//   });

//   numberS.forEach(function(el) {
//     el.oninput = function() {
// 			var number1 = parseFloat(numberS[0].value),
// 					number2 = parseFloat(numberS[1].value);
			
//       if (number1 > number2) {
//         var tmp = number1;
//         numberS[0].value = number2;
//         numberS[1].value = tmp;
//       }

//       rangeS[0].value = number1;
//       rangeS[1].value = number2;

//     }
//   });

// });

// ------------------------------------------------------ //
// Input range multiple value for rating gap
// ------------------------------------------------------ //

// $(document).ready(function() {

//   var parent = document.querySelector("#rating-gap");
//   if(!parent) return;

//   var
//     rangeS = parent.querySelectorAll("input[type=range].rating"),
//     numberS = parent.querySelectorAll("input[type=number].rating");

//   rangeS.forEach(function(el) {
//     el.oninput = function() {
//       var slide1 = parseFloat(rangeS[0].value),
//         	slide2 = parseFloat(rangeS[1].value);

//       if (slide1 > slide2) {
// 				[slide1, slide2] = [slide2, slide1];
//         // var tmp = slide2;
//         // slide2 = slide1;
//         // slide1 = tmp;
//       }

//       numberS[0].value = slide1;
//       numberS[1].value = slide2;
//     }
//   });

//   numberS.forEach(function(el) {
//     el.oninput = function() {
// 			var number1 = parseFloat(numberS[0].value),
// 					number2 = parseFloat(numberS[1].value);
			
//       if (number1 > number2) {
//         var tmp = number1;
//         numberS[0].value = number2;
//         numberS[1].value = tmp;
//       }

//       rangeS[0].value = number1;
//       rangeS[1].value = number2;

//     }
//   });

// });

// Initialize slider distance:
$(document).ready(function() {
	var rangeDistance = document.getElementById('slider-distance');
	noUiSlider.create(rangeDistance, {
		start: [50],
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
		document.getElementsByName('max-distanse').value = values[handle];
	});
});

// Initialize slider age gap:
$(document).ready(function() {
	var rangeAge = document.getElementById('slider-age-gap');
	noUiSlider.create(rangeAge, {
		start: [18, 33],
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
		document.getElementById('value-age-max').innerHTML = values[1];
		document.getElementsByName('min-age').value = values[0];
		document.getElementsByName('max-age').value = values[1];
	});
});

// Initialize slider fame rating gap:
$(document).ready(function() {
	var rangeRating = document.getElementById('slider-rating-gap');
	noUiSlider.create(rangeRating, {
		start: [40, 70],
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
		document.getElementsByName('min-rating').value = values[0];
		document.getElementsByName('max-rating').value = values[1];
	});
});







