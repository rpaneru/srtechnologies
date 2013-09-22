<?php



/* 

**  Function:   convert_number 

**  Arguments:  int 

**  Returns:    string 

**  Description: 

**      Converts a given integer (in range [0..1T-1], inclusive) into 

**      alphabetical format ("one", "two", etc.). 

*/ 


if (!function_exists("convert_number")) {
function convert_number($number) 

{ 

    if (($number < 0) || ($number > 999999999)) 

    { 

        return "$number"; 

    } 



    $Gn = floor($number / 1000000);  /* Millions (giga) */ 

    $number -= $Gn * 1000000; 

    $kn = floor($number / 1000);     /* Thousands (kilo) */ 

    $number -= $kn * 1000; 

    $Hn = floor($number / 100);      /* Hundreds (hecto) */ 

    $number -= $Hn * 100; 

    $Dn = floor($number / 10);       /* Tens (deca) */ 

    $n = $number % 10;               /* Ones */ 



    $res = ""; 



    if ($Gn) 

    { 

        $res .= convert_number($Gn) . " Million"; 

    } 



    if ($kn) 

    { 

        $res .= (empty($res) ? "" : " ") . 

            convert_number($kn) . " Thousand"; 

    } 



    if ($Hn) 

    { 

        $res .= (empty($res) ? "" : " ") . 

            convert_number($Hn) . " Hundred"; 

    } 



    $ones = array("", "One", "Two", "Three", "Four", "Five", "Six", 

        "Seven", "Eight", "Nine", "Ten", "Eleven", "Twelve", "Thirteen", 

        "Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eighteen", 

        "Nineteen"); 

    $tens = array("", "", "Twenty", "Thirty", "Fourty", "Fifty", "Sixty", 

        "Seventy", "Eigthy", "Ninety"); 



    if ($Dn || $n) 

    { 

        if (!empty($res)) 

        { 

            $res .= " and "; 

        } 



        if ($Dn < 2) 

        { 

            $res .= $ones[$Dn * 10 + $n]; 

        } 

        else 

        { 

            $res .= $tens[$Dn]; 



            if ($n) 

            { 

                $res .= "-" . $ones[$n]; 

            } 

        } 

    } 



    if (empty($res)) 

    { 

        $res = "zero"; 

    } 



    return $res; 
}
} 




if (!function_exists("number_comma")) {
function number_comma($input)

{

    if(strlen($input)<=2)

    { return $input; }

    $length=substr($input,0,strlen($input)-2);

    $formatted_input = number_comma($length).",".substr($input,-2);

    return $formatted_input;
}
}



if (!function_exists("number_format_in")) {
function number_format_in($num,$decimal){

    // Indian implementation for number_format()

    $pos = strpos((string)$num, ".");

    if ($pos === false) { $decimalpart="00";}

    else { $decimalpart= substr($num, $pos+1, 2); $num = substr($num,0,$pos); }



    if(strlen($num)>3 & strlen($num) <= 12){

                $last3digits = substr($num, -3 );

                $numexceptlastdigits = substr($num, 0, -3 );

                $formatted = number_comma($numexceptlastdigits);

                $stringtoreturn = $formatted.",".$last3digits.".".$decimalpart ;

    }elseif(strlen($num)<=3){

                $stringtoreturn = $num.".".$decimalpart ;

    }elseif(strlen($num)>12){

                $stringtoreturn = number_format($num, 2);

    }



    if(substr($stringtoreturn,0,2)=="-,"){$stringtoreturn = "-".substr($stringtoreturn,2 );}



    return $stringtoreturn;

}
}


?>