<?php

for($i = 0; $i < 10; $i++) {
  var_dump($i);

}

for($i = 9; $i < 10; $i++) {
  var_dump($i);
}

for($i = 2; $i < 1_000_000; $i++) {
  var_dump($i);
}

$time = time();
$i = 0;
while(time() - $time + 1) {
  var_dump($i);
  $i++;
}
while(false) {
  var_dump('WHILE');

}
do {
  var_dump('DO');
} while(false);

//while(true) {
// }

$fruits = ['apple', 'banana', 'cherry'];
foreach($fruits as $fruit) {
  var_dump($fruit);
}
foreach($fruits as $key => $fruit) {
  var_dump($key, $fruit);
}
var_dump($fruits);