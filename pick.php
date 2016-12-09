<?php

namespace codazoda\music;

require 'MixTape.php';

// Create an instance of MixTape
$mixTape = new MixTape;

// Gather a bunch of picks from certain years
$picks = array(
    $mixTape->randomPick('2010'),
    $mixTape->randomPick('2000'),
    $mixTape->randomPick('1980', 'r-b-hip-hop-songs'),
    $mixTape->randomPick('2000'),
    $mixTape->randomPick('1990'),
    $mixTape->randomPick('2010'),
    $mixTape->randomPick('2000'),
    $mixTape->randomPick('1980'),
    $mixTape->randomPick('2000'),
    $mixTape->randomPick('1990', 'r-b-hip-hop-songs'),
    $mixTape->randomPick('2010'),
    $mixTape->randomPick('2000'),
    $mixTape->randomPick('1980'),
    $mixTape->randomPick('2000'),
    $mixTape->randomPick('1990'),
    $mixTape->randomPick('2010'),
    $mixTape->randomPick('2000'),
    $mixTape->randomPick('1980'),
    $mixTape->randomPick('2000'),
    $mixTape->randomPick('1990')
);

// Randomize the picks
shuffle($picks);

// Output them
print_r($picks);
