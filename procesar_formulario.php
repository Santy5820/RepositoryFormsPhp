<?php
// Incluir PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

// Captura de datos del formulario
$devoluciones = $_POST['devoluciones'];
$envios = $_POST['envios'];
$pagos = $_POST['pagos'];
$tyc = $_POST['tyc'];
$datos = $_POST['datos'];
$contacto = $_POST['contacto'];
$redes = $_POST['redes'];
$correo_cliente = $_POST['correo_cliente']; // Nuevo campo para el correo del cliente

// Validar el correo del cliente
if (!filter_var($correo_cliente, FILTER_VALIDATE_EMAIL)) {
    echo "El correo del cliente no es válido.";
    exit;
}

// Instanciar PHPMailer
$mail = new PHPMailer(true);

try {
    // Configuración del servidor de correo
    $mail->isSMTP();
    $mail->Host = 'smtp.hostinger.com'; // Servidor SMTP
    $mail->SMTPAuth = true;
    $mail->Port = 465;  
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;  
    $mail->Username = 'hola@visiongraphix.co'; // Correo desde el cual enviarás
    $mail->Password = 'V316g791_'; // Contraseña del correo

    // Destinatarios
    $mail->setFrom('hola@visiongraphix.co', 'VisionGrpahix.co');
    $mail->addAddress('cabreraarizasantiago@gmail.com', 'VisionGrpahix.co'); // Tu correo
    $mail->addAddress($correo_cliente); // Correo del cliente

    // Contenido del correo
    $mail->isHTML(true);
    $mail->Subject = 'Formulario completado por el cliente';
    $mail->Body    = "
        <h2>Información del Footer:</h2>
        <p><strong>Política de Devoluciones:</strong> $devoluciones</p>
        <p><strong>Política de Envíos:</strong> $envios</p>
        <p><strong>Métodos de Pago:</strong> $pagos</p>
        <p><strong>Términos y Condiciones:</strong> $tyc</p>
        <p><strong>Política de Tratamiento de Datos:</strong> $datos</p>
        <p><strong>Contacto:</strong> $contacto</p>
        <p><strong>Redes Sociales:</strong> $redes</p>
    ";

    // Enviar el correo
    $mail->send();
    echo 'El formulario ha sido enviado correctamente';
} catch (Exception $e) {
    echo "Error al enviar el formulario: {$mail->ErrorInfo}";
}
?>
