<?php
// PHP program to break the loop
  
// Declare two array and initialize it
$arr1 = array( 'A', 'B', 'C' );
$arr2 = array( 'C', 'A', 'B', 'D' );
  
// Use foreach loop
foreach ($arr1 as $a) {
    echo "$a ";
      
    // Ue nested loop
    foreach ($arr2 as $b) {
        if ($a != $b )
            echo "$b ";
        else
            break 1; 
    }
    echo "\n";
}
  
echo "\nLoop Terminated";
?>