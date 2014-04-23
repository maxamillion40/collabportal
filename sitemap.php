<?php
	header("Content-type: application/xml");
	include("includes/sitemap-data.php");
?>
<?php
	echo '<?xml version="1.0" encoding="UTF-8"?>';
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
	<?php
		foreach($map as $url)	{
			if(isset($url["file"]) and isset($url["priority"]))	{
				echo "<url>";
				echo "<loc>http://" . $_SERVER["SERVER_NAME"] . "/" . $url["file"] . "</loc>";
				echo "<lastmod>" . date("Y-m-d",filemtime($url["file"])) . "</lastmod>";
				echo "<changefreq>weekly</changefreq>";
				echo "<priority>" . $url["priority"] . "</priority>";
				echo "</url>";
			}
		}
	?>
</urlset> 