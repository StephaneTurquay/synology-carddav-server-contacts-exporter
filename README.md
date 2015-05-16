Synology CardDav Server Contacts Exporter
==========

[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)

PHP script that allows you to export all contacts from your Synology CardDav Server into .vcf files.

## Install

Download this repository, rename it with a much easier name and move it into your NAS Web Station folder (by default: web/).

## Configuration

1. Define the dumped filename from the Synology's PostGreSQL database 
2. Define the path where you want to export all the .vcf files. It can not be outside the Web Station folder.

``` php
// Define name and extension of the dumped file. (Default: caldav.sql)
$dump_file = 'caldav.sql';

// Define the path where .vcf files will be exported
$export_path = 'export/';
```

## Usage

Open your favorite web browser and reach the URL or IP of your NAS followed by the path to index.php such as : http://url_of_your_nas/path/to/index.php

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.

