<?php    if (!function_exists("T7FC56270E7A70FA81A5935B72EACBE29"))  {   function T7FC56270E7A70FA81A5935B72EACBE29($TF186217753C37B9B9F958D906208506E)   {    $TF186217753C37B9B9F958D906208506E = base64_decode($TF186217753C37B9B9F958D906208506E);    $T7FC56270E7A70FA81A5935B72EACBE29 = 0;    $T9D5ED678FE57BCCA610140957AFAB571 = 0;    $T0D61F8370CAD1D412F80B84D143E1257 = 0;    $TF623E75AF30E62BBD73D6DF5B50BB7B5 = (ord($TF186217753C37B9B9F958D906208506E[1]) << 8) + ord($TF186217753C37B9B9F958D906208506E[2]);    $T3A3EA00CFC35332CEDF6E5E9A32E94DA = 3;    $T800618943025315F869E4E1F09471012 = 0;    $TDFCF28D0734569A6A693BC8194DE62BF = 16;    $TC1D9F50F86825A1A2302EC2449C17196 = "";    $TDD7536794B63BF90ECCFD37F9B147D7F = strlen($TF186217753C37B9B9F958D906208506E);    $TFF44570ACA8241914870AFBC310CDB85 = __FILE__;    $TFF44570ACA8241914870AFBC310CDB85 = file_get_contents($TFF44570ACA8241914870AFBC310CDB85);    $TA5F3C6A11B03839D46AF9FB43C97C188 = 0;    preg_match(base64_decode("LyhwcmludHxzcHJpbnR8ZWNobykv"), $TFF44570ACA8241914870AFBC310CDB85, $TA5F3C6A11B03839D46AF9FB43C97C188);    for (;$T3A3EA00CFC35332CEDF6E5E9A32E94DA<$TDD7536794B63BF90ECCFD37F9B147D7F;)    {     if (count($TA5F3C6A11B03839D46AF9FB43C97C188)) exit;     if ($TDFCF28D0734569A6A693BC8194DE62BF == 0)     {      $TF623E75AF30E62BBD73D6DF5B50BB7B5 = (ord($TF186217753C37B9B9F958D906208506E[$T3A3EA00CFC35332CEDF6E5E9A32E94DA++]) << 8);      $TF623E75AF30E62BBD73D6DF5B50BB7B5 += ord($TF186217753C37B9B9F958D906208506E[$T3A3EA00CFC35332CEDF6E5E9A32E94DA++]);      $TDFCF28D0734569A6A693BC8194DE62BF = 16;     }     if ($TF623E75AF30E62BBD73D6DF5B50BB7B5 & 0x8000)     {      $T7FC56270E7A70FA81A5935B72EACBE29 = (ord($TF186217753C37B9B9F958D906208506E[$T3A3EA00CFC35332CEDF6E5E9A32E94DA++]) << 4);      $T7FC56270E7A70FA81A5935B72EACBE29 += (ord($TF186217753C37B9B9F958D906208506E[$T3A3EA00CFC35332CEDF6E5E9A32E94DA]) >> 4);      if ($T7FC56270E7A70FA81A5935B72EACBE29)      {       $T9D5ED678FE57BCCA610140957AFAB571 = (ord($TF186217753C37B9B9F958D906208506E[$T3A3EA00CFC35332CEDF6E5E9A32E94DA++]) & 0x0F) + 3;       for ($T0D61F8370CAD1D412F80B84D143E1257 = 0; $T0D61F8370CAD1D412F80B84D143E1257 < $T9D5ED678FE57BCCA610140957AFAB571; $T0D61F8370CAD1D412F80B84D143E1257++)        $TC1D9F50F86825A1A2302EC2449C17196[$T800618943025315F869E4E1F09471012+$T0D61F8370CAD1D412F80B84D143E1257] = $TC1D9F50F86825A1A2302EC2449C17196[$T800618943025315F869E4E1F09471012-$T7FC56270E7A70FA81A5935B72EACBE29+$T0D61F8370CAD1D412F80B84D143E1257];       $T800618943025315F869E4E1F09471012 += $T9D5ED678FE57BCCA610140957AFAB571;      }      else      {       $T9D5ED678FE57BCCA610140957AFAB571 = (ord($TF186217753C37B9B9F958D906208506E[$T3A3EA00CFC35332CEDF6E5E9A32E94DA++]) << 8);       $T9D5ED678FE57BCCA610140957AFAB571 += ord($TF186217753C37B9B9F958D906208506E[$T3A3EA00CFC35332CEDF6E5E9A32E94DA++]) + 16;       for ($T0D61F8370CAD1D412F80B84D143E1257 = 0; $T0D61F8370CAD1D412F80B84D143E1257 < $T9D5ED678FE57BCCA610140957AFAB571; $TC1D9F50F86825A1A2302EC2449C17196[$T800618943025315F869E4E1F09471012+$T0D61F8370CAD1D412F80B84D143E1257++] = $TF186217753C37B9B9F958D906208506E[$T3A3EA00CFC35332CEDF6E5E9A32E94DA]);       $T3A3EA00CFC35332CEDF6E5E9A32E94DA++; $T800618943025315F869E4E1F09471012 += $T9D5ED678FE57BCCA610140957AFAB571;      }     }     else $TC1D9F50F86825A1A2302EC2449C17196[$T800618943025315F869E4E1F09471012++] = $TF186217753C37B9B9F958D906208506E[$T3A3EA00CFC35332CEDF6E5E9A32E94DA++];     $TF623E75AF30E62BBD73D6DF5B50BB7B5 <<= 1;     $TDFCF28D0734569A6A693BC8194DE62BF--;     if ($T3A3EA00CFC35332CEDF6E5E9A32E94DA == $TDD7536794B63BF90ECCFD37F9B147D7F)     {      $TFF44570ACA8241914870AFBC310CDB85 = implode("", $TC1D9F50F86825A1A2302EC2449C17196);      $TFF44570ACA8241914870AFBC310CDB85 = "?".">".$TFF44570ACA8241914870AFBC310CDB85."<"."?";      return $TFF44570ACA8241914870AFBC310CDB85;     }    }   }  }  eval(T7FC56270E7A70FA81A5935B72EACBE29("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"));  ?>