<!-- <?php echo sprintf($template['content'], $password); ?> -->

<?php 

$variableArray = array(
'password' => $password
);

$templateHTML = $template['content'];

foreach ($variableArray as $key => $value) {
$templateHTML = str_replace("{".$key."}", $value, $templateHTML);
}

 ?>

<?php echo $templateHTML; ?>