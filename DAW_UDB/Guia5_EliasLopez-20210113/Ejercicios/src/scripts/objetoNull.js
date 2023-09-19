function tieneValoresNulos(objeto) {
    for (let propiedad in objeto) {
        if (objeto[propiedad] === null) {
            return true; // Si se encuentra al menos un valor nulo, devuelve true
        }
    }
    return false; // Si no se encuentra ningún valor nulo, devuelve false
};

export default tieneValoresNulos