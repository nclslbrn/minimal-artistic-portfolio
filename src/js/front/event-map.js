export default function () {
	const leaflet = window.L;
	const mapElem = document.getElementById("map");

	// const dataBlock = document.getElementById( 'eventsMapData' )
	const layer = {
		url: "https://tile.jawg.io/jawg-dark/{z}/{x}/{y}{r}.png?access-token=1a3WPGMMAFNzR82i1XPtxKdscVlFu6FnfMGaIkRcffu5B2fgGxHhIIHvV9M7syeH",
		attribution: "<a href=\"https://www.jawg.io?utm_medium=map&utm_source=attribution\" target=\"_blank\">&copy; Jawg</a> - <a href=\"https://www.openstreetmap.org?utm_medium=map-attribution&utm_source=jawg\" target=\"_blank\">&copy; OpenStreetMap</a>&nbsp;contributors",
		subdomains: "abcd",
		minZoom: 0,
		maxZoom: 20,
		ext: "png",
	};

	const eventsMapCenter = [46.48117, 2.440409];
	const eventsMapZoom = 6;
	const singleEventMapZoom = 16;

	if (null !== mapElem && null !== leaflet) {
		// single event map
		if (mapElem.classList.contains("single-marker")) {
			const overlay = mapElem.parentElement;
			mapElem.width = overlay.offsetWidth;
			mapElem.height = overlay.offsetHeight;
			const latitude = mapElem.getAttribute("data-latitude");
			const longitude = mapElem.getAttribute("data-longitude");
			const singleEventMap = leaflet
				.map("map")
				.setView([latitude, longitude], singleEventMapZoom);

			leaflet
				.tileLayer(layer.url, {
					attribution: layer.attribution,
					subdomains: layer.subdomains,
					minZoom: layer.minZoom,
					maxZoom: layer.maxZoom,
					ext: layer.ext,
				})
				.addTo(singleEventMap);

			leaflet.marker([latitude, longitude]).addTo(singleEventMap);

			// mulitple events map
		} else if (
			null !== window.eventsMapData &&
			undefined !== window.eventsMapData
		) {
			const multipleEventsMap = leaflet
				.map("map")
				.setView(eventsMapCenter, eventsMapZoom);
			leaflet
				.tileLayer(layer.url, {
					attribution: layer.attribution,
					subdomains: layer.subdomains,
					minZoom: layer.minZoom,
					maxZoom: layer.maxZoom,
					ext: layer.ext,
				})
				.addTo(multipleEventsMap);

			window.eventsMapData.forEach((eventData) => {
				leaflet
					.marker([eventData.latt, eventData.long])
					.bindPopup(`<a href="${eventData.link}">${eventData.title}</a>`)
					.openPopup()
					.addTo(multipleEventsMap);
			});

			const viewButton = document.querySelectorAll(
				"#change-event-display-mode > button",
			);
			const eventList = document.getElementById("events-list");
			if (
				0 < viewButton.length &&
				null !== eventList &&
				eventList !== undefined
			) {
				viewButton.forEach((btn) => {
					btn.addEventListener("click", () => {
						const target = btn.getAttribute("data-toggle");
						viewButton.forEach((b) => b.classList.remove("active"));
						btn.classList.add("active");
						if ("map" === target) {
							eventList.style.display = "none";
							mapElem.style.height = "70vh";
							leaflet.Util.requestAnimFrame(
								multipleEventsMap.invalidateSize,
								multipleEventsMap,
								!1,
								multipleEventsMap._container,
							);
						} else if ("events-list" === target) {
							mapElem.style.height = "0";
							eventList.style.display = "block";
						}
					});
				});
			}
		}
	}
}
