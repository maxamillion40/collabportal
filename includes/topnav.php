<?php
	require_once("func.php");
	mysql_auto_connect();
	$return_to = get_uri();
	if(is_loggedin())	{
		$unread = count(mysql_get("SELECT `id` FROM `messages` WHERE `to`='".$_SESSION["user"]."' AND `read`='0'"));
	}
?>
<header>
	<div class="container">
		<!-- Logo -->
		<a href="./" class="logo" id="trans"><span class="scratch"></span></a>
		<!-- Nav -->
		<ul class="site-nav">
			<li><a href="http://scratch.mit.edu/projects/editor/"><?php echo __("Create"); ?></a></li>
			<li><a href="http://scratch.mit.edu/explore/?date=this_month"><?php echo __("Explore"); ?></a></li>
			<li><a href="http://scratch.mit.edu/discuss/13/"><?php echo __("Discuss"); ?></a></li>
			<li class="addborder"><a href="help.php"><?php echo __("Help"); ?></a></li>
			<?php
		        $res = "";
				if(isset($_GET["result"]))	{
					$res = $_GET["result"];
				}
				$err = "";
				if(isset($_GET["error"]))	{
					$err = $_GET["error"];
				}
				$uname = "";
				if(isset($_GET["uname"]))	{
					$uname = $_GET["uname"];
				}
				$name = "";
				if(isset($_GET["name"]))	{
					$name = $_GET["name"];
				}
				
                    require_once("includes/notices.php");
					
				if(is_loggedin())	{
					echo "<li id='msg-icon'><a href='messages.php'><img id='msg-image' src='img/topnav.png' alt='Msg' height='35' width='35' /></a>";
					if($unread > 0)	{
						echo "<span id='notificationsCount'>".$unread."</span>";
					}
					echo "</li>";
					echo "<li id='welcome'><a>" . __("Welcome") . ", ".$_SESSION["user"]."</a></li>";
					echo "<div id='amenu'><li id='bmenu'><a><img id='mbn' src='img/topnav.png' height='35' width='35' /></a></li>
                            <ul id='menulink'>
                                <li><a href='mystuff.php'>" . __("My Collabs") . "</a></li><br/>
                                <li><a href='about.php'>" . __("About Scratchcollabs") . "</a></li><br/>
								<li><a href='help.php'>" . __("Help") . "</a></li><br/>
								<li><a href='settings.php'>" . __("Settings") . "</a></li><br/>
								<li id='bye'><a href='action.php?logout'><img id='lbn' src='img/topnav.png' height='35' width='35' /><span id='logout-sign'>" . __("Logout") . "</span></a></li>
                            </ul></div>";
				}
				else	{
					echo "<li id=\"asc\"><a href=\"about.php\">" . __("What is Scratchcollabs?") . "</a></li>
					<li id=\"join\">
							<a onclick='loginbox();'>" . __("Join us") . "!</a>
							<div id=\"login\" style=\"display: none;\">
								<div id=\"arrow\"></div>
								<div id=\"form\">
									<form action=\"action.php?login&return=$return_to\" method=\"post\">
										<input type=\"text\" name=\"name\" placeholder=\"" . __("Username") . "\" required value=\"".$uname."\" />
										<input type=\"password\" name=\"pass\" placeholder=\"" . __("Password") . "\" required />
										<input type=\"submit\" value=\"" . __("Login") . "\" class=\"button grey\" />
										<a href=\"join.php\">" . __("New here?") . "</a>
									</form>
								</div>
							</div>
					</li>";
				}
			?>
		</ul>
	</div>
</header>