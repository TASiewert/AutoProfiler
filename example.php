<?php

require 'autoprofile.php';

$imageData = file_get_contents($_FILES["pic"]["tmp_name"]); 
$autoProfiler = new AutoProfiler("** API KEY **");
$data = $autoProfiler->getProfileInformation($imageData);

highlight_string("" . var_export($data, true));