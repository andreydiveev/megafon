<?php
/*
 * @var $news
 * @var $this NewsController
 */

$this->breadcrumbs=array(
    'Новости' => array('/news'),
);
?>

<h3><?=$news->short_description?></h3>

<p>
    <span><?=date('Y-m-d', strtotime($news->date_created))?></span>
    <span><b><?=$news->author->name?></b></span>
</p>

<div style="text-align: justify;">
    <img src="<?=$news->large_image?>" style="display:block; margin: 0px 15px 10px 0px;margin:20px auto;">
    <?=$news->text?>
</div>

<p/>

<div>
    Категория: <a href="#to_categroy"><?=$news->category->name?></a><p/>
</div>
