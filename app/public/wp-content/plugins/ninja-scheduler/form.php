<?php

// Add shortcode for the frontend appointment form
function appointment_frontend_form_shortcode() {
    ob_start();
    ?>
    <form id="frontend-appointment-form" method="post">
        <?php wp_nonce_field('frontend_appointment_nonce', 'frontend_appointment_nonce'); ?>
        <p>
            <label for="appointment_name">Name:</label>
            <input type="text" id="appointment_name" name="appointment_name" required>
        </p>
        <p>
            <label for="appointment_email">Email:</label>
            <input type="email" id="appointment_email" name="appointment_email" required>
        </p>
        <p>
            <label for="appointment_phone">Phone:</label>
            <input type="tel" id="appointment_phone" name="appointment_phone" required pattern="[0-9]{10}">
        </p>
        <p>
            <label for="appointment_subject">Subject:</label>
            <input type="text" id="appointment_subject" name="appointment_subject" required>
        </p>
        <p>
            <label for="appointment_date">Date:</label>
            <input type="date" id="appointment_date" name="appointment_date" required>
        </p>
        <p>
            <label for="appointment_time">Time:</label>
            <select id="appointment_time" name="appointment_time" required>
                <option value="">Select a time</option>
            </select>
        </p>
        <p>
            <input type="submit" name="submit_frontend_appointment" value="Book Appointment">
        </p>
    </form>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var dateInput = document.getElementById('appointment_date');
        var timeSelect = document.getElementById('appointment_time');

        dateInput.addEventListener('change', function() {
            var selectedDate = new Date(this.value);
            var dayIndex = (selectedDate.getDay() + 6) % 7; // Convert Sunday (0) to 6, and shift others

            // AJAX call to get available time slots
            var xhr = new XMLHttpRequest();
            xhr.open('POST', '<?php echo admin_url('admin-ajax.php'); ?>', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (xhr.status === 200) {
                    var timeSlots = JSON.parse(xhr.responseText);
                    timeSelect.innerHTML = '<option value="">Select a time</option>';
                    timeSlots.forEach(function(slot) {
                        var option = document.createElement('option');
                        option.value = slot.from + ' - ' + slot.to;
                        option.textContent = slot.from + ' - ' + slot.to;
                        timeSelect.appendChild(option);
                    });
                }
            };
            xhr.send('action=get_available_time_slots&day_index=' + dayIndex);
        });
    });
    </script>
    <?php
    return ob_get_clean();
}
add_shortcode('appointment_form', 'appointment_frontend_form_shortcode');

// AJAX handler for getting available time slots
function get_available_time_slots() {
    $day_index = isset($_POST['day_index']) ? intval($_POST['day_index']) : 0;
    $time_slots = get_option('appointment_time_slots', array());
    $available_slots = isset($time_slots[$day_index]) ? $time_slots[$day_index] : array();
    wp_send_json($available_slots);
}
add_action('wp_ajax_get_available_time_slots', 'get_available_time_slots');
add_action('wp_ajax_nopriv_get_available_time_slots', 'get_available_time_slots');

// Handle frontend form submission
function handle_frontend_appointment_submission() {
    if (isset($_POST['submit_frontend_appointment']) && wp_verify_nonce($_POST['frontend_appointment_nonce'], 'frontend_appointment_nonce')) {
        $name = sanitize_text_field($_POST['appointment_name']);
        $email = sanitize_email($_POST['appointment_email']);
        $phone = sanitize_text_field($_POST['appointment_phone']);
        $subject = sanitize_text_field($_POST['appointment_subject']);
        $date = sanitize_text_field($_POST['appointment_date']);
        $time = sanitize_text_field($_POST['appointment_time']);

        $appointment = array(
            'post_title'    => $name,
            'post_status'   => 'publish',
            'post_type'     => 'appointment',
        );

        $post_id = wp_insert_post($appointment);

        if ($post_id) {
            update_post_meta($post_id, '_appointment_email', $email);
            update_post_meta($post_id, '_appointment_phone', $phone);
            update_post_meta($post_id, '_appointment_subject', $subject);
            update_post_meta($post_id, '_appointment_date', $date);
            update_post_meta($post_id, '_appointment_time', $time);

            // Send email notifications
            $to_admin = get_option('admin_email');
            $subject_admin = 'New Appointment Booked';
            $message_admin = "A new appointment has been booked:\n\nName: $name\nEmail: $email\nPhone: $phone\nSubject: $subject\nDate: $date\nTime: $time";
            wp_mail($to_admin, $subject_admin, $message_admin);

            $subject_user = 'Your Appointment Confirmation';
            $message_user = "Dear $name,\n\nYour appointment has been booked successfully:\n\nSubject: $subject\nDate: $date\nTime: $time\n\nThank you for choosing our service.";
            wp_mail($email, $subject_user, $message_user);

            echo '<p>Your appointment has been booked successfully!</p>';
        } else {
            echo '<p>There was an error booking your appointment. Please try again.</p>';
        }
    }
}
add_action('init', 'handle_frontend_appointment_submission');
