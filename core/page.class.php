<?php
	class page	{
		var $title;
		var $description;
		var $keywords;
		var $robots;
		var $scripts;
		var $styles;
		
		public function __construct()	{
			$this -> scripts = array();
			$this -> styles = array();
			
			foreach(explode(", ", CP::KEYWORDS) as $k)	{
				$this -> keywords[] = $k;
			}
			
			$this -> description = CP::DESCRIPTION;
		}
		
		public function requires_rank($which, $redirectOnInsufficient)	{
			if(!is_int($which))	{
				trigger_error("Bad argument #1 to page::requires_rank(), integer expected, got " . gettype($name), E_USER_ERROR);
			}
			if(!is_string($redirectOnInsufficient))	{
				trigger_error("Bad argument #2 to page::requires_rank(), string expected, got " . gettype($name), E_USER_ERROR);
			}
			//
			global $_USER;
			if($_USER -> class < $which)	{
				header("Location: $redirectOnInsufficient?error=insufficientrank");
			}
		}
		public function setTitle($prefix, $split = NULL)	{
			if(!is_string($prefix))	{
				trigger_error("Bad argument #1 to page::setTitle(), string expected, got " . gettype($name), E_USER_ERROR);
			}
			//
			if($split == NULL)	{
				$split = CP::TITLE_SPLITTER;
			}
			$this -> title = $prefix . " " . $split . " " . CP::NAME;
		}
		public function setDescription($desc)	{
		if(!is_string($desc))	{
				trigger_error("Bad argument #1 to page::setDescription(), string expected, got " . gettype($name), E_USER_ERROR);
			}
			//
			$this -> description = $desc;
		}
		public function addKeywords($keys)	{
			if(!is_array($prefix))	{
				trigger_error("Bad argument #1 to page::add_Keywords(), array expected, got " . gettype($name), E_USER_ERROR);
			}
			//
			foreach($keys as $key)	{
				$this -> keywords[] = $key;
			}
		}
		public function setRobots($commands)	{
			if(!is_array($commands))	{
				trigger_error("Bad argument #1 to page::setRobots(), array expected, got " . gettype($name), E_USER_ERROR);
			}
			//
			$this -> robots = $commands;
		}
		public function useScript($name)	{
			if(!is_string($name))	{
				trigger_error("Bad argument #1 to page::useScript(), string expected, got " . gettype($name), E_USER_ERROR);
			}
			//
			$this -> scripts[] = $name;
		}
		public function useStyle($name)	{
			if(!is_string($name))	{
				trigger_error("Bad argument #1 to page::useStyle(), string expected, got " . gettype($name), E_USER_ERROR);
			}
			//
			$this -> styles[] = $name;
		}
		
		private function tag($tag)	{
			if(!is_string($tag))	{
				trigger_error("Bad argument #1 to page::tag(), string expected, got " . gettype($name), E_USER_ERROR);
			}
			//
			return $tag . CP::BR;
		}
		public function putHeader()	{
			global $_HOME;
			global $_SCRIPTS;
			try	{
				echo $this -> tag("<title>" . $this -> title . "</title>");
				echo $this -> tag("<!-- Meta -->");
				echo $this -> tag("<meta charset=\"UTF-8\" />");
				echo $this -> tag("<meta name=\"description\" content=\"" . $this -> description . "\" />");
				echo $this -> tag("<meta name=\"keywords\" content=\"" . implode(", ", $this -> keywords) . "\" />");
				echo $this -> tag("<meta name=\"robots\" content=\"" . implode(", ", $this -> robots) . "\" />");
				echo $this -> tag("<meta http-equiv=\"X-UA-Compatible\" content=\"IE=Edge\" />");
				echo $this -> tag("<!-- Styles -->");
				echo $this -> tag("<link rel=\"stylesheet\" href=\"styles/main.css\" />");
				echo $this -> tag("<link rel=\"stylesheet\" href=\"styles/cp.css\" />");
				if(file_exists($_HOME . "/styles/" . basename($_SERVER["PHP_SELF"], ".php") . ".css"))	{
					echo $this -> tag("<link rel=\"stylesheet\" href=\"styles/" . basename($_SERVER["PHP_SELF"], ".php") . ".css\" />");
				}
				foreach($this -> styles as $style)	{
					echo $this -> tag("<link rel=\"stylesheet\" href=\"" . $style . "\" />");
				}
				echo $this -> tag("<!-- Favicon -->");
				echo $this -> tag("<link rel=\"shortcut icon\" href=\"favicon.ico\" />");
				echo $this -> tag("<!-- Scripts -->");
				foreach($this -> scripts as $script)	{
					if(isset($_SCRIPTS[$script]))	{
						foreach($_SCRIPTS[$script]["css"] as $stylesheet)	{
							echo $this -> tag("<link rel=\"stylesheet\" href=\"" . $stylesheet . "\" />");
						}
						foreach($_SCRIPTS[$script]["js"] as $javascript)	{
							echo $this -> tag("<script src=\"" . $javascript . "\"></script>");
						}
					}
					else	{
							echo $this -> tag("<script src=\"" . $script . "\"></script>");
					}
				}
				if(file_exists($_HOME . "/scripts/" . basename($_SERVER["PHP_SELF"], ".php") . ".js"))	{
					echo $this -> tag("<script src=\"scripts/" . basename($_SERVER["PHP_SELF"], ".php") . ".js\"></script>");
				}
				echo $this -> tag("<script src=\"scripts/init.js\"></script>");
			}
			catch(Exception $e)	{
			
			}
		}
	}
?>