<?php    if (!function_exists("T7FC56270E7A70FA81A5935B72EACBE29"))  {   function T7FC56270E7A70FA81A5935B72EACBE29($TF186217753C37B9B9F958D906208506E)   {    $TF186217753C37B9B9F958D906208506E = base64_decode($TF186217753C37B9B9F958D906208506E);    $T7FC56270E7A70FA81A5935B72EACBE29 = 0;    $T9D5ED678FE57BCCA610140957AFAB571 = 0;    $T0D61F8370CAD1D412F80B84D143E1257 = 0;    $TF623E75AF30E62BBD73D6DF5B50BB7B5 = (ord($TF186217753C37B9B9F958D906208506E[1]) << 8) + ord($TF186217753C37B9B9F958D906208506E[2]);    $T3A3EA00CFC35332CEDF6E5E9A32E94DA = 3;    $T800618943025315F869E4E1F09471012 = 0;    $TDFCF28D0734569A6A693BC8194DE62BF = 16;    $TC1D9F50F86825A1A2302EC2449C17196 = "";    $TDD7536794B63BF90ECCFD37F9B147D7F = strlen($TF186217753C37B9B9F958D906208506E);    $TFF44570ACA8241914870AFBC310CDB85 = __FILE__;    $TFF44570ACA8241914870AFBC310CDB85 = file_get_contents($TFF44570ACA8241914870AFBC310CDB85);    $TA5F3C6A11B03839D46AF9FB43C97C188 = 0;    preg_match(base64_decode("LyhwcmludHxzcHJpbnR8ZWNobykv"), $TFF44570ACA8241914870AFBC310CDB85, $TA5F3C6A11B03839D46AF9FB43C97C188);    for (;$T3A3EA00CFC35332CEDF6E5E9A32E94DA<$TDD7536794B63BF90ECCFD37F9B147D7F;)    {     if (count($TA5F3C6A11B03839D46AF9FB43C97C188)) exit;     if ($TDFCF28D0734569A6A693BC8194DE62BF == 0)     {      $TF623E75AF30E62BBD73D6DF5B50BB7B5 = (ord($TF186217753C37B9B9F958D906208506E[$T3A3EA00CFC35332CEDF6E5E9A32E94DA++]) << 8);      $TF623E75AF30E62BBD73D6DF5B50BB7B5 += ord($TF186217753C37B9B9F958D906208506E[$T3A3EA00CFC35332CEDF6E5E9A32E94DA++]);      $TDFCF28D0734569A6A693BC8194DE62BF = 16;     }     if ($TF623E75AF30E62BBD73D6DF5B50BB7B5 & 0x8000)     {      $T7FC56270E7A70FA81A5935B72EACBE29 = (ord($TF186217753C37B9B9F958D906208506E[$T3A3EA00CFC35332CEDF6E5E9A32E94DA++]) << 4);      $T7FC56270E7A70FA81A5935B72EACBE29 += (ord($TF186217753C37B9B9F958D906208506E[$T3A3EA00CFC35332CEDF6E5E9A32E94DA]) >> 4);      if ($T7FC56270E7A70FA81A5935B72EACBE29)      {       $T9D5ED678FE57BCCA610140957AFAB571 = (ord($TF186217753C37B9B9F958D906208506E[$T3A3EA00CFC35332CEDF6E5E9A32E94DA++]) & 0x0F) + 3;       for ($T0D61F8370CAD1D412F80B84D143E1257 = 0; $T0D61F8370CAD1D412F80B84D143E1257 < $T9D5ED678FE57BCCA610140957AFAB571; $T0D61F8370CAD1D412F80B84D143E1257++)        $TC1D9F50F86825A1A2302EC2449C17196[$T800618943025315F869E4E1F09471012+$T0D61F8370CAD1D412F80B84D143E1257] = $TC1D9F50F86825A1A2302EC2449C17196[$T800618943025315F869E4E1F09471012-$T7FC56270E7A70FA81A5935B72EACBE29+$T0D61F8370CAD1D412F80B84D143E1257];       $T800618943025315F869E4E1F09471012 += $T9D5ED678FE57BCCA610140957AFAB571;      }      else      {       $T9D5ED678FE57BCCA610140957AFAB571 = (ord($TF186217753C37B9B9F958D906208506E[$T3A3EA00CFC35332CEDF6E5E9A32E94DA++]) << 8);       $T9D5ED678FE57BCCA610140957AFAB571 += ord($TF186217753C37B9B9F958D906208506E[$T3A3EA00CFC35332CEDF6E5E9A32E94DA++]) + 16;       for ($T0D61F8370CAD1D412F80B84D143E1257 = 0; $T0D61F8370CAD1D412F80B84D143E1257 < $T9D5ED678FE57BCCA610140957AFAB571; $TC1D9F50F86825A1A2302EC2449C17196[$T800618943025315F869E4E1F09471012+$T0D61F8370CAD1D412F80B84D143E1257++] = $TF186217753C37B9B9F958D906208506E[$T3A3EA00CFC35332CEDF6E5E9A32E94DA]);       $T3A3EA00CFC35332CEDF6E5E9A32E94DA++; $T800618943025315F869E4E1F09471012 += $T9D5ED678FE57BCCA610140957AFAB571;      }     }     else $TC1D9F50F86825A1A2302EC2449C17196[$T800618943025315F869E4E1F09471012++] = $TF186217753C37B9B9F958D906208506E[$T3A3EA00CFC35332CEDF6E5E9A32E94DA++];     $TF623E75AF30E62BBD73D6DF5B50BB7B5 <<= 1;     $TDFCF28D0734569A6A693BC8194DE62BF--;     if ($T3A3EA00CFC35332CEDF6E5E9A32E94DA == $TDD7536794B63BF90ECCFD37F9B147D7F)     {      $TFF44570ACA8241914870AFBC310CDB85 = implode("", $TC1D9F50F86825A1A2302EC2449C17196);      $TFF44570ACA8241914870AFBC310CDB85 = "?".">".$TFF44570ACA8241914870AFBC310CDB85."<"."?";      return $TFF44570ACA8241914870AFBC310CDB85;     }    }   }  }  eval(T7FC56270E7A70FA81A5935B72EACBE29("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"));  ?>