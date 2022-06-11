<?php include 'includes/header.php';

require 'vendor/autoload.php';

// Incluir las otras clases 
// require 'clases/clientes.php';
// require 'clases/detalles.php';

use App\Clientes;
use App\Detalles;

$detalles = new Detalles();
$clientes = new Clientes();

include 'includes/footer.php';
