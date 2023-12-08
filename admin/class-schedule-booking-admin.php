<?php

// namespace Schedulebooking;

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://webart.technology
 * @since      1.0.0
 *
 * @package    Schedule_Booking
 * @subpackage Schedule_Booking/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Schedule_Booking
 * @subpackage Schedule_Booking/admin
 * @author     Webart Technology <deepak.sharma@webart.technology>
 */
class Schedule_Booking_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	// public function __construct( $plugin_name, $version ) {

	// 	$this->plugin_name = $plugin_name;
	// 	$this->version = $version;

	// }

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Schedule_Booking_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Schedule_Booking_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/schedule-booking-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Schedule_Booking_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Schedule_Booking_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/schedule-booking-admin.js', array( 'jquery' ), $this->version, false );

	}


public function admin_part(){
	// Display booked appointments in the admin panel
function appointment_booking_admin_menu() {
    add_menu_page(
        'Appointment Booking',
        'Appointments',
        'manage_options',
        'appointment_booking',
        'appointment_booking_admin_page'
    );
}
add_action('admin_menu', 'appointment_booking_admin_menu');

// Admin page content
function appointment_booking_admin_page() {
    $booked_appointment_date = get_option('booked_appointment_date');
    ?>
    <div class="wrap">
        <h2>Booked Appointments</h2>
        <?php if ($booked_appointment_date) : ?>
            <p>Appointment booked for: <?php echo esc_html($booked_appointment_date); ?></p>
        <?php else : ?>
            <p>No appointments booked yet.</p>
        <?php endif; ?>
    </div>
    <?php
}
}


}
