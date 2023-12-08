<?php

// namespace AppointmentBooking;
// namespace Schedulebooking;

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://webart.technology
 * @since             1.0.0
 * @package           Schedule_Booking
 *
 * @wordpress-plugin
 * Plugin Name:       Schedule Booking
 * Plugin URI:        https://webart.technology
 * Description:       This is a booking plugin
 * Version:           1.0.0
 * Author:            Webart Technology
 * Author URI:        https://webart.technology/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       schedule-booking
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// use Schedulebooking\Schedule_Booking_Admin;
/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'SCHEDULE_BOOKING_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-schedule-booking-activator.php
 */
function activate_schedule_booking() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-schedule-booking-activator.php';
	Schedule_Booking_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-schedule-booking-deactivator.php
 */
function deactivate_schedule_booking() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-schedule-booking-deactivator.php';
	Schedule_Booking_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_schedule_booking' );
register_deactivation_hook( __FILE__, 'deactivate_schedule_booking' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-schedule-booking.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_schedule_booking() {

	$plugin = new Schedule_Booking();
	$plugin->run();

}
run_schedule_booking();


// Shortcode for the booking form
function appointment_booking_form_shortcode() {
    if (isset($_POST['submit_appointment'])) {
        $appointment_date = sanitize_text_field($_POST['appointment_date']);
        // Perform additional validation and processing as needed
        // For simplicity, let's just save the date in the options table
        update_option('booked_appointment_date', $appointment_date);
        echo '<p>Appointment booked for ' . $appointment_date . '</p>';
    }

    ob_start();
    ?>
    <!-- <form method="post" action="">
        <label for="appointment_date">Select Appointment Date:</label>
        <input type="date" name="appointment_date" required>
        <input type="submit" name="submit_appointment" value="Book Appointment">
    </form> -->
    <?php
//     return ob_get_clean();
}
// add_shortcode('appointment_form', 'appointment_booking_form_shortcode');

// require_once plugin_dir_path( __FILE__ ) . 'admin/class-schedule-booking-admin.php';

// $my_plugin = new Schedule_Booking_Admin();

// $my_plugin->admin_part();


require_once plugin_dir_path(__FILE__) . 'includes/class-appointment-booking.php';



class BootstrapIntegration {
    public function __construct() {
        add_action('wp_enqueue_scripts', array($this, 'enqueue_bootstrap'));
    }

    public function enqueue_bootstrap() {
        wp_enqueue_style('bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css');
        wp_enqueue_script('bootstrap-js', 'https://code.jquery.com/jquery-3.5.1.slim.min.js', array(), '3.5.1', true);
        wp_enqueue_script('popper-js', 'https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js', array(), '2.5.2', true);
        wp_enqueue_script('bootstrap-js', 'https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js', array('jquery', 'popper-js'), '4.5.2', true);
    }
}

new BootstrapIntegration();
new AppointmentBooking();