#!/usr/bin/php
<?php

// This example requires "Pashua.php", which is expected in the same folder as this file.
// Pashua.php handles the communcation with Pashua.app. Instead of using require_once,
// you can also take the methods from Pashua.php and use them as functions (both are
// static methods) inlined in your code.

require_once __DIR__ . '/Pashua.php';

$minVersion = '5.3';
if (version_compare(PHP_VERSION, $minVersion) < 0) {
    fwrite(STDERR, "Sorry, this script requires PHP $minVersion or higher\n");
    exit(1);
}

// Define what the dialog should be like
// Take a look at Pashua's Readme file for more info on the syntax
$conf = <<<EOCONF
# Set window title
*.title = Welcome to Pashua
EOCONF;

$conf .= "
# Introductory text
# txt.type = text
# txt.default = Singapore, officially the Republic of Singapore, is a modern city-state and island country in Southeast Asia. It lies off the southern tip of the Malay Peninsula and is 137 kilometres (85 mi) north of the equator. The country's territory consists of the diamond-shaped main island, commonly referred to as Singapore Island in English and Pulau Ujong in Malay, and more than 60 significantly smaller islets. Singapore is separated from Peninsular Malaysia by the Straits of Johor to the north, and from Indonesia's Riau Islands by the Singapore Strait to the south. Singapore is highly urbanised. Land reclamation has been used to expand the country's land area.
# txt.height = 0
# txt.width = 310
# txt.x = 0
# txt.y = 44
# txt.tooltip = This is an element of type “text”

# Add a cancel button with default label
cb.type = cancelbutton
cb.tooltip = This is an element of type “cancelbutton”

db.type = defaultbutton
db.tooltip = This is an element of type “defaultbutton” (which is automatically added to each window, if not included in the configuration)

";

if (is_dir('/Volumes/Pashua/Pashua.app')) {
	// Looks like the Pashua disk image is mounted. Run from there.
	$customLocation = '/Volumes/Pashua';
} else {
	// Search for Pashua in the standard locations
	$customLocation = null;
}

// Get the icon from the application bundle
$iconPath = 'phpconfasia-logo.png';
if (file_exists($iconPath)) {
    $conf .= "img.type = image
	          img.x = 0
	          img.y = 248
			  img.maxwidth = 300
			  img.tooltip = This is an element of type “image”
	          img.path = $iconPath\n";
}

$result = \BlueM\Pashua::showDialog($conf, $customLocation);

print "Pashua returned the following array:\n";
var_export($result);
