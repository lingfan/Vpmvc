<?php
/**
 * 
 * 视图类
 * @author 胡威
 *
 */
class View
{
	/**
	 * 
	 * 呈现布局模板
	 * @param string $file
	 */
	static public function render($file)
	{
		$content =  self::load($file);
		include(ROOT_PATH.'/v/layout.php');
		exit;
	}
	
	/**
	 * 
	 * 呈现局部模板
	 * @param string $file
	 */
	static public function renderPartail($file)
	{
		echo self::load($file);
		exit;
	}
	
	/**
	 * 
	 * 加载局部模板
	 * @param string $file
	 */
	static public function load($file)
	{
		$viewFile = ROOT_PATH.'/v/'.$file.'.php';
		if (is_readable($viewFile)) {
			ob_start();
			include($viewFile);
			$content = ob_get_contents();
			ob_end_clean();
			return $content;
		} else {
			new VException("{$viewFile} 模板文件不存在");
		}
		
	}
	
	static public function layout()
	{
		
	}
}