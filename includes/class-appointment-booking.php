<?php

class AppointmentBooking {
    public function __construct() {
        add_action('init', array($this, 'register_post_type'));
        add_action('add_meta_boxes', array($this, 'add_meta_boxes'));
        add_action('save_post', array($this, 'save_appointment_details_meta_box'));
        add_shortcode('appointment_form', array($this, 'render_appointment_form'));
        // add_action('init', array($this, 'handle_form_submission'));
        add_action('admin_menu', array($this, 'add_plugin_submenu'));
        add_action('wp_ajax_my_ajax_action', array($this, 'my_ajax_callback'));
add_action('wp_ajax_nopriv_my_ajax_action', array($this, 'my_ajax_callback')); // For non-logged in users
        // add_action('admin_menu', array($this, 'add_appointment_admin_page'));
        // add_action('admin_menu', array($this, 'add_appointment_admin_page'));
        // Hook the function to the appropriate WordPress action
    }


    public function register_post_type() {  
    register_post_type('appointment', array(
        'labels' => array(
            'name' => 'Appointments',
            'singular_name' => 'Appointment',
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array('title'),
    ));
}


    public function add_meta_boxes() {
    add_meta_box(
        'appointment_details_meta_box',
        'Appointment Details',
        array($this, 'render_appointment_details_meta_box'),
        'appointment',
        'normal',  
        'high'
    );
}


var $mysite_url="";

public function render_appointment_details_meta_box($post) {
    // Retrieve appointment details
    $name = get_post_meta($post->ID, '_name', true);
    $phone = get_post_meta($post->ID, '_phone', true);
    $email = get_post_meta($post->ID, '_email', true);
    $date = get_post_meta($post->ID, '_date', true);
    $time = get_post_meta($post->ID, '_time', true);

    // Display appointment details with input fields
    ?>


<div class="container mt-5 mb-5">
<div class="row">
    <div class="col" style="margin:20px 0px;" >
       <label for="appointment_name">Name:</label>
    <input type="text" id="appointment_name" class="form-control" style="margin:10px 0px;" name="appointment_name" value="<?php echo esc_attr($name); ?>"> <br>

    <label for="appointment_phone">Phone:</label>
    <input type="tel" id="appointment_phone" class="form-control" style="margin:10px 0px;" name="appointment_phone" value="<?php echo esc_attr($phone); ?>"> <br>

    <label for="appointment_email">Email:</label>
    <input type="email" id="appointment_email" class="form-control" style="margin:10px 0px;" name="appointment_email" value="<?php echo esc_attr($email); ?>"> <br>

    <label for="appointment_datepicker">Date:</label>
    <input type="date" id="appointment_datepicker" style="margin:10px 0px;" class="form-control" name="appointment_date" value="<?php echo esc_attr($date); ?>"> <br>

    <label for="appointment_timePicker">Time:</label>
    <input type="time" id="appointment_timePicker" style="margin:10px 0px;" class="form-control" name="appointment_time" value="<?php echo esc_attr($time); ?>"> <br>


    </div>
</div>  

</div>

    <?php
}

public function save_appointment_details_meta_box($post_id) {
    // Check if the user has permission to edit the post
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

        $appointment_name = isset($_POST['appointment_name']) ? sanitize_text_field($_POST['appointment_name']) : '';
        $appointment_phone = isset($_POST['appointment_phone']) ? sanitize_text_field($_POST['appointment_phone']) : '';
        $appointment_email = isset($_POST['appointment_email']) ? sanitize_text_field($_POST['appointment_email']) : '';
        $appointment_date = isset($_POST['appointment_date']) ? sanitize_text_field($_POST['appointment_date']) : '';
        $appointment_time = isset($_POST['appointment_time']) ? sanitize_text_field($_POST['appointment_time']) : '';
    
        // Save or update the post with the new data
        update_post_meta($post_id, '_name', $appointment_name);
        update_post_meta($post_id, '_phone', $appointment_phone);
        update_post_meta($post_id, '_email', $appointment_email);
        update_post_meta($post_id, '_date', $appointment_date);
        update_post_meta($post_id, '_time', $appointment_time);
    

}



public function add_plugin_submenu() {
    add_submenu_page(
        'edit.php?post_type=appointment',
        'Plugin Information',
        'Plugin Information',
        'manage_options',
        'appointment-plugin-info',
        array($this, 'render_plugin_info_page')
    );
}

public function render_plugin_info_page() {
    ?>
    <div class="wrap">
        <h1>Appointment Booking Plugin</h1>
        <p>This plugin allows you to manage appointments on your site.</p>
        <h2>Shortcodes</h2>
        <p><strong>[appointment_form]</strong>: Use this shortcode to display the booking form.</p>
    </div>
    <?php
}


    public function render_appointment_form() {
        // var_dump(plugin_dir_path(__FILE__));
        ob_start();
        include plugin_dir_path(__FILE__) . '../template/booking-form.php';
        return ob_get_clean();
    }
    
   
    public function save_appointment_details($post_id) {
    if (isset($_POST['submit_appointment'])) {
        
    }
}



// Mail Function 

// Add this to your theme's functions.php or a custom plugin file

public function appointment_book_mail($name, $phone, $email, $date, $time) {

        // // Email content
        $to = $email; // Change this to your desired email address
        $subject = 'New Appointment Booking';
        $message = "Name: $name\nPhone: $phone\nEmail: $email\nDate: $date\nTime: $time";

        // Send the email
        $mail_result = wp_mail($to, $subject, $message);

        if ($mail_result) {
            echo 'successfully_send_email';
        } else {
            echo 'email_send_error';
        }
}




public function my_ajax_callback() {
    // Your PHP logic here
    $myget =  $_POST['objdata'];

    if($myget['parameter_submit']){

    $name = sanitize_text_field($myget['parameter_name']);
    $phone = sanitize_text_field($myget['parameter_phone']);
    $email = sanitize_email($myget['parameter_email']);
    $date = sanitize_text_field($myget['parameter_date']);
    $time = sanitize_text_field($myget['parameter_time']);

    $post_data = array(
        'post_title' => $name . ' - ' . $date . ' ' . $time,
        'post_type' => 'appointment',
        'post_status' => 'publish',
    );

    $post_id = wp_insert_post($post_data);

    if (!is_wp_error($post_id)) {
        update_post_meta($post_id, '_name', $name);
        update_post_meta($post_id, '_phone', $phone);
        update_post_meta($post_id, '_email', $email);
        update_post_meta($post_id, '_date', $date);
        update_post_meta($post_id, '_time', $time);
// echo "successfully_submitted";

$this->appointment_book_mail($name, $phone, $email, $date, $time);

    } else {
        echo '<p>Error booking appointment.</p>';
    }
    wp_die();

}
}

}

?>
