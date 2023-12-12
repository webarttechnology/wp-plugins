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


<div class="container mt-5 mb-5">
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
    <input type="time" class="form-control" name="time" id="appointment_timePicker" required>
    <!-- <input type="hidden" class="form-control" id ="submit_data" name="my_site_url" value="true"> -->

    <input type="submit" class="btn btn-primary mt-3" name="submit_appointment" value="Book Appointment">
</form>
</div>
</div>  

</div>

<script>

jQuery(document).ready(function($){  
    console.log('my ajax');

    $('#appointment-booking-form').submit(function(event) {
        // Prevent the default form submission
        event.preventDefault();

        var name = $('#name').val();
        var phone = $('#phone').val();
        var email = $('#email').val();
        var date = $('#appointment_datepicker').val();
        var time = $('#appointment_timePicker').val(); 
        var submit = $('#submit_data').val();
    var myObject = {
    parameter_name:name , // Additional parameters
    parameter_phone: phone ,
    parameter_email: email ,
    parameter_date: date ,
    parameter_time: time,       
    parameter_submit: true 

}
     // AJAX request
     $.ajax({
        url: "<?php echo admin_url('admin-ajax.php'); ?>", // WordPress AJAX URL
        type: 'POST',
        data: {
            action: 'my_ajax_action', // Custom action name
            objdata: myObject
        },
        success: function(response) {
            // Handle the response
            console.log(response);
            if(response==="successfully_submitted"){
                alert('Appointment Booked Successfully');
                $('#appointment-booking-form')[0].reset();
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error('AJAX Error:', textStatus, errorThrown);
            alert('Something went wrong , please try again after sometime');
        }
    });

    });

});

</script>