<!DOCTYPE html>
<html>
<head>
<?php echo $head; ?>
<?php if (isset($application_head)) echo $application_head; ?>
</head>
<body>
<?php echo $header; ?>
<?php if (isset($top)) echo $top; ?>
<?php echo $content; ?>
<?php echo $footer; ?>
<?php if (isset($application_footer)) echo $application_footer; ?>
</body>
</html>