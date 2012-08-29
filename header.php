<!DOCTYPE html>
<html>
<head>
	<title><?php if(!$multipleview) { echo $post->title." | "; Options::out( 'title' ); } else { Options::out( 'title' ); echo ' | '; Options::out( 'tagline' ); } ?></title>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
	<meta name="generator" content="Habari <?php echo Version::get_habariversion() ?>" />
	<link rel="stylesheet" type="text/css" href="<?php Site::out_url( 'theme' ); ?>/style.css" media="screen" />
	<?php echo $theme->header(); ?>
</head>

<body>
	<div id="wrapper">
		<div id="header">
			<?php echo $theme->area('header'); ?>
		</div>
		<div id="menu">
				<?php echo $theme->area('menubar'); ?>
		</div>