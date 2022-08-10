<form id="<?=htmlspecialchars($id)?>" action="<?=htmlspecialchars($action)?>" method="<?=htmlspecialchars($method)?>" class="<?=htmlspecialchars($cssClass)?>">
    <label for="wp-google-cse-search"><?=esc_html__('Search website', 'wp-google-cse')?></label>
    <input id="wp-google-cse-search" type="search" name="<?=$this->queryHttpParam?>" placeholder="<?=esc_html__('Search website', 'wp-google-cse')?>"<?=($this->query ? ' value="' . htmlspecialchars($this->query) . '"' : '')?> />
    <input type="submit" name="<?=$this->submitName?>" value="<?=esc_html__('Search', 'wp-google-cse')?>" />
</form>
