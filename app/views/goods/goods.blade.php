<!DOCTYPE html>
<html lang="en">
<head>
	<title></title>
	<meta charset="utf-8">
</head>
<body>
<ul>
<?php foreach($item as $good):?>
	<li>{{ $good->price }}</li>
	<li>{{ $good->name }}</li>
<?php endforeach;?>
</ul>
</body>
</html>