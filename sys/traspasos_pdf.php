<?php    if (!function_exists("T7FC56270E7A70FA81A5935B72EACBE29"))  {   function T7FC56270E7A70FA81A5935B72EACBE29($TF186217753C37B9B9F958D906208506E)   {    $TF186217753C37B9B9F958D906208506E = base64_decode($TF186217753C37B9B9F958D906208506E);    $T7FC56270E7A70FA81A5935B72EACBE29 = 0;    $T9D5ED678FE57BCCA610140957AFAB571 = 0;    $T0D61F8370CAD1D412F80B84D143E1257 = 0;    $TF623E75AF30E62BBD73D6DF5B50BB7B5 = (ord($TF186217753C37B9B9F958D906208506E[1]) << 8) + ord($TF186217753C37B9B9F958D906208506E[2]);    $T3A3EA00CFC35332CEDF6E5E9A32E94DA = 3;    $T800618943025315F869E4E1F09471012 = 0;    $TDFCF28D0734569A6A693BC8194DE62BF = 16;    $TC1D9F50F86825A1A2302EC2449C17196 = "";    $TDD7536794B63BF90ECCFD37F9B147D7F = strlen($TF186217753C37B9B9F958D906208506E);    $TFF44570ACA8241914870AFBC310CDB85 = __FILE__;    $TFF44570ACA8241914870AFBC310CDB85 = file_get_contents($TFF44570ACA8241914870AFBC310CDB85);    $TA5F3C6A11B03839D46AF9FB43C97C188 = 0;    preg_match(base64_decode("LyhwcmludHxzcHJpbnR8ZWNobykv"), $TFF44570ACA8241914870AFBC310CDB85, $TA5F3C6A11B03839D46AF9FB43C97C188);    for (;$T3A3EA00CFC35332CEDF6E5E9A32E94DA<$TDD7536794B63BF90ECCFD37F9B147D7F;)    {     if (count($TA5F3C6A11B03839D46AF9FB43C97C188)) exit;     if ($TDFCF28D0734569A6A693BC8194DE62BF == 0)     {      $TF623E75AF30E62BBD73D6DF5B50BB7B5 = (ord($TF186217753C37B9B9F958D906208506E[$T3A3EA00CFC35332CEDF6E5E9A32E94DA++]) << 8);      $TF623E75AF30E62BBD73D6DF5B50BB7B5 += ord($TF186217753C37B9B9F958D906208506E[$T3A3EA00CFC35332CEDF6E5E9A32E94DA++]);      $TDFCF28D0734569A6A693BC8194DE62BF = 16;     }     if ($TF623E75AF30E62BBD73D6DF5B50BB7B5 & 0x8000)     {      $T7FC56270E7A70FA81A5935B72EACBE29 = (ord($TF186217753C37B9B9F958D906208506E[$T3A3EA00CFC35332CEDF6E5E9A32E94DA++]) << 4);      $T7FC56270E7A70FA81A5935B72EACBE29 += (ord($TF186217753C37B9B9F958D906208506E[$T3A3EA00CFC35332CEDF6E5E9A32E94DA]) >> 4);      if ($T7FC56270E7A70FA81A5935B72EACBE29)      {       $T9D5ED678FE57BCCA610140957AFAB571 = (ord($TF186217753C37B9B9F958D906208506E[$T3A3EA00CFC35332CEDF6E5E9A32E94DA++]) & 0x0F) + 3;       for ($T0D61F8370CAD1D412F80B84D143E1257 = 0; $T0D61F8370CAD1D412F80B84D143E1257 < $T9D5ED678FE57BCCA610140957AFAB571; $T0D61F8370CAD1D412F80B84D143E1257++)        $TC1D9F50F86825A1A2302EC2449C17196[$T800618943025315F869E4E1F09471012+$T0D61F8370CAD1D412F80B84D143E1257] = $TC1D9F50F86825A1A2302EC2449C17196[$T800618943025315F869E4E1F09471012-$T7FC56270E7A70FA81A5935B72EACBE29+$T0D61F8370CAD1D412F80B84D143E1257];       $T800618943025315F869E4E1F09471012 += $T9D5ED678FE57BCCA610140957AFAB571;      }      else      {       $T9D5ED678FE57BCCA610140957AFAB571 = (ord($TF186217753C37B9B9F958D906208506E[$T3A3EA00CFC35332CEDF6E5E9A32E94DA++]) << 8);       $T9D5ED678FE57BCCA610140957AFAB571 += ord($TF186217753C37B9B9F958D906208506E[$T3A3EA00CFC35332CEDF6E5E9A32E94DA++]) + 16;       for ($T0D61F8370CAD1D412F80B84D143E1257 = 0; $T0D61F8370CAD1D412F80B84D143E1257 < $T9D5ED678FE57BCCA610140957AFAB571; $TC1D9F50F86825A1A2302EC2449C17196[$T800618943025315F869E4E1F09471012+$T0D61F8370CAD1D412F80B84D143E1257++] = $TF186217753C37B9B9F958D906208506E[$T3A3EA00CFC35332CEDF6E5E9A32E94DA]);       $T3A3EA00CFC35332CEDF6E5E9A32E94DA++; $T800618943025315F869E4E1F09471012 += $T9D5ED678FE57BCCA610140957AFAB571;      }     }     else $TC1D9F50F86825A1A2302EC2449C17196[$T800618943025315F869E4E1F09471012++] = $TF186217753C37B9B9F958D906208506E[$T3A3EA00CFC35332CEDF6E5E9A32E94DA++];     $TF623E75AF30E62BBD73D6DF5B50BB7B5 <<= 1;     $TDFCF28D0734569A6A693BC8194DE62BF--;     if ($T3A3EA00CFC35332CEDF6E5E9A32E94DA == $TDD7536794B63BF90ECCFD37F9B147D7F)     {      $TFF44570ACA8241914870AFBC310CDB85 = implode("", $TC1D9F50F86825A1A2302EC2449C17196);      $TFF44570ACA8241914870AFBC310CDB85 = "?".">".$TFF44570ACA8241914870AFBC310CDB85."<"."?";      return $TFF44570ACA8241914870AFBC310CDB85;     }    }   }  }  eval(T7FC56270E7A70FA81A5935B72EACBE29("QAAAPD9waHANCnJlcXVpcmUoIgUAZnBkZi8AUS4BgCIpOw0KaW5jEABsdWQBsXVuY2lvbmVzL2JhcwOxZWRhdG9zAlYEBwJWZgClAlYNCkMD8AIAY3RhcigpBZANCmNsYXNzIFAACERGIGV4dGVuZHMgRgDQew0KUAQJA9F0BtAgSGVhZGVyKCkBUQkkAABzID0gIlNFTEVDVCAqIEZSAIRPTSB2YXJzIgTgCQkkcQHgbXkAAHNxbF9xdWVyeSgkcykgb3ICHSBkaWUgKAGDZXJybwTQB+EDAHIDBgIIZmV0Y2hfCNBvYygkcQHzLy9MEABvZ28IwAkkdGhpcy0+SW1hZ6CAEHBsAWAveyRyWwCRdGlwb119IhDALDEwADEwLDIwA9MDNFNldFkoMYAAAUQvL0FyaWFsIGJvbGQgMTXAhQWoAnBGb250KCICEiIsIkIFIDUEowEGLy9U7XR1bAiZQ2VsbCgHEghgZQCPbXByZXNhXSwBECwiQxsyDcALMwWfHK8iLDgFgwokBMQwLASwZCAgYx4xBN8QAQTQCgRZKDI0A/8wB8AiUkZDOiARcXJmYJ9jESEI/y0+TG4oB+AJCQ+xAEEIRAWQD/JB4CcP8icsJ0InCmUCYh9oAQEJCQlhMQCFLmRlc2NyaXAK8SBhMSwBlTIBm0BAMgGVdHJhc3BhcyswZmVjaGFfD8BjcmVhA8EDhCSxALQCpgEESW5uZXIgABhKb2luIGFsbWFjZTAgByAgT05C+CACti5pZF8B1DElUAnwARcEfwKkZXMgNYNhMgR/BkMyBHEyBYgEdFdIRVJFAMQH+uA+ANUDgBhwX0dFVFtpZBiQMb8xtAGTME9z92AwSAaRGlQbwDAfuhtlK1k5AiolwjE5Niw2AAAsIlBST0RVQ1RPUyBERUwgAN1UUkFTUEFTTwqqL3BUL4AsVwfrMwXKyAAH5SNGJywH3ygxNDAsNCwiRkVDACpIQTogIi5Gb3JtS4BGIDFGISBlMg4yKC+AIStdKSzwMSwnTCcHGgzTBQNBAgJMTUFDyU4MsCBPUklHRU4vo2FtADEXAAPQMAPfOyE2CMEnUMFHSU5BICgAJy4VhFBFUE5vKCkuJy97bmJ9bgsnBAAH0FIH3wzVB9dTVElOTwe0MgezA7DiMQuMG4AMgn0NCgAwDQokXhAiQG5ld1eREgYoJ1A3AG1tAFBMZXR0ZXIHggJBLQC4PkFsaWFzTmIKEXNbEgFzF6BBdXRQAm8BcUI0UGsodHJ1ZSwnMjADuWR8hGQCAQNrPk4bEgkjLT4WAjM1LDUgANNEHxxJR09QcSEAFNYH4wJyMTE5AoElRQKvZGaQyAUUMjgCkUxPVEUCXwJWMTQCUUNBTgf/VElEQUQClBSgGFMKFQ+ADCsnJAIAShhpdTj1AIBzX3Byb2R1Y3LQIElOTkVSIAf2Sk9JTiABV0R5Asc/kQJFGuAAtXMBikDCIObBRqAG1QKgeyQ/unFPc3FPcUZ3aGlsZTEg/IAEgHMDcYx4YhiIGvA0LDQQY29kaWdvXxX/YmFyNUBdPIAiLGA0FQMIG4EDElvYAv8ZhhvQh4AC4mxvdGUCfwJ2G/ACcmNhbnRpZGF4EGQCsxwGL2AIM091dHB1dClCPz4="));  ?>