if (document.querySelector('#map')) {
    ymaps.ready(init);
}

function init () {
    var myMap = new ymaps.Map('map', {
        center: [59.808459, 30.459113],
        zoom: 9,
        controls: []
    });

    myGeoObject = new ymaps.GeoObject({
        // Описание геометрии.
        geometry: {
            type: "Point",
            coordinates: [59.808459, 30.459113],
        },
    });
    myMap.geoObjects.add(myGeoObject)

    const select = document.querySelector('.contacts__select select');

    select.addEventListener('change', () => {
        const coords = select.value.split(',')
        myMap.setCenter(coords)

        myGeoObject = new ymaps.GeoObject({
            // Описание геометрии.
            geometry: {
                type: "Point",
                coordinates: coords,
            },
        });
        myMap.geoObjects.add(myGeoObject)
    })

    
    
}

