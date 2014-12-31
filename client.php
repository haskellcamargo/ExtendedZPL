<?php
/**
 *  @File : client.php
 *  @Autor : FelipeBarros<felipe.barros.pt@gmail.com>
 *  @Description : Responsável por conter a inicialização da aplicação lógica.
 *  @Version : 1.0 [2014-12-30]
 *
*/
include_once('autoload.php');
include_once('config/constant.php');

use main\core\Configuration,
	main\core\ZPLException,
	main\core\Core,
	main\core\InputAdapter,
	main\interpreter\Tokenizer;

if( !defined('CONFIG_FILE') || !file_exists(CONFIG_FILE) ) 
	throw new \Exception("Error Processing Request File: config.ini", 0);

$configurationData = parse_ini_file(CONFIG_FILE);

if( empty($configurationData) )
	throw new \Exception("Error Processing Request Load Content Data config.ini", 0);


$configuration = new Configuration($configurationData);
$configuration
	->setLanguage()
	->setErrorsFile()
	->setRunnableMode(PHP_SAPI);

if(!isset($argv)) $argv = $_GET;

$core = new Core( $configuration,
					new InputAdapter(
							Configuration::getRunnableMode(),
							$argv
));

$core->run();

/*
 * Test Lexer
 */
// $lexer  = new Tokenizer(file_get_contents("zpl/Main.zpl"));
// $token  = $lexer->nextToken();

// while ($token->key != EOF) {
// 	var_dump($token->key);
// 	$token = $lexer->nextToken();
// }

/*
 * Test parser
 */

// $lexer  = new Tokenizer(file_get_contents($argv[1]));
// $parser = new TokenReader($lexer);
// $parser->stmt();

?>