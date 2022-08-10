<div class="search-results-pager">
    <p><?=esc_html__('Other results', 'wp-google-cse')?></p>
    <ul>
    <?php for ($page = 1; $page <= $numberOfPages; $page++):?>
        <li>
            <a href="<?=htmlspecialchars($customActionUri)?>?q=<?=htmlspecialchars($this->query)?>&amp;start=<?=($page == 1 ? '' : $page-1)?>0&amp;send=search"<?=(($page == $this->selectedPage) ? ' class="selected-page"' : '')?>><?=$page?></a>
        </li>
    <?php endfor?>
    </ul>
</div>
