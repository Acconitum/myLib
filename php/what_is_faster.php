
class Test
{
	public $string;
	public function __construct($string)
	{
		$this->string = $string;
	}

	public function getString()
	{
		return $this->string;
	}
}

$t = new Test('Hallo');

$executionStartTime = microtime(true);

for($i = 0 ; $i < 1000000; $i++) {
	$k = $t->getString();
}

$executionEndTime = microtime(true);
$seconds = $executionEndTime - $executionStartTime;

echo 'function: '.$seconds."\n"; // 0.029029130935669 sec


$executionStartTime = microtime(true);

for($i = 0 ; $i < 1000000; $i++) {
	$k = $t->string;
}

$executionEndTime = microtime(true);
$seconds = $executionEndTime - $executionStartTime;

echo 'property: '.$seconds."\n"; // 0.012920141220093 sec

/*####### prperty is mcuh faster ############*/
