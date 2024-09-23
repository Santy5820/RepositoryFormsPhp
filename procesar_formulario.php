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

// Instanciar PHPMailer
$mail = new PHPMailer(true);

try {
    // Configuración del servidor de correo
    $mail->isSMTP();
    $mail->Host = 'smtp.tu-servidor.com'; // Servidor SMTP
    $mail->SMTPAuth = true;
    $mail->Username = 'tu-correo@tu-dominio.com'; // Correo desde el cual enviarás
    $mail->Password = 'tu-password'; // Contraseña del correo
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    // Destinatarios
    $mail->setFrom('tu-correo@tu-dominio.com', 'Santiago Cabrera');
    $mail->addAddress('tucorreo@dominio.com', 'Santiago Cabrera'); // Tu correo

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
