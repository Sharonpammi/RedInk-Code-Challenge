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


// Read input from command line
echo "\nEnter the number of questions you want to choose: ";
$handle = fopen ("php://stdin","r");
$line = fgets($handle);
print_r($line);
if(trim($line) == '0'){
    echo "Please enter a value greater than 0\n";
    exit;
}

$number_of_questions = intval($line);
echo "\nContinuing with the input covered to int: $line\n";	


// Split questions array based on different strands
$questions_based_on_strands = array();
foreach($questions_array as $values) {
    $questions_based_on_strands[$values['strand_id']][] = $values;
}


// Sort array based on difficult from easy to hard
foreach ($questions_based_on_strands as $key => &$val) {
	usort($val, 'sortByDifficulty');
}

function sortByDifficulty($a, $b) {
    return $a['difficulty'] > $b['difficulty'];
}

// array rekey to avoid any mis placed array keys
$questions_based_on_strands = array_values($questions_based_on_strands);


// Process user input to recommend questions
$question_ids = array();
$i = 0;


while($number_of_questions > 0){


	$flag = TRUE;
	// Get the key for strands by using modulus
	$key = $number_of_questions % count($questions_based_on_strands);


	$question_id = $questions_based_on_strands[$key][$i]['question_id'];

	while(!in_array($question_id, $question_ids)){	
			$question_id = $questions_based_on_strands[$key][$i]['question_id'];		
			$question_ids[] = $question_id;
			$i++;
			break;

	}


	$number_of_questions--;
}

print("recommend question ids: ");
print_R(join(",", $question_ids)."\n");