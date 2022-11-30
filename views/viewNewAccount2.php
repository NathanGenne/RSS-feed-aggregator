<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Création de compte - 2</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <style  type="text/css">
    .off {
        background-color: #ffffff;
        border: #666666 1px solid;
        color: #cccccc;
        font: 20px Verdana,Arial,Helvetica,sans-serif;
        font-weight: bold;
    }
    .on {
        background-color: green;
        border: #666666 1px solid;
        color: #ffffff;
        font: 20px Verdana,Arial,Helvetica,sans-serif;
        font-weight: bold;
    }
    </style>
    <script>
        // ---------------------------------------------------------
        // Functions js relatives à la sélection des centres d'intérêts
        // ---------------------------------------------------------

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

            if (currenttotal == 3) { return false; }

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
            if (currenttotal > 0) {
                for($i=0; $i < currenttotal; $i++) {
                    inputValue = document.getElementsByClassName('on')[$i].value;
                    topics.push(inputValue);
                }
                document.getElementById('result').innerHTML = topics;
            }

        }
    </script>
</head>

<body>
    <p>
        <input class="off" type="button" value="bresil" onclick='btnclick(this);' />
        <input class="off" type="button" value="sport" onclick='btnclick(this);'  />
        <input class="off" type="button" value="politique" onclick='btnclick(this);' />
        <input class="off" type="button" value="emploi" onclick='btnclick(this);' />
        <input class="off" type="button" value="livres" onclick='btnclick(this);' />
    </p>
    <p id='result'></p>
    <input class="off" type="button" value="confirmer" onclick='confirm();' />
</body>

</html>