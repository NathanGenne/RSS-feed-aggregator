<?php
    $topics = ["international","europe","bresil","sport","politique","emploi","livres"];
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <main role="main" class="" id="home">
        <h1 class="pt-5 pb-4">Bienvenu</h1>
        <a href="./home/logout">logout</a>
        <div class = "container">
        <?php
            foreach($topics as $topic) {
                $topic_content = 'https://www.lemonde.fr/'.$topic.'/rss_full.xml';
                $topic_content = simplexml_load_file($topic_content);?>

                <h2><?= $topic ?></h2>
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4">
                <?php foreach($topic_content->channel->item as $list) { ?>
                    <div class="cadre col">
                        <fieldset>
                                <h4><a href="<?= $list->link ?>"><?= $list->title ?></a></h4>
                                <p><?= $list->description ?></p>
                            
                        </fieldset>
                    </div>
                    
                <?php } ?>
                </div>
            <?php } ?>
                
        </div>
    </main>
</body>

</html>