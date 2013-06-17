<?
/**
 * Draws a categories list
 *
 * @var array $categories List of categories
 */

$tags_arr = array();
$count = 0;
$weight = 1;
$rate = 0.8;
?>

<div style="width: 300px;" class="jqcloud">
    <?foreach($categories as $category):?>
        <span class="w<?=rand(1,8)?>">
            <a href="/news/index/category_id/<?=$category->id?>">
                <?=$category->name?>(<?=$category->countNews()?>)
            </a>
        </span>
    <?endforeach?>
</div>
