<ul class="results-promo">
    <?php foreach ($this->promotedResults as $promotedResultNumber => $promotedResultData):?>
        <li class="<?=$cssClass?>">
            <?php if(($promotedResultImageSrc = $promotedResultData->pagemap->cse_image[0]->src)!=''):?>
                <figure class="result-image">
                    <img src="<?=htmlspecialchars($promotedResultImageSrc)?>" />
                </figure>
            <?php endif?>
            <div class="result-text">
                <p class="result-title"><?=htmlspecialchars($promotedResultData->title)?></p>
                <p class="result-link"><a href="<?=htmlspecialchars($promotedResultData->link)?>"><?=htmlspecialchars($promotedResultData->title)?></a></p>
                <p class="result-www"><a  href="<?=htmlspecialchars($promotedResultData->link)?>"><?=htmlspecialchars($promotedResultData->link)?></a></p>
                <?php if ($promotedResultData->bodyLines[0]->title):?>
                    <p class="result-snippet"><?=$promotedResultData->bodyLines[0]->title?></p>
                <?php endif?>
            </div>
        </li>
    <?php endforeach?>
</ul>
