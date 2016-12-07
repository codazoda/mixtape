# MixTape

MixTape is a PHP class that picks a random year within the specified decade and
returns a random song from the Billboard Hot 100 archive.

Here's some example code that uses the class to pick 15 songs from my preferred
list of decades.

```
<?php

namespace codazoda\music;

require 'MixTape.php';

$mixTape = new MixTape;
$picks = $mixTape->getPicks();
print_r($picks);
```

Here's how you would pick a single song from a specific decade.

```
$pick = $mixTape->randomPick('1980');
print_r($pick);
```

## Rationale

I created MixTape because I wanted some random song picks for CD's that I can
put into my old school truck radio. I want some variety so each list of songs
has several picks from each decade that I'm interested in and then those songs
are randomized. I plan to burn a dozen or so CD's and keep them in my 20 year
old truck the way you would have listened to music when the truck was made.