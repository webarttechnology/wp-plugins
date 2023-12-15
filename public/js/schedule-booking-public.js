(function( $ ) {
	'use strict';

	/**
	 * All of the code for your public-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */

	
	$(document).ready(function() {
		// Hide all steps except the first one
		$('.step:not(:first)').hide();
	  
		// Handle next button click
		$('.next').on('click', function() {
		  var currentStep = $(this).closest('.step');

		var value_name = $('#name').val();
		var value_phone = $('#phone').val();
		var value_email = $('#email').val();
		var value_date = $('#appointment_datepicker').val();
		  if(parseInt(currentStep.data('step')) === 1){

			if(value_name === '' || value_phone === '' || value_email === ''){
				alert('Please fill the all fields');
				// return false;
			}else{
			
				var nextStep = $('[data-step="' + (parseInt(currentStep.data('step')) + 1) + '"]');
			currentStep.hide();
			nextStep.show();
			
			}

		  }else if(parseInt(currentStep.data('step')) === 2){

			
			if(value_date === ''){
				alert('Please select date');
				// return false;
			}else{
			
				var nextStep = $('[data-step="' + (parseInt(currentStep.data('step')) + 1) + '"]');
			currentStep.hide();
			nextStep.show();
			
			}

		  }else{
			var nextStep = $('[data-step="' + (parseInt(currentStep.data('step')) + 1) + '"]');
			currentStep.hide();
			nextStep.show();
		  }

		  console.log(currentStep);
		  console.log((parseInt(currentStep.data('step'))));
	  
		//   currentStep.hide();
		//   nextStep.show();
		});
	  
		// Handle previous button click
		$('.prev').on('click', function() {
		  var currentStep = $(this).closest('.step');
		  var prevStep = $('[data-step="' + (parseInt(currentStep.data('step')) - 1) + '"]');
	  
		  currentStep.hide();
		  prevStep.show();
		});
	  });


	//   part-2

	$(document).ready(function() {  	
		// console.log('my ajax');
	
		$('#form_submit').click(function() {
			var name = $('#name').val();
			var phone = $('#phone').val();
			var email = $('#email').val();
			var date = $('#appointment_datepicker').val();
			var time = $('#appointment_timePicker').val(); 
	
			if (name !== '' && phone !== '' && email !== '' && date !== '' && time !== '') {
				// AJAX request
				var myObject = {
					parameter_name: name,
					parameter_phone: phone,
					parameter_email: email,
					parameter_date: date,
					parameter_time: time,
					parameter_submit: true 
				};
	
				$.ajax({
					url: my_script_vars.ajax_url,
					type: 'POST',
					data: {
						action: 'my_ajax_action',
						objdata: myObject
					},
					success: function(response) {
						// console.log(response);
						if(response === "successfully_send_email") {
							alert('Appointment Booked and Mail Sent To Your Given Mail Id Successfully');
							$('#appointment-booking-form')[0].reset();
							$('.step').hide();
							$('[data-step="1"]').show();
						}else{
							alert('Appointment Booked but Mail not Sent To Your Given Mail Id');
							$('#appointment-booking-form')[0].reset();
							$('.step').hide();
							$('[data-step="1"]').show();
						}
					},
					error: function(jqXHR, textStatus, errorThrown) {
						console.error('AJAX Error:', textStatus, errorThrown);
						alert('Something went wrong, please try again after some time');
					}
				});
			} else {
				// Handle validation errors, show alerts, etc.
				// console.log(date);
				if(name === ''){
					alert('Please fill the name field');
					$('.step').hide();
					$('[data-step="1"]').show();
					console.log('the date is :' + date);
				} else if(phone === ''){
					alert('Please fill the phone field');
					$('.step').hide();
					$('[data-step="1"]').show();
				} else if(email === ''){
					alert('Please fill the email field');
					$('.step').hide();
					$('[data-step="1"]').show();
				} else if(date === ''){
					alert('Please select date');
					$('.step').hide();
					$('[data-step="2"]').show();
				} else if(time === ''){
					alert('Please select time');
					$('.step').hide();
					$('[data-step="3"]').show();
				} else {
					alert('Please fill in the details');
				}
			}
			return false; // Prevent the default form submission
		});
	});


})( jQuery );
