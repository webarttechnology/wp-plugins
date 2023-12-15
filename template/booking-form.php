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
              <div class="btn btn-primary next" id="book_steps1" data-step="2">Next</div>
            </div>

            <!-- Step 2 -->
            <div class="step" data-step="2">
              <h3>Select Date</h3>
              <div class="form-group">
              <label  for="date">Date:</label>
    <input type="date" class="form-control" name="date" id="appointment_datepicker" required>
              </div>
              <div class="btn btn-primary prev" data-step="1">Previous</div>
              <div class="btn btn-primary next" id="book_steps2" data-step="3">Next</div>
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