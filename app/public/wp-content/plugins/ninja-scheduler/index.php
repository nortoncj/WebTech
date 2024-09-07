<?php
/*
Plugin Name: Ninja Appointment Scheduler
Description: A simple plugin to schedule appointments.
Version: 1.0
Author: WebTech Ninjas
*/

include 'form.php';

// Custom Columns
function set_custom_appointment_columns($columns) {
    $columns = array(
        'cb' => '<input type="checkbox" />',
        'title' => __('Name', 'your_text_domain'),
        'appointment_email' => __('Email', 'your_text_domain'),
        'appointment_phone' => __('Phone Number', 'your_text_domain'),
        'appointment_subject' => __('Subject', 'your_text_domain'),
        'appointment_date' => __('Appointment Date', 'your_text_domain'),
        'appointment_time' => __('Appointment Time', 'your_text_domain'),
        'date' => __('Date', 'your_text_domain'),
    );
    return $columns;
}
add_filter('manage_edit-appointment_columns', 'set_custom_appointment_columns');

// Populate custom columns with appointment data
function custom_appointment_column($column, $post_id) {
    switch ($column) {
        case 'appointment_date':
            $date = get_post_meta($post_id, '_appointment_date', true);
            echo esc_html($date);
            break;
        case 'appointment_time':
            $time = get_post_meta($post_id, '_appointment_time', true);
            echo esc_html($time);
            break;
        case 'appointment_email':
            $email = get_post_meta($post_id, '_appointment_email', true);
            echo esc_html($email);
            break;
        case 'appointment_phone':
            $phone = get_post_meta($post_id, '_appointment_phone', true);
            echo esc_html($phone);
            break;
        case 'appointment_subject':
            $subject = get_post_meta($post_id, '_appointment_subject', true);
            echo esc_html($subject);
            break;
    }
}
add_action('manage_appointment_posts_custom_column', 'custom_appointment_column', 10, 2);

// Make the custom columns sortable
function custom_appointment_sortable_columns($columns) {
    $columns['appointment_date'] = 'appointment_date';
    $columns['appointment_time'] = 'appointment_time';
    $columns['appointment_email'] = 'appointment_email';
    $columns['appointment_phone'] = 'appointment_phone';
    $columns['appointment_subject'] = 'appointment_subject';
    return $columns;
}
add_filter('manage_edit-appointment_sortable_columns', 'custom_appointment_sortable_columns');

// Apply sorting by meta value
function custom_appointment_column_orderby($query) {
    if (!is_admin() || !$query->is_main_query()) {
        return;
    }

    $orderby = $query->get('orderby');

    if ('appointment_date' === $orderby) {
        $query->set('meta_key', '_appointment_date');
        $query->set('orderby', 'meta_value');
    } elseif ('appointment_time' === $orderby) {
        $query->set('meta_key', '_appointment_time');
        $query->set('orderby', 'meta_value');
    } elseif ('appointment_email' === $orderby) {
        $query->set('meta_key', '_appointment_email');
        $query->set('orderby', 'meta_value');
    } elseif ('appointment_phone' === $orderby) {
        $query->set('meta_key', '_appointment_phone');
        $query->set('orderby', 'meta_value');
    } elseif ('appointment_subject' === $orderby) {
        $query->set('meta_key', '_appointment_subject');
        $query->set('orderby', 'meta_value');
    }
}
add_action('pre_get_posts', 'custom_appointment_column_orderby');

// Register custom post type for appointments
function register_appointment_post_type() {
    register_post_type('appointment', array(
        'labels' => array(
            'name' => 'Appointments',
            'singular_name' => 'Appointment',
            'add_new' => 'Add Appointment',
            'add_new_item' => 'Add New Appointment',
            'edit_item' => 'Edit Appointment',
            'new_item' => 'New Appointment',
            'view_item' => 'View Appointment',
            'search_items' => 'Search Appointments',
            'not_found' => 'No appointments found',
            'not_found_in_trash' => 'No appointments found in trash',
        ),
        'public' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'rewrite' => false,
        'query_var' => false,
        'menu_icon' => 'dashicons-calendar-alt',
        'supports' => array('title'),
    ));
}
add_action('init', 'register_appointment_post_type');

// Add custom fields to the appointment post type
function appointment_add_custom_fields() {
    add_meta_box(
        'appointment_details',
        'Appointment Details',
        'appointment_custom_fields_callback',
        'appointment',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'appointment_add_custom_fields');

// Callback function to display custom fields
function appointment_custom_fields_callback($post) {
    wp_nonce_field(basename(__FILE__), 'appointment_nonce');
    
    $email = get_post_meta($post->ID, '_appointment_email', true);
    $phone = get_post_meta($post->ID, '_appointment_phone', true); // Added phone field retrieval
    $subject = get_post_meta($post->ID, '_appointment_subject', true);
    $date = get_post_meta($post->ID, '_appointment_date', true);
    $time = get_post_meta($post->ID, '_appointment_time', true);
    ?>
    <p>
        <label for="appointment_email">Email:</label>
        <input type="email" id="appointment_email" name="appointment_email" value="<?php echo esc_attr($email); ?>" required>
    </p>
    <p>
        <label for="appointment_phone">Phone:</label>
        <input type="tel" id="appointment_phone" name="appointment_phone" value="<?php echo esc_attr($phone); ?>" required pattern="[1-9]{1}[0-9]{9}">
    </p>
    <p>
        <label for="appointment_subject">Subject:</label>
        <input type="text" id="appointment_subject" name="appointment_subject" value="<?php echo esc_attr($subject); ?>" required>
    </p>
    <p>
        <label for="appointment_date">Date:</label>
        <input type="date" id="appointment_date" name="appointment_date" value="<?php echo esc_attr($date); ?>" required>
    </p>
    <p>
        <label for="appointment_time">Time:</label>
        <input type="time" id="appointment_time" name="appointment_time" value="<?php echo esc_attr($time); ?>" required>
    </p>
    <?php
}

// Save custom fields
function appointment_save_custom_fields($post_id) {
    // Verify nonce
    if (!isset($_POST['appointment_nonce']) || !wp_verify_nonce($_POST['appointment_nonce'], basename(__FILE__))) {
        return $post_id;
    }

    // Check autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return $post_id;
    }

    // Check post type
    if ('appointment' != $_POST['post_type']) {
        return $post_id;
    }

    // Check user permissions
    if (!current_user_can('edit_post', $post_id)) {
        return $post_id;
    }

    // Save custom fields
    $email = isset($_POST['appointment_email']) ? sanitize_email($_POST['appointment_email']) : '';
    $phone = isset($_POST['appointment_phone']) ? sanitize_text_field($_POST['appointment_phone']) : ''; // Corrected field name
    $subject = isset($_POST['appointment_subject']) ? sanitize_text_field($_POST['appointment_subject']) : '';
    $date = isset($_POST['appointment_date']) ? sanitize_text_field($_POST['appointment_date']) : '';
    $time = isset($_POST['appointment_time']) ? sanitize_text_field($_POST['appointment_time']) : '';

    update_post_meta($post_id, '_appointment_email', $email);
    update_post_meta($post_id, '_appointment_phone', $phone); // Corrected field name
    update_post_meta($post_id, '_appointment_subject', $subject);
    update_post_meta($post_id, '_appointment_date', $date);
    update_post_meta($post_id, '_appointment_time', $time);
}
add_action('save_post_appointment', 'appointment_save_custom_fields');

// Add settings page for available time slots
function appointment_settings_page() {
    add_submenu_page(
        'edit.php?post_type=appointment',
        'Appointment Settings',
        'Settings',
        'manage_options',
        'appointment-settings',
        'appointment_settings_page_html'
    );
}
add_action('admin_menu', 'appointment_settings_page');

function appointment_settings_page_html() {
    if (!current_user_can('manage_options')) {
        return;
    }

    if (isset($_POST['save_time_slots'])) {
        $time_slots = array();
        foreach ($_POST['time_slots'] as $day_index => $day_slots) {
            foreach ($day_slots as $slot_index => $slot) {
                if (!empty($slot['from']) && !empty($slot['to'])) {
                    $time_slots[$day_index][$slot_index] = array(
                        'from' => sanitize_text_field($slot['from']),
                        'to' => sanitize_text_field($slot['to'])
                    );
                }
            }
        }
        update_option('appointment_time_slots', $time_slots);
        echo '<div class="updated"><p>Time slots saved successfully!</p></div>';
    }

    $time_slots = get_option('appointment_time_slots', array());

    ?>
    <div class="wrap">
        <h1>Appointment Settings</h1>
        <form method="post">
    <table class="form-table">
        <thead>
            <tr>
                <th><h2>Day</h2></th>
                <th><h2>Time Slots</h2></th>
            </tr>
        </thead>
        <tbody>
            <?php
            $days = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');
            foreach ($days as $index => $day):
            ?>
                <tr>
                    <td><h3><?php echo esc_html($day); ?></h3></td>
                    <td>
                        <?php for ($slot = 0; $slot < 5; $slot++): ?>
                            <div class="time-slot">
                                <label>Slot <?php echo $slot + 1; ?>:</label>
                                <input type="time" name="time_slots[<?php echo $index; ?>][<?php echo $slot; ?>][from]" 
                                    value="<?php echo isset($time_slots[$index][$slot]['from']) ? esc_attr($time_slots[$index][$slot]['from']) : ''; ?>">
                                to
                                <input type="time" name="time_slots[<?php echo $index; ?>][<?php echo $slot; ?>][to]" 
                                    value="<?php echo isset($time_slots[$index][$slot]['to']) ? esc_attr($time_slots[$index][$slot]['to']) : ''; ?>">
                            </div>
                        <?php endfor; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <p>
        <input type="submit" name="save_time_slots" class="button-primary" value="Save Time Slots">
    </p>
</form>
    </div>
    <?php
}


