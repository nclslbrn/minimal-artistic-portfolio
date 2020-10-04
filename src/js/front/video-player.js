import Plyr from 'plyr';

const players = Array.from(document.querySelectorAll('.player')).map(p => new Plyr(p));