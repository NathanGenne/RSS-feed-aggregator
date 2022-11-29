<?php
$topics = $_SESSION['topics'];
foreach($topics as $topic) {
    $topic_content = 'https://www.lemonde.fr/'.$topic.'/rss_full.xml';
    $topic_content = simplexml_load_file($topic_content);

}

?>