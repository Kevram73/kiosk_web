<?php

// Laravel Migration Table fixer
// By: Abel Koudaya

// WHAT IT DOES: Add records to the Laravel migrations table based on what is missing (ie found in the files located at /database/migrations). This allows you to quickly add multiple possible missing records to the migrations table and get past errors when trying to run 'php artisan migrate' such as 'table already exists', to which the normal solution is to rollback and loose tables/data.

// HOW TO USE: Copy into the root of your laravel install and make sure database config in .env is valid

// WARNING: Backup entire datbase before running this from the Larvel app root - absolutely no liability can be held for data loss!.


// Get database settings from .env
$myfile = fopen(".env", "r") or die("Unable to open file!");
$envContent = fread($myfile, filesize(".env"));

$envPairs = explode("\n", $envContent);
$envPairs = array_filter($envPairs);
$settings = array();
foreach ($envPairs as $pair) {
    $temp = explode("=", $pair);
    $settings[$temp[0]] = $temp[1];
}

if (isset($settings["DB_HOST"]) && isset($settings["DB_USERNAME"]) && isset($settings["DB_PASSWORD"]) && isset($settings["DB_DATABASE"])) {

    // Connect to database
    $dbConnection = new mysqli($settings["DB_HOST"], $settings["DB_USERNAME"], $settings["DB_PASSWORD"], $settings["DB_DATABASE"]);
    if ($dbConnection) {

        // Get all the files from the migrations folder in the correct order
        $migrationFiles = array_diff(scandir("database/migrations"), array('..', '.'));
        sort($migrationFiles);

        $lastBatchNo = 0;
        foreach ($migrationFiles as $migrationFile) {
            // Remove extension from the file
            $filename = pathinfo($migrationFile, PATHINFO_FILENAME);

            // Check if entry exists in migrations table
            $sql = "SELECT * FROM migrations WHERE migration = '$filename'";
            $migrationEntries = $dbConnection->query($sql);
            if ($migrationEntries && $migrationEntries->num_rows > 0) {
                $migrationEntry = $migrationEntries->fetch_assoc();
                $lastBatchNo = $migrationEntry["batch"];
                echo "$filename exists (batch number $lastBatchNo)\n";
            } else {
                // create new record!
                $lastBatchNo++;
                $sql = "INSERT INTO migrations(migration,batch) VALUES ('$filename',$lastBatchNo)";
                $addEntry = $dbConnection->query($sql);

                if ($addEntry) {
                    echo "$filename does NOT exist - added successfully with batch ID $lastBatchNo\n";
                } else {
                    die("Error adding record for $filename");
                }
            }
        }
    } else {
        die("Error connecting to database with provided settings");
    }
} else {
    die("Required database settings in .env could not be located");
}
?>
