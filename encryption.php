<?php
    $plainText = $_POST['plainText'];
    $option = $_POST['option'];
    $plainText_copy = $plainText;
    $cipherText;
    switch($option){
        case '3': 
            $cipherText = substitution_cipher($plainText_copy, 1);
        break;
        case '1': 
            $cipherText = ceaser_cipher($plainText_copy, 1);
        break;
        case '2':
            $cipherText = ceaser_cipher($plainText_copy, 2);
        break;
        case '4':
            $cipherText = substitution_cipher($plainText_copy, 2);
    }
    function ceaser_cipher($plainText, $option){
        if($option == 1){
            $key = mt_rand(0, 25);
            for($i = 0; $i < strlen($plainText); $i++){
                $ascii_plainText = ord($plainText[$i]);
                $ascii_cipherText = $ascii_plainText + $key;
                if($ascii_cipherText > 122){
                    $ascii_cipherText -= 122;
                    $plainText[$i] = chr(97+$ascii_cipherText);
                }
                else{
                    $plainText[$i] = chr($ascii_cipherText);
                }
            }
        }
        if($option == 2){
            for($i = 0; $i < strlen($plainText); $i++){
                $key = mt_rand(0,25);
                $ascii_plainText = ord($plainText[$i]);
                $ascii_cipherText = $ascii_plainText + $key;
                if($ascii_cipherText > 122){
                    $ascii_cipherText -= 122;
                    $plainText[$i] = chr(97+$ascii_cipherText);
                }
                else{
                    $plainText[$i] = chr($ascii_cipherText);
                }
            }
        }
        return $plainText;
    }
    function substitution_cipher($plainText, $option){
        if($option == 1){
            $key = mt_rand(1, 25);
            $table = array();
            
            // Making the substitution table 
            for($i = 0; $i < 26; $i++){
                $temp = ($key++)%26;
                array_push($table, chr(97+$temp));
            }
            // Replacing the plain text to convert it into cipher text
            for($i = 0; $i < strlen($plainText); $i++){
                $ascii_plainText = ord($plainText[$i]);
                if($ascii_plainText == 32){
                    $plainText[$i] = '%';
                }
                else{
                    $table_index = $ascii_plainText - 97;
                    $plainText[$i] = $table[$table_index]; 
                }
            }
        }
        if($option == 2){
            $table_lower = array();
            $table_upper = array();
            $key_lower = mt_rand(1, 25);
            $key_upper = mt_rand(1, 25);
            $space_count = 0;

            // Setting up the table for lowercase characters
            for($i = 0; $i < 26; $i++){
                $temp = ($key_lower++)%26;
                array_push($table_lower, chr(97+$temp));
            }
            // Setting up the table for uppercase characters
            for($i = 0; $i < 26; $i++){
                $temp = ($key_upper++)%26;
                array_push($table_upper, chr(65+$temp));
            }
            $temp = 1;
            for($i = 0; $i < strlen($plainText); $i++){
                $ascii_plainText = ord($plainText[$i]);
                if($temp%2 == 0 && $ascii_plainText != 32){
                    if(ctype_upper($plainText[$i])){
                        $plainText[$i] = $table_lower[$ascii_plainText - 65];
                    }
                    else if(ctype_lower($plainText[$i])){ 
                        $plainText[$i] = $table_upper[$ascii_plainText - 97];
                    }
                    $temp++;
                }
                else if($temp%2 != 0 && $ascii_plainText != 32){
                    if(ctype_upper($plainText[$i])){
                        $plainText[$i] = $table_upper[$ascii_plainText - 65];
                    }
                    if(ctype_lower($plainText[$i])){
                        $plainText[$i] = $table_lower[$ascii_plainText - 97];
                    }
                    $temp++;
                }
                else{
                    $space_count++;
                    if($space_count%2 == 0){
                        $plainText[$i] = '%';
                    }
                    else{
                        $plainText[$i] = '@';
                    }
                    $temp++;
                }
            }
        }
        return $plainText;
    }
    echo($cipherText);
?>