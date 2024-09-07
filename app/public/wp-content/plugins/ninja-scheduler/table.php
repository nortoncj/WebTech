<?php
// Add Posts
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

// Add custom columns to the appointment list table
function set_custom_appointment_columns($columns) {
    $columns['appointment_date'] = __('Appointment Date', 'your_text_domain');
    $columns['appointment_time'] = __('Appointment Time', 'your_text_domain');
    return $columns;
}



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
    }
}

// Save Custom Fields
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

// Callback function to display custom fields
function appointment_custom_fields_callback($post) {
    wp_nonce_field(basename(__FILE__), 'appointment_nonce');
    
    $email = get_post_meta($post->ID, '_appointment_email', true);
    $subject = get_post_meta($post->ID, '_appointment_subject', true);
    $date = get_post_meta($post->ID, '_appointment_date', true);
    $time = get_post_meta($post->ID, '_appointment_time', true);
    ?>
    <p>
        <label for="appointment_email">Email:</label>
        <input type="email" id="appointment_email" name="appointment_email" value="<?php echo esc_attr($email); ?>" required>
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

    $email = isset($_POST['appointment_email']) ? sanitize_email($_POST['appointment_email']) : '';
    $subject = isset($_POST['appointment_subject']) ? sanitize_text_field($_POST['appointment_subject']) : '';
    $date = isset($_POST['appointment_date']) ? sanitize_text_field($_POST['appointment_date']) : '';
    $time = isset($_POST['appointment_time']) ? sanitize_text_field($_POST['appointment_time']) : '';

    update_post_meta($post_id, '_appointment_name', $name);
    update_post_meta($post_id, '_appointment_email', $email);
    update_post_meta($post_id, '_appointment_subject', $subject);
    update_post_meta($post_id, '_appointment_date', $date);
    update_post_meta($post_id, '_appointment_time', $time);
}
