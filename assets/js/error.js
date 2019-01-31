require('../css/error.css');

import Typed from 'typed.js';

//https://github.com/mattboldt/typed.js/

var options = {
    strings: ["Page not found", "try again", "nothin' here"],
    typeSpeed: 50,
    backSpeed: 10,
    backDelay: 2000,
    showCursor: true,
    loop: true
}

var typed = new Typed(".p2", options);