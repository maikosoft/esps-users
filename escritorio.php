<?php
// valida sesion /// INCLUIR ANTES QUE NADA //
include("validar.php");
//////////////////////////////////////////////
include("modulos.php");
include("inc/nemesis.php");
$connection = Nemesis::get_connection(); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"  dir="ltr" lang="en-US">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<title><? 
$cat = Nemesis::select("*","configuracion","`opcion` = 'titulo'");
while ($row = $cat->fetch_array()) { echo $row["valor"]; } ?></title>

<link rel='stylesheet' href='css/style.css' type='text/css' media='all' />
<link rel='stylesheet' href='css/navigation.css' type='text/css' media='all' />
<link rel='stylesheet' href='css/form.css' type='text/css' media='all' />
<link rel='stylesheet' href='css/table.css' type='text/css' media='all' />

<script type='text/javascript' src='js/minmax.js'></script>

<script type='text/javascript' src='js/jquery.js'></script>
<script type='text/javascript' src='js/jquery.droppy.js'></script>
<script type='text/javascript' src='js/jquery.curvycorners.js'></script>
<script type='text/javascript' src='js/jquery.pngFix.js'></script>
<script type='text/javascript' src='js/jquery.idTabs.js'></script>

<script type="text/javascript">
$(document).ready(function(){
	/* Navigation */
	$('#navigation').droppy({
		/* dropdown speed */
		speed: 10
	});
	/* PNG fix */
	$(document).pngFix();
	/* Round corner */
	$('.round').corner({
		/* top left */
		tl: { radius: 5 },
		/* top right */
		tr: { radius: 5 },
		/* bottom left */
		bl: { radius: 5 },
		/* bottom right */
		br: { radius: 5 }
	});
});
</script>

</head>
<body>

<div id="header">

	<?php top(); ?>

</div>

<ul id="navigation">
	
</ul>

<div id="main">

<div id="title" class="round">
	<h1>Escritorio</h1>
	<span class="right">Este es el escritorio</span>
</div>
<div id="sidebar">

	
	<div class="side-box">
		<?php menulateral(); ?>
	</div>
	
	

</div>

<div id="content">
<div id="content-container">

	<div class="box round">
		<h2>Bienvenido</h2>
		
		
		<div id="tab1">
			
			<div class="success round"><strong>Bienvenido!</strong> Al panel de administración de <strong>ESPS</strong>.</div>
			
			
			<!-- <p><strong>Integer et purus at tellus porta rhoncus.</strong> 
			Fusce consequat est rutrum magna tincidunt vitae dictum magna gravida. 
			In ut sagittis metus. 
			Integer ac eros libero, ac <a href="#">imperdiet ante</a>. 
			Integer sit amet enim dolor, id venenatis neque. 
			<a href="#"><strong>Proin</strong></a> at orci vel dolor hendrerit dapibus. 
			Aliquam at metus interdum nunc posuere euismod. 
			Cras id nisi orci.</p>

			<ul>
				<li>Integer ullamcorper luctus eros, vel lacinia augue vulputate imperdiet.</li>
				<li>Integer convallis nisi ac turpis dapibus a cursus tellus molestie.</li>
				<li>Sed ornare elit et nunc pulvinar posuere.</li>
			</ul>
			
			<ol>
				<li>Integer ullamcorper luctus eros, vel lacinia augue vulputate imperdiet.</li>
				<li>Integer convallis nisi ac turpis dapibus a cursus tellus molestie.</li>
				<li>Sed ornare elit et nunc pulvinar posuere.</li>
			</ol> -->
		</div>

		
	
	</div>
	

	
	<!-- <div class="box round">
		<h2>Table Sample</h2>
		<table>
		<thead>
		<tr>
			<th scope="col">Name</th>
			<th scope="col">Website Address</th>
			<th scope="col">Email Address</th>
			<th scope="col">Action</th>
		</tr>
		</thead>
		<tbody>
		<tr class="odd">
			<td>John Adams</td>
			<td>http://themeforest.net?ref=ne-design</td>
			<td>sample@sample.com</td>
			<td><a href="#">Add</a> | <a href="#">Edit</a> | <a href="#">Remove</a></td>
		</tr>
		<tr>
			<td>John Adams</td>
			<td>http://themeforest.net?ref=ne-design</td>
			<td>sample@sample.com</td>
			<td><a href="#">Add</a> | <a href="#">Edit</a> | <a href="#">Remove</a></td>
		</tr>
		<tr class="odd">
			<td>John Adams</td>
			<td>http://themeforest.net?ref=ne-design</td>
			<td>sample@sample.com</td>
			<td><a href="#">Add</a> | <a href="#">Edit</a> | <a href="#">Remove</a></td>
		</tr>
		<tr>
			<td>John Adams</td>
			<td>http://themeforest.net?ref=ne-design</td>
			<td>sample@sample.com</td>
			<td><a href="#">Add</a> | <a href="#">Edit</a> | <a href="#">Remove</a></td>
		</tr>
		</tbody>
		</table>
		
		
	</div> -->

</div>
</div>



</div>

<div id="footer">
	<?php foot(); ?>
</div>

</body>
</html>