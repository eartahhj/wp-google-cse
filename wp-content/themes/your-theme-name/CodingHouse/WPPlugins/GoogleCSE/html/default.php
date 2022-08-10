<?php
if ($this->query):
    if ($this->totalResults > 0):
        ?>
        <h2><?php printf(esc_html__('Results found for: %s', 'wp-google-cse'), '<em>' . htmlspecialchars($this->query) . '</em>')?></h2>
        <p class="result-num"><?php printf(esc_html__(_n('%d result', '%d results', $this->totalResults, 'wp-google-cse')), $this->totalResults)?></p>
        <?php
    else:
        ?>
        <p class="result-num"><?=esc_html__('No results', 'wp-google-cse')?></p>
        <?php
    endif;
else:
    esc_html__('No search term entered', 'wp-google-cse');
endif;
