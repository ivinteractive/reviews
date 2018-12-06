/*=============================
=         Star Effects        =
=============================*/

console.log(campaign_title);

var starRatings = document.querySelectorAll('#star-ratings star'),
	activeStars = 0;

if(starRatings.length > 0) {
	for(var i=0; i<starRatings.length; i++) {
		starRatings[i].index = i;
		starRatings[i].addEventListener('mouseover', hoverStar);
		starRatings[i].addEventListener('mouseleave', hoverStar);
		starRatings[i].addEventListener('click', clickStar);
	}
}

function hoverStar(e) {
	if(this.index >= activeStars) {
		for(var i=activeStars > 0 ? activeStars : 0; i<=this.index; i++)
			starRatings[i].className = e.type == 'mouseover' ? 'hover' : '';
	}
	else {
		if(e.type == 'mouseover') {
			for(var j=activeStars-1; j>this.index; j--)
				starRatings[j].className = '';
		}
		else if(e.type == 'mouseleave') {
			for(var k=0; k<activeStars; k++)
				starRatings[k].className = 'hover';
		}
	}
}

function clickStar(e) {
	activeStars = activeStars - 1;
	var length = activeStars > this.index ? activeStars : this.index;
	for(var i=0; i<=length; i++) {
		starRatings[i].className = this.index != activeStars && i <= this.index ? 'hover' : '';
	}
	activeStars = document.querySelectorAll('#star-ratings star.hover').length;
	document.querySelector('#selected-rating span').innerHTML = activeStars;
	document.getElementById('rating').value = activeStars;
}

/*=============================
=        Event Tracking       =
=============================*/

var links = document.querySelectorAll('a:not(#external-review-link)');
for (var i = 0; i < links.length; i++) {
	links[i].addEventListener('click', function(e) {
		trackEvent('Outbound Link', 'Link Click', e.currentTarget.innerText, '');
	});
}

var externalReviewLink = document.getElementById('external-review-link');
if (externalReviewLink) {
	externalReviewLink.addEventListener('click', function(e) {
		var linkText = e.currentTarget.innerText.split(" ");
		trackEvent('Exit To Review Site', 'CTA Button Click', linkText[linkText.length - 1], '');
	});
}


/*=============================
=        Form Submission      =
=============================*/

var loadTime = new Date().getTime(),
	reviewsForm = document.getElementById('reviews-form');

if(reviewsForm) {
	grabToken(reviewsForm);
	reviewsForm.addEventListener('submit', formSubmit);
}

var reviews = document.querySelectorAll('#reviews-list form');
if(reviews.length > 0) {
	for(var i=0; i<reviews.length; i++) {
		reviews[i].addEventListener('submit', formSubmit);
	}
}

function formSubmit(e) {
	e.preventDefault();

	var form = this,
		displayField = form.querySelector('input[name="display"]');

	if(form.classList.contains('display-form')) {
		displayField.setAttribute('value', displayField.value == '0' ? '1' : '0');
	}

	var data = getFormData(form);

	reqwest({
		url: form.action,
		method: form.method,
		type: 'json',
		data: data,
		success: function(r) {
			console.log(r.errors);
			if (r.errors && Object.keys(r.errors).length > 0) {
				setErrors(form, r.errors);
				trackEvent('Negative Feedback Form', 'Form Submit', campaign_title, '0');
			}
			if(r.message && r.errors.length == 0) {
				document.getElementById('wrapper').innerHTML = r.message;
				trackEvent('Negative Feedback Form', 'Form Submit', campaign_title, '1');
			}
			if(r.display) {
				form.querySelector('button').className = displayField.value == '1' ? 'added' : '';
			}
		},
		error: function(r) {
			console.log(r);
		},
	});
}

function getFormData(form) {
	var types = ['INPUT', 'TEXTAREA', 'SELECT'];
	var dataObject = {};

	for(t=0;t<types.length;t++) {
		var inputs = form.getElementsByTagName(types[t]);
		for(var i=0;i<inputs.length;i++) {
			dataObject[inputs[i].name] = inputs[i].value;
		}
	}

	if(form.querySelector('[name="_submit"]')) {
		dataObject._submit = form.querySelector('[name="_submit"]').value;
	}

	var now = new Date().getTime();
	dataObject.c_time = ((now - loadTime) / 1000) < 7 ? 1 : 0;

	return dataObject;
}

function grabToken(form) {
	var time = new Date().getTime();
	reqwest({
		url: '/token-gen/'+form.id+'?_='+time,
		method: 'GET',
		type: 'json',
		success: function(r) {
			form.querySelector('[name="_submit"]').value = r.token;
			form.querySelector('#token').value = randomString(r.token);
		},
		error: function(r) {
			console.log(r);
		},
	});
}

function randomString(token) {
	var chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz",
		strlen = 5,
		randomstring = '';
	for(var i=0; i<strlen; i++) {
		var rnum = Math.floor(Math.random() * chars.length);
		randomstring += chars.substring(rnum,rnum+1);
	}
	return token + randomstring;
}

// function externalClicked() {
// 	document.getElementById('clicked').value = '1';
// 	form.dispatchEvent(new Event('submit'));
// }

function setErrors(form, errors) {
	var current = form.querySelectorAll('.error');

	for(var err=0; err<current.length; err++) {
		current[err].className = current[err].className.replace(' error', '');
	}

	for(var key in errors) {
		var input = form.querySelector('[name="'+key+'"]');
		if(input) {
			input.parentNode.className += ' error';
		}
	}
}

function trackEvent(campaign,action,label,value) {
	value = typeof value !== 'undefined' ? value : '0';
	if(typeof ga==='undefined') {
		console.log(label);
	} else {
		if ("ga" in window) {
			tracker = ga.getAll()[0];
			if (tracker)
				tracker.send('event',campaign, action, label, value);
		}
	}
}
