// Imports
import tieneValoresNulos from "./objetoNull.js";

(() => {
    // Elementos
    const formulario = document.querySelector("#form_variants");
    const graficaDiv = document.querySelector(".graficaDiv");
    const titleGrafica = document.querySelector(".tituloGrafica");

    // Variables
    let isNull;
    let datos;

    // Inputs
    let tipoGrafica;
    let colorGrafica;
    let orientacionGrafica;

    // Datos de gráfico
    const dataVariantGraphic = {
        'tipo': null,
        'color': null,
        'orientacion': null,
    }

    // Eventos
    formulario.addEventListener('submit', e => {
        e.preventDefault();
        analizarVariants();
    })


    // Funciones
    const analizarVariants = async () => {
        // Obtener parametro de tipo de grafica
        obtenerTipoGrafica();
        obtenerColor();
        obtenerOrientacion();

        // Validar parametros nulos
        isNull = tieneValoresNulos(dataVariantGraphic);

        if (!isNull) {
            graficaDiv.classList.remove("hidden");

            // Obtener datos y generar gráfica
            let datos = await obtenerDatos(dataVariantGraphic['tipo']);
            generarGrafica(datos);
        }
    }

    function generarGrafica(datos) {
        titleGrafica.textContent = dataVariantGraphic['tipo'];

        const canvas = document.getElementById('grafica');
        const ctx = canvas.getContext('2d');

        // Configuración de la gráfica
        const anchoBarra = 40; // Ancho de cada barra
        const espacioEntreBarras = 20; // Espacio entre barras
        const alturaMaxima = 200; // Altura máxima de la gráfica
        const posicionInicialX = 50; // Posición inicial en X

        // Limpiar el canvas
        ctx.clearRect(0, 0, canvas.width, canvas.height);

        // Dibujar las barras
        for (let i = 0; i < datos.length; i++) {
            const alturaBarra = (datos[i].percent / 100) * alturaMaxima;
            const posicionX = posicionInicialX + i * (anchoBarra + espacioEntreBarras);
            const posicionY = canvas.height - alturaBarra;

            ctx.fillStyle = dataVariantGraphic['color']; // Color de las barras
            ctx.fillRect(posicionX, posicionY, anchoBarra, alturaBarra);
        }
    }

    // Obtener variantes
    const obtenerTipoGrafica = () => {
        tipoGrafica = document.querySelector('input[name="data_graphic"]:checked');
        // Validación de marcado
        dataVariantGraphic['tipo'] = tipoGrafica?.value ?? null;
    }

    const obtenerColor = () => {
        colorGrafica = document.querySelector('input[name="data_color"]:checked');
        // Validación de marcado
        dataVariantGraphic['color'] = colorGrafica?.value ?? null;
    };

    const obtenerOrientacion = () => {
        orientacionGrafica = document.querySelector('input[name="data_direction"]:checked');
        // Validación de marcado
        dataVariantGraphic['orientacion'] = orientacionGrafica?.value ?? null;
    }

    const obtenerDatos = async (typeGraphic) => {
        try {
            const response = await fetch(`../data/${typeGraphic}.json`);
            const datos = await response.json();
            return datos.data;
        } catch (error) {
            console.error('Error al cargar los datos JSON:', error);
            return null; // Otra opción es lanzar una excepción aquí
        }
    }


})();