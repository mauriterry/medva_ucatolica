<?php
define('DEFAULT_TITLE', 'Ucatolica Medva');// titulo general para toda la pagina

$config = array(); //

$config ['production']= array();
$config ['production']['db'] = array();
$config ['production']['db']['host'] ='localhost';
$config ['production']['db']['name'] ='medva';
$config ['production']['db']['user'] ='omegasol';
$config ['production']['db']['password'] ='admin.2008*';
$config ['production']['db']['port'] ='3306';
$config ['production']['db']['engine'] ='mysql';

$config ['staging']= array();
$config ['staging']['db'] = array();
$config ['staging']['db']['host'] ='localhost';
$config ['staging']['db']['name'] ='medva';
$config ['staging']['db']['user'] ='omegasol';
$config ['staging']['db']['password'] ='admin.2008*';
$config ['staging']['db']['port'] ='3306';
$config ['staging']['db']['engine'] ='mysql';

$config ['development']= array();
$config ['development']['db'] = array();
$config ['development']['db']['host'] ='localhost';
$config ['development']['db']['name'] ='medva';
$config ['development']['db']['user'] ='omegasol';
$config ['development']['db']['password'] = 'admin.2008*';
$config ['development']['db']['port'] ='3306';
$config ['development']['db']['engine'] ='mysql';

