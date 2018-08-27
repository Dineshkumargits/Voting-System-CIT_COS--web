<?php
if(isset($_POST['parties'])){
  $data = $_POST['parties'];
  $password="abcd";
  $crypted_text = MyCrypt($data,$password);
  $file_name = "files/".$data."-".date("d-m-Y")."-".date("h-i-s").microtime().".txt";
  $handle = fopen($file_name,'w') or die('Cannot Open file :'.$file_name);
  fwrite($handle,$crypted_text);
  // fwrite($handle,MyDecrypt($crypted_text,$password));
  $decrypted_data = MyDecrypt($crypted_text,$password);
// $data1=crypt($data);
// //   echo crypt($data1);
// $o1=0,$o2=0,$o3=0,$o4=0;
// if ($data == "BJP"){
//   $o1++;
// }elseif ($data == "CONGRESS") {
//   $o2++;
// }elseif ($data == "AIADMK") {
//   $o3++;
// }elseif ($data == "DMK") {
//   $o4++;
// }
}

function MyDecrypt($input,$key){
        /* Open module, and create IV */
        $td = mcrypt_module_open('des', '', 'ecb', '');
        $key = substr($key, 0, mcrypt_enc_get_key_size($td));
        $iv_size = mcrypt_enc_get_iv_size($td);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        /* Initialize encryption handle */
        if (mcrypt_generic_init($td, $key, $iv) != -1) {
            /* 2 Reinitialize buffers for decryption */
            mcrypt_generic_init($td, $key, $iv);
            $p_t = mdecrypt_generic($td, $input);
                return $p_t;
            /* 3 Clean up */
            mcrypt_generic_deinit($td);
            mcrypt_module_close($td);
        }
} // end function Decrypt()


function MyCrypt($input, $key){
    /* Open module, and create IV */
    $td = mcrypt_module_open('des', '', 'ecb', '');
    $key = substr($key, 0, mcrypt_enc_get_key_size($td));
    $iv_size = mcrypt_enc_get_iv_size($td);
    $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
    /* Initialize encryption handle */
    if (mcrypt_generic_init($td, $key, $iv) != -1) {
        /* 1 Encrypt data */
        $c_t = mcrypt_generic($td, $input);
        mcrypt_generic_deinit($td);
            return $c_t;
        /* 3 Clean up */
        mcrypt_generic_deinit($td);
        mcrypt_module_close($td);
    }
}
  ?>
