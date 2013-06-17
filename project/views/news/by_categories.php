<?php
/*
 * @var $news
 * @var string $view_mode
 * @var $this NewsController
 */

$this->breadcrumbs=array(
	'Новости',
);
?>

<h1 style="">Лента новостей</h1>
<div style="margin:20px 0px;">
    <input type="radio" class="cat_switcher" name="view_mode" value="as_list" <?=($view_mode=='as_list')?'checked="checked"':''?>/> Списком
    <input type="radio" class="cat_switcher" name="view_mode" value="by_cat" <?=($view_mode=='by_cat')?'checked="checked"':''?>/> По категориям
</div>

<div style="clear:both"></div>

<div style="display: inline-block; width:580px;float:left; margin:0px 20px 0px 0px;">

    <?$count=0;?>
    <?foreach($categories as $category):?>
        <?if(($news_count = $category->countNews()) == 0)continue?>

        <h3><?=$category->name?> (<?=$news_count?>)</h3>

        <?
            if($news_count > 3){
                $params = array(
                    'limit'=>3,
                    'order' => 'RAND()',
                );
            }else{
                $params = array(
                    'order'=>'date_created DESC'
                );
            }
        ?>

        <?foreach($category->news($params) as $news_item):?>
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
                        <time><?=date('Y-m-d', strtotime($news_item->date_created))?></time>
                        <a href="/news/index/id/<?=$news_item->id?>">
                            <b><?=$news_item->title?></b>
                        </a>
                    </div>
                    <div>
                        <?=$news_item->short_description?>
                    </div>
                </span>
            </div>
            <?$count++?>
        <? endforeach?>
    <? endforeach?>

    <?if($count==0):?>
        Нет данных для отображения.
    <?endif?>
</div>


<div style="width: 300px;display: inline-block;float:left;">
    <?$this->widget('CategoriesWidget');?>
</div>