const leaflet = window.L
const mapElem = document.getElementById('map')
const dataBlock = document.getElementById('eventsMapData')
const layer = {
    url: 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
    attribution:
        '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}

const eventsMapCenter = [46.48117, 2.440409]
const eventsMapZoom = 6

if (mapElem !== null && leaflet !== null) {
    // single event map
    if (mapElem.classList.contains('single-marker')) {
        const overlay = mapElem.parentElement
        mapElem.width = overlay.offsetWidth
        mapElem.height = overlay.offsetHeight
        const latitude = mapElem.getAttribute('data-latitude')
        const longitude = mapElem.getAttribute('data-longitude')
        const singleEventMap = leaflet
            .map('map')
            .setView([latitude, longitude], 18)

        leaflet
            .tileLayer(layer.url, {
                attribution: layer.attribution
            })
            .addTo(singleEventMap)

        leaflet.marker([latitude, longitude]).addTo(singleEventMap)
        // mulitple events map
    } else if (
        window.eventsMapData !== null &&
        window.eventsMapData !== undefined
    ) {
        const multipleEventsMap = leaflet
            .map('map')
            .setView(eventsMapCenter, eventsMapZoom)
        leaflet
            .tileLayer(layer.url, {
                attribution: layer.attribution,
                maxZoom: 18
            })
            .addTo(multipleEventsMap)

        eventsMapData.forEach((eventData) => {
            leaflet
                .marker([eventData.latt, eventData.long])
                .bindPopup(`<a href="${eventData.link}">${eventData.title}</a>`)
                .openPopup()
                .addTo(multipleEventsMap)
        })

        const viewButton = document.querySelectorAll(
            '#change-event-display-mode > button'
        )
        const eventList = document.getElementById('events-list')
        if (
            viewButton.length > 0 &&
            eventList !== null &&
            eventList !== undefined
        ) {
            for (let i = 0; i < viewButton.length; i++) {
                viewButton[i].addEventListener('click', (event) => {
                    const target = viewButton[i].getAttribute('data-toggle')
                    for (let j = 0; j < viewButton.length; j++) {
                        viewButton[j].classList.remove('active')
                    }
                    viewButton[i].classList.add('active')
                    if (target === 'map') {
                        eventList.style.display = 'none'
                        mapElem.style.height = '500px'
                        leaflet.Util.requestAnimFrame(
                            multipleEventsMap.invalidateSize,
                            multipleEventsMap,
                            !1,
                            multipleEventsMap._container
                        )
                    } else if (target === 'events-list') {
                        mapElem.style.height = '0'
                        eventList.style.display = 'block'
                    }
                })
            }
        }
    }
}
