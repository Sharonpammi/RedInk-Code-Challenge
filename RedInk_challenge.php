<?php

// Process Questions array
$questions_array = array_map('str_getcsv', file('questions.csv'));

// Process array row and assign header names to keys
array_walk($questions_array, function(&$a) use ($questions_array) {
  $a = array_combine($questions_array[0], $a);
});

# remove column header
array_shift($questions_array); 

// print_R($questions_array);


// Process Usage array
$usage_array = array_map('str_getcsv', file('usage.csv'));

// Process array row and assign header names to keys
array_walk($usage_array, function(&$a) use ($usage_array) {
  $a = array_combine($usage_array[0], $a);
});

# remove column header
array_shift($usage_array);


?>