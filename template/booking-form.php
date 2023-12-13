<!-- This is a simplified example; you may need to customize it further -->

<?php 

// if (session_status() == PHP_SESSION_NONE) {
//     // Start the session
//     session_start();
// }


$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';
$siteUrl = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

// $_SESSION['site_url'] = $siteUrl;
?>


<!-- <div class="container mt-5 mb-5">
<div class="row justify-content-center"> <h3>Appointment Booking Form</h3> </div>
<div class="row">
    <div class="col">

    <form id="appointment-booking-form" action="" method="post">
    <label  for="name">Name:</label>
    <input type="text" class="form-control" id="name" name="name" required>

    <label  for="phone">Phone:</label>
    <input type="tel" class="form-control" id="phone" name="phone" required>

    <label  for="email">Email:</label>
    <input type="email" class="form-control" id="email" name="email" required>

    <label  for="date">Date:</label>
    <input type="date" class="form-control" name="date" id="appointment_datepicker" required>

    <label  for="time">Time:</label>
    <input type="time" class="form-control" name="time" id="appointment_timePicker" required> -->
    <!-- <input type="hidden" class="form-control" id ="submit_data" name="my_site_url" value="true"> -->

    <!-- <input type="submit" class="btn btn-primary mt-3" name="submit_appointment" value="Book Appointment">
</form>
</div>
</div>   -->

<!-- </div> -->




<div class="container mt-5 mb-5">
  <div class="row justify-content-center mt-5">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Appointment Booking Form</div>
        <div class="card-body">
          <form id="appointment-booking-form">
            <!-- Step 1 -->
            <div class="step" data-step="1">
              <h3>Enter The Basic Details</h3>
              <div class="form-group">
              <label  for="name">Name:</label>
    <input type="text" class="form-control" id="name" name="name" required>

    <label  for="phone">Phone:</label>
    <input type="tel" class="form-control" id="phone" name="phone" required>

    <label  for="email">Email:</label>
    <input type="email" class="form-control" id="email" name="email" required>
              </div>
              <div class="btn btn-primary next" data-step="2">Next</div>
            </div>

            <!-- Step 2 -->
            <div class="step" data-step="2">
              <h3>Select Date</h3>
              <div class="form-group">
              <label  for="date">Date:</label>
    <input type="date" class="form-control" name="date" id="appointment_datepicker" required>
              </div>
              <div class="btn btn-primary prev" data-step="1">Previous</div>
              <div class="btn btn-primary next" data-step="3">Next</div>
            </div>

            <!-- Step 3 -->
            <div class="step" data-step="3">
              <h3>Select Time</h3>
              <div class="form-group">
              <label  for="time">Time:</label>
    <input type="time" class="form-control" name="time" id="appointment_timePicker" required>
    <!-- <input type="hidden" class="form-control" id ="submit_data" name="my_site_url" value="true"> -->
              </div>
              <div class="btn btn-primary prev" data-step="2">Previous</div>
              <input type="submit" id="form_submit" class="btn btn-primary" name="submit_appointment" value="Book Appointment">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> -->


<script>
jQuery(document).ready(function($) {
  // Hide all steps except the first one
  $('.step:not(:first)').hide();

  // Handle next button click
  $('.next').on('click', function() {
    var currentStep = $(this).closest('.step');
    var nextStep = $('[data-step="' + (parseInt(currentStep.data('step')) + 1) + '"]');

    currentStep.hide();
    nextStep.show();
  });

  // Handle previous button click
  $('.prev').on('click', function() {
    var currentStep = $(this).closest('.step');
    var prevStep = $('[data-step="' + (parseInt(currentStep.data('step')) - 1) + '"]');

    currentStep.hide();
    prevStep.show();
  });
});
</script>


<script>

jQuery(document).ready(function($) {  
    console.log('my ajax');

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
                url: "<?php echo admin_url('admin-ajax.php'); ?>",
                type: 'POST',
                data: {
                    action: 'my_ajax_action',
                    objdata: myObject
                },
                success: function(response) {
                    console.log(response);
                    if(response === "successfully_submitted") {
                        alert('Appointment Booked Successfully');
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

</script>