<?
session_start();
ob_start();
//Get top and menu
require("req/top.req.php");
//require("req/*");
include("req/inc.config.php");
#require("req/browser.stats.php");
require("req/clean.php");
require("req/form.php");
require("req/get_by_id.php");
require("req/get_date.php");
require("req/text_format.php");


//Get file contet, or get "front.php" page
if((isset($_GET['script']) || isset($_GET['domain'])) && $_GET['script'] != "right") 
{
	
	if(isset($_GET['domain']))
	{
		if(!isset($_GET['script']))
		{
			if(file_exists($_GET['domain']."/front.php"))
			{
				$req = "ok";
				require($_GET['domain']."/front.php");
				
			}
			else
			{
				$reqdomain = $_GET['domain'];
				header("Location: ?script=error&error=404&reqdomain=$reqdomain");
			}
		}
		else
		{
			if(file_exists($_GET['domain']."/".$_GET['script'].".php"))
			{
				$req = "ok";
				require($_GET['domain']."/".$_GET['script'].".php");
			}
			else
			{
				$reqdomain = $_GET['domain'];
				$reqscript = $_GET['script'];
				header("Location: ?script=error&error=404&reqdomain=$reqdomain&reqscript=$reqscript");
			}
		}
	
	}
	elseif(!isset($_GET['domain']))
	{
		if(file_exists($_GET['script'].".php"))
		{
			$req = "ok";
			require($_GET['script'].".php");
		}
		else
		{
			$reqscript = $_GET['script'];
			if($reqscript == "fejl") die("fatal.....");
			header("Location: ?script=error&error=404&reqscript=$reqscript");
		}
	}
}
else
{
	require("front.php");
}

//Make right
if(isset($_GET['domain']) && file_exists($_GET['domain']."/right.php"))
{
	require($_GET['domain']."/right.php");
}
else
{
	require("right.php");
}

//Get bottom and footer
require("req/bottom.req.php");
ob_end_flush();
?>
