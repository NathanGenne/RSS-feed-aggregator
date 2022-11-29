
// ---------------------------------------------------------
// Functions relatives à la sélection des centres d'intérêts
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
    if (currenttotal > 0) {
        for($i=0; $i < currenttotal; $i++) {
            inputValue = document.getElementsByClassName('on')[$i].value;
            topics.push(inputValue);
        }
        document.getElementById('result').innerHTML = topics;
    }
    

}