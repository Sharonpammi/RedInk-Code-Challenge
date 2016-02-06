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

echo "\nEnter the number of questions you want to choose: ";
$handle = fopen ("php://stdin","r");
$line = fgets($handle);
print_R("\nEntered input: ");
print_r($line);
if(trim($line) == '0'){
    echo "Please enter a value greater than 0\n";
    exit;
}

$line = intval($line);
echo "\n"; 
echo "Continuing with the input covered to int: $line\n";


// Split questions array based on different strands
$questions_based_on_strands = array();
foreach($questions_array as $values) {
    $questions_based_on_strands[$values['strand_id']][] = $values;
}


?>