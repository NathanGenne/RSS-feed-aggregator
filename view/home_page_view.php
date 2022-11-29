<?php

$topics = ["bresil","sport","politique","emploi","livres"];

foreach($topics as $topic) {
    $topic_content = 'https://www.lemonde.fr/'.$topic.'/rss_full.xml';
    $topic_content = simplexml_load_file($topic_content);?>

    <h2><?= $topic ?></h2>
    <?php foreach($topic_content->channel->item as $list) { ?>
        <h4><a href="<?= $list->link ?>"><?= $list->title ?></a></h4>
        <h5><?= $list->description ?></h5>
    <?php }
}
?>

<style  type="text/css">
.off
{
    background-color: #ffffff;
    border: #666666 1px solid;  
    color: #cccccc;
    font: 20px Verdana,Arial,Helvetica,sans-serif;
    font-weight: bold;
}
.on
{
    background-color: green;
    border: #666666 1px solid;  
    color: #ffffff;
    font: 20px Verdana,Arial,Helvetica,sans-serif;
    font-weight: bold;
}
</style>

<p>
    <input class="off" type="button" value="bresil" onclick='btnclick(this);' />
    <input class="off" type="button" value="sport" onclick='btnclick(this);'  />
    <input class="off" type="button" value="politique" onclick='btnclick(this);' />
    <input class="off" type="button" value="emploi" onclick='btnclick(this);' />
    <input class="off" type="button" value="livres" onclick='btnclick(this);' />
    </p>
<p id='result'></p>
<input class="off" type="button" value="confirmer" onclick='confirm();' />