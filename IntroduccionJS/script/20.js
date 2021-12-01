// Métodos de propiedad (Funciones)
const reproductor = {
  reproducir: function (id = 01) {
    console.log(`Reproduciendo Canción con el ID ${id}`);
  },
  pausar: function () {
    console.log("Pausando...");
  },
  crearPlaylist: function (nombre) {
    console.log(`Creando la playlist: ${nombre}`);
  },
  reproducirPlaylist: function (nombre) {
    console.log(`Reproduciendo la playlist: ${nombre}`);
  },
};

reproductor.borrarCancion = function (id) {
  console.log(`Eliminando la canción: ${id}`);
};

reproductor.reproducir(23);
reproductor.pausar();
reproductor.borrarCancion(20);
reproductor.crearPlaylist("Sad's Moments");
reproductor.reproducirPlaylist("Sad's Moments");
