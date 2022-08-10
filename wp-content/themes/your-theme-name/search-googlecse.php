<?php
/*
Template Name: Google Custom Search Engine
*/
use \CodingHouse\WPPlugins\GoogleCSE;

require_once 'CodingHouse/WPPlugins/GoogleCSE/GoogleCustomSearchEngine.php';

$searchEngineId = '';
$error = null;

if (get_option('wpgooglecse_cx_multilanguage')) {
	$searchEngineIdsMultilanguage = GoogleCustomSearchEngine::getMultilanguageIdsFromWpOption(get_option('wpgooglecse_cx_multilanguage'));
	if (empty($searchEngineIdsMultilanguage)) {
		$error = new WP_Error('wpgooglecse_error_1', _('WP Google CSE: Could not retrieve Engine IDs in multiple language, please check settings.'));
	} else {
		$searchEngineId = GoogleCustomSearchEngine::getSearchEngineIdByLanguage(substr(get_locale(), 0, 2), $searchEngineIdsMultilanguage);
	}
} else {
	$searchEngineId = get_option('wpgooglecse_cx') ?: '';
}

if (is_wp_error($error)) {
	echo $error->get_error_message();
}

$searchEngineApiKey = get_option('wpgooglecse_apikey') ?: '';
$customContainerCssClass = get_option('wpgooglecse_container_html_class') ?: '';
$customFormId = get_option('wpgooglecse_form_html_id') ?: 'wp-googlecse-form-search';
$customFormCssClass = get_option('wpgooglecse_form_html_class') ?: 'wp-googlecse-form-search';
$customActionUri = get_option('wpgooglecse_form_action') ?: wp_make_link_relative(get_page_link());
$googleCSE = null;

if ($searchEngineApiKey) {
	try {
		$googleCSE = new CodingHouse\WPPlugins\GoogleCSE\GoogleCustomSearchEngine($searchEngineId, $searchEngineApiKey, substr(get_locale(), 0, 2));
		$googleCSE->initEngine();
	} catch (\Exception $e) {
		echo $e->getMessage();
	}
}
?>

<?php get_header()?>

	<main id="primary" class="site-main">
		<div class="wp-googlecse-container<?=$customContainerCssClass ? ' ' . htmlspecialchars($customContainerCssClass) : ''?>">
			<?php if ($googleCSE):?>
				<?php $googleCSE->renderForm($customFormId, $customFormCssClass, esc_url($customActionUri))?>

				<div class="search-results">
			    <?php
				$googleCSE->html();
			    $googleCSE->renderPromoResults();
			    $googleCSE->renderNormalResults();
			    $googleCSE->renderPager();
			    ?>
			    </div>
			<?php else:?>
				<script async src="https://cse.google.com/cse.js?cx=<?=htmlspecialchars($searchEngineId)?>"></script>
			    <div class="gcse-search"></div>
			<?php endif?>
		</div>
	</main>

<?php
get_sidebar();
get_footer();
?>
