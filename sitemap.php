<?php
	header("Content-type: application/xml");
?>
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
	<url>
		<loc>http://<?php echo $_SERVER["SERVER_NAME"]; ?>/index.php</loc>
		<lastmod><?php echo date("Y-m-d",filemtime("index.php")); ?></lastmod>
		<changefreq>weekly</changefreq>
		<priority>1</priority>
	</url>
</urlset> 