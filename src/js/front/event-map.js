export default function() {

	const leaflet = window.L
	const mapElem = document.getElementById( 'map' )

	// const dataBlock = document.getElementById( 'eventsMapData' )
	const layer = {
		url: 'https://tiles.stadiamaps.com/tiles/alidade_smooth/{z}/{x}/{y}{r}.{ext}',
		attribution: '&copy; <a href="https://www.stadiamaps.com/" target="_blank">Stadia Maps</a> &copy; <a href="https://openmaptiles.org/" target="_blank">OpenMapTiles</a> &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors', subdomains: 'abcd',
		minZoom: 0,
		maxZoom: 20,
		ext: 'png'
	}

	const eventsMapCenter = [ 46.48117, 2.440409 ]
	const eventsMapZoom = 6
	const singleEventMapZoom = 16

	if ( null !== mapElem && null !== leaflet ) {

		// single event map
		if ( mapElem.classList.contains( 'single-marker' ) ) {
			const overlay = mapElem.parentElement
			mapElem.width = overlay.offsetWidth
			mapElem.height = overlay.offsetHeight
			const latitude = mapElem.getAttribute( 'data-latitude' )
			const longitude = mapElem.getAttribute( 'data-longitude' )
			const singleEventMap = leaflet
				.map( 'map' )
				.setView([ latitude, longitude ], singleEventMapZoom )

			leaflet
				.tileLayer( layer.url, {
					attribution: layer.attribution,
					subdomains: layer.subdomains,
					minZoom: layer.minZoom,
					maxZoom: layer.maxZoom,
					ext: layer.ext
				})
				.addTo( singleEventMap )

			leaflet.marker([ latitude, longitude ]).addTo( singleEventMap )

			// mulitple events map
		} else if (
			null !== window.eventsMapData &&
			window.eventsMapData !== undefined
		) {
			const multipleEventsMap = leaflet
				.map( 'map' )
				.setView( eventsMapCenter, eventsMapZoom )
			leaflet
				.tileLayer( layer.url, {
					attribution: layer.attribution,
					subdomains: layer.subdomains,
					minZoom: layer.minZoom,
					maxZoom: layer.maxZoom,
					ext: layer.ext
				})
				.addTo( multipleEventsMap )

			window.eventsMapData.forEach( ( eventData ) => {
				leaflet
					.marker([ eventData.latt, eventData.long ])
					.bindPopup( `<a href="${eventData.link}">${eventData.title}</a>` )
					.openPopup()
					.addTo( multipleEventsMap )
			})

			const viewButton = document.querySelectorAll(
				'#change-event-display-mode > button'
			)
			const eventList = document.getElementById( 'events-list' )
			if (
				0 < viewButton.length &&
				null !== eventList &&
				eventList !== undefined
			) {
				for ( let i = 0; i < viewButton.length; i++ ) {
					viewButton[i].addEventListener( 'click', () => {
						const target = viewButton[i].getAttribute( 'data-toggle' )
						for ( let j = 0; j < viewButton.length; j++ ) {
							viewButton[j].classList.remove( 'active' )
						}
						viewButton[i].classList.add( 'active' )
						if ( 'map' === target ) {
							eventList.style.display = 'none'
							mapElem.style.height = '70vh'
							leaflet.Util.requestAnimFrame(
								multipleEventsMap.invalidateSize,
								multipleEventsMap,
								! 1,
								multipleEventsMap._container
							)
						} else if ( 'events-list' === target ) {
							mapElem.style.height = '0'
							eventList.style.display = 'block'
						}
					})
				}
			}
		}
	}
}
