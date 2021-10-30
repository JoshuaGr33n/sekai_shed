/* Javascript for Restaurant Reservations booking form */

var rtb_booking_form = rtb_booking_form || {};

jQuery(document).ready(function ($) {

	/**
	 * Initialize the booking form when loaded
	 */
	rtb_booking_form.init = function() {

		// Scroll to the first error message on the booking form
		if ( $( '.rtb-booking-form .rtb-error' ).length ) {
			$('html, body').animate({
				scrollTop: $( '.rtb-booking-form .rtb-error' ).first().offset().top + -40
			}, 500);
		}

		// Show the message field on the booking form
		$( '.rtb-booking-form .add-message a' ).click( function() {
			$(this).hide();
			$(this).parent().siblings( '.message' ).addClass( 'message-open' )
				.find( 'label' ).focus();

			return false;
		});

		// Show the message field on load if not empty
		if ( $.trim( $( '.rtb-booking-form .message textarea' ).val() ) ) {
			$( '.rtb-booking-form .add-message a' ).trigger( 'click' );
		}

		// Disable the submit button when the booking form is submitted
		$( '.rtb-booking-form form' ).submit( function() {
			$(this).find( 'button[type="submit"]' ).prop( 'disabled', 'disabled' );
			return true;
		} );

		// Enable datepickers on load
		if ( typeof rtb_pickadate !== 'undefined' ) {

			// Declare datepicker
			var $date_input = $( '#rtb-date' );
			if ( $date_input.length ) {
				var date_input = $date_input.pickadate({
					format: rtb_pickadate.date_format,
					formatSubmit: 'yyyy/mm/dd',
					hiddenName: true,
					min: !rtb_pickadate.allow_past,
					container: 'body',
					firstDay: rtb_pickadate.first_day,

					onStart: function() {

						// Block dates beyond early bookings window
						if ( rtb_pickadate.early_bookings !== '' ) {
							this.set( 'max', parseInt( rtb_pickadate.early_bookings, 10 ) );
						}

						// Select the value when loaded if a value has been set
						if ( $date_input.val()	!== '' ) {
							var date = new Date( $date_input.val() );
							if ( Object.prototype.toString.call( date ) === "[object Date]" ) {
								this.set( 'select', date );
							}
						}
					}
				});

				rtb_booking_form.datepicker = date_input.pickadate( 'picker' );
			}

			// Declare timepicker
			var $time_input = $( '#rtb-time' );
			if ( $time_input.length ) {
				var time_input = $time_input.pickatime({
					format: rtb_pickadate.time_format,
					formatSubmit: 'h:i A',
					hiddenName: true,
					interval: parseInt( rtb_pickadate.time_interval, 10 ),
					container: 'body',

					// Select the value when loaded if a value has been set
					onStart: function() {
						if ( $time_input.val()	!== '' ) {
							var today = new Date();
							var today_date = today.getFullYear() + '/' + ( today.getMonth() + 1 ) + '/' + today.getDate();
							var time = new Date( today_date + ' ' + $time_input.val() );
							if ( Object.prototype.toString.call( time ) === "[object Date]" ) {
								this.set( 'select', time );
							}

						}
					}
				});

				rtb_booking_form.timepicker = time_input.pickatime( 'picker' );
			}

			// We need to check both to support different jQuery versions loaded
			// by older versions of WordPress. In jQuery v1.10.2, the property
			// is undefined. But in v1.11.3 it's set to null.
			if ( rtb_booking_form.datepicker === null || typeof rtb_booking_form.datepicker == 'undefined' ) {
				return;
			}

			// Pass conditional configuration parameters
			if ( rtb_pickadate.disable_dates.length ) {

				// Update weekday dates if start of the week has been modified
				var disable_dates = jQuery.extend( true, [], rtb_pickadate.disable_dates );
				if ( typeof rtb_booking_form.datepicker.component.settings.firstDay == 'number' ) {
					var weekday_num = 0;
					for ( var disable_key in rtb_pickadate.disable_dates ) {
						if ( typeof rtb_pickadate.disable_dates[disable_key] == 'number' ) {
							weekday_num = rtb_pickadate.disable_dates[disable_key] - rtb_booking_form.datepicker.component.settings.firstDay;
							if ( weekday_num < 1 ) {
								weekday_num = 7;
							}
							disable_dates[disable_key] =  weekday_num;
						}
					}
				}

				rtb_booking_form.datepicker.set( 'disable', disable_dates );
			}

			if ( typeof rtb_pickadate.late_bookings === 'string' ) {
				if ( rtb_pickadate.late_bookings == 'same_day' ) {
					rtb_booking_form.datepicker.set( 'min', 1 );
				} else if ( rtb_pickadate.late_bookings !== '' ) {
					rtb_pickadate.late_bookings = parseInt( rtb_pickadate.late_bookings, 10 );
					if ( rtb_pickadate.late_bookings % 1 === 0 && rtb_pickadate.late_bookings >= 1440 ) {
						var min = Math.floor( rtb_pickadate.late_bookings / 1440 );
						rtb_booking_form.datepicker.set( 'min', min );
					}
				}
			}

			// If no date has been set, select today's date if it's a valid
			// date. User may opt not to do this in the settings.
			if ( $date_input.val() === '' && !$( '.rtb-booking-form .date .rtb-error' ).length ) {

				if ( rtb_pickadate.date_onload == 'soonest' ) {
					rtb_booking_form.datepicker.set( 'select', new Date() );
				} else if ( rtb_pickadate.date_onload !== 'empty' ) {
					var dateToVerify = rtb_booking_form.datepicker.component.create( new Date() );
					var isDisabled = rtb_booking_form.datepicker.component.disabled( dateToVerify );
					if ( !isDisabled ) {
						rtb_booking_form.datepicker.set( 'select', dateToVerify );
					}
				}
			}

			if ( rtb_booking_form.timepicker === null || typeof rtb_booking_form.timepicker == 'undefined' ) {
				return;
			}

			// Update timepicker on pageload and whenever the datepicker is closed
			rtb_booking_form.update_timepicker_range();
			rtb_booking_form.datepicker.on( {
				open: function () {
					
					rtb_booking_form.before_change_value = rtb_booking_form.datepicker.get();
				},

				close: function() {

					rtb_booking_form.after_change_value = rtb_booking_form.datepicker.get();

					if(rtb_booking_form.before_change_value != rtb_booking_form.after_change_value) {
						// clear time value if date changed
						rtb_booking_form.timepicker.clear();
					}

					rtb_booking_form.update_timepicker_range();
					rtb_booking_form.update_party_size_select();
					rtb_booking_form.update_possible_tables();
				}
			});

			rtb_booking_form.timepicker.on( {
				close: function() {
					rtb_booking_form.update_party_size_select();
					rtb_booking_form.update_possible_tables();
				}
			});

			$( '#rtb-party' ).on( 'change', function() {
				rtb_booking_form.update_possible_tables();
			});

			rtb_booking_form.update_possible_tables();
		}
	};

	/**
	 * Update the timepicker's range based on the currently selected date
	 */
	rtb_booking_form.update_timepicker_range = function() {

		// Reset enabled/disabled rules on this timepicker
		rtb_booking_form.timepicker.set( 'enable', false );
		rtb_booking_form.timepicker.set( 'disable', false );

		if ( rtb_booking_form.datepicker.get() === '' ) {
			rtb_booking_form.timepicker.set( 'disable', true );
			return;
		}

		var selected_date = new Date( rtb_booking_form.datepicker.get( 'select', 'yyyy/mm/dd' ) ),
			selected_date_year = selected_date.getFullYear(),
			selected_date_month = selected_date.getMonth(),
			selected_date_date = selected_date.getDate(),
			current_date = new Date();

		// Declaring the first element true inverts the timepicker settings. All
		// times subsequently declared are valid. Any time that doesn't fall
		// within those declarations is invalid.
		// See: http://amsul.ca/pickadate.js/time/#disable-times-all
		var valid_times = [ rtb_booking_form.get_outer_time_range() ];

		if ( rtb_pickadate.enable_max_reservations ) {
			selected_date_month = ('0' + (selected_date_month + 1)).slice(-2);
			selected_date_date = ('0' + selected_date_date).slice(-2);
			
			var data = 'year=' + selected_date_year + '&month=' + selected_date_month + '&day=' + selected_date_date + '&action=rtb_get_available_time_slots';
			jQuery.post( ajaxurl, data, function( response ) {
				if ( ! response ) {
					rtb_booking_form.timepicker.set( 'disable', true );

					return;
				}

				var additional_valid_times = jQuery.parseJSON( response ); 
				var all_valid_times = valid_times.concat( additional_valid_times ); 
				rtb_booking_form.timepicker.set( 'disable', all_valid_times );
			});
		}

		else {
			// Check if this date is an exception to the rules
			if ( typeof rtb_pickadate.schedule_closed !== 'undefined' ) {
	
				var excp_date = [];
				var excp_start_date = [];
				var excp_start_time = [];
				var excp_end_date = [];
				var excp_end_time = [];
				for ( var closed_key in rtb_pickadate.schedule_closed ) {
	
					excp_date = new Date( rtb_pickadate.schedule_closed[closed_key].date );
					if ( excp_date.getFullYear() == selected_date_year &&
							excp_date.getMonth() == selected_date_month &&
							excp_date.getDate() == selected_date_date
							) {
	
						// Closed all day
						if ( typeof rtb_pickadate.schedule_closed[closed_key].time == 'undefined' ) {
							rtb_booking_form.timepicker.set( 'disable', [ true ] );
	
							return;
						}
	
						if ( typeof rtb_pickadate.schedule_closed[closed_key].time.start !== 'undefined' ) {
							excp_start_date = new Date( '1 January 2000 ' + rtb_pickadate.schedule_closed[closed_key].time.start );
							excp_start_time = [ excp_start_date.getHours(), excp_start_date.getMinutes() ];
						} else {
							excp_start_time = [ 0, 0 ]; // Start of the day
						}
	
						if ( typeof rtb_pickadate.schedule_closed[closed_key].time.end !== 'undefined' ) {
							excp_end_date = new Date( '1 January 2000 ' + rtb_pickadate.schedule_closed[closed_key].time.end );
							excp_end_time = [ excp_end_date.getHours(), excp_end_date.getMinutes() ];
						} else {
							excp_end_time = [ 24, 0 ]; // End of the day
						}
	
						excp_start_time = rtb_booking_form.get_earliest_time( excp_start_time, selected_date, current_date );
	
						valid_times.push( { from: excp_start_time, to: excp_end_time, inverted: true } );
					}
				}
	
				excp_date = excp_start_date = excp_start_time = excp_end_date = excp_end_time = null;
	
				// Exit early if this date is an exception
				if ( valid_times.length > 1 ) {
					rtb_booking_form.timepicker.set( 'disable', valid_times );
	
					return;
				}
			}
	
			// Get any rules which apply to this weekday
			if ( typeof rtb_pickadate.schedule_open != 'undefined' ) {
	
				var selected_date_weekday = selected_date.getDay();
	
				var weekdays = {
					sunday: 0,
					monday: 1,
					tuesday: 2,
					wednesday: 3,
					thursday: 4,
					friday: 5,
					saturday: 6,
				};
	
				var rule_start_date = [];
				var rule_start_time = [];
				var rule_end_date = [];
				var rule_end_time = [];
				for ( var open_key in rtb_pickadate.schedule_open ) {
	
					if ( typeof rtb_pickadate.schedule_open[open_key].weekdays !== 'undefined' ) {
						for ( var weekdays_key in rtb_pickadate.schedule_open[open_key].weekdays ) {
							if ( weekdays[weekdays_key] == selected_date_weekday ) {
	
								// Closed all day
								if ( typeof rtb_pickadate.schedule_open[open_key].time == 'undefined' ) {
									rtb_booking_form.timepicker.set( 'disable', [ true ] );
	
									return;
								}
	
								if ( typeof rtb_pickadate.schedule_open[open_key].time.start !== 'undefined' ) {
									rule_start_date = new Date( '1 January 2000 ' + rtb_pickadate.schedule_open[open_key].time.start );
									rule_start_time = [ rule_start_date.getHours(), rule_start_date.getMinutes() ];
								} else {
									rule_start_time = [ 0, 0 ]; // Start of the day
								}
	
								if ( typeof rtb_pickadate.schedule_open[open_key].time.end !== 'undefined' ) {
									rule_end_date = new Date( '1 January 2000 ' + rtb_pickadate.schedule_open[open_key].time.end );
									rule_end_time = rtb_booking_form.get_latest_viable_time( rule_end_date.getHours(), rule_end_date.getMinutes() );
								} else {
									rule_end_time = [ 24, 0 ]; // End of the day
								}
	
								rule_start_time = rtb_booking_form.get_earliest_time( rule_start_time, selected_date, current_date );
	
								valid_times.push( { from: rule_start_time, to: rule_end_time, inverted: true } );
	
							}
						}
					}
				}
	
				rule_start_date = rule_start_time = rule_end_date = rule_end_time = null;
	
				// Pass any valid times located
				if ( valid_times.length > 1 ) {
					rtb_booking_form.timepicker.set( 'disable', valid_times );
	
					return;
				}
	
			}

			// Set it to always open if no rules have been defined
			rtb_booking_form.timepicker.set( 'enable', true );
			rtb_booking_form.timepicker.set( 'disable', false );
		}

		return;
	};

	/**
	 * Get the outer times to exclude based on the time interval
	 *
	 * This is a work-around for a bug in pickadate.js
	 * See: https://github.com/amsul/pickadate.js/issues/614
	 */
	rtb_booking_form.get_outer_time_range = function() {

		var interval = rtb_booking_form.timepicker.get( 'interval' );

		var hour = 24;

		while ( interval >= 60 ) {
			hour--;
			interval -= 60;
		}

		if ( interval > 0 ) {
			hour--;
			interval = 60 - interval;
		}

		return { from: [0, 0], to: [ hour, interval ] };
	};

	/**
	 * Get the latest working opening hour/minute value
	 *
	 * This is a workaround for a bug in pickadate.js. The end time of a valid
	 * time value must NOT fall within the last timepicker interval and midnight
	 * See: https://github.com/amsul/pickadate.js/issues/614
	 */
	rtb_booking_form.get_latest_viable_time = function( hour, minute ) {

		var interval = rtb_booking_form.timepicker.get( 'interval' );

		var outer_time_range = this.get_outer_time_range(); 

		/* 
		* Adjust the last time for wide intervals, so that the last time entered
		* corresponds to an interval time. A pickadate bug causes a later time to
		* be available for booking otherwise.
		 */
		if ( interval > 60) {

			var last_hour = 0;
			var last_minute = 0;
			var last_time_minutes = 0;

			var end_time_minutes = 60 * hour + minute;

			while ( ( last_time_minutes + interval ) <= end_time_minutes ) {
				
				var remainder = interval + last_minute;

				while ( remainder >= 60 ) {
					last_hour++;
					remainder -= 60;
				}

				last_minute = remainder;

				last_time_minutes = 60 * last_hour + last_minute;
			}

			var long_interval_viable_time = [ last_hour, last_minute ];
		}

		
		if ( interval > 60 ) {
			
			return long_interval_viable_time;
		}
		else if ( hour > outer_time_range.to[0] || minute > outer_time_range.to[1] ) {
			
			return [ outer_time_range.to[0], outer_time_range.to[1] ];
		} else {
			
			return [ hour, minute ];
		}
	};

	/**
	 * Get the earliest valid time
	 *
	 * This checks the valid time for the day and, if a current day, applies
	 * any late booking restrictions. It also ensures that times in the past
	 * are not availabe.
	 *
	 * @param array start_time
	 * @param array selected_date
	 * @param array current_date
	 */
	rtb_booking_form.get_earliest_time = function( start_time, selected_date, current_date ) {

		// Only make adjustments for current day selections
		if ( selected_date.toDateString() !== current_date.toDateString() ) {
			return start_time;
		}

		// Get the number of minutes after midnight to compare
		var start_minutes = ( start_time[0] * 60 ) + start_time[1],
			current_minutes = ( current_date.getHours() * 60 ) + current_date.getMinutes(),
			late_booking_minutes;

		start_minutes = start_minutes > current_minutes ? start_minutes : current_minutes;

		if ( typeof rtb_pickadate.late_bookings === 'number' && rtb_pickadate.late_bookings % 1 === 0 ) {
			late_booking_minutes = current_minutes + rtb_pickadate.late_bookings;
			if ( late_booking_minutes > start_minutes ) {
				start_minutes = late_booking_minutes;
			}
		}

		start_time = [ Math.floor( start_minutes / 60 ), start_minutes % 60 ];

		return start_time;
	};

	rtb_booking_form.update_party_size_select = function() {
		
		if ( rtb_pickadate.enable_max_reservations && rtb_pickadate.max_people ) {
			var partySelect = $('#rtb-party'),
			selected_date = new Date( rtb_booking_form.datepicker.get( 'select', 'yyyy/mm/dd' ) ),
			selected_date_year = selected_date.getFullYear(),
			selected_date_month = selected_date.getMonth(),
			selected_date_date = selected_date.getDate(),
			selected_time = rtb_booking_form.timepicker.get('value');

			if ( ! selected_time ) { return; }

			selected_date_month = ('0' + (selected_date_month + 1)).slice(-2);
			selected_date_date = ('0' + selected_date_date).slice(-2);

			//reset party size
			partySelect.prop("selectedIndex", 0).change();
			
			var data = 'year=' + selected_date_year + '&month=' + selected_date_month + '&day=' + selected_date_date + '&time=' + selected_time + '&action=rtb_get_available_party_size';
			jQuery.post( ajaxurl, data, function( response ) {
				if ( ! response ) {
					return;
				}

				response = jQuery.parseJSON(response);

				var available_spots = response.available_spots;

				partySelect.prop('disabled', false);

				partySelect.find('> option').each(function() {
					var that = $(this); 
					if (this.value > available_spots) {
						that.prop('disabled', true);
					} else {
						that.prop('disabled', false);
					}
				});
			});
		}
	}

	rtb_booking_form.update_possible_tables = function() { 
		
		if ( rtb_pickadate.enable_tables ) { 

			var table_select = $('#rtb-table'),
			party = $('#rtb-party').val(),
			selected_date = new Date( rtb_booking_form.datepicker.get( 'select', 'yyyy/mm/dd' ) ),
			selected_date_year = selected_date.getFullYear(),
			selected_date_month = selected_date.getMonth(),
			selected_date_date = selected_date.getDate(),
			selected_time = rtb_booking_form.timepicker.get('value');

			if ( ! selected_time || ! party ) { return; }

			selected_date_month = ('0' + (selected_date_month + 1)).slice(-2);
			selected_date_date = ('0' + selected_date_date).slice(-2);

			//reset table selection
			table_select.prop("selectedIndex", 0).change();

			//remove table combinations
			table_select.find('> option').each( function() {
				if ( $( this ).val().indexOf( ',' ) !== -1 ) { $( this ).remove(); }
			});

			var booking_id = $( '.rtb-booking-form form input[name="ID"]').length ? $( '.rtb-booking-form form input[name="ID"]').val() : 0;

			var data = 'booking_id=' + booking_id + '&year=' + selected_date_year + '&month=' + selected_date_month + '&day=' + selected_date_date + '&time=' + selected_time + '&party=' + party + '&action=rtb_get_available_tables';
			jQuery.post( ajaxurl, data, function( response ) {
				if ( ! response ) {
					return;
				}

				response = jQuery.parseJSON(response);

				var available_tables = response.available_tables;

				table_select.prop('disabled', false);

				table_select.find('> option').hide();
				table_select.find('> option').attr('disabled', 'disabled');

				jQuery.each(available_tables, function(index, element) {

					if ( index.indexOf( ',' ) === -1 ) { 
						table_select.find('> option[value="' + index + '"]').show();
						table_select.find('> option[value="' + index + '"]').removeAttr('disabled', 'disabled');
					}
					else {
						table_select.append( '<option value="' + index + '">' + element + '</option>' );
					}

				});

				if ( response.selected_table != -1 ) { 
					table_select.val( response.selected_table );
				}

			});
		}

	}

	rtb_booking_form.init();
});

//Handle reservation modification
jQuery(document).ready(function() {
	jQuery('.rtb-modification-toggle').on('click', function() {
		jQuery('.rtb-modification-form, .rtb-booking-form-form').toggleClass('rtb-hidden');

		if (jQuery('.rtb-modification-form').hasClass('rtb-hidden')) {
			jQuery('.rtb-modification-toggle').html(rtb_booking_form_js_localize.want_to_modify);
		}
		else {
			jQuery('.rtb-modification-toggle').html(rtb_booking_form_js_localize.make);
		}
	});

	jQuery(document).on('click', '.rtb-find-reservation-button', function() {
		var booking_email = jQuery('input[name="rtb_modification_email"]').val();

		var data = 'booking_email=' + booking_email + '&action=rtb_find_reservations';
		jQuery.post(ajaxurl, data, function(response) {

			if (response.success) {
				var booking_html = '';
				var guest_txt = '';
				var pay_btn = '';

				jQuery(response.data.bookings).each(function( index, val) {
					pay_btn = '';
					guest_txt = val.party > 1 ? rtb_booking_form_js_localize.guests : rtb_booking_form_js_localize.guest;
					
					if('payment_pending' == val.status || 'payment_failed' == val.status) {
						pay_btn = `
							<div class="rtb-deposit-booking" data-bookingid="${val.ID}" data-bookingemail="${val.email}">
								${rtb_booking_form_js_localize.deposit}
							</div>
						`;
					}

					booking_html += `
						<div class="rtb-cancel-booking-div">
							<div class="rtb-cancel-booking" data-bookingid="${val.ID}" data-bookingemail="${val.email}">
								${rtb_booking_form_js_localize.cancel}
							</div>
							${pay_btn}
							<div class="rtb-booking-information">${val.datetime} - ${val.party} ${guest_txt} (${val.status_lbl})</div>
						</div>
					`;
				});

				jQuery('.rtb-bookings-results').html(booking_html);

				cancellationHandler();
				delayedPaymentHandler();
			}
			else {jQuery('.rtb-bookings-results').html(response.data.msg);}
		});
	});
});

function cancellationHandler() {
	jQuery('.rtb-cancel-booking:not(.cancelled)').off('click');
	jQuery('.rtb-cancel-booking:not(.cancelled)').on('click', function() {
		var btn = jQuery(this);

		if(btn.hasClass('processing')) {
			return;
		}

		btn.addClass('processing');

		var booking_id = btn.data('bookingid');
		var booking_email = btn.data('bookingemail');

		var data = {
			'booking_id': booking_id,
			'booking_email': booking_email,
			'action': 'rtb_cancel_reservations'
		};

		jQuery.post(ajaxurl, data, function(response) {
			if (response.success) {
				if (response.data.hasOwnProperty('cancelled_redirect')) {
					window.location.href = response.data.cancelled_redirect;
				}
				else {
					btn.off('click');
					btn.addClass('cancelled');
					btn.text('Cancelled');
				}
			}
			else {
				btn.parent().after(`<p class="alert error">${response.data.msg}</p>`);
			}

			btn.removeClass('processing');
		});
	});
}

function delayedPaymentHandler() {
	jQuery('.rtb-deposit-booking').off('click');
	jQuery('.rtb-deposit-booking').on('click', function() {
		var btn = jQuery(this);

		if(btn.hasClass('processing')) {
			return;
		}

		btn.addClass('processing');

		var booking_id = btn.data('bookingid');
		var booking_email = btn.data('bookingemail');

		var data = {
			'booking_id': booking_id,
			'booking_email': booking_email,
			'payment': 'rtb-delayed-deposit'
		};

		let current_loc = window.location;
		let params = new URLSearchParams();
		Object.keys( data ).map( function( param ) { params.append( param, data[ param ] ) } );

		window.location = current_loc.origin + current_loc.pathname + '?' + params.toString();

	});
}

// Functions for the 'View Bookings' shortcode
jQuery(document).ready(function ($) {
	jQuery('.rtb-view-bookings-form-date-selector').on('change', function() {
		window.location.href = replaceUrlParam(window.location.href, 'date', jQuery(this).val());
	});

	jQuery('.rtb-edit-view-booking').on('click', function() {
		jQuery('.rtb-view-bookings-form-confirmation-div, .rtb-view-bookings-form-confirmation-background-div').removeClass('rtb-hidden');

		jQuery('.rtb-view-bookings-form-confirmation-div').data('bookingid', jQuery(this).data('bookingid'));

		jQuery(this).prop('checked', false);
	});

	jQuery('.rtb-view-bookings-form-confirmation-accept').on('click', function() {
		var booking_id = jQuery('.rtb-view-bookings-form-confirmation-div').data('bookingid');

		var data = 'booking_id=' + booking_id + '&action=rtb_set_reservation_arrived';
		jQuery.post(ajaxurl, data, function(response) {

			if (response.success) {window.location.href = window.location.href}
			else {jQuery('.rtb-view-bookings-form-confirmation-div').html(response.data.msg);}
		});
	});

	jQuery('.rtb-view-bookings-form-confirmation-decline').on('click', function() {
		jQuery('.rtb-view-bookings-form-confirmation-div, .rtb-view-bookings-form-confirmation-background-div').addClass('rtb-hidden');
	});
	jQuery('.rtb-view-bookings-form-confirmation-background-div').on('click', function() {
		jQuery('.rtb-view-bookings-form-confirmation-div, .rtb-view-bookings-form-confirmation-background-div').addClass('rtb-hidden');
	});
	jQuery('#rtb-view-bookings-form-close').on('click', function() {
		jQuery('.rtb-view-bookings-form-confirmation-div, .rtb-view-bookings-form-confirmation-background-div').addClass('rtb-hidden');
	});
});

function replaceUrlParam(url, paramName, paramValue)
{
    if (paramValue == null) {
        paramValue = '';
    }
    var pattern = new RegExp('\\b('+paramName+'=).*?(&|#|$)');
    if (url.search(pattern)>=0) {
        return url.replace(pattern,'$1' + paramValue + '$2');
    }
    url = url.replace(/[?#]$/,'');
    return url + (url.indexOf('?')>0 ? '&' : '?') + paramName + '=' + paramValue;
}