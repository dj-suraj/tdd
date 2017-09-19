<?php

namespace tdd\tddworkshop;

class Calculator
{

    public function calculate($operation, $numbers = '')
    {

        $response = self::getNumberAndDelimiter($numbers);
        $delimiter = $response['delimiter'];
        $numbers = $response['numbers'];

        if (empty($numbers)) {
            return 0;
        } else {
            if (!is_string($numbers)) {
                throw new \InvalidArgumentException('Parameters must be a string');
            }

            $numbersArray = explode($delimiter, str_replace('\n', $delimiter, $numbers));
            $negative_numbers = array_filter($numbersArray, function ($number_item) {
                return $number_item < 0;
            });

            if (count($negative_numbers) > 0) {
                throw new \InvalidArgumentException('Negative numbers ('.implode(',', $negative_numbers).') not allowed.');
            }

            if (array_filter($numbersArray, 'is_numeric') !== $numbersArray) {
                throw new \InvalidArgumentException('Parameter string must contain only numbers.');
            }

            $numbersArray = array_filter($numbersArray, function ($number_item) {
                return $number_item < 1000;
            });

            return $operation == 'add' ? array_sum($numbersArray) : array_product($numbersArray);
        }
    }

    private function getNumberAndDelimiter($input)
    {

        $result = [];

        if (strstr($input, '\\\\')) {
            $numberArray = explode('\\\\', $input);

            $result['delimiter'] = $numberArray[1];
            $result['numbers'] = $numberArray[2];
            return $result;
        }

        $result['delimiter'] = ',';
        $result['numbers'] = $input;

        return $result;
    }
}
