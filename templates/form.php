<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?= $title ?></title>
</head>
<body>
	<form method="post" enctype="multipart/form-data">
		<input type="text" name="username">
		<hr>
		<input type="file" name="file">
		<hr>
		<button type="submit">Save</button>
	</form>
</body>
</html>