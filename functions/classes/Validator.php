<?php

namespace Classes;
class Validator
{

    protected array $rules_list = ['required', 'min', 'max', 'email', 'match', 'minNum'];
    protected array $errors = [];
    protected array $messages = [
        'required' => 'The :fieldname: field is required',
        'min' => 'The :fieldname: field must be a minimun :rulevalue: characters',
        'max' => 'The :fieldname: field must be a maximum :rulevalue: characters',
        'email' => 'Not valid email',
        'match' => 'The :fieldname: field must match :rulevalue: field',
        'minNum' => 'The :fieldname: field must be a number with a minimum value :rulevalue:',
    ];
    protected $data_items;

    final public function validate(array $data = [], array $rules = []): Validator
    {
        $this->data_items = $data;

        foreach ($data as $field => $value) {
            // in_array($field, array_keys($rules))
            if (isset($rules[$field])) {
                $this->check([
                    'fieldname' => $field,
                    'value' => $value,
                    'rules' => $rules[$field],
                ]);
            }
        }
        return $this;
    }

     protected function check(array $field): void
    {
        foreach ($field['rules'] as $rule => $rule_value) {
            if (in_array($rule, $this->rules_list, true) && !$this->$rule($field['value'], $rule_value)) {
                $this->addError(
                    $field['fieldname'],
                    str_replace([':fieldname:', ':rulevalue:'], [$field['fieldname'], $rule_value], $this->messages[$rule])
                );
            }
        }
    }

     protected function required(string $value, $rule_value): bool
    {
        return !empty(trim($value));
    }

     protected function min(string $value, $rule_value): bool
    {
        return mb_strlen($value, 'UTF-8') >= $rule_value;
    }

     protected function max(string $value, $rule_value): bool
    {
        return mb_strlen($value, 'UTF-8') <= $rule_value;
    }

     protected function minNum(string $value, $rule_value)
    {
        return filter_var($value, FILTER_VALIDATE_INT, ['options' => ['min_range' => $rule_value]]);
    }

    protected function email(string $value, $rule_value)
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }

    protected function match(string $value, $rule_value): bool
    {
        return $value === $this->data_items[$rule_value];
    }

    protected function addError(string $fieldname, string $error): void
    {
        $this->errors[$fieldname][] = $error;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function listErrors(string $fieldname): string
    {
        $output = '';
        if (isset($this->errors[$fieldname])) {
            $output .= "<div class='invalid-feedback d-block'><ul class='list-unstyled'>";
            foreach ($this->errors[$fieldname] as $error) {
                $output .= "<li>{$error}</li>";
            }
            $output .= "</ul></div>";
        }
        return $output;
    }

    public function hasErrors(): bool
    {
        return !empty($this->errors);
    }
}
