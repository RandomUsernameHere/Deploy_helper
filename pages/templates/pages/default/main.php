<?php /**@var \web136\UserInterface\Templates\TemplateData $data */ ?>
<?php
use web136\core\RBDH;
use  \web136\DebugOutput\CustomDebugger;

?>
<html>
<head>
	<title>RBDH - Rsync Based Deploy Helper</title>
</head>
<body>
<header>
	<div>Template loaded</div>
</header>
<main>

	<?php try {

		preg_match_all ('#@.*@#', '@baseDir@/pages/controllers', $result, PREG_SET_ORDER);

		//CustomDebugger::debugPrintVar (RBDH::getInstance());
		//CustomDebugger::debugPrintVar (RBDH::getInstance()->parseAliases('@baseDir@/pages/controllers'));


	} catch (\web136\Exceptions\FileNotExistsException $e) {
		\web136\DebugOutput\CustomDebugger::debugPrintVar ($e->getMessage ());
	} catch (\web136\Exceptions\InvalidParametersException $e) {
		\web136\DebugOutput\CustomDebugger::debugPrintVar ($e->getMessage ());
	} catch (\Exception $e) {
		\web136\DebugOutput\CustomDebugger::debugPrintVar ($e->getMessage ());
	} ?>

	<?=$data['content']?>

</main>
<footer>

</footer>
</body>
</html>