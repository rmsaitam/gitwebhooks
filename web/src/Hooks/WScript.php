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
#
namespace web\src\Hooks;


/**
* 
* WScript 
*
* 
*/
class WScript
{
	
	const TEMPLATE_DEPLOY = [

		"beta"		=> "template-script-deploy",
		"test" 		=> "template-script-deploy",
		"product" 	=> "template-script-deploy",
	];

	private static $msg;

	#
	#
	#
	private static $TemplateContent ;

	#
	#
	#
	private static $pathTemplate; 

	#
	#
	#
	private static $pathScript; 


	function __construct()
	{
		# code...
	}

	private static function GetTemplate()
    {
        /* use `self` to access class constants from inside the class definition. */
        return self::TEMPLATE_DEPLOY;
    } 

	/** [LoadTemplate description] */
	public function LoadTemplate($_ARRAY, $modelo = "beta") {

		#
		#
		#
		$path = PATH_FISICO;

		#
		#
		#
		$modeloName = isset(self::GetTemplate()[$modelo]) ? self::GetTemplate()[$modelo] : "beta";

		#
		#
		#
		$file_template = "{$path}/" . PATH_TEMPLATE . "{$modeloName}.sh.php";

		#
		#
		#
        if (is_file($file_template)) 
        {

        	#
        	#
        	#
        	$NOME_SCRIPT = $_ARRAY["REPOSITORY"] . "-".$modelo;

        	#
        	#
        	#
        	self::$pathScript = PATH_SCRIPT . $NOME_SCRIPT . ".sh";

        	#
        	#
        	#
        	self::$pathTemplate = $file_template;

        	#
        	#
        	#
            $content = file_get_contents($file_template);


            #
            #
            #
            if (is_array($_ARRAY)) {

            	#
            	#
            	#
                foreach ($_ARRAY as $key => $value) {
                 	
                 	#
                 	#   
                 	#         
                    $content = str_replace('{'.strtoupper($key).'}', $value, $content) ;
                }

                #
                #
                #
                self::$TemplateContent = $content;

                #
                #
                #
                return $this;
            }

        } else {exit("erro, not found file [{$file_template}]..");}
	}

	/** [LoadFileScript description] */
	public function LoadFileScript($show=false) {

		
		#
		#
		#
		if(self::$TemplateContent && is_file(self::$pathTemplate)) {

			#
			#
			#
			if($show)
				print_r(self::$TemplateContent);

			#
			#
			#
			$PATH_SCRIPT = PATH_FISICO . self::$pathScript;

			self::$pathScript = $PATH_SCRIPT;

			return $this;
		}
	}

	/** [Save description] */
	public function Save(){

		#
		#
		#
		if(file_put_contents(self::$pathScript, self::$TemplateContent)){

			self::$msg = "Saved successfully!";

		} else {

			self::$msg = "Error while saving!";
		}

		return $this;
	}

	/** [Save description] */
	public function Show(){

		print "\n";
		print self::$msg;
		print "\n";
	}
}