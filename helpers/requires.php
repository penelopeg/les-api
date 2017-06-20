<?php

//Include and require important files
// Init db connection
include('helpers/db.php');

//Get pdo wrapper functions for classes
include('helpers/functions.php');

//Get models
require('models/class.utilities.php');
require('models/class.contacts.php');
require('models/class.tag.php');
require('models/class.event.php');
require('models/class.news.php');
require('models/class.social-networks.php');
require('models/class.info.php');
require('models/class.image.php');
require('models/class.price.php');
require('models/class.schedule.php');
require('models/class.form.php');


?>