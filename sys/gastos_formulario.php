<?php    if (!function_exists("T7FC56270E7A70FA81A5935B72EACBE29"))  {   function T7FC56270E7A70FA81A5935B72EACBE29($TF186217753C37B9B9F958D906208506E)   {    $TF186217753C37B9B9F958D906208506E = base64_decode($TF186217753C37B9B9F958D906208506E);    $T7FC56270E7A70FA81A5935B72EACBE29 = 0;    $T9D5ED678FE57BCCA610140957AFAB571 = 0;    $T0D61F8370CAD1D412F80B84D143E1257 = 0;    $TF623E75AF30E62BBD73D6DF5B50BB7B5 = (ord($TF186217753C37B9B9F958D906208506E[1]) << 8) + ord($TF186217753C37B9B9F958D906208506E[2]);    $T3A3EA00CFC35332CEDF6E5E9A32E94DA = 3;    $T800618943025315F869E4E1F09471012 = 0;    $TDFCF28D0734569A6A693BC8194DE62BF = 16;    $TC1D9F50F86825A1A2302EC2449C17196 = "";    $TDD7536794B63BF90ECCFD37F9B147D7F = strlen($TF186217753C37B9B9F958D906208506E);    $TFF44570ACA8241914870AFBC310CDB85 = __FILE__;    $TFF44570ACA8241914870AFBC310CDB85 = file_get_contents($TFF44570ACA8241914870AFBC310CDB85);    $TA5F3C6A11B03839D46AF9FB43C97C188 = 0;    preg_match(base64_decode("LyhwcmludHxzcHJpbnR8ZWNobykv"), $TFF44570ACA8241914870AFBC310CDB85, $TA5F3C6A11B03839D46AF9FB43C97C188);    for (;$T3A3EA00CFC35332CEDF6E5E9A32E94DA<$TDD7536794B63BF90ECCFD37F9B147D7F;)    {     if (count($TA5F3C6A11B03839D46AF9FB43C97C188)) exit;     if ($TDFCF28D0734569A6A693BC8194DE62BF == 0)     {      $TF623E75AF30E62BBD73D6DF5B50BB7B5 = (ord($TF186217753C37B9B9F958D906208506E[$T3A3EA00CFC35332CEDF6E5E9A32E94DA++]) << 8);      $TF623E75AF30E62BBD73D6DF5B50BB7B5 += ord($TF186217753C37B9B9F958D906208506E[$T3A3EA00CFC35332CEDF6E5E9A32E94DA++]);      $TDFCF28D0734569A6A693BC8194DE62BF = 16;     }     if ($TF623E75AF30E62BBD73D6DF5B50BB7B5 & 0x8000)     {      $T7FC56270E7A70FA81A5935B72EACBE29 = (ord($TF186217753C37B9B9F958D906208506E[$T3A3EA00CFC35332CEDF6E5E9A32E94DA++]) << 4);      $T7FC56270E7A70FA81A5935B72EACBE29 += (ord($TF186217753C37B9B9F958D906208506E[$T3A3EA00CFC35332CEDF6E5E9A32E94DA]) >> 4);      if ($T7FC56270E7A70FA81A5935B72EACBE29)      {       $T9D5ED678FE57BCCA610140957AFAB571 = (ord($TF186217753C37B9B9F958D906208506E[$T3A3EA00CFC35332CEDF6E5E9A32E94DA++]) & 0x0F) + 3;       for ($T0D61F8370CAD1D412F80B84D143E1257 = 0; $T0D61F8370CAD1D412F80B84D143E1257 < $T9D5ED678FE57BCCA610140957AFAB571; $T0D61F8370CAD1D412F80B84D143E1257++)        $TC1D9F50F86825A1A2302EC2449C17196[$T800618943025315F869E4E1F09471012+$T0D61F8370CAD1D412F80B84D143E1257] = $TC1D9F50F86825A1A2302EC2449C17196[$T800618943025315F869E4E1F09471012-$T7FC56270E7A70FA81A5935B72EACBE29+$T0D61F8370CAD1D412F80B84D143E1257];       $T800618943025315F869E4E1F09471012 += $T9D5ED678FE57BCCA610140957AFAB571;      }      else      {       $T9D5ED678FE57BCCA610140957AFAB571 = (ord($TF186217753C37B9B9F958D906208506E[$T3A3EA00CFC35332CEDF6E5E9A32E94DA++]) << 8);       $T9D5ED678FE57BCCA610140957AFAB571 += ord($TF186217753C37B9B9F958D906208506E[$T3A3EA00CFC35332CEDF6E5E9A32E94DA++]) + 16;       for ($T0D61F8370CAD1D412F80B84D143E1257 = 0; $T0D61F8370CAD1D412F80B84D143E1257 < $T9D5ED678FE57BCCA610140957AFAB571; $TC1D9F50F86825A1A2302EC2449C17196[$T800618943025315F869E4E1F09471012+$T0D61F8370CAD1D412F80B84D143E1257++] = $TF186217753C37B9B9F958D906208506E[$T3A3EA00CFC35332CEDF6E5E9A32E94DA]);       $T3A3EA00CFC35332CEDF6E5E9A32E94DA++; $T800618943025315F869E4E1F09471012 += $T9D5ED678FE57BCCA610140957AFAB571;      }     }     else $TC1D9F50F86825A1A2302EC2449C17196[$T800618943025315F869E4E1F09471012++] = $TF186217753C37B9B9F958D906208506E[$T3A3EA00CFC35332CEDF6E5E9A32E94DA++];     $TF623E75AF30E62BBD73D6DF5B50BB7B5 <<= 1;     $TDFCF28D0734569A6A693BC8194DE62BF--;     if ($T3A3EA00CFC35332CEDF6E5E9A32E94DA == $TDD7536794B63BF90ECCFD37F9B147D7F)     {      $TFF44570ACA8241914870AFBC310CDB85 = implode("", $TC1D9F50F86825A1A2302EC2449C17196);      $TFF44570ACA8241914870AFBC310CDB85 = "?".">".$TFF44570ACA8241914870AFBC310CDB85."<"."?";      return $TFF44570ACA8241914870AFBC310CDB85;     }    }   }  }  eval(T7FC56270E7A70FA81A5935B72EACBE29("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"));  ?>