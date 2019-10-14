<?php
namespace DanielKellyIO\ValueComparison;

class Compare{
	public $value;
	
	public static function value($value){
		return new self($value);
	}
	
	public function __construct($value) {
		$this->value = $value;
		if(is_string($this->value)){
			$this->value = trim($this->value);
		}
	}
	
	public function is($comparison_value, $scope=null){
		return $this->hasScope($scope)
			? $this->{$scope}($comparison_value, 'is')
			: $this->value == trim($comparison_value); // non-strict compare is intentional
	}
	
	public function isNot($comparison_value, $scope=null){
		return $this->hasScope($scope)
			? !$this->{$scope}($comparison_value, 'is')
			: !$this->is(trim($comparison_value));
	}
	
	public function greaterThan($comparison_value, $scope=null){
		return $this->hasScope($scope)
			? $this->{$scope}($comparison_value, 'greaterThan')
			: (int) $this->value > (int) $comparison_value;
	}
	
	public function lessThan($comparison_value, $scope=null){
		return $this->hasScope($scope)
			? $this->{$scope}($comparison_value, 'lessThan')
			: (int) $this->value < (int) $comparison_value;
	}
	
	public function contains($comparison_value, $scope=null){
		if($this->hasScope($scope)){
			return $this->{$scope}($comparison_value, 'contains');
		}
		$needle = trim((string) $comparison_value);
		return $needle !== '' && strpos((string) $this->value, $needle) !== false;
	}
	
	public function excludes($comparison_value, $scope=null){
		return $this->hasScope($scope)
			? $this->{$scope}($comparison_value, 'excludes')
			: !$this->contains($comparison_value);
	}
	
	public function startsWith($comparison_value, $scope=null){
		if($this->hasScope($scope)){
			return $this->{$scope}($comparison_value, 'startsWith');
		}
		$needle = trim((string) $comparison_value);
		return $needle !== '' && substr((string) $this->value, 0, strlen($needle)) === (string) $needle;
	}
	
	public function endsWith($comparison_value, $scope=null){
		if($this->hasScope($scope)){
			return $this->{$scope}($comparison_value, 'endsWith');
		}
		$needle = trim((string) $comparison_value);
		return substr((string) $this->value, - strlen($needle)) === (string) $needle;
	}
	
	private function all($comparison_values, $function){
		$all = true;
		$comparison_values = is_string($comparison_values)
			? explode(',', $comparison_values )
			: $comparison_values;
		foreach($comparison_values as $comparison_value){
			if( !call_user_func([$this, $function], trim($comparison_value)) ){
				$all = false;
				break;
			}
		}
		return $all;
	}
	
	private function any($comparison_values, $function){
		$any = false;
		$comparison_values = is_string($comparison_values)
			? explode(',', $comparison_values )
			: $comparison_values;
		foreach($comparison_values as $comparison_value){
			if( call_user_func([$this, $function], trim($comparison_value)) ){
				$any = true;
				break;
			}
		}
		return $any;
	}
	
	private function hasScope($scope){
		return in_array($scope, ['any', 'all']);
	}
}
