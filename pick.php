<?php

namespace codazoda\music;

require 'MixTape.php';

$mixTape = new MixTape;
$picks = $mixTape->getPicks();
print_r($picks);