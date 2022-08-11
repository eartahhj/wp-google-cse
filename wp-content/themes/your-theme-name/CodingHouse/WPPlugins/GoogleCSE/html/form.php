<form id="<?=htmlspecialchars($id)?>" action="<?=htmlspecialchars($action)?>" method="<?=htmlspecialchars($method)?>" class="<?=htmlspecialchars($cssClass)?>">
    <label for="wp-google-cse-search">
        <span class="sr-only"><?=esc_html__('Search website', 'wp-google-cse')?></span>
    </label>
    <div id="wp-googlecse-form-search-container" class="grid">
        <input id="wp-google-cse-search" type="search" name="<?=$this->queryHttpParam?>" placeholder="<?=esc_html__('Search website', 'wp-google-cse')?>"<?=($this->query ? ' value="' . htmlspecialchars($this->query) . '"' : '')?> />
        <button type="submit" name="<?=$this->submitName?>">
            <span class="sr-only"><?=esc_html__('Search', 'wp-google-cse')?></span>
        </button>
    </div>
</form>
