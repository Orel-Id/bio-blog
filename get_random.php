<?php

header("Content-Type: application/json");

$jokes = array(
    "Chuck Norris doesn’t read books. He stares them down until he gets the information he wants.",
    "Time waits for no man. Unless that man is Chuck Norris.",
    "If you spell Chuck Norris in Scrabble, you win. Forever.",
    "Chuck Norris breathes air … five times a day."
);

$jokeIndex = array_rand($jokes);

// echo $jokes[$jokeIndex];

// 2 étapes
// * 1 comment créer cette structure en PHP ?
// * 2 comment la transformer en JSON ?

$result = array(
    "joke" => $jokes[$jokeIndex]
);

// var_dump($result);

echo json_encode($result);

// echo "{ \"joke\": \"" . $jokes[$jokeIndex] . "\" }";

// { "joke": "My joke" }
