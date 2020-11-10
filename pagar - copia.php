<?php
// SDK de Mercado Pago
require __DIR__ .  '/vendor/autoload.php';

// Agrega credenciales
MercadoPago\SDK::setAccessToken('TEST-1261130280105518-110315-06b0adc1804de5369b72af7b9793f0ae-667320427');

// Crea un objeto de preferencia
$preference = new MercadoPago\Preference();
$preference->back_urls = array(
    "success" => "https://localhost/carrito/thankyou.php",
    "failure" => "http://localhost/carrito/errorpago.php?error=failure",
    "pending" => "http://localhost/carrito/errorpago.php?error=pending"
);
$preference->auto_return = "approved";

// Crea un ítem en la preferencia
$datos=array();
for($x=0;$x<10;$x++){
	$item = new MercadoPago\Item();
	$item->title = 'Pantalon';
	$item->quantity = 1;
	$item->unit_price = 12.50;
	$datos[]=$item;
}
$preference->items = $datos;
$preference->save();
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
	<form action="http://localhost/carrito/insertarpago.php" method="POST">
		<script
			src="https://www.mercadopago.com.ar/integrations/v1/web-payment-checkout.js"
			data-preference-id="<?php echo $preference->id; ?>">
		</script>

	</form>
</body>
</html>