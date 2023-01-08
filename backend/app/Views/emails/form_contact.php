<?php
$config = new \Config\CMS\Settings();
echo $this->extend($config->viewLayoutEmail);
?>

<?php echo $this->section('main') ?>

<p>Hola:</p>

<strong>Formulario de contacto, esto son los datos:</strong>
<p> Email: <?php echo $email; ?> </p>
<p> Nombre: <?php echo $name; ?> </p>
<p> Ubicación: <?php echo $location; ?> </p>
<p> Mensaje: <?php echo $message; ?> </p>


<?php echo $this->endSection() ?>