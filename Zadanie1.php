<?php
    Class PhoneKeyboardConverter {
        public $output = "", $error = "", $input = "";
        private $zamiennik;
        
        function setVariable($input, $zamiennik) {
            $input = strtolower($input);
            $this->input = $input;
            $this->zamiennik = $zamiennik;
        }

        function convertToNumeric($input) {
            $inputArray = str_split($input);
            $convertedValue = "";
            $count = 1;
            foreach ($inputArray as $key => $value) {
                $convertedValue .= array_search($value, $this->zamiennik);
                if($count != count($inputArray)) {
                    $convertedValue .= ",";
                }
                $count++;
            }
            return $convertedValue;
        }

        function convertToString($input) {
            $inputArray = explode(',', $input);
            $convertedValue = "";
            foreach ($inputArray as $key => $value) {
                $convertedValue .= $this->zamiennik[$value];
                if ($key == 0) {
                    $convertedValue = strtoupper($convertedValue);
                } elseif ($key > 2) {
                    if ($inputArray[$key-2] == '11' && $inputArray[$key-1] == '0') {
                        $convertedValue[$key] = strtoupper($convertedValue[$key]);
                    }
                }
            }
            return $convertedValue;
        }

        function start() {
            if (preg_match('~[0-9]+~', $this->input)) {
                $this->output = $this->ConvertToString($this->input);
            } else {
                $this->output = $this->convertToNumeric($this->input);
            }
        }
    }

    $converter = new PhoneKeyboardConverter();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $zamiennik = array(
            2 => 'a',
            22 => 'b',
            222 => 'c',
            3 => 'd',
            33 => 'e',
            333 => 'f',
            4 => 'g',
            44 => 'h',
            444 => 'i',
            5 => 'j',
            55 => 'k',
            555 => 'l',
            6 => 'm',
            66 => 'n',
            666 => 'o',
            7 => 'p',
            77 => 'q',
            777 => 'r',
            7777 => 's',
            8 => 't',
            88 => 'u',
            888 => 'v',
            9 => 'w',
            99 => 'x',
            999 => 'y',
            9999 => 'z',
            0 => ' ',
            1 => ',',
            11 => '.'
        );
        
        $converter->setVariable($_POST['input'], $zamiennik);

        $converter->start();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zadanie 1</title>
</head>
<body>
    <form action="" method="post">
        <input type="text" name="input" value="<?= $converter->input?>">
        <p color="red"><?= $converter->error ?></p>
        <input type="submit" value="Zamień">
    </form>
    <p>Output: <?= $converter->output ?></p>
</body>
</html>