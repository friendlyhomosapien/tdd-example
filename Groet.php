<?php

namespace App;

class Groet
{
    protected $case_name_normal = '/[A-Z]?[a-z]+(?!\,)/';
    protected $case_name_upper = '/[A-Z]+(?!\,)/';
    protected $name_arr = [];
    protected $name_upper_arr = [];

    public function greet($input)
    {
        if (preg_match($this->case_name_normal, $input)) {
            return 'Hallo ' . $input . '.';
        } else if ($input === null) {
            return 'Hallo vriend.';
        } else if (preg_match($this->case_name_upper, $input)) {
            return 'HALLO ' . $input . '!';
        } else if (is_array($input)) {
            $msg = 'Hallo ';
            $result = '';
            $this->analyzeArray($input);
            if (count($this->name_arr) > 0) {
                $result .= $msg . $this->createMsg();
            }
            if (count($this->name_upper_arr)) {
                $msg_deaf = $result !== '' ? ' EN HALLO ' : 'HALLO ';
                $result .= $msg_deaf . $this->createMsgBadHearing();
            }
            return $result;
        }
    }
    private function analyzeArray($input)
    {
        foreach ($input as $name) {
            if (preg_match($this->case_name_upper, $name)) {
                array_push($this->name_upper_arr, $name);
            } else if (preg_match($this->case_name_normal, $name)) {
                array_push($this->name_arr, $name);
            } else if (preg_match('/\,?/', $name)) {
                $names = explode(',', $name);
                foreach ($names as $name) {
                    if (preg_match($this->case_name_upper, $name)) {
                        array_push($this->name_upper_arr, trim($name));
                    } else if (preg_match($this->case_name_normal, $name)) {
                        array_push($this->name_arr, trim($name));
                    }
                }
            }
        }
    }
    private function createMsg()
    {
        $last_name_in_array = array_pop($this->name_arr);
        return implode(', ', $this->name_arr) . ' en ' . $last_name_in_array . '.';
    }
    private function createMsgBadHearing()
    {
        $last_name_in_array = array_pop($this->name_upper_arr);
        return implode(', ', $this->name_upper_arr) . ' en ' . $last_name_in_array . '!';
    }
}