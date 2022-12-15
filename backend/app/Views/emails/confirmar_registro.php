<?php
$config = new \Config\CMS\Settings();
echo $this->extend($config->viewLayoutEmail);
?>

<?php echo $this->section('main') ?>

<p>Hola <?php echo $username?>:</p>

<strong>Confirmar registro banco de tiempo</strong>
<p>Accede desde este enlace para confirmar tu email y así tener acceso a tu área privada</p>

<a href="<?php echo $activacion_url; ?>">Verifica tu email : <?php echo $email; ?></a>

<?php echo $this->endSection() ?>