<ul class="results-normal">
    <?php foreach ($this->normalResults as $normalResultNum => $normalResultData):?>
    <li class="<?=$cssClass?>">
        <?php if (($normalResultImageSrc = $normalResultData->pagemap->cse_image[0]->src) != ''):?>
        <figure class="result-image">
            <img src="<?=htmlspecialchars($normalResultImageSrc)?>" alt="" width="150" height="150" />
        </figure>
        <?php endif?>
        <div class="result-text">
            <!-- <p class="result-title"><?=htmlspecialchars($normalResultData->title)?></p> -->
            <p class="result-link"><a href="<?=htmlspecialchars($normalResultData->link)?>"><?=htmlspecialchars($normalResultData->title)?></a></p>
            <p class="result-www"><a href="<?=htmlspecialchars($normalResultData->link)?>"><?=htmlspecialchars($normalResultData->link)?></a></p>
            <p class="result-snippet"><?=$normalResultData->htmlSnippet?></p>
        </div>
    </li>
    <?php endforeach?>
</ul>
