<?php
$config = new \Config\CMS\Settings();
echo $this->extend($config->viewLayoutEmail);
?>

<?php echo $this->section('main') ?>

<p>Hola:</p>

<strong>Formulario de contacto, esto son los datos:</strong>
<p> <?php echo $email; ?> </p>
<p> <?php echo $name; ?> </p>


<?php echo $this->endSection() ?>