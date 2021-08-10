import Plyr from 'plyr'

Array.from(document.querySelectorAll('.player')).map((p) => new Plyr(p))
