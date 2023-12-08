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


<div class="container">
<div class="row justify-content-center"> <h3>Appointment Booking Form</h3> </div>
<div class="row">
    <div class="col">

    <form id="appointment-booking-form" action="" method="post">
    <label  for="name">Name:</label>
    <input type="text" class="form-control" name="name" required>

    <label  for="phone">Phone:</label>
    <input type="tel" class="form-control" name="phone" required>

    <label  for="email">Email:</label>
    <input type="email" class="form-control" name="email" required>

    <label  for="date">Date:</label>
    <input type="date" class="form-control" name="date" required>

    <label  for="time">Time:</label>
    <input type="time" class="form-control" name="time" required>
    <input type="hidden" class="form-control" name="my_site_url" value="<?php echo $siteUrl; ?>">

    <input type="submit" class="btn btn-primary mt-3" name="submit_appointment" value="Book Appointment">
</form>
</div>
</div>  

</div>