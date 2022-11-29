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

<html>
<head>
<style  type="text/css">
.off
{
    BACKGROUND-COLOR: #ffffff;
    BORDER-BOTTOM: #666666 1px solid;
    BORDER-LEFT: #666666 1px solid;
    BORDER-RIGHT: #666666 1px solid;
    BORDER-TOP: #666666 1px solid;  
    COLOR: #ccc;
    FONT: 11px Verdana,Arial,Helvetica,sans-serif;
    font-weight:bold;
}
.on
{
    BACKGROUND-COLOR: GREEN;
    BORDER-BOTTOM: #666666 1px solid;
    BORDER-LEFT: #666666 1px solid;
    BORDER-RIGHT: #666666 1px solid;
    BORDER-TOP: #666666 1px solid;  
    COLOR: #ffffff;
    FONT: 11px Verdana,Arial,Helvetica,sans-serif;
    font-weight:bold;
}
</style>

<script lang=javascript>
var currenttotal = 0;

function btnclick(btn)
{
    if (btn.classList.contains("on"))
    {
        btn.class="off";
        btn.setAttribute("class","off");
        currenttotal--;
        return false;
    }

    if (currenttotal == 3) {
        return false;
    }

    if (btn.classList.contains("off"))
    {
        btn.class="on";
        btn.setAttribute("class","on");
        currenttotal++;
        return false;
    }

}

function confirm() {
    topics = [];
    for($i=0; $i < currenttotal; $i++) {
        inputValue = document.getElementsByClassName('on')[$i].value;
        topics.push(inputValue);
    }
    document.getElementById('result').innerHTML = topics;

}
</script>
</head>
<body>
    <p>
    <input class="off" name="bresil"    id="answerA" type="button" value="bresil" onclick='javascript:btnclick(this);' />
    <input class="off" name="sport"     id="answerB" type="button" value="sport" onclick='javascript:btnclick(this);'  />
    <input class="off" name="politique" id="answerC" type="button" value="politique" onclick='javascript:btnclick(this);' />
    <input class="off" name="emploi"    id="answerD" type="button" value="emploi" onclick='javascript:btnclick(this);' />
    <input class="off" name="livres"    id="answerE" type="button" value="livres" onclick='javascript:btnclick(this);' />
    </p>
    <p id='result'></p>
    <input class="off" type="button" value="confirmer" onclick='javascript:confirm();' />
    </body>
    </html>