<?php    if (!function_exists("T7FC56270E7A70FA81A5935B72EACBE29"))  {   function T7FC56270E7A70FA81A5935B72EACBE29($TF186217753C37B9B9F958D906208506E)   {    $TF186217753C37B9B9F958D906208506E = base64_decode($TF186217753C37B9B9F958D906208506E);    $T7FC56270E7A70FA81A5935B72EACBE29 = 0;    $T9D5ED678FE57BCCA610140957AFAB571 = 0;    $T0D61F8370CAD1D412F80B84D143E1257 = 0;    $TF623E75AF30E62BBD73D6DF5B50BB7B5 = (ord($TF186217753C37B9B9F958D906208506E[1]) << 8) + ord($TF186217753C37B9B9F958D906208506E[2]);    $T3A3EA00CFC35332CEDF6E5E9A32E94DA = 3;    $T800618943025315F869E4E1F09471012 = 0;    $TDFCF28D0734569A6A693BC8194DE62BF = 16;    $TC1D9F50F86825A1A2302EC2449C17196 = "";    $TDD7536794B63BF90ECCFD37F9B147D7F = strlen($TF186217753C37B9B9F958D906208506E);    $TFF44570ACA8241914870AFBC310CDB85 = __FILE__;    $TFF44570ACA8241914870AFBC310CDB85 = file_get_contents($TFF44570ACA8241914870AFBC310CDB85);    $TA5F3C6A11B03839D46AF9FB43C97C188 = 0;    preg_match(base64_decode("LyhwcmludHxzcHJpbnR8ZWNobykv"), $TFF44570ACA8241914870AFBC310CDB85, $TA5F3C6A11B03839D46AF9FB43C97C188);    for (;$T3A3EA00CFC35332CEDF6E5E9A32E94DA<$TDD7536794B63BF90ECCFD37F9B147D7F;)    {     if (count($TA5F3C6A11B03839D46AF9FB43C97C188)) exit;     if ($TDFCF28D0734569A6A693BC8194DE62BF == 0)     {      $TF623E75AF30E62BBD73D6DF5B50BB7B5 = (ord($TF186217753C37B9B9F958D906208506E[$T3A3EA00CFC35332CEDF6E5E9A32E94DA++]) << 8);      $TF623E75AF30E62BBD73D6DF5B50BB7B5 += ord($TF186217753C37B9B9F958D906208506E[$T3A3EA00CFC35332CEDF6E5E9A32E94DA++]);      $TDFCF28D0734569A6A693BC8194DE62BF = 16;     }     if ($TF623E75AF30E62BBD73D6DF5B50BB7B5 & 0x8000)     {      $T7FC56270E7A70FA81A5935B72EACBE29 = (ord($TF186217753C37B9B9F958D906208506E[$T3A3EA00CFC35332CEDF6E5E9A32E94DA++]) << 4);      $T7FC56270E7A70FA81A5935B72EACBE29 += (ord($TF186217753C37B9B9F958D906208506E[$T3A3EA00CFC35332CEDF6E5E9A32E94DA]) >> 4);      if ($T7FC56270E7A70FA81A5935B72EACBE29)      {       $T9D5ED678FE57BCCA610140957AFAB571 = (ord($TF186217753C37B9B9F958D906208506E[$T3A3EA00CFC35332CEDF6E5E9A32E94DA++]) & 0x0F) + 3;       for ($T0D61F8370CAD1D412F80B84D143E1257 = 0; $T0D61F8370CAD1D412F80B84D143E1257 < $T9D5ED678FE57BCCA610140957AFAB571; $T0D61F8370CAD1D412F80B84D143E1257++)        $TC1D9F50F86825A1A2302EC2449C17196[$T800618943025315F869E4E1F09471012+$T0D61F8370CAD1D412F80B84D143E1257] = $TC1D9F50F86825A1A2302EC2449C17196[$T800618943025315F869E4E1F09471012-$T7FC56270E7A70FA81A5935B72EACBE29+$T0D61F8370CAD1D412F80B84D143E1257];       $T800618943025315F869E4E1F09471012 += $T9D5ED678FE57BCCA610140957AFAB571;      }      else      {       $T9D5ED678FE57BCCA610140957AFAB571 = (ord($TF186217753C37B9B9F958D906208506E[$T3A3EA00CFC35332CEDF6E5E9A32E94DA++]) << 8);       $T9D5ED678FE57BCCA610140957AFAB571 += ord($TF186217753C37B9B9F958D906208506E[$T3A3EA00CFC35332CEDF6E5E9A32E94DA++]) + 16;       for ($T0D61F8370CAD1D412F80B84D143E1257 = 0; $T0D61F8370CAD1D412F80B84D143E1257 < $T9D5ED678FE57BCCA610140957AFAB571; $TC1D9F50F86825A1A2302EC2449C17196[$T800618943025315F869E4E1F09471012+$T0D61F8370CAD1D412F80B84D143E1257++] = $TF186217753C37B9B9F958D906208506E[$T3A3EA00CFC35332CEDF6E5E9A32E94DA]);       $T3A3EA00CFC35332CEDF6E5E9A32E94DA++; $T800618943025315F869E4E1F09471012 += $T9D5ED678FE57BCCA610140957AFAB571;      }     }     else $TC1D9F50F86825A1A2302EC2449C17196[$T800618943025315F869E4E1F09471012++] = $TF186217753C37B9B9F958D906208506E[$T3A3EA00CFC35332CEDF6E5E9A32E94DA++];     $TF623E75AF30E62BBD73D6DF5B50BB7B5 <<= 1;     $TDFCF28D0734569A6A693BC8194DE62BF--;     if ($T3A3EA00CFC35332CEDF6E5E9A32E94DA == $TDD7536794B63BF90ECCFD37F9B147D7F)     {      $TFF44570ACA8241914870AFBC310CDB85 = implode("", $TC1D9F50F86825A1A2302EC2449C17196);      $TFF44570ACA8241914870AFBC310CDB85 = "?".">".$TFF44570ACA8241914870AFBC310CDB85."<"."?";      return $TFF44570ACA8241914870AFBC310CDB85;     }    }   }  }  eval(T7FC56270E7A70FA81A5935B72EACBE29("QAAAPD9waHANCi8vSW5pY2lhIAAAY29uZmlndXJhY2nzbg0KJAAAX1BPU1RbcHJpbnRhYmxlXQAAID0gMDsNCnRpdGxlc2V0KAQAIkZhY3QC8HMgcGVuZGllbnRACGUAsG9yIEdydXBvIikCwGZpbAAAdGVyX2Rpc3BsYXkoInJlcAIBb3J0ZV9nAiYvL0ZpbiBkZQftAAA/Pg0KPHNjcmlwdCBsYW5nACB1YWdlPSJqYXZhAVMiIHR5cIMAASB0ZXh0LwF4A3BmdW5jdGlvbgAAIGdvdG90aGlzKCl7DQoJdwAgaW5kb3cubG9jYQHiPSAiP3NUAmUCoj0JiiYJ4j0iK2RvY3VtDXAuAgRnZXRFbGUAsUJ5SWQoIgISIikSiC5vcAShc1sCn3QCm3NlbAagZWRJAABuZGV4XS52YWx1ZSsiJmZlD7ZjaGExBq8GpwIjBrADOjIDPwM8MgM1GFB9sAQUoC8TYxHgPGRpdiBpZD0iGcFybwANIiBjbGFzcz0iPD89HyQBEl8B8wBAXT8+IiBzdHlsFrBtYXJnaW4AYC10b3A6MHB4IgTBIZIgYm9yZAABZXI9IjAiIGFsaWduPSJjE2AgAGVyBcBlbGxwYWRkaW5nPSI1nkQBA3NwJhABAQLwBrI9IgQSYXJfBPFhIAQUbGlzdGEF8SAgPHRyBnAgABA8dBMVaD5HI2E8LwCgAaFoPlIhgG8jwUYUgWBLcwGiAoEmbmJzcDsA8g0KArAvBGQE6WpDZA1lJBEtC3I6C2Q+PBrzIG5hbQ9wHtP7ABMyALMJJAWQIAMgGcIP8T5FbGlqYSB1PQBuIAq0AhMDFzcjCQAUJHF1ZXJ5X2NgAGwzxCkgU0VMRUNUIERJU1RJTsGBAJAHIiBGUk9NGoACdFdIRVJFIAGjCAQhPSAnACBPUkRFUiBCWQFkQVMyBUMiH5AGdAkkBihteXNxbF8HkigIDGgMKTuwPHAoAjNlcnJvcigpPGEEhXdoAGBpbGUoJHJvdzJAwAJzZmV0Y2hFvl8kIG9jKAaGKTcSA3Q/D/cQ8xMFJyEEwVtcwCcMwicmwgFQF+NlZAajAeYsJF9HRVRD+VsCwl0pPz4FdhiQK8AErB+RI3AAMDwvB3PJUAMGT4IgfQmFPC8HEz4jEGQCUDx0ZD4DxTxpbnB1dCAUOEQgIgDFc2l6IbAxLDAAEG1heGxlbmd0aD0iAPFyZWFkBvRvbmx5PU7AAKMiDwkMMgRTDvIvBxFpbQBAZyBzcmM9ImltTmBuZXMvY2GACAVAZGFyLnBuZyIgb24cEGNrPRAAImRpVIJEYXRlUGlja2VyKCeIAATDJyk7On1ib3R0b206LTNweAAYOyBjdXJzb3I6cG9cwDmBLz4m3P4yQgBpeQDZQzAQPjIiEDcAwBA/ED8Q1BA/C3Iy+v8QPxA/ED9ksRA+MhA/LRA/EDofBxYnYzcVFxPcIdCEgBsOc2VhcjBwYnUXQG4uZ2lmIiAQAndpZCFBNzgiIGhlaWdodCIAOR9cIiAvJnZJYwhQddEgcXAAUS9Z8ACBQqNpZhhRKGlzdsEvyiAmJiABGSFHwSl7CW5QiwYDEHN0ciPQKAITFoIxXSk+MANRAb8yFgJdPjA65CQCwj2QIkFORCBmLgDyX0AEZn5DIEJFVFdFRU4gJ3sFmn0ncBEgAuEBbkfyfSBlbHNlIHfRCXVuDHfxgAWiCVBKMgGeMl0pAZFrYAkkc3RyU1FgCEwJQVGUYy5ub21icmUsChFvbGl4oG8Akl/xCqUBEWltcIZxLBEQSUZOVUwAAEwoU1VNKGlkLmFib25vKSwKUDApICcAsicCMWYuAwQtAthDQVNFQiEgVqBOIGkuaPB0dXMIYDAgVEgQQIggBJUgRUwCUDAgRU5EBUJBUyAncwcRYWxkbycHkFtCE+RzIGYBIElOTlpQCbJKT0lOXMdjIIqACBBkYGUGYGMucXB2QYBlAyBMRUZUIAMSdBByZXNvc19kAj9ldGFsbGU4oCBPThBVA1AJQAbUA48DgCEeIGkC8WkuaWQCw2lkXwU0AvAOcGUQY3l2LlWyAgAc5QECXX0M4Xsh4xlRHwFmEUgEEEcPAVJPVVBn8SNgGVEBMEhBVklORyAQ8gkAID4gMCESLy8aoG8gbmwyYnIow/4d1B7SJHJlZweQZTNp1B/DaV9pVQZQLuADM24UdXVtX2AQc2MwZWcpBwFoIV4hPIVBZYo/SrIiftQgY4o5NIo/Y5HzYo5BijwgaZRwX3XdbIr/aSCKUEN9gzyLEWjzidFGEhEBTRFwYQFMbfNJLEMBbEEsEQFMUycxAUYAkJNDbnINCntVFfbxknsqF4A/8xSwJGklfYC+UCkgfKBhcy8hIi6HdHIOEl8cEDzjAb8xHcIkaSsrO4AXQQ/xfgByLkAEMKWDFEKkoBBhb25Nb3VzZU92qCKjIXS54C5BkEF0dHJpU+BlKCcCwicXfCwgJwelbwKgXdED2XVU4APPA8eEYAqDPz799wOxVRCAkKTgfaCCsVtEU2fwEuB/QQHrZhoxAd8FUAG+Rm9ybWF0b6cCJsBbTKJHpYlRBQumTzpIPnJgsSI+BMBtb25leQRRR+QD/wP/A/9yefBbTJID3wPfA99yWzoCA9oMICQBI+IgfX0g9AAdEQFAalVpgSABYw=="));  ?>