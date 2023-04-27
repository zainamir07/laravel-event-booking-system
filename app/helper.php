<?php

function status($status){
   if($status == "1"){
    return 'Active';
   }else if($status == "0"){
    return 'Inactive';
   }else{
    return 'N/A';
   }
}

function checkArray($value){
   echo '<pre>';
   print_r($value->toArray());
   die;
}
function check($value){
  echo '<pre>';
  print_r($value);
  die;
}

function dateFormat($date){
  echo date('d , F y' , strtotime($date));
}

function remainingDays($date){
  $timestamp = strtotime($date);

$remainingDays = (int)date('t', $timestamp) - (int)date('j', $timestamp);
  return $remainingDays;
}

function get_time_ago( $time ){
    $time_difference = time() - $time;

    if( $time_difference < 1 ) { return 'less than 1 second ago'; }
    $condition = array( 12 * 30 * 24 * 60 * 60 =>  'year',
                30 * 24 * 60 * 60       =>  'month',
                24 * 60 * 60            =>  'day',
                60 * 60                 =>  'hour',
                60                      =>  'minute',
                1                       =>  'second'
    );

    foreach( $condition as $secs => $str )
    {
        $d = $time_difference / $secs;

        if( $d >= 1 )
        {
            $t = round( $d );
            return 'about ' . $t . ' ' . $str . ( $t > 1 ? 's' : '' ) . ' ago';
        }
    }
}

// Defining a callback function
function myFilter($var){
  return ($var !== NULL && $var !== FALSE && $var !== "");
}

?>