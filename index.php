<?php

// Define name and extension of the dumped file. (Default: caldav.sql)
$dump_file = 'caldav.sql';

// Define the path where .vcf files will be exported
$export_path = 'export/';

// Dump the table including all the contacts
exec('pg_dump -O -U postgres caldav -t addressbook_object -a > ' . $dump_file . ' 2>error.log');

// Detect if an error occurred during the dump 
if(file_exists('error.log')) {
	$log = file_get_contents('error.log');
	
	if (strpos($log, 'failed: FATAL:  database') != null) {
		echo 'The package CardDAV Server is not installed on your DiskStation or its database has been renamed or deleted.';
		unlink($dump_file);
	}
	unlink('error.log');
}

// If path doesn't exist, create it
if (!file_exists($export_path)) {
	mkdir($export_path);
}

// Store table's datas into a string
$caldav = file_get_contents($dump_file);

// Extract information needed to create .vcf files
preg_match_all('/BEGIN:VCARD(.+)END:VCARD/', $caldav, $vcard_data);
preg_match_all('/[a-zA-Z0-9-]+\.vcf/', $caldav, $vcard_name);

foreach ($vcard_name[0] as $key => $name) {

	// Create all .vcf files and store it at the defined place
	if(file_put_contents($export_path . $name, str_replace('\r\n', "\r\n" , $vcard_data[0][$key]))) {
		echo $key+1 . ": " . $name . " has been exported !<br />";
	}
	else {
		echo "<strong>Error with ". $key+1 . ': ' . $name . "<br />";
	}	
}

?>