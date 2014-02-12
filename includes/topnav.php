<?php
	require_once("loader.php");
	require_once("func.php");
	$return_to = get_uri();
	if($_USER -> is_online())	{
		$unread = count($_MYSQL -> get("SELECT `id` FROM `messages` WHERE `to`='".$_USER -> name ."' AND `read`='0'"));
	}
	
	
?>
<div id="navfix"></div>
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
				//Required for notice/error boxes
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
			?>
			<ul id='rightnav'>
			<?php	
				if($_USER -> is_online())	{
				//Content loggedin START
			?>
			<div id="msg-menu-a"><li>
				<li id="msg-icon">
					<a><img id='msg-image' src='img/topnav.png' alt='Msg' height='35' width='35' /></a>
				</li>
				<ul id="msg-menu-content">
					<li><a href="inbox.php"><?php echo __("Inbox"); ?></a></li>
					<li><a href="outbox.php"><?php echo __("Outbox"); ?></a></li>
					<li><a href="compose.php"><?php echo __("New"); ?></a></li>
				</ul>
			</div>
			<?php
					if($unread > 0)	{
			?>
						<span id='notificationsCount'><?php echo $unread; ?></span>
			<?php
					}
			?>
					</li>
					<li id='welcome'><a><?php echo __("Welcome") . ",&nbsp;" . $_SESSION["user"]; ?></a></li>
					<div id='amenu'>
						<li id='bmenu'>
							<a><img id='mbn' src='img/topnav.png' height='35' width='35' /></a>
						</li>
						<ul id='menulink'>
							<li><a href='mystuff.php'><?php echo __("My Collabs"); ?></a></li><br/>
							<li><a href='about.php'><?php echo __("About ScratchCollabs"); ?></a></li><br/>
							<li><a href='help.php'><?php echo __("Help"); ?></a></li><br/>
							<li><a href='settings.php'><?php echo __("Settings"); ?></a></li><br/>
							<li id='bye'><a href='action.php?logout'><img id='lbn' src='img/topnav.png' height='35' width='35' /><span id='logout-sign'><?php echo __("Logout"); ?></span></a></li>
						</ul>
					</div>
			<?php
				//Content loggedin END
				}
				else	{
				//Content offline START
			?>
					<li id="asc"><a href="about.php"><?php echo __("What is ScratchCollabs?"); ?></a></li>
					<li id="join">
							<a onclick='loginbox();'><?php echo __("Join"); ?>!</a>
							<div id="login" style="display: none;">
								<div id="arrow"></div>
								<div id="form">
									<form action="action.php?login&return=<?php echo $return_to; ?>" method="post">
										<input type="text" name="name" placeholder="<?php echo __("Username"); ?>" required value="<?php echo $uname; ?>" />
										<input type="password" name="pass" placeholder="<?php echo __("Password"); ?>" required />
										<input type="submit" value="<?php echo __("Login"); ?>" class="button grey" />
										<a href="join.php"><?php echo __("New here?"); ?></a>
									</form>
								</div>
							</div>
					</li>
			<?php
				//Content offline END
				}
			?>
			</ul>
		</ul>
	</div>
</header>