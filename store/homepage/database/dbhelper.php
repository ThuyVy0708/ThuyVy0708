<?php
require_once('config.php');
function execute($sql)
{
	//save data into table
	// open connection to database
	$con = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);
    if (!$con) {
        die('Connection failed: ' . mysqli_connect_error());
    }
	//insert, update, delete
	mysqli_query($con, $sql);

	//close connection
	mysqli_close($con);
}

function executeResult($sql)
{
	//save data into table
	// open connection to database
	$con = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);
    if (!$con) {
        die('Connection failed: ' . mysqli_connect_error());
    }
	//insert, update, delete
	$result = mysqli_query($con, $sql);
        // check if the query was successful
    if (!$result) {
        die('Query failed: ' . mysqli_error($con));
    }
	$data   = [];
	while ($row = mysqli_fetch_array($result, 1)) {
		$data[] = $row;
	}
	mysqli_close($con);
	return $data;
}

function executeSingleResult($sql)
{
	//save data into table
	// open connection to database
	$con = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);
    if (!$con) {
        die('Connection failed: ' . mysqli_connect_error());
    }
	//insert, update, delete
	$result = mysqli_query($con, $sql);
	$row    = mysqli_fetch_array($result, 1);

	//close connection
	mysqli_close($con);

	return $row;
}
