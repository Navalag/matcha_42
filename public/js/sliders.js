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
		document.getElementsByName('max-distanse').value = values[handle];
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
		document.getElementsByName('min-age').value = values[0];
		document.getElementsByName('max-age').value = values[1];
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
		document.getElementsByName('min-rating').value = values[0];
		document.getElementsByName('max-rating').value = values[1];
	});
});
