/* global jQuery:false */
var THEMEREX_user_marks = false;

function initReviews() {
	"use strict";

	var fromFront = arguments[0] ? true : false;
	
	// Show current marks
	jQuery('.reviews_data .criteria_stars').each(function() {
		"use strict";
		setStarsOnMark(jQuery(this).find('.theme_stars').eq(0), null);
	});
	
	/*
	if (fromFront) {
		setAverageMark('reviews_author');
		setAverageMark('reviews_users');
	}
	*/
	
	if (allowUserReviews) {
		// Stars selector: over, out and click
		jQuery('.reviews_users .reviews_data').on('mouseover', '.theme_stars', function(e) {
			"use strict";
			if (!allowUserReviews) return;
			jQuery(this).parent().find('.theme_stars').removeClass('theme_stars_on');
			jQuery(this).addClass('theme_stars_on').prevAll().addClass('theme_stars_on');
		});
		jQuery('.reviews_users .reviews_data').on('mouseout', '.theme_stars', function(e) {
			"use strict";
			if (!allowUserReviews) return;
			setStarsOnMark(jQuery(this), null);
		});
		jQuery('.reviews_users .reviews_data').on('click', '.theme_stars', function(e) {
			"use strict";
			if (!allowUserReviews) return;
			if (!THEMEREX_user_marks && jQuery(this).parents('#reviews_users').length > 0) {
				jQuery(this).parent().parent().parent().find('.theme_stars').removeClass('theme_stars_on');
				jQuery(this).parent().parent().parent().find('input').val(0);
				THEMEREX_user_marks = true;
			}
			var mark = Number(jQuery(this).data('mark'));
			if (mark === 1 && mark === Number(jQuery(this).parent().siblings('input').val())) {
				mark = 0;
			}
			setStarsOnMark(jQuery(this), mark);
			setAverageMark(jQuery(this).parents('.reviews_tab').attr('id'));
			// Change description to button
			if (!jQuery('.reviews_users .criteria_summary_text').hasClass('show_button')) {
				jQuery('.reviews_users .criteria_summary_text').addClass('show_button');
			}
		});
	}
	
	// Summary hover
	if (fromFront) {
		jQuery('.criteria_summary').hover(
			function(e) {
				"use strict";
				jQuery(this).addClass('show_word');
			},
			function(e) {
				"use strict";
				jQuery(this).removeClass('show_word');
			}
		);
	}
}

// Show average mark
function setAverageMark() {
	"use strict";
	var id = arguments[0] ? arguments[0] : '';
	var avg = 0;
	var cnt = 0;
	jQuery((id ? '#'+id+' ' : '')+'.reviews_data .criteria_row input').each(function() {
		avg += parseFloat(jQuery(this).val());
		cnt++;
	});
	avg = cnt > 0 ? Math.round(avg/cnt*10)/10 : '0.0';
	if (String(avg).length==1) {
		avg += '.0';
	}
	jQuery((id ? '#'+id+' ' : '')+'.reviews_summary .criteria_mark').html(avg);
	jQuery((id ? '#'+id+' ' : '')+'.reviews_summary .criteria_word').html(getReviewsRatingWordValue(avg));
	setAverageStars(id, avg);
}

// Set average stars width
function setAverageStars(id, avg) {
	"use strict";
	jQuery((id ? '#'+id+' ' : '')+'.reviews_summary .stars_on').css('width', Math.round(avg/5*100)+'%');
}

// Restore or set new stars value
function setStarsOnMark(obj, mark) {
	"use strict";
	if (mark!==null)
		obj.parent().siblings('input').val(mark);
	else
		mark = obj.parent().siblings('input').val();
	obj.parent().find('.theme_stars').removeClass('theme_stars_on').each(function(idx) {
		if (idx<mark) jQuery(this).addClass('theme_stars_on');
	});
}

// Get word-value review rating
function getReviewsRatingWordValue(r) {
	"use strict";
	var words = reviews_levels.split(',');
	r = Math.max(1, Math.min(words.length, Math.round(r)));
	return words[r-1];
}
