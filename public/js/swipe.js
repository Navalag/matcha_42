// ------------------------------------------------------ //
// Tinder style swipe
// ------------------------------------------------------ //

// 'use strict';

var tinderContainer = document.querySelector('.tinder');
var allCards = document.querySelectorAll('.tinder--card');
var nope = document.getElementById('nope');
var love = document.getElementById('love');
var machScreen = document.querySelector('.match-screen');
var dataJSON = document.querySelector('.link-button');
var i = 1;

function initCards(card, index) {
	var newCards = document.querySelectorAll('.tinder--card:not(.removed)');

	newCards.forEach(function (card, index) {
		card.style.zIndex = allCards.length - index;
		// card.style.transform = 'scale(' + (20 - index) / 20 + ') translateY(-' + 30 * index + 'px)';
		card.style.opacity = (10 - index) / 10;
	});
	
	tinderContainer.classList.add('loaded');
}

initCards();

allCards.forEach(function (el) {
	var hammertime = new Hammer(el);

	hammertime.on('pan', function (event) {
		el.classList.add('moving');
	});

	hammertime.on('pan', function (event) {
		if (event.deltaX === 0) return;
		if (event.center.x === 0 && event.center.y === 0) return;

		tinderContainer.classList.toggle('tinder_love', event.deltaX > 0);
		tinderContainer.classList.toggle('tinder_nope', event.deltaX < 0);

		var xMulti = event.deltaX * 0.03;
		var yMulti = event.deltaY / 80;
		var rotate = xMulti * yMulti;

		event.target.style.transform = 'translate(' + event.deltaX + 'px, ' + event.deltaY + 'px) rotate(' + rotate + 'deg)';
	});

	hammertime.on('panend', function (event) {
		el.classList.remove('moving');
		var moveOutWidth = document.body.clientWidth;
		var keep = Math.abs(event.deltaX) < 80 || Math.abs(event.velocityX) < 0.5;
		var userId = event.target.children[0].getAttribute("data-id");

		event.target.classList.toggle('removed', !keep);

		if (keep) {
			event.target.style.transform = '';
		} else {
			var endX = Math.max(Math.abs(event.velocityX) * moveOutWidth, moveOutWidth);
			var toX = event.deltaX > 0 ? endX : -endX;
			var endY = Math.abs(event.velocityY) * moveOutWidth;
			var toY = event.deltaY > 0 ? endY : -endY;
			var xMulti = event.deltaX * 0.03;
			var yMulti = event.deltaY / 80;
			var rotate = xMulti * yMulti;
			event.target.style.transform = 'translate(' + toX + 'px, ' + (toY + event.deltaY) + 'px) rotate(' + rotate + 'deg)';
			initCards();
			if (tinderContainer.classList.contains('tinder_love')) {
				sendActionToServer('love', userId);
				dataJSON.setAttribute('data-json-id', i);
				i++;
			} else if (tinderContainer.classList.contains('tinder_nope')) {
				sendActionToServer('skip', userId);
				dataJSON.setAttribute('data-json-id', i);
				i++;
			}
		}
		tinderContainer.classList.remove('tinder_love');
		tinderContainer.classList.remove('tinder_nope');
	});
});

function sendActionToServer(action, userId) {
	var urlLove = '/search/like';
	var urlSkip = '/search/nope';
	var urlBlock = '/search/block';
	var urlReportFake = '/search/report_fake';
	var urlCheckProfile = '/search/check_profile';
	var tokenName =  $('input[name="csrf_name"]').attr('value');
	var tokenValue =  $('input[name="csrf_value"]').attr('value');
	var data = {"action_user_id" : userId,"csrf_name" : tokenName,"csrf_value" : tokenValue};
	if (action == 'love') {
		$.post(urlLove, data, function(response) {
			console.log(response);
			// if (match) {
				// machScreen.style.zIndex = 999;
				// machScreen.style.opacity = 1;
			// }
		});
	} else if (action == 'skip') {
		$.post(urlSkip, data, function(response) {
			console.log(response);
		});
	} else if (action == 'block') {
		$.post(urlBlock, data, function(response) {
			console.log(response);
		});
	} else if (action == 'report_fake') {
		$.post(urlReportFake, data, function(response) {
			console.log(response);
		});
	} else if (action == 'check_profile') {
		$.post(urlCheckProfile, data, function(response) {
			console.log(response);
		});
	}
}

function createButtonListener(love) {
	return function (event) {
		var cards = document.querySelectorAll('.tinder--card:not(.removed)');
		var moveOutWidth = document.body.clientWidth * 1.5;

		if (!cards.length) return false;

		var card = cards[0];
		var userId = card.children[0].getAttribute("data-id");
		// console.log(userId);

		card.classList.add('removed');

		if (love) {
			card.style.transform = 'translate(' + moveOutWidth + 'px, -100px) rotate(-30deg)';
			sendActionToServer('love', userId);
			// machScreen.style.zIndex = 999;
			// machScreen.style.opacity = 1;
			dataJSON.setAttribute('data-json-id', i);
			i++;
		} else {
			sendActionToServer('skip', userId);
			card.style.transform = 'translate(-' + moveOutWidth + 'px, -100px) rotate(30deg)';
			dataJSON.setAttribute('data-json-id', i);
			i++;
		}

		initCards();

		event.preventDefault();
	};
}

var nopeListener = createButtonListener(false);
var loveListener = createButtonListener(true);

nope.addEventListener('click', nopeListener);
love.addEventListener('click', loveListener);

machScreen.querySelector('.match-return-btn').addEventListener('click', function(){
	machScreen.style.opacity = 0;
	machScreen.style.zIndex = 0;
});

// ------------------------------------------------------ //
// Open user profile on find a match page
// ------------------------------------------------------ //

$(document).ready(function () {
	$('.other-user-profile').hide();
	$('.card-header').hide();
});

function blockUser() {
	var user_id = $('#block').attr('data-id');
	console.log(user_id);
	// if (sendActionToServer('block', user_id)) {
	// 	console.log('success');
	// } else {
	// 	console.log('fail');
	// }
	sendActionToServer('block', user_id);
}

function reportFakeAccount() {
	var user_id = $('#report').attr('data-id');
	console.log(user_id);
	// if (sendActionToServer('report_fake', user_id)) {
	// 	console.log('success');
	// } else {
	// 	console.log('fail');
	// }
	sendActionToServer('report_fake', user_id);
}

function openUserProfile() {
	var jsonId = document.querySelector('.link-button').getAttribute("data-json-id");
	// console.log('check open');
	$( ".tinder" ).hide();
	$('.card-header').show();
	$('.other-user-profile').show();

	sendActionToServer('check_profile', usersJSON[jsonId].basic_info.id);
	/*
	** display user photo
	*/
	const next = document.querySelector('.next');
	const prev = document.querySelector('.prev');
	const slider = document.querySelector('.slider');
	console.log(usersJSON[jsonId].photo);

	if (next && prev && slider) {
		let elementsCount = usersJSON[jsonId].photo.length;
		let current = 1;
		let slideWidth = 533;
		let shift = 0;

		/*
		** insert user photo into slider
		*/
		usersJSON[jsonId].photo.forEach(function(photo) {
			$(".slider").append("<div class=\"slide\" style=\"background-image: url('"+
				photo
				+"')\"></div>");
		});

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

	/*
	** display other info
	**
	** 1. Firs name, Last name, age
	** 2. About me
	** 3. Interests
	** 4. Popularity
	*/
	// 1)
	$("#name-age").append(
		"<h3>"+
		usersJSON[jsonId].basic_info.first_name
		+" "+
		usersJSON[jsonId].basic_info.last_name
		+",</h3><span>"+" "+
		usersJSON[jsonId].basic_info.age
		+"</span>"
	);
	// 2)
	if (usersJSON[jsonId].basic_info.about_me) {
		$("#name-age").after(
			"<h5 class=\"card-title\" id=\"about_title\">About:</h5>" +
			"<p class=\"card-text\" id=\"about_body\">"+
				usersJSON[jsonId].basic_info.about_me
			+"</p>"
		);
	}
	// 3)
	if (usersJSON[jsonId].interests) {
		usersJSON[jsonId].interests.forEach(function(interest) {
			$("#user-tags").append("<span class=\"badge badge-info\" style=\"margin: 0px 3px;\">"+
				interest
			+"</span>");
		});
	}
	// 4)
	$("#progress").append(
		"<div class=\"progress-bar bg-red\" role=\"progressbar\" style=\"width: "+
		usersJSON[jsonId].basic_info.fame_rating
		+"%; height: 7px;\" aria-valuenow=\""+
		usersJSON[jsonId].basic_info.fame_rating
		+"\" aria-valuemin=\"0\" aria-valuemax=\"100\"></div>"
	);

	/*
	** insert data-id for block and report buttons
	*/
	$('#block').attr('data-id', usersJSON[jsonId].basic_info.id);
	$('#report').attr('data-id', usersJSON[jsonId].basic_info.id);
}

function hideUserProfile() {
	// console.log('check close');
	$('.other-user-profile').hide();
	$('.card-header').hide();
	$( ".tinder" ).show();
	$(".slider").children().remove();
	$("#name-age").children().remove();
	$("#about_title").remove();
	$("#about_body").remove();
	$("#user-tags").children().remove();
	$("#progress").children().remove();
}









