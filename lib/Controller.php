<?php
/**
 *  控制器类库
 */ 
class Controller
{
	protected $parts;
	public $params;
	
	public function __construct($actionString)
	{
		$actionString = strtolower($actionString);
		
		if (substr($actionString, -1, 1) == '/') {
			$actionString = substr($actionString, 0, strlen($actionString) - 1);
		}
		
		$parts = explode('/', $actionString);
		if (empty($parts[0])) {
			$parts[0] = 'index';
		}
		
		if (empty($parts[1])) {
			$parts[1] = 'index';
		}
		$parts[0] = 'C'.ucfirst($parts[0]);
		$parts[1] = 'A'.ucfirst($parts[1]);
		
		$this->parts = $parts;
		$this->sectionAction = $parts[0].'/'.$parts[1];
		array_shift($parts);
		array_shift($parts);
		$this->params = $parts;
	}
	
	public function run()
	{
		if (!class_exists($this->parts[0])) {
			throw new VException("不存在{$this->parts[0]}此控制器");
		}
		
		if (!method_exists($this->parts[0], $this->parts[1])) {
			throw new VException("执行模块{$this->parts[1]}不存在{$this->parts[0]}控制器中");
		}
		
		$called = call_user_func_array(array(new $this->parts[0], $this->parts[1]), array($this->params));
		
		if ($called === FALSE) {
			throw new VException("模块{$this->parts[1]}在控制器{$this->parts[0]}中执行失败");
		}
	}
}
?>