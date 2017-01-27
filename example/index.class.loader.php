<?php

/** 
* Example: Include autoload and call the classes/methods
*/
require('../dist/php/autoload.php');

/* Call the class `SuperHero` and say you are `IronMan` */
use \Example\SuperHero as IronMan;
/* use \Example\SuperHero; <= or just call and use class real name `SuperHero` */

use \Villain\Bob; /* Example with namespace `Villain` setted, see `autoload.php` */

/* Using the classes */
Bob::says();
IronMan::says();
/* SuperHero::says() <= without change the class name */

?>