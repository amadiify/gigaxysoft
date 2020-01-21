<?=\Moorexa\Rexa::runDirective(true,'setdefault')?>

<!DOCTYPE html>
<html lang="en-us">
<head> 
	<title><?=$package->name?></title>

	<!-- meta tags -->
	<?=\Moorexa\Rexa::runDirective(true,'partial','meta-tags.md')?>

	<!-- load theme meta tags -->
	<?=\Moorexa\Rexa::runDirective(true,'component','meta-tags')?>

	<!-- link tags -->
	<link rel="canonical" href="<?=url($package->url)?>">
	<!-- favicon -->
	<link rel="icon" type="image/png" href="<?=$package->icon?>" sizes="32x32">
	
	<!-- css -->
	<?=$assets->loadCss($__css)?>
  
</head>
	
<body>