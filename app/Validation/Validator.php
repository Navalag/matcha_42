<?php

namespace Matcha\Validation;

use Respect\Validation\Validator as Respect;
use Respect\Validation\Exceptions\NestedValidationException;

class Validator
{
	protected $errors;

	public function editTextError()
	{
		$pattern = array();
		$replacement = array();

		$pattern[0] = '/Password_old/';
		$pattern[1] = '/Password_new/';
		$pattern[2] = '/Password_repeat/';
		$replacement[0] = 'Password';
		$replacement[1] = 'Password';
		$replacement[2] = 'Password';

		if ($this->errors) {
			foreach ($this->errors as $key => $value) {
				$this->errors[$key] = preg_replace($pattern, $replacement, $value);
			}
		}
	}

	public function validate($request, array $rules)
	{
		foreach ($rules as $field => $rule) {
			try {
				$rule->setName(ucfirst($field))->assert($request->getParam($field));
			} catch (NestedValidationException $e) {
				$this->errors[$field] = $e->getMessages();
			}
		}

		$this->editTextError();

		$_SESSION['errors'] = $this->errors;

		return $this;
	}

	public function failed()
	{
		return !empty($this->errors);
	}
}
