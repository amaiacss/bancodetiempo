<?php
$config = new \Config\CMS\Settings();
echo $this->extend($config->viewLayoutEmail);
?>

<?php echo $this->section('main') ?>

<strong>Confirmar registro banco de tiempo</strong>
<p>Accede desde este enlace para confirmar tu email y así tener acceso a tu área privada<</p>

<p><?php echo $email; ?></p>
<p><?php echo $activacion_url; ?></p>


<?php echo $this->endSection() ?>