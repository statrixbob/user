<?php

/*
* @package   s9e\TextFormatter
* @copyright Copyright (c) 2010-2015 The s9e Authors
* @license   http://www.opensource.org/licenses/mit-license.php The MIT License
*/
namespace s9e\TextFormatter\Configurator\Items\AttributeFilters;
use InvalidArgumentException;
use RuntimeException;
use s9e\TextFormatter\Configurator\Helpers\ContextSafeness;
use s9e\TextFormatter\Configurator\Items\AttributeFilter;
class HashmapFilter extends AttributeFilter
{
	public function __construct(array $map = \null, $strict = \false)
	{
		parent::__construct('s9e\\TextFormatter\\Parser\\BuiltInFilters::filterHashmap');
		$this->resetParameters();
		$this->addParameterByName('attrValue');
		$this->addParameterByName('map');
		$this->addParameterByName('strict');
		$this->setJS('BuiltInFilters.filterHashmap');
		if (isset($map))
			$this->setMap($map, $strict);
	}
	public function asConfig()
	{
		if (!isset($this->vars['map']))
			throw new RuntimeException("Hashmap filter is missing a 'map' value");
		return parent::asConfig();
	}
	public function setMap(array $map, $strict = \false)
	{
		if (!\is_bool($strict))
			throw new InvalidArgumentException('Argument 2 passed to ' . __METHOD__ . ' must be a boolean');
		if (!$strict)
			foreach ($map as $k => $v)
				if ($k === $v)
					unset($map[$k]);
		\ksort($map);
		$this->vars['map']    = $map;
		$this->vars['strict'] = $strict;
	}
	public function isSafeInCSS()
	{
		if (!isset($this->vars['map']) || empty($this->vars['strict']))
			return \false;
		$disallowedChars = ContextSafeness::getDisallowedCharactersInCSS();
		foreach ($this->vars['map'] as $value)
			foreach ($disallowedChars as $char)
				if (\strpos($value, $char) !== \false)
					return \false;
		return \true;
	}
	public function isSafeInJS()
	{
		if (!isset($this->vars['map']) || empty($this->vars['strict']))
			return \false;
		$disallowedChars = ContextSafeness::getDisallowedCharactersInJS();
		foreach ($this->vars['map'] as $value)
			foreach ($disallowedChars as $char)
				if (\strpos($value, $char) !== \false)
					return \false;
		return \true;
	}
}