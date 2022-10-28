import Plyr from 'plyr'
export default function() {
	Array.from( document.querySelectorAll( '.player' ) ).map( ( p ) => new Plyr( p ) )
}
