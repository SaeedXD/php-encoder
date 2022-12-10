<?php

namespace App\Services;

class Encoder
{
    public function __construct($code = null, $Key_A = 0, $Key_B = 0, $des = null)
    {
        $this->me = "\n/****************************************‌/\n   </> Develoed By Saeed Golestani !\n/****************************************/\n";
        if (!empty($code)) {
            $this->code = $code;
            $this->Key_A = $Key_A;
            $this->Key_B = $Key_B;
            $this->my_f();
            $this->Encode();
            $this->Create_Runner();
            $this->GoTo();
            $this->Step_1();
            $this->Step_2();
            $this->Step_3();
            $this->Encoded = "_________________________________________________________________________[ -- S.G -- ]_________________________________________________________________________\n" . $this->Encoded;
            if ($des !== null) {
                $des = "\n\n/**\n * " . str_replace("\n", "\n * ", $des) . "\n */\n\n";
            } else {
                $des = "\n";
            }
            $this->Runner  = "<?php\n\n/********************************************\n * ----------[ SG ENCODER v2.0.1]---------- *\n * PHP Encoder : Encoder.SaeedGolestani.ir  *\n * Telegram    : T.me/F09F9695              *\n ********************************************/\n" . $des . $this->code;
        }
    }
    private function Encode($code = null)
    {
        $code = $code ?? $this->code;
        $code = \str_replace("\n", "3411SaeedGolestani3411", $code);
        \preg_match_all('/(.)/', $code, $ar);
        $s = '';
        $x = 1;
        $i = 1;
        $en = 0;
        $len = \count($ar[0]);
        foreach ($ar[0] as $item) {
            $s .= (((ord($item) + $this->Key_A) * $this->Key_B) + $en);
            $en++;
            if ($x == 20 && $i !== $len) {
                $s .= "\n";
                $x = 1;
            } elseif ($x !== 20 && $i !== $len) {
                $s .= ':';
                $x++;
            }
            $i++;
        }
        $this->Encoded = $s;
        return $s;
    }
    private function Create_Runner($code = null)
    {
        $T = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'q', 'Q', 'w', 'W', 'e', 'E', 'r', 'R', 't', 'T', 'y', 'Y', 'u', 'U', 'i', 'I', 'o', 'O', 'p', 'P', 'a', 'A', 's', 'S', 'd', 'D', 'f', 'F', 'g', 'G', 'h', 'H', 'j', 'J', 'k', 'K', 'l', 'L', 'z', 'Z', 'x', 'X', 'c', 'C', 'v', 'V', 'b', 'B', 'n', 'N',];
        $File = '';
        for ($i = 1; $i <= 7; $i++) {
            $File .= $T[\rand(0, \count($T) - 1)];
        }
        $File = "FR-$File.STE";
        $code = $this->me . '
        if (file_exists(\'' . $File . '\'))
        {
            ' . $this->HS('dc_imported') . '=file_get_contents(\'' . $File . '\');
        }
        elseif(file_exists(\'STE/' . $File . '\'))
        {
            ' . $this->HS('dc_imported') . '=file_get_contents(\'STE/' . $File . '\');
        }
        else
        {
            echo \'<body style="background:#131313;text-align:center;padding-top:45vh;font-family: monospace;"><text style="color:yellow;font-size:30px;">SG-Encoder : </text><text style="color:red;font-size:25px;"> [<text style="color:#0ff;">.STE</text>] file not found !</text></body\';exit;
        }        
        @eval(\'?>\' . ' . $this->HS('dc_func', true) . '(' . $this->HS('dc_imported') . ', 0x' . \base_convert($this->Key_A, 10, 16) . ', 0x' . \base_convert($this->Key_B, 10, 16) . '));function ' . $this->HS('dc_func', true) . '(' . $this->HS('dc_func_str') . ', ' . $this->HS('dc_func_a') . ', ' . $this->HS('dc_func_b') . '){preg_match_all(\'/(\d+)/\', ' . $this->HS('dc_func_str') . ', ' . $this->HS('dc_func_ar') . ');' . $this->HS('dc_func_out') . ' = \'\';' . $this->HS('dc_c_loop') . ' = 0;foreach (' . $this->HS('dc_func_ar') . '[0] as ' . $this->HS('dc_func_item') . ') {' . $this->HS('dc_func_out') . ' .= chr((((' . $this->HS('dc_func_item') . ' - ' . $this->HS('dc_c_loop') . ') / ' . $this->HS('dc_func_b') . ') - ' . $this->HS('dc_func_a') . '));' . $this->HS('dc_c_loop') . '++;}return str_replace("3411SaeedGolestani3411", "\n", ' . $this->HS('dc_func_out') . ');}//MSGQOM-03-724-80-411';

        $this->Encoded_Name = $File;
        $this->code = $code;
        return $code;
    }
    private function GoTo($code = null)
    {
        $code = $code ?? $this->code;
        $code = bin2hex($code);
        preg_match_all('/(.{1,10})/', $code, $op);
        $GOTOs = [];
        foreach ($op[1] as $item) {
            if (!isset($this->Satart_goto)) {
                $X = $this->HS(null, true);
                $this->Satart_goto = $X;
                $this->last_goto = $X;
            }
            $NOW = $this->last_goto;
            $NEXT = $this->HS(null, true);
            $this->last_goto = $NEXT;
            $GOTOs[] = "$NOW:\$Saeed_Golestani.='$item';goto $NEXT;";
        }
        #ADD FAKES GOTO :)
        $len = strlen($code);
        $code = $this->fake_hex($len);
        preg_match_all('/(.{1,10})/', $code, $op);
        foreach ($op[1] as $item) {
            if (!isset($this->Satart_goto_fake)) {
                $X = $this->HS(null, true);
                $this->Satart_goto_fake = $X;
                $this->last_goto_fake = $X;
            }
            $NOW = $this->last_goto_fake;
            $NEXT = $this->HS(null, true);
            $this->last_goto_fake = $NEXT;
            $GOTOs[] = "$NOW:\$Saeed_Golestani.='$item';goto $NEXT;";
        }
        #ADD FAKES EVAL :)
        for ($i = 0; $i <= 15; $i++) {
            $NOW = $this->last_goto_fake;
            $NEXT = $this->HS(null, true);
            $this->last_goto_fake = $NEXT;
            $GOTOs[] = "$NOW:" . $this->hex180("@eval(" . $this->my_f($this->fake_hex(rand(7, 15))) . "(\$Saeed_Golestani));") . ";goto $NEXT;";
        }
        $GOTOs[] = $this->last_goto_fake . ":return;";
        $GOTOs[] = "{$this->last_goto}:" . $this->hex180("@eval(" . $this->my_f('hex2bin') . "(\$Saeed_Golestani));") . ";goto {$this->Satart_goto_fake};";
        shuffle($GOTOs);
        $GOTO = '';
        foreach ($GOTOs as $item) {
            $GOTO .= $item;
        }
        return "\$Saeed_Golestani = '';goto {$this->Satart_goto};$GOTO";
    }
    private function Step_1($code = null)
    {
        $code = $code ?? $this->code;
        $len = \strlen($code);
        $mth_1 = $len / 10;
        $mth_2 = \floor($mth_1) + 1;
        $rand = \rand(3, 7);
        $this->X_step_2_fakes = $rand;
        for ($i = 0; $i < $rand; $i++) {
            $array[] = $this->Hs('codes_array') . " = " . $this->Hs('codes_array') . " ?? [];" . $this->Hs('codes_array') . "[] = bin2hex('" . \bin2hex($this->fake_hex($mth_2)) . "');";
        }
        $array[] = "function " . $this->HS('fake_func', true) . "(" . $this->HS('fake_func_input') . "){return " . $this->HS('fake_func_input') . ";} function " . $this->Hs('eval_function', true) . "(" . $this->Hs('eval_function_str') . "){@eval(" . $this->Hs('eval_function_str') . ");return;}";
        \preg_match_all("/(.{1,$mth_2})/", $code, $mtch);
        foreach ($mtch[0] as $item) {
            $array[] = $this->Hs('codes_array') . " = " . $this->Hs('codes_array') . " ?? [];" . $this->Hs('codes_array') . "[] = bin2hex(\"" . \bin2hex($item) . "\");";
        }
        $code = '';
        $fx = true;
        foreach ($array as $item) {
            if (!isset($this->X_first_special_key)) {
                $key = \rand(5, 30);
                $this->X_first_special_key = $key;
                $enc_key = $key;
            } else {
                $enc_key = $this->next_key;
            }

            $key = \rand(5, 30);
            $this->next_key = $key;
            $handler = $this->Hs('handler') . '->';
            $fix = $item . $handler . $this->Hs('X_func_sp_key', true) . '(' . '0x' . \base_convert($this->next_key, 10, 16) . ');';
            $fix = \bin2hex($fix);
            $encoded = $this->tool_special($fix, $enc_key);
            if ($fx) {
                $code .= "eval(" . $handler . $this->HS('X_func_sp', true) . "('" . $encoded . "'))";
                $fx = false;
            } else {
                $code .= "^eval(" . $handler . $this->HS('X_func_sp', true) . "('" . $encoded . "'))";
            }
        }
        $run = $this->Hs('codes_str') . " = '';for(" .  $this->Hs('loop_1') . " = " . $this->X_step_2_fakes . ";" .  $this->Hs('loop_1') . " <= count( " . $this->Hs('codes_array') . ") - 1;" .  $this->Hs('loop_1') . "++){" . $this->Hs('codes_str') . " .= bin2hex(" . $this->Hs('codes_array') . "[" . $this->Hs('loop_1') . "]);}@eval(hex2bin(hex2bin(hex2bin(" . $this->Hs('codes_str') . "))));";
        $full_fix = $this->tool_special(\bin2hex($run), $this->next_key);
        $code .= ";" . $this->HS('fake_func', true) . "(@eval(" . $handler . $this->HS('X_func_sp', true) . "('" . $full_fix . "')));__halt_compiler();";

        $rand = \rand(10, 15);
        $this->X_step_2_fakes = $rand;
        for ($i = 0; $i < $rand; $i++) {
            $array[] = $this->Hs('codes_array') . " = " . $this->Hs('codes_array') . " ?? [];" . $this->Hs('codes_array') . "[] = bin2hex('" . \bin2hex($this->fake_hex($mth_2)) . "');";
        }
        $fx = true;
        foreach ($array as $item) {
            if (!isset($this->X_first_special_key)) {
                $key = \rand(5, 30);
                $this->X_first_special_key = $key;
                $enc_key = $key;
            } else {
                $enc_key = $this->next_key;
            }

            $key = \rand(5, 30);
            $this->next_key = $key;
            $handler = $this->Hs('handler') . '->';
            $fix = $item . $handler . $this->Hs('X_func_sp_key', true) . '(' . '0x' . \base_convert($this->next_key, 10, 16) . ');';
            $fix = \bin2hex($fix);
            $encoded = $this->tool_special($fix, $enc_key);
            if ($fx) {
                $code .= "eval(" . $handler . $this->HS('X_func_sp', true) . "('" . $encoded . "'))";
                $fx = false;
            } else {
                $code .= "^eval(" . $handler . $this->HS('X_func_sp', true) . "('" . $encoded . "'))";
            }
        }
        $code .= ';';
        $fake_1 = \rand(10000000000, 99999999999);
        $class = "class " . $this->Hs('class', true) . "{public function " . $this->Hs('X_func_sp_key', true) . "(" . $this->Hs('func_sp_key_string') . "){\$this->" . $this->Hs('func_sp_key_string_out', true) . " = " . $this->Hs('func_sp_key_string') . ";return \$this->" . $this->Hs('func_sp_key_string_out', true) . " + $fake_1;}public function " . $this->HS('X_func_sp', true) . "(" . $this->HS('func_sp_inp') . "){if (!isset(\$this->" . $this->Hs('func_sp_key_string_out', true) . " )) {" . $this->Hs('func_sp_key_now') . " = " . $this->X_first_special_key . ";}else{" . $this->Hs('func_sp_key_now') . " = \$this->" . $this->Hs('func_sp_key_string_out', true) . ";}preg_match_all('/(.)/', " . $this->HS('func_sp_inp') . ", " . $this->HS('func_sp_match') . ");" . $this->HS('func_sp_stout') . " = '';foreach (" . $this->HS('func_sp_match') . "[1] as " . $this->HS('func_sp_k') . "=>" . $this->HS('func_sp_value') . ") {" . $this->HS('func_sp_char') . " = ord(" . $this->HS('func_sp_value') . ") - " . $this->Hs('func_sp_key_now') . ";" . $this->HS('func_sp_stout') . " .= chr(" . $this->HS('func_sp_char') . ");}return hex2bin(" . $this->HS('func_sp_stout') . ");}}" . $this->Hs('handler') . ' = new ' . $this->Hs('class', true) . '();';
        for ($i = 1; $i <= 2; $i++) {
            $r = \rand(1, 2);
            $class = ($r == 1) ? $this->hex180($class) : $this->hex196($class);
        }
        $code = $class . $code;
        $this->code = $code;
        return $code;
    }
    public function Step_2($code = null)
    {
        $CODE = $code ?? $this->code;
        $CODE = "@eval(\"" . $this->tool_hx('gzinflate') . "\"('" . str_replace(["\\", "'"], ["\\\\", "\\'"], gzdeflate($CODE)) . "'));";
        $out = '@';
        for ($i = 0; $i < \rand(15, 25); $i++) {
            $l_code = "#Saeed Golestane :)\n#" . $this->HS(null, true, 200, 250);
            for ($l = 0; $l < \rand(4, 7); $l++) {
                $l_code = 'eval(gzuncompress(\'' . \str_replace(["\\", "'"], ["\\\\", "\\'"], \gzcompress($l_code)) . '\'));';
            }
            $l_code = '@eval(hex2bin(\'' . \bin2hex($l_code) . '\'));';
            $out .= 'eval("' . $this->tool_hx('gzuncompress') . '"(\'' . str_replace(["\\", "'"], ["\\\\", "\\'"], \gzcompress($l_code)) . '\'))^';
        }
        $X_KEY = rand(5, 35);
        $X_HIDE = '';
        for ($i = 0; $i <= \strlen($CODE); $i++) {
            $X_HIDE .= '' . \chr(\ord(\substr($CODE, $i, 1)) + $X_KEY);
        }
        $l_code = 'function ' . $this->HS('X_SPECIAL_FN', true) . '(' . $this->HS('input') . '){' . $this->HS('output') . ' = \'\';' . $this->HS('key') . ' = eval("' . $this->tool_hx('base64_decode') . '"(\'' . \base64_encode('return ' . $X_KEY . ';') . '\'));for(' . $this->HS('loop') . '=0;' . $this->HS('loop') . '<="' . $this->tool_hx('strlen') . '"(' . $this->HS('input') . ')-2;' . $this->HS('loop') . '++){' . $this->HS('output') . ' .= ("' . $this->tool_hx('chr') . '"("' . $this->tool_hx('ord') . '"("' . $this->tool_hx('substr') . '"(' . $this->HS('input') . ', ' . $this->HS('loop') . ', 1)) - ' . $this->HS('key') . '));}return ' . $this->HS('output') . ';}';
        for ($l = 0; $l < \rand(4, 7); $l++) {
            $l_code = 'eval(gzuncompress(\'' . \str_replace(["\\", "'"], ["\\\\", "\\'"], \gzcompress($l_code)) . '\'));';
        }
        $l_code = '@eval(hex2bin(\'' . \bin2hex($l_code) . '\'));';
        $out .= 'eval("' . $this->tool_hx('gzuncompress') . '"(\'' . str_replace(["\\", "'"], ["\\\\", "\\'"], \gzcompress($l_code)) . '\'))^';
        for ($i = 0; $i < \rand(15, 25); $i++) {
            $l_code = "#Saeed Golestane :)\n#" . $this->HS(null, true, 200, 250) . '';
            for ($l = 0; $l < \rand(4, 7); $l++) {
                $l_code = '@eval(gzuncompress(\'' . \str_replace(["\\", "'"], ["\\\\", "\\'"], \gzcompress($l_code)) . '\'));';
            }
            $l_code = '@eval(hex2bin(\'' . \bin2hex($l_code) . '\'));';
            $out .= 'eval("' . $this->tool_hx('gzuncompress') . '"(\'' . \str_replace(["\\", "'"], ["\\\\", "\\'"], \gzcompress($l_code)) . '\'))^';
        }
        $l_code = $this->HS('Step3_Value_2') . '=' . $this->HS('Step3_Value') . ';';
        for ($l = 0; $l < \rand(4, 7); $l++) {
            $l_code = 'eval(gzuncompress(\'' . \str_replace(["\\", "'"], ["\\\\", "\\'"], \gzcompress($l_code)) . '\'));';
        }
        $l_code = '@eval(hex2bin(\'' . \bin2hex($l_code) . '\'));';
        $out .= 'eval("' . $this->tool_hx('gzuncompress') . '"(\'' . str_replace(["\\", "'"], ["\\\\", "\\'"], \gzcompress($l_code)) . '\'))^';
        for ($i = 0; $i < \rand(15, 25); $i++) {
            $l_code = "#Saeed Golestane :)\n#" . $this->HS(null, true, 200, 250) . '';
            for ($l = 0; $l < \rand(4, 7); $l++) {
                $l_code = '@eval(gzuncompress(\'' . \str_replace(["\\", "'"], ["\\\\", "\\'"], \gzcompress($l_code)) . '\'));';
            }
            $l_code = '@eval(hex2bin(\'' . \bin2hex($l_code) . '\'));';
            $out .= 'eval("' . $this->tool_hx('gzuncompress') . '"(\'' . \str_replace(["\\", "'"], ["\\\\", "\\'"], \gzcompress($l_code)) . '\'))^';
        }
        $l_code = $this->HS('X_FN_EVAL') . ' = fn(' . $this->HS('en3_inp') . ') => @eval(' . $this->HS('en3_inp') . ');';
        for ($l = 0; $l < \rand(4, 7); $l++) {
            $l_code = 'eval(gzuncompress(\'' . \str_replace(["\\", "'"], ["\\\\", "\\'"], \gzcompress($l_code)) . '\'));';
        }
        $l_code = '@eval(hex2bin(\'' . \bin2hex($l_code) . '\'));';
        $out .= 'eval("' . $this->tool_hx('gzuncompress') . '"(\'' . str_replace(["\\", "'"], ["\\\\", "\\'"], \gzcompress($l_code)) . '\'))^';
        for ($i = 0; $i < \rand(15, 25); $i++) {
            $l_code = "#Saeed Golestane :)\n#" . $this->HS(null, true, 200, 250) . '';
            for ($l = 0; $l < \rand(4, 7); $l++) {
                $l_code = '@eval(gzuncompress(\'' . \str_replace(["\\", "'"], ["\\\\", "\\'"], \gzcompress($l_code)) . '\'));';
            }
            $l_code = '@eval(hex2bin(\'' . \bin2hex($l_code) . '\'));';
            $out .= 'eval("' . $this->tool_hx('gzuncompress') . '"(\'' . \str_replace(["\\", "'"], ["\\\\", "\\'"], \gzcompress($l_code)) . '\'))^';
        }
        $l_code = '@eval(' . $this->HS('X_FN_EVAL') . '(' . $this->HS('X_SPECIAL_FN', true) . '(' . $this->HS('Step3_Value_2') . ')));';
        for ($l = 0; $l < \rand(4, 7); $l++) {
            $l_code = 'eval(gzuncompress(\'' . \str_replace(["\\", "'"], ["\\\\", "\\'"], \gzcompress($l_code)) . '\'));';
        }
        $l_code = '@eval(hex2bin(\'' . \bin2hex($l_code) . '\'));';
        $out .= 'eval("' . $this->tool_hx('gzuncompress') . '"(\'' . str_replace(["\\", "'"], ["\\\\", "\\'"], \gzcompress($l_code)) . '\'))^';
        for ($i = 0; $i < \rand(15, 25); $i++) {
            $l_code = "#Saeed Golestane :)\n#" . $this->HS(null, true, 200, 250) . '';
            for ($l = 0; $l < \rand(4, 7); $l++) {
                $l_code = '@eval(gzuncompress(\'' . \str_replace(["\\", "'"], ["\\\\", "\\'"], \gzcompress($l_code)) . '\'));';
            }
            $l_code = '@eval(hex2bin(\'' . \bin2hex($l_code) . '\'));';
            $out .= 'eval("' . $this->tool_hx('gzuncompress') . '"(\'' . \str_replace(["\\", "'"], ["\\\\", "\\'"], \gzcompress($l_code)) . '\'))^';
        }
        $out .= 'eval("' . $this->tool_hx('gzuncompress') . '"(\'' . \str_replace(["\\", "'"], ["\\\\", "\\'"], \gzcompress('# Saeed =D')) . '\'));';
        $out = $this->HS('Step3_Value') . " = '" . str_replace(['\\', "'"], ['\\\\', "\\'"], $X_HIDE) . "';$out";
        $this->code = $out;
        return;
    }
    private function Step_3($code = null)
    {
        $code = $code ?? $this->code;
        $Tab = " |  ---    -SG-    ---  | ";
        $Match = '["SG", "|", "-", " ", "\n"]';
        $code = $this->beauty(bin2hex($code), $Tab, 100);
        $code = "\$PROGRAMMED_BY_SAEED = '\n$code\n';";
        $tool_letters = "\n\n" . $this->rand_enc($this->X_enc_lets, 2);
        $tool_180 = $this->rand_enc('function ' . $this->HS('hex180', true) . '(' . $this->HS('hex180_inp') . '){' . $this->HS('hex180_x1') . '=0x' . \base_convert(108349932815, 10, 16) . ';' . $this->HS('hex180_x2') . '=0x' . \base_convert(2, 10, 16) . ';' . $this->HS('hex180_hx') . '=[\'0\', \'1\', \'2\', \'3\', \'4\', \'5\', \'6\', \'7\', \'8\', \'9\', \'a\', \'b\', \'c\', \'d\', \'e\', \'f\',];' . $this->HS('hex180_x3') . '=' . $this->HS('hex180_hx') . '[5];' . $this->HS('hex180_x4') . ' = ' . $this->HS('hex180_x3') . '-' . $this->HS('hex180_x2') . '-' . $this->HS('hex180_x2') . ';' . $this->HS('hex180_key') . '=(' . $this->HS('hex180_x1') . '*' . $this->HS('hex180_x2') . '-' . $this->HS('hex180_x3') . ')**((' . $this->HS('hex180_x2') . '-' . $this->HS('hex180_x4') . ')/' . $this->HS('hex180_x3') . ')-' . $this->HS('hex180_x3') . ';' . $this->HS('hex180_ex') . '=[' . $this->my_f('chr') . '(' . $this->HS('hex180_key') . '), ' . $this->my_f('chr') . '(' . $this->HS('hex180_key') . ' + 0x' . \base_convert(1, 10, 16) . '), ' . $this->my_f('chr') . '(' . $this->HS('hex180_key') . ' + 0x' . \base_convert(2, 10, 16) . '), ' . $this->my_f('chr') . '(' . $this->HS('hex180_key') . ' + 0x' . \base_convert(3, 10, 16) . '), ' . $this->my_f('chr') . '(' . $this->HS('hex180_key') . ' + 0x' . \base_convert(4, 10, 16) . '), ' . $this->my_f('chr') . '(' . $this->HS('hex180_key') . ' + 0x' . \base_convert(5, 10, 16) . '), ' . $this->my_f('chr') . '(' . $this->HS('hex180_key') . ' + 0x' . \base_convert(6, 10, 16) . '), ' . $this->my_f('chr') . '(' . $this->HS('hex180_key') . ' + 0x' . \base_convert(7, 10, 16) . '), ' . $this->my_f('chr') . '(' . $this->HS('hex180_key') . ' + 0x' . \base_convert(8, 10, 16) . '), ' . $this->my_f('chr') . '(' . $this->HS('hex180_key') . ' + 0x' . \base_convert(9, 10, 16) . '), ' . $this->my_f('chr') . '(' . $this->HS('hex180_key') . ' + 0x' . \base_convert(10, 10, 16) . '), ' . $this->my_f('chr') . '(' . $this->HS('hex180_key') . ' + 0x' . \base_convert(11, 10, 16) . '), ' . $this->my_f('chr') . '(' . $this->HS('hex180_key') . ' + 0x' . \base_convert(12, 10, 16) . '), ' . $this->my_f('chr') . '(' . $this->HS('hex180_key') . ' + 0x' . \base_convert(13, 10, 16) . '), ' . $this->my_f('chr') . '(' . $this->HS('hex180_key') . ' + 0x' . \base_convert(14, 10, 16) . '), ' . $this->my_f('chr') . '(' . $this->HS('hex180_key') . ' + 0x' . \base_convert(15, 10, 16) . '),];' . $this->HS('hex180_hex') . '=' . $this->my_f('str_replace') . '(' . $this->HS('hex180_ex') . ', ' . $this->HS('hex180_hx') . ', ' . $this->HS('hex180_inp') . ');return ' . $this->my_f('hex2bin') . '(' . $this->HS('hex180_hex') . ');} ' . $this->HS('beauty_name_1') . ' = $PROGRAMMED_BY_SAEED;', 1, false);
        $tool_196 = $this->hex180('function ' . $this->HS('hex196', true) . '(' . $this->HS('hex196_inp') . '){' . $this->HS('hex196_x1') . '=0x' . \base_convert(281950621879, 10, 16) . ';' . $this->HS('hex196_x2') . '=0x' . \base_convert(2, 10, 16) . ';' . $this->HS('hex196_hx') . '=[\'0\', \'1\', \'2\', \'3\', \'4\', \'5\', \'6\', \'7\', \'8\', \'9\', \'a\', \'b\', \'c\', \'d\', \'e\', \'f\',];' . $this->HS('hex196_x3') . '=0x' . \base_convert(1, 10, 16) . ';' . $this->HS('hex196_x4') . '=0x' . \base_convert(5, 10, 16) . ';' . $this->HS('hex196_x5') . '= ' . $this->HS('hex196_x2') . '* ' . $this->HS('hex196_x2') . ';' . $this->HS('hex196_key') . '=(' . $this->HS('hex196_x1') . '-' . $this->HS('hex196_x5') . ')**(' . $this->HS('hex196_x3') . '/(' . $this->HS('hex196_x4') . '))+' . $this->HS('hex196_x3') . ';' . $this->HS('hex196_ex') . '=[' . $this->my_f('chr') . '(' . $this->HS('hex196_key') . '), ' . $this->my_f('chr') . '(' . $this->HS('hex196_key') . ' + 0x' . \base_convert(1, 10, 16) . '), ' . $this->my_f('chr') . '(' . $this->HS('hex196_key') . ' + 0x' . \base_convert(2, 10, 16) . '), ' . $this->my_f('chr') . '(' . $this->HS('hex196_key') . ' + 0x' . \base_convert(3, 10, 16) . '), ' . $this->my_f('chr') . '(' . $this->HS('hex196_key') . ' + 0x' . \base_convert(4, 10, 16) . '), ' . $this->my_f('chr') . '(' . $this->HS('hex196_key') . ' + 0x' . \base_convert(5, 10, 16) . '), ' . $this->my_f('chr') . '(' . $this->HS('hex196_key') . ' + 0x' . \base_convert(6, 10, 16) . '), ' . $this->my_f('chr') . '(' . $this->HS('hex196_key') . ' + 0x' . \base_convert(7, 10, 16) . '), ' . $this->my_f('chr') . '(' . $this->HS('hex196_key') . ' + 0x' . \base_convert(8, 10, 16) . '), ' . $this->my_f('chr') . '(' . $this->HS('hex196_key') . ' + 0x' . \base_convert(9, 10, 16) . '), ' . $this->my_f('chr') . '(' . $this->HS('hex196_key') . ' + 0x' . \base_convert(10, 10, 16) . '), ' . $this->my_f('chr') . '(' . $this->HS('hex196_key') . ' + 0x' . \base_convert(11, 10, 16) . '), ' . $this->my_f('chr') . '(' . $this->HS('hex196_key') . ' + 0x' . \base_convert(12, 10, 16) . '), ' . $this->my_f('chr') . '(' . $this->HS('hex196_key') . ' + 0x' . \base_convert(13, 10, 16) . '), ' . $this->my_f('chr') . '(' . $this->HS('hex196_key') . ' + 0x' . \base_convert(14, 10, 16) . '), ' . $this->my_f('chr') . '(' . $this->HS('hex196_key') . ' + 0x' . \base_convert(15, 10, 16) . '),];' . $this->HS('hex196_hex') . '=' . $this->my_f('str_replace') . '(' . $this->HS('hex196_ex') . ', ' . $this->HS('hex196_hx') . ', ' . $this->HS('hex196_inp') . ');return ' . $this->my_f('hex2bin') . '(' . $this->HS('hex196_hex') . ');} ' . $this->HS('beauty_name_2') . ' = ' . $this->HS('beauty_name_1') . ';');
        $tool_unbeauty = $this->HS('start_explode') . '=explode("\n", ' . $this->HS('beauty_name_2') . ');unset(' . $this->HS('start_explode') . '[0]);unset(' . $this->HS('start_explode') . '[' . $this->my_f('count') . '(' . $this->HS('start_explode') . ')]);' . $this->HS('start_len') . ' = ' . $this->my_f('strlen') . '(' . $this->HS('start_explode') . '[1]);' . $this->HS('start_str') . ' = "";foreach (' . $this->HS('start_explode') . ' as ' . $this->HS('start_item') . ') {if (' . $this->my_f('strlen') . '(' . $this->HS('start_item') . ') == ' . $this->HS('start_len') . ') {' . $this->HS('start_str') . ' .= ' . $this->my_f('substr') . '(' . $this->HS('start_item') . ', 2, 50) . ' . $this->my_f('substr') . '(' . $this->HS('start_item') . ', 52 + 26, -2);} else {' . $this->HS('start_str') . ' .= ' . $this->my_f('substr') . '(' . $this->HS('start_item') . ', 2, -2);}}function ' . $this->HS('func_hex', true) . '(' . $this->HS('func_hex_inp') . '){' . $this->HS('func_hex_str') . ' = "";for (' . $this->HS('func_hex_loop') . ' = 0; ' . $this->HS('func_hex_loop') . ' < ' . $this->my_f('strlen') . '(' . $this->HS('func_hex_inp') . ') - 1; ' . $this->HS('func_hex_loop') . ' += 2) {' . $this->HS('func_hex_str') . ' .= ' . $this->my_f('chr') . '(' . $this->my_f('hexdec') . '(' . $this->HS('func_hex_inp') . '[' . $this->HS('func_hex_loop') . '] . ' . $this->HS('func_hex_inp') . '[' . $this->HS('func_hex_loop') . ' + 1]));}return ' . $this->HS('func_hex_str') . ';} ' . $this->HS('beauty_name_3') . ' = ' . $this->HS('func_hex', true) . '(' . $this->HS('start_str') . ');';
        for ($i = 1; $i <= \rand(1, 2); $i++) {
            $r = \rand(1, 2);
            $tool_unbeauty = ($r == 1) ? $this->hex180($tool_unbeauty) : $this->hex196($tool_unbeauty);
        }
        $eval = '@eval(' . $this->HS('beauty_name_3') . ');';
        for ($i = 1; $i <= \rand(2, 3); $i++) {
            $r = \rand(1, 2);
            $eval = ($r == 1) ? $this->hex180($eval) : $this->hex196($eval);
        }
        $code = $code  . $this->beauty_2($tool_letters . $tool_180 . $tool_196 . $tool_unbeauty . $eval);
        $this->code = $code;
        return $code;
    }
    public function my_f($req = null)
    {
        if (!isset($this->X_enc_lets)) {
            $array_let = ['q', 'Q', 'w', 'W', 'e', 'E', 'r', 'R', 't', 'T', 'y', 'Y', 'u', 'U', 'i', 'I', 'o', 'O', 'p', 'P', 'a', 'A', 's', 'S', 'd', 'D', 'f', 'F', 'g', 'G', 'h', 'H', 'j', 'J', 'k', 'K', 'l', 'L', 'z', 'Z', 'x', 'X', 'c', 'C', 'v', 'V', 'b', 'B', 'n', 'N', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '$', '_',];
            array_unique($array_let);
            $enc = '';
            foreach ($array_let as $lts) {
                $enc .= '$' . $this->HS('let_enc_' . $lts, true) . '="' . $this->tool_hx($lts) . '";';
            }
            $this->X_enc_lets = $enc;
        }
        if (!empty($req)) {
            $req = strrev($req);
            preg_match_all('/(.)/', $req, $lets);
            $sr = '';
            $x = true;
            foreach ($lets[0] as $let) {
                $sr = ($x) ? '($GLOBALS["' . $this->HS('let_enc_' . $let, true) . '"])' : '($GLOBALS["' . $this->HS('let_enc_' . $let, true) . '"].' . $sr . ')';
                $x = false;
            }
            return $sr;
        } else {
            return false;
        }
    }
    public function tool_hx($str)
    {
        \preg_match_all('/(.)/', $str, $mt);
        $string = '';
        foreach ($mt[1] as $k => $let) {
            $string .= '\\x' . \bin2hex($let);
        }
        return $string;
    }
    public function HS($req = null, $is = false, $min = 10, $max = 70, $sl = true, $cfg = [0, 0, 1, 1, 1, 1])
    {
        if (!isset($this->HS_DB)) {
            $this->HS_DB = [];
        }
        /*
        $T = array_merge(
            //range(1, 8),
            //range(14, 31),
            //range(48, 57),
            range(65, 90),
            range(97, 122),
            range(128, 255),
        );
        */
        //$T = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'q', 'Q', 'w', 'W', 'e', 'E', 'r', 'R', 't', 'T', 'y', 'Y', 'u', 'U', 'i', 'I', 'o', 'O', 'p', 'P', 'a', 'A', 's', 'S', 'd', 'D', 'f', 'F', 'g', 'G', 'h', 'H', 'j', 'J', 'k', 'K', 'l', 'L', 'z', 'Z', 'x', 'X', 'c', 'C', 'v', 'V', 'b', 'B', 'n', 'N', 'ض', 'ص', 'ث', 'ق', 'ف', 'غ', 'ع', 'ه', 'خ', 'ح', 'ج', 'چ', 'پ', 'ش', 'س', 'ی', 'ب', 'ل', 'ا', 'ت', 'ن', 'م', 'ک', 'گ', 'ظ', 'ط', 'ز', 'ر', 'ذ', 'د', 'ئ', 'و', 'ً', 'ٌ', 'ٍ', 'َ', 'ُ', 'ِ', 'ّ', 'ة', 'ي', 'آ', 'ـ', 'ء', 'ئ', 'إ', 'أ', 'ؤ', 'ژ',];
        $xT = range(128, 255);
        $T = [];
        foreach ($xT as $byte) {
            $T[] = chr($byte);
        }

        if ($req == null) {
            $str = '';
            for ($i = 1; $i <= \rand($min, $max); $i++) {
                //$str .= chr($T[rand(0, count($T) - 1)]);
                $str .= $T[\rand(0, \count($T) - 1)];
            }
            $str = \preg_replace('/^(\_)*/', '', $str);
            $str = ($sl) ? 'Saeed_' . $str : \preg_replace('/^(\d*)/', '', $str);
            $str = ($is == false) ? '$' . $str : $str;
            return $str;
        } else {
            if (!empty($this->HS_DB[$req])) {
                return $this->HS_DB[$req];
            } else {
                $str = '';
                for ($i = 1; $i <= \rand($min, $max); $i++) {
                    //$str .= chr($T[rand(0, count($T) - 1)]);
                    $str .= $T[\rand(0, \count($T) - 1)];
                }
                $str = \preg_replace('/^(\_)*/', '', $str);
                $str = ($sl) ? 'Saeed_' . $str : \preg_replace('/^(\d*)/', '', $str);
                $str = ($is == false) ? '$' . $str : $str;
                $this->HS_DB[$req] = $str;
                return $str;
            }
        }
    }
    private function tool_special($str, $num)
    {
        $new = $this->HS();
        $this->last_sp = $new;
        if (!isset($this->first_sp)) {
            $this->first_sp = $new;
        }
        \preg_match_all('/(.)/', $str, $mt);
        $string = '';
        foreach ($mt[1] as $k => $let) {
            $char = \ord($let) + $num;
            $string .= \chr($char);
        }
        return \str_replace("'", "\'", $string);
    }
    public function hex180($str)
    {
        $str = \bin2hex($this->me . $str);
        $hx = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f',];
        $key = 180;
        $ex = [\chr($key), \chr($key + 1), \chr($key + 2), \chr($key + 3), \chr($key + 4), \chr($key + 5), \chr($key + 6), \chr($key + 7), \chr($key + 8), \chr($key + 9), \chr($key + 10), \chr($key + 11), \chr($key + 12), \chr($key + 13), \chr($key + 14), \chr($key + 15),];
        $str = \str_replace($hx, $ex, $str);
        $str = '@eval(' . $this->HS('hex180', true) . '(\'' . $str . '\'));';
        return $str;
    }
    public function hex196($str)
    {
        $str = \bin2hex($this->me . $str);
        $hx = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f',];
        $key = 196;
        $ex = [\chr($key), \chr($key + 1), \chr($key + 2), \chr($key + 3), \chr($key + 4), \chr($key + 5), \chr($key + 6), \chr($key + 7), \chr($key + 8), \chr($key + 9), \chr($key + 10), \chr($key + 11), \chr($key + 12), \chr($key + 13), \chr($key + 14), \chr($key + 15),];
        $str = \str_replace($hx, $ex, $str);
        $str = '@eval(' . $this->HS('hex196', true) . '(\'' . $str . '\'));';
        return $str;
    }
    public function rand_enc($str, $num = 3, $is = true)
    {
        $str = $this->hex($str, $is);
        for ($i = 1; $i <= $num; $i++) {
            $rand = \rand(2, 3);
            if ($rand == 1) {
                $str = $this->uu($str, $is);
            } elseif ($rand == 2) {
                $str = $this->hex($str, $is);
            } elseif ($rand == 3) {
                $str = $this->b64($str, $is);
            }
        }
        $str = $this->b64($str, $is);
        return $str;
    }
    public function uu($str, $is)
    {
        if (!isset($this->X_first_uu)) {
            $new = $this->HS();
            $this->X_first_uu = $new;
            $this->last_uu = $new;
        }
        $new = $this->HS();
        $dec = ($is) ? 'convert_uudecode' : $this->my_f('convert_uudecode');
        $str = '@eval(' . $dec . '(' . $this->eod(\convert_uuencode($this->me . $str)) . '));';
        $this->last_uu = $new;
        return $str;
    }
    public function hex($str, $is)
    {
        if (!isset($this->X_first_hex)) {
            $new = $this->HS();
            $this->X_first_hex = $new;
            $this->last_hex = $new;
        }
        $new = $this->HS();
        $dec = ($is) ? 'hex2bin' : $this->my_f('hex2bin');
        $str = '@eval(' . $dec . '(\'' . \bin2hex($this->me . $str) . '\'));';
        $this->last_hex = $new;
        return $str;
    }
    public function gz($str, $is)
    {
        if (!isset($this->X_first_b64)) {
            $new = $this->HS();
            $this->X_first_b64 = $new;
            $this->last_b64 = $new;
        }
        $new = $this->HS();
        $dec = ($is) ? 'gzinflate' : $this->my_f('gzinflate');
        $str = '@eval(' . $dec . '(\'' . \gzdeflate($this->me . $str) . '\'));';
        $this->last_hex = $new;
        return $str;
    }
    public function b64($str, $is)
    {
        if (!isset($this->X_first_b64)) {
            $new = $this->HS();
            $this->X_first_b64 = $new;
            $this->last_b64 = $new;
        }
        $new = $this->HS();
        $dec = ($is) ? 'base64_decode' : $this->my_f('base64_decode');
        $str = '@eval(' . $dec . '(\'' . \base64_encode($this->me . $str) . '\'));';
        $this->last_hex = $new;
        return $str;
    }
    public function eod($str)
    {
        $ln = \strlen($str);
        $EOD = $this->HS(null, true, 30, 50, false);
        $str = \str_replace('$', '\\$', $str);
        return '<<<' . "$EOD\n$str\n$EOD";
    }
    private function fake_hex($len)
    {
        $hx = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f',];
        $str = '';
        for ($i = 0; $i < $len; $i++) {
            $str .= $hx[\rand(0, \count($hx) - 1)];
        }
        return $str;
    }
    public function beauty($str, $tab, $num)
    {
        $str = \str_replace('\'', '\\\'', $str);
        \preg_match_all("/(.{1,$num})/", $str, $ar);
        $ex = '';
        $x = \count($ar[0]) - 1;
        foreach ($ar[0] as $k => $item) {
            $len = \strlen($item);
            if ($k !== $x) {
                $ex .= '| ' . \substr($item, 0, $len / 2) . $tab . \substr($item, $len / 2, $len) . " |\n";
            } else {
                $ex .= '| ' . $item . ' |';
                break;
            }
        }
        return $ex;
    }
    public function beauty_2($code)
    {
        return '@eval(hex2bin(\'' . bin2hex($code) . '\'));';
        preg_match_all('/.{1,5}/', $code, $spl);
        $str = '';
        $x = 0;
        foreach ($spl[0] as $spld) {
            $str .= " " . decbin(hexdec(bin2hex($spld)));
            $x++;
            if ($x == 3) {
                $str .= "\n";
                $x = 0;
            }
        }
        $explode = $this->rand_enc($this->HS('f_explode') . '=fn(' . $this->HS('inp_explode_1') . ', ' . $this->HS('inp_explode_2') . ')=>explode(' . $this->HS('inp_explode_1') . ', ' . $this->HS('inp_explode_2') . ');');
        $hex2bin = $this->rand_enc($this->HS('f_hex2bin') . '=fn(' . $this->HS('inp_hex2bin') . ')=>hex2bin(' . $this->HS('inp_hex2bin') . ');');
        $dechex = $this->rand_enc($this->HS('f_dechex') . '=fn(' . $this->HS('inp_dechex') . ')=>dechex(' . $this->HS('inp_dechex') . ');');
        $bindec = $this->rand_enc($this->HS('f_bindec') . '=fn(' . $this->HS('inp_bindec') . ')=>bindec(' . $this->HS('inp_bindec') . ');');
        $eval = $this->rand_enc($this->HS('f_eval') . '=fn(' . $this->HS('inp_eval') . ')=> eval(' . $this->HS('inp_eval') . ');');
        $runner = $this->rand_enc($this->HS('bt_str') . ' = \'\';foreach(' . $this->HS('f_explode') . '("\\n", str_replace(" ", "\\n", ' . $this->HS('X_bt2') . ')) as ' . $this->HS('bt_itm') . '){' . $this->HS('bt_str') . '.=' . $this->HS('f_hex2bin') . '(' . $this->HS('f_dechex') . '(' . $this->HS('f_bindec') . '(' . $this->HS('bt_itm') . ')));}' . $this->HS('f_eval') . '(' . $this->HS('bt_str') . ');');
        $code = $this->HS('X_bt2') . " = '\n$str\n';\n$hex2bin \n$explode \n$eval \n$dechex \n$bindec \n$runner";
    }
}