require('../css/error.css');

import Typed from 'typed.js';

// Modified from: https://codepen.io/cluzier/pen/yZNyab
// Needs typed.js: https://github.com/mattboldt/typed.js/

status = document.getElementById("status_code").textContent;

function getTexte()
{
    if (status === "404")
    {
        return ["Page non trouvée", "Back to ailleurs"];
    }
    else
    {
        return ["Oops erreur !", "Back to ailleurs"];
    }
}

var text = getTexte();

    var options = {
        strings: text,
        typeSpeed: 50,
        backSpeed: 10,
        backDelay: 2000,
        showCursor: true,
        loop: true
    };

var typed = new Typed(".p2", options);

