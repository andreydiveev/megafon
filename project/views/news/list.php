<?php
/*
 * @var $news
 * @var $view_mode
 * @var $this NewsController
 */

$this->breadcrumbs=array(
    'Новости',
);
?>

<h1 style="">Лента новостей</h1>
<div style="margin:20px 0px;">
    <input type="radio" class="cat_switcher" name="view_mode" value="as_list" <?=($view_mode=='as_list')?'checked':''?>/> Списком
    <input type="radio" class="cat_switcher" name="view_mode" value="by_cat" <?=($view_mode=='by_cat')?'checked':''?>/> По категориям
</div>

<div style="clear:both"></div>


<div style="display: inline-block; width:580px;float:left; margin:0px 20px 0px 0px;">

    <?foreach($news as $news_item):?>
        <div style="background: #F2EFE6;
    border: 1px solid #B25538;
    padding: 10px;
    margin: 0px 0px 20px 0px;
    display: inline-block;">
        <span style="float:left;">
            <a href="/news/index/id/<?=$news_item->id?>">
                <img src="<?=$news_item->small_image?>" style="border:1px solid #76C376;margin: 0px 10px 0px 0px;">
            </a>
        </span>
        <span>
            <div style="margin-bottom: 5px;">
                <a href="/news/index/id/<?=$news_item->id?>">
                    <b><?=$news_item->title?></b>
                </a>
            </div>
            <div>
                <?=$news_item->short_description?>
            </div>
        </span>
        </div>
    <?endforeach?>
</div>


<div style="width: 300px;display: inline-block;float:left;">
    <?$this->widget('CategoriesWidget');?>
</div>