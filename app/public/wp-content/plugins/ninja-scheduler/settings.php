<?php

// Appointment Settings
function appointment_settings_page_html() {
    if (!current_user_can('manage_options')) {
        return;
    }

    if (isset($_POST['save_time_slots'])) {
        $time_slots = array();
        for ($i = 0; $i < 7; $i++) {
            $day_slots = isset($_POST['time_slots'][$i]) ? $_POST['time_slots'][$i] : array();
            $time_slots[] = array_map('sanitize_text_field', $day_slots);
        }
        update_option('appointment_time_slots', $time_slots);
        echo '<div class="updated"><p>Time slots saved successfully!</p></div>';
    }

    $days = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');
    $saved_time_slots = get_option('appointment_time_slots', array_fill(0, 7, array()));
    ?>
    <div class="wrap">
        <h1>Appointment Settings</h1>
        <form method="post" action="">
            <?php foreach ($days as $index => $day): ?>
                <h2><?php echo $day; ?></h2>
                <div class="time-slots">
    <?php
    $day_slots = isset($saved_time_slots[$index]) ? $saved_time_slots[$index] : array();
    for ($i = 0; $i < 5; $i++): // Allow up to 5 time slot pairs per day
        $from_value = isset($day_slots[$i]['from']) ? $day_slots[$i]['from'] : '';
        $to_value = isset($day_slots[$i]['to']) ? $day_slots[$i]['to'] : '';
    ?>
        <div class="time-slot-pair">
            <input type="time" name="time_slots[<?php echo $index; ?>][<?php echo $i; ?>][from]" value="<?php echo esc_attr($from_value); ?>" placeholder="From">
            <span>to</span>
            <input type="time" name="time_slots[<?php echo $index; ?>][<?php echo $i; ?>][to]" value="<?php echo esc_attr($to_value); ?>" placeholder="To">
        </div>
    <?php endfor; ?>
</div>
            <?php endforeach; ?>
            <p><input type="submit" name="save_time_slots" class="button button-primary" value="Save Time Slots"></p>
        </form>
    </div>
    <?php
}

// Appointment Settings Page
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