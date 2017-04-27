<?php
/***********

 ▄▄▄██▀▀▀▓█████   █████▒ █████▒▒█████  ▄▄▄█████▓ ▒█████   ███▄    █  ██▓
   ▒██   ▓█   ▀ ▓██   ▒▓██   ▒▒██▒  ██▒▓  ██▒ ▓▒▒██▒  ██▒ ██ ▀█   █ ▓██▒
   ░██   ▒███   ▒████ ░▒████ ░▒██░  ██▒▒ ▓██░ ▒░▒██░  ██▒▓██  ▀█ ██▒▒██▒
▓██▄██▓  ▒▓█  ▄ ░▓█▒  ░░▓█▒  ░▒██   ██░░ ▓██▓ ░ ▒██   ██░▓██▒  ▐▌██▒░██░
 ▓███▒   ░▒████▒░▒█░   ░▒█░   ░ ████▓▒░  ▒██▒ ░ ░ ████▓▒░▒██░   ▓██░░██░
 ▒▓▒▒░   ░░ ▒░ ░ ▒ ░    ▒ ░   ░ ▒░▒░▒░   ▒ ░░   ░ ▒░▒░▒░ ░ ▒░   ▒ ▒ ░▓
 ▒ ░▒░    ░ ░  ░ ░      ░       ░ ▒ ▒░     ░      ░ ▒ ▒░ ░ ░░   ░ ▒░ ▒ ░
 ░ ░ ░      ░    ░ ░    ░ ░   ░ ░ ░ ▒    ░      ░ ░ ░ ▒     ░   ░ ░  ▒ ░
 ░   ░      ░  ░                  ░ ░               ░ ░           ░  ░

*
* @about 	project GitHub Webhooks, 
* Application responsible 
* for receiving posts from github webhooks, and automating 
* our production environment by deploying
* 
* @autor 	@jeffotoni
* @date 	25/04/2017
* @since    Version 0.1
* 
*/

#
#
require_once "config/setconfig.php";

echo "\nStart\n";

// print_r($_GET);
// print_r($_POST);

#
#
#
if(isset($_POST['payload'], $_GET['idkeys3']) && $_GET['idkeys3'] == '123456789') {


	#
	#
	#
	$vetorJson = $_POST['payload'];
	
	// if webhooks registered
	// 
	//

	//ob_start();

	$XGitHubEvent 	= $_SERVER['HTTP_X_GITHUB_EVENT'];

	$UserAgent 		= $_SERVER['HTTP_USER_AGENT'];

	$HTTP_X_HUB_SIGNATURE = $_SERVER['HTTP_X_HUB_SIGNATURE'];


	echo "\n";
	echo $XGitHubEvent;
	echo "\n";

	echo "\n";
	echo $UserAgent;
	echo "\n";

	echo "\n";
	echo $HTTP_X_HUB_SIGNATURE;
	echo "\n";

	#
	#
	#
	$json = json_decode($_POST['payload'], true);

	$ref 		= $json["ref"];
	$rep_id 	= $json["repository"]["id"];
	$rep_name 	= $json["repository"]["name"];

	echo "\n";
	echo $ref;
	echo "\n";

	echo "\n";
	echo $rep_id;
	echo "\n";

	echo "\n";
	echo $rep_name;
	echo "\n";

	print_r($_SERVER);

	print_r($json);

	#
	#
	#
	// $api()->WebHooks()->LoadTemplate([

	// 		"GIT_PATH" => "s3archiviobrasil",
	// 		"BRANCH" => "beta",
	// 	])
	// ->LoadFileScript(true);

	#
	#
	# Picking up the database
	# 
	//$COMANDO = "export GIT_PATH={$path_git_projeto} && /bin/sh ".PATH_LOCAL."/script-deploy.sh 2>&1";

	#
	#
	#
	//$last_line2 = shell_exec($COMANDO);

	#
	#
	#
	//print_r($last_line2);

	#
	#
	#
	//$string = ob_get_clean();
	file_put_contents(PATH_FISICO. PATH_LOG , $string . PHP_EOL, FILE_APPEND);
}
