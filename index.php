<?php

// SHADER GENERATOR by Marco Cervellin v1.0
// ----------------------------------------

function html2rgb($color){
	//html hex colors to rgb
	if(strlen($color) == 6){
		list($r, $g, $b) = array($color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5]);
	}elseif(strlen($color) == 3){
		list($r, $g, $b) = array($color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2]);
	}else{
		return false;
	}
	return array(hexdec($r), hexdec($g), hexdec($b));
}

function shadergen($width, $height, $hexcolor, $alpha){
	//imposta colore e alpha
	$color = str_replace('#', '', $hexcolor);
	$filename = $color . "-" . $alpha . '.png';
	$rgb = html2rgb($color);
	$alpha = round((100 - $alpha) * 1.27);

	//crea risorsa immagine
	$im = imagecreatetruecolor($width, $height);
	imagealphablending($im, false);
	imagesavealpha($im, true);

	//imposta colore
	$color = imagecolorallocatealpha($im, $rgb[0], $rgb[1], $rgb[2], $alpha);
	imagefill($im, 0, 0, $color);

	header('Content-Disposition: Attachment;filename=' . $filename);
	header('Content-type: image/png');

	imagepng($im);
	imagedestroy($im);

	exit;
}

if($_POST['submit'] == 'crea'){
	$width = $_POST['width'];
	$height = $_POST['height'];
	$color = $_POST['color'];
	$alpha = $_POST['alpha'];
	$color = str_replace('#', '', $color);
	shadergen($width, $height, $color, $alpha);
}
?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Shader Generator</title>
		<style type="text/css">
			/* RESET
			/*---------------------------------*/
			*,html,body,div,dl,dt,dd,ul,ol,li,h1,h2,h3,h4,h5,h6,pre,form,label,fieldset,input,p,blockquote,th,td{margin:0;padding:0}
			table{border-collapse:collapse;border-spacing:0}
			fieldset,img{border:0}
			address,caption,cite,code,dfn,em,strong,th,var{font-style:normal;font-weight:normal}
			ol,ul,li{list-style:none}
			caption,th{text-align:left}
			h1,h2,h3,h4,h5,h6{font-size:100%;font-weight:normal}
			q:before,q:after{content:''}
			a{text-decoration:none}
			strong{font-weight:bold}
			em{font-style:italic}
			a img, input{border:none}
			a:active{outline:none}
			div,ul,li,form{position:relative}
			.fix:after{content:" ";visibility:hidden;display:block;height:0;clear:both}
			* html .fix{height:1%}
			.hide{display:none}

			body{
				background:#ddd;
				font-family: helvetica, arial, sans-serif;
				font-size:14px;
				line-height:20px;
				color:#222;
			}

			#genform{
				width:500px;
				margin:100px auto;
				padding:20px;
				border:1px solid #bbb;
				-webkit-border-radius: 10px;
				-moz-border-radius: 10px;
				border-radius: 10px;
				background:#fff;
				box-shadow: 0 0 6px 6px #ccc;
			}



			h1, h2{
				font-family: helvetica, arial, sans-serif;
				font-size:20px;
				line-height:20px;
				color:#222;
				font-weight:bold;
				margin-bottom:20px;
				text-shadow:0 1px 0px #bbb;
			}

			h2{
				font-size:12px;
				text-shadow:none;
			}

			label{
				float:left;
				width:100px;
				overflow:hidden;
				line-height:24px;
			}
			input{
				width:50px;
				padding:4px;
				overflow:hidden;
				border:1px solid #bbb;
			}
			p{
				display:block;
				margin-bottom:5px;
			}

			input[type=submit]{
				margin:30px auto 0;
				width:100px;
				padding:4px 6px;
				text-transform:uppercase;
				font-family: helvetica, arial, sans-serif;
				font-size:12px;
				line-height:20px;
				color:#fff;
				font-weight:bold;
				background:#bbb;
				cursor:pointer;
			}
			span{
				margin-left:10px;
				font-size:11px;
			}
			span.version{
				float:right;
			}

		</style>
	</head>
	<body>
		<div id="genform">
			<h1>Shader Generator</h1>
			<h2>Create and download a PNG image with transparency to use with css backgrounds.</h2>
			<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
				<p><label>Width </label><input type="text" name="width" value="10"/> <span>px</span></p>
				<p><label>Height </label><input type="text" name="height" value="10"/> <span>px</span></p>
				<p><label>Color </label><input type="text" name="color" value="fff"/><span>(esadecimale)</span></p>
				<p><label>Transparency </label><input type="text" name="alpha" value="40"/><span>(0-100)</span></p>
				<p><input type="submit" name="submit" value="generate"/></p>
			</form>
			<span class="version">macodev - v1.0</span>
		</div>

	</body>
</html>


