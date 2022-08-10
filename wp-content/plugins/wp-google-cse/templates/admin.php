<h2>Settings for WP Google Custom Search Engine Plugin</h2>

<?php settings_errors()?>

<form method="post" action="options.php">
    <?php
    settings_fields('wpgooglecse_option_group');
    do_settings_sections('wp_googlecse_plugin');
    submit_button();
    ?>
</form>
