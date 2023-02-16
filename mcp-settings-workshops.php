<?php
require_once plugin_dir_path( __FILE__ ) . 'includes/templates.php';
add_action( 'admin_menu', 'register_mcp_admin_settings_workshops' );

function register_mcp_admin_settings_workshops() {
    add_submenu_page(
        'mcp-workshops-and-webinars',
        'Edit Workshops',
        'Edit Workshops',
        'manage_options',
        'mcp-add-workshop',
        'admin_settings_workshops'
    );
}

function admin_settings_workshops() {
    global $mcp_cf7;
    $optionKey = $mcp_cf7::DB_KEY_WORKSHOPS;
    $shortcode = $mcp_cf7::KEY_WORKSHOPS;
    $options = get_option($optionKey);
    $num_rows = is_array($options) ? count($options) : 0;
    $tooltipMsg = 'All form fields are required or the event will not save in the database.';
    ?>
    <div class="cf7-mcp-tabs" style="padding: 40px 40px 0 20px;" data-scope="<?php echo $optionKey; ?>">
        <?php echo render_alert_container(); ?>
        <header class="header">
            <h1>Workshops</h1>
        </header>
        <section class="section-wrapper">
            <div class="table-header">
                <h2>Manage Events</h2>
                <div class="btn-group">
                    <button class="cf7-add-field button-secondary">Add</button>
                    <button class="cf7-save-fields button-primary" data-scope="<?php echo $optionKey; ?>">Save & Publish</button>
                </div>
            </div>
            <div>
                <?php echo render_table($options, $num_rows); ?>
                <p>Friendly Reminder: All fields are required<p>
            </div>
            <div style="margin: 20px 0;">
                <button class="cf7-save-fields button-primary" data-scope="<?php echo $optionKey; ?>">Save & Publish</button>
            </div>
        </section>
        <?php echo render_shortcode_section($shortcode); ?>
    </div>
    <script>
        jQuery(document).ready(function($) {
            $('.cf7-remove-field').attr('data-scope','<?php echo $optionKey; ?>');
            $('.cf7-add-field').click(function(e) {
                e.preventDefault();
                var tableRow = '<?php echo addslashes(render_table_row(array('location' => '', 'id' => '', 'date' => '', 'time' => ''), 2)); ?>';
                $('table.custom-fields tbody').append(tableRow);
            });
        });
    </script>
    <?php
}
