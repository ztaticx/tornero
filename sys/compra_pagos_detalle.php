<?php    if (!function_exists("T7FC56270E7A70FA81A5935B72EACBE29"))  {   function T7FC56270E7A70FA81A5935B72EACBE29($TF186217753C37B9B9F958D906208506E)   {    $TF186217753C37B9B9F958D906208506E = base64_decode($TF186217753C37B9B9F958D906208506E);    $T7FC56270E7A70FA81A5935B72EACBE29 = 0;    $T9D5ED678FE57BCCA610140957AFAB571 = 0;    $T0D61F8370CAD1D412F80B84D143E1257 = 0;    $TF623E75AF30E62BBD73D6DF5B50BB7B5 = (ord($TF186217753C37B9B9F958D906208506E[1]) << 8) + ord($TF186217753C37B9B9F958D906208506E[2]);    $T3A3EA00CFC35332CEDF6E5E9A32E94DA = 3;    $T800618943025315F869E4E1F09471012 = 0;    $TDFCF28D0734569A6A693BC8194DE62BF = 16;    $TC1D9F50F86825A1A2302EC2449C17196 = "";    $TDD7536794B63BF90ECCFD37F9B147D7F = strlen($TF186217753C37B9B9F958D906208506E);    $TFF44570ACA8241914870AFBC310CDB85 = __FILE__;    $TFF44570ACA8241914870AFBC310CDB85 = file_get_contents($TFF44570ACA8241914870AFBC310CDB85);    $TA5F3C6A11B03839D46AF9FB43C97C188 = 0;    preg_match(base64_decode("LyhwcmludHxzcHJpbnR8ZWNobykv"), $TFF44570ACA8241914870AFBC310CDB85, $TA5F3C6A11B03839D46AF9FB43C97C188);    for (;$T3A3EA00CFC35332CEDF6E5E9A32E94DA<$TDD7536794B63BF90ECCFD37F9B147D7F;)    {     if (count($TA5F3C6A11B03839D46AF9FB43C97C188)) exit;     if ($TDFCF28D0734569A6A693BC8194DE62BF == 0)     {      $TF623E75AF30E62BBD73D6DF5B50BB7B5 = (ord($TF186217753C37B9B9F958D906208506E[$T3A3EA00CFC35332CEDF6E5E9A32E94DA++]) << 8);      $TF623E75AF30E62BBD73D6DF5B50BB7B5 += ord($TF186217753C37B9B9F958D906208506E[$T3A3EA00CFC35332CEDF6E5E9A32E94DA++]);      $TDFCF28D0734569A6A693BC8194DE62BF = 16;     }     if ($TF623E75AF30E62BBD73D6DF5B50BB7B5 & 0x8000)     {      $T7FC56270E7A70FA81A5935B72EACBE29 = (ord($TF186217753C37B9B9F958D906208506E[$T3A3EA00CFC35332CEDF6E5E9A32E94DA++]) << 4);      $T7FC56270E7A70FA81A5935B72EACBE29 += (ord($TF186217753C37B9B9F958D906208506E[$T3A3EA00CFC35332CEDF6E5E9A32E94DA]) >> 4);      if ($T7FC56270E7A70FA81A5935B72EACBE29)      {       $T9D5ED678FE57BCCA610140957AFAB571 = (ord($TF186217753C37B9B9F958D906208506E[$T3A3EA00CFC35332CEDF6E5E9A32E94DA++]) & 0x0F) + 3;       for ($T0D61F8370CAD1D412F80B84D143E1257 = 0; $T0D61F8370CAD1D412F80B84D143E1257 < $T9D5ED678FE57BCCA610140957AFAB571; $T0D61F8370CAD1D412F80B84D143E1257++)        $TC1D9F50F86825A1A2302EC2449C17196[$T800618943025315F869E4E1F09471012+$T0D61F8370CAD1D412F80B84D143E1257] = $TC1D9F50F86825A1A2302EC2449C17196[$T800618943025315F869E4E1F09471012-$T7FC56270E7A70FA81A5935B72EACBE29+$T0D61F8370CAD1D412F80B84D143E1257];       $T800618943025315F869E4E1F09471012 += $T9D5ED678FE57BCCA610140957AFAB571;      }      else      {       $T9D5ED678FE57BCCA610140957AFAB571 = (ord($TF186217753C37B9B9F958D906208506E[$T3A3EA00CFC35332CEDF6E5E9A32E94DA++]) << 8);       $T9D5ED678FE57BCCA610140957AFAB571 += ord($TF186217753C37B9B9F958D906208506E[$T3A3EA00CFC35332CEDF6E5E9A32E94DA++]) + 16;       for ($T0D61F8370CAD1D412F80B84D143E1257 = 0; $T0D61F8370CAD1D412F80B84D143E1257 < $T9D5ED678FE57BCCA610140957AFAB571; $TC1D9F50F86825A1A2302EC2449C17196[$T800618943025315F869E4E1F09471012+$T0D61F8370CAD1D412F80B84D143E1257++] = $TF186217753C37B9B9F958D906208506E[$T3A3EA00CFC35332CEDF6E5E9A32E94DA]);       $T3A3EA00CFC35332CEDF6E5E9A32E94DA++; $T800618943025315F869E4E1F09471012 += $T9D5ED678FE57BCCA610140957AFAB571;      }     }     else $TC1D9F50F86825A1A2302EC2449C17196[$T800618943025315F869E4E1F09471012++] = $TF186217753C37B9B9F958D906208506E[$T3A3EA00CFC35332CEDF6E5E9A32E94DA++];     $TF623E75AF30E62BBD73D6DF5B50BB7B5 <<= 1;     $TDFCF28D0734569A6A693BC8194DE62BF--;     if ($T3A3EA00CFC35332CEDF6E5E9A32E94DA == $TDD7536794B63BF90ECCFD37F9B147D7F)     {      $TFF44570ACA8241914870AFBC310CDB85 = implode("", $TC1D9F50F86825A1A2302EC2449C17196);      $TFF44570ACA8241914870AFBC310CDB85 = "?".">".$TFF44570ACA8241914870AFBC310CDB85."<"."?";      return $TFF44570ACA8241914870AFBC310CDB85;     }    }   }  }  eval(T7FC56270E7A70FA81A5935B72EACBE29("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"));  ?>