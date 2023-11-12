if (document.querySelector('#leafletmap')) {
    const lat = 13.71695782348248;
    const lng = -89.14944145434251;
    const zoom = 16;

    var map = L.map('leafletmap').setView([lat, lng], zoom);

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    L.marker([lat, lng]).addTo(map)
        .bindPopup(`
        <h2 class="mapa__heading">DevWebCamp</h2>
        <p class="mapa__texto">Centro de Convenciones de El Salvador</p>
        `)
        .openPopup();
}