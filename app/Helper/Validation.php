<?php

namespace App\Helper;

use App\Model\DB;


class Validation
{

    protected $rules;

    protected $data;

    private $errors;

    public function make(array $data, array $rules): bool
    {
        $this->data = $data;
        $this->rules = $rules;

        $valid = [true];

        foreach ($rules as $item => $ruleset) {

            $value_arr = \explode('|', $ruleset);

            foreach ($value_arr as $rule) {

                $param_pos = \strpos($rule, ':');

                if ($param_pos !== false) {

                    $param = \substr($rule, $param_pos + 1);
                    $rule = \substr($rule, 0, $param_pos);
                } else {

                    $param = "";
                }

                $methodName = \ucfirst($rule);

                $value = isset($data[$item]) ? $data[$item] : null;
                if (\method_exists($this, $methodName) && $value !== null) {

                    $validate_result = $this->{$methodName}($item, $value, $param);

                    if ($validate_result === false) {
                        $valid[] = false;
                    }
                }
            }
        }

        if (in_array(false, $valid)) {
            $valid = false;
        } else {
            $valid = true;
        }

        return $valid;
    }

    public function getErrors()
    {
        return $this->errors;
    }

    protected function generateError($item, $message = "%s")
    {
        $this->errors[$item][] = sprintf($message, $item);
    }

    /**************************
     * Rules
     */


    /**
     * check if has value
     * 
     * @param string $item
     * @param string $value
     *
     * @return bool
     */
    private function required($item, $value)
    {
        if (empty($value)) {
            $this->generateError($item, 'پر کردن فیلد %s الزامی است.');
            return false;
        }

        return true;
    }

    private function unique($item, $value, $param)
    {
        $table = "";
        $__position = strpos($param, '__');
        if ($__position !== false) {

            $table = substr($param, 0, $__position);
            $item = substr($param, $__position + 2);
        } else {
            $table = $param;
        }

        $db = new DB;
        $user_found = $db->from($table)->find($item, $value);

        if(is_null($user_found)){
            $this->generateError($item, 'قبلا یک حساب کاربری با این %s ساخته شده است.');
            return false;
        }

        return true;
    }

    private function confirm($item, $value, $param)
    {

        if (!isset($this->data[$param])) {
            return false;
        }

        if ($this->data[$param] !== $value) {
            $this->generateError($item, "%s همخوانی ندارد.");
            return false;
        }

        return true;
    }

    private function emailnumber($item, $value)
    {
        if ($this->email($item, $value) || $this->number($item, $value)) {
            return true;
        }

        unset($this->errors[$item][count($this->errors[$item]) - 1]);

        return false;
    }

    private function email($item, $value)
    {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $this->generateError($item, '%s صحیح نمیباشد.');
            return false;
        }

        return true;
    }

    private function number($item, $value)
    {

        $preg = '/[^0-9]/';

        if (!filter_var($value, FILTER_VALIDATE_INT) && \preg_match($preg, $value)) {
            $this->generateError($item, '%s صحیح نمیباشد.');
            return false;
        }

        return true;
    }
}
