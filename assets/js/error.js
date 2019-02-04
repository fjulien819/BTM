require('../css/error.css');

import Typed from 'typed.js';

//https://github.com/mattboldt/typed.js/

 status = document.getElementById("status_code").textContent;

function getTexte()
{
    if (status === "404")
    {
        return ["Page non trouvée", "Back to ailleurs"];
    }
    else
    {
        return ["Une erreur s'est produite", "Back to ailleurs"];
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


// Ce JS vient directement du pen, j'ai donc mis l'autre en standby en attendant
/*

$('.hero-down').mousedown(function () {
    TweenMax.fromTo('.btn-react', 0.25, {
        opacity: 0,
        scale: 0
    }, {
        opacity: 0.25,
        scale: 1,
        onComplete: function () {
            TweenMax.to('.btn-react', 0.25, {
                opacity: 0,
                scale: 0
            });
        }
    });
});

$('a[href*=#]:not([href=#])').click(function () {
    if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname ==
        this.hostname) {
        var target = $(this.hash);
        target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
        if (target.length) {
            $('html,body').animate({
                scrollTop: target.offset().top
            }, 1000);
            return false;
        }
    }
});

*/