<?php
    Class PhoneKeyboardConverter {
        public $output = "", $error = "", $input = "";
        
        function setInput($input) {
            $input = strtolower($input);
            $this->input = $input;
        }

        function convertToNumeric($input) {
            $convertedValue = "";
            $count = 0;
            while ($count < strlen($input)) {
                switch ($input[$count]) {
                    case 'a':
                        $convertedValue .= "2";
                    break;
                    case 'b':
                        $convertedValue .= "22";
                    break;
                    case 'c':
                        $convertedValue .= "222";
                    break;
                    case 'd':
                        $convertedValue .= "3";
                    break;
                    case 'e':
                        $convertedValue .= "33";
                    break;
                    case 'f':
                        $convertedValue .= "333";
                    break;
                    case 'g':
                        $convertedValue .= "4";
                    break;
                    case 'h':
                        $convertedValue .= "44";
                    break;
                    case 'i':
                        $convertedValue .= "444";
                    break;
                    case 'j':
                        $convertedValue .= "5";
                    break;
                    case 'k':
                        $convertedValue .= "55";
                    break;
                    case 'l':
                        $convertedValue .= "555";
                    break;
                    case 'm':
                        $convertedValue .= "6";
                    break;
                    case 'n':
                        $convertedValue .= "66";
                    break;
                    case 'o':
                        $convertedValue .= "666";
                    break;
                    case 'p':
                        $convertedValue .= "7";
                    break;
                    case 'q':
                        $convertedValue .= "77";
                    break;
                    case 'r':
                        $convertedValue .= "777";
                    break;
                    case 's':
                        $convertedValue .= "7777";
                    break;
                    case 't':
                        $convertedValue .= "8";
                    break;
                    case 'u':
                        $convertedValue .= "88";
                    break;
                    case 'v':
                        $convertedValue .= "888";
                    break;
                    case 'w':
                        $convertedValue .= "9";
                    break;
                    case 'x':
                        $convertedValue .= "99";
                    break;
                    case 'y':
                        $convertedValue .= "999";
                    break;
                    case 'z':
                        $convertedValue .= "9999";
                    break;
                    case ' ':
                        $convertedValue .= "0";
                    break;
                    case '.':
                        $convertedValue .= "11";
                    break;
                    case ',':
                        $convertedValue .= "1";
                    break;
                    
                    default:
                        $this->error = "W polu znajduje sie niedozwolony znak!<br>Dozwolone znaki [A-Z], [a-z], ',', '.'";
                        return;
                    break;
                }
                if($count != strlen($input)-1) {
                    $convertedValue .= ",";
                }
                $count++;
            }
            return $convertedValue;
        }

        function convertToString($input) {
            $inputArray = explode(",", $input);
            $convertedValue = "";
            foreach ($inputArray as $key => $value) {
                switch ($value) {
                    case '2':
                        $convertedValue .= "a";
                    break;
                    case '22':
                        $convertedValue .= "b";
                    break;
                    case '222':
                        $convertedValue .= "c";
                    break;
                    case '3':
                        $convertedValue .= "d";
                    break;
                    case '33':
                        $convertedValue .= "e";
                    break;
                    case '333':
                        $convertedValue .= "f";
                    break;
                    case '4':
                        $convertedValue .= "g";
                    break;
                    case '44':
                        $convertedValue .= "h";
                    break;
                    case '444':
                        $convertedValue .= "i";
                    break;
                    case '5':
                        $convertedValue .= "j";
                    break;
                    case '55':
                        $convertedValue .= "k";
                    break;
                    case '555':
                        $convertedValue .= "l";
                    break;
                    case '6':
                        $convertedValue .= "m";
                    break;
                    case '66':
                        $convertedValue .= "n";
                    break;
                    case '666':
                        $convertedValue .= "o";
                    break;
                    case '7':
                        $convertedValue .= "p";
                    break;
                    case '77':
                        $convertedValue .= "q";
                    break;
                    case '777':
                        $convertedValue .= "r";
                    break;
                    case '7777':
                        $convertedValue .= "s";
                    break;
                    case '8':
                        $convertedValue .= "t";
                    break;
                    case '88':
                        $convertedValue .= "u";
                    break;
                    case '888':
                        $convertedValue .= "v";
                    break;
                    case '9':
                        $convertedValue .= "w";
                    break;
                    case '99':
                        $convertedValue .= "x";
                    break;
                    case '999':
                        $convertedValue .= "y";
                    break;
                    case '9999':
                        $convertedValue .= "z";
                    break;
                    case '0':
                        $convertedValue .= " ";
                    break;
                    case '11':
                        $convertedValue .= ".";
                    break;
                    case '1':
                        $convertedValue .= ",";
                    break;
                    
                    default:
                        $this->error = "W polu znajduje sie niedozwolony znak!<br>Dozwolone znaki [0-9], ','";
                        return;
                    break;
                }
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
        $converter->setInput($_POST['input']);

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