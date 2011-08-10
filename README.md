# Simple API based PHP URL shortener

## Install
Create a database.

Run sql/tables.sql on the database.

Change the database details in config.php.

Upload all files except the SQL directory and README.md.

## Use
http://site.com/create.php?url=http://blah.com
Returns JSON array with shortened id.

http://site.com/update.php?id=123abc&url=http://blah.com
Updates URL if the correct HTTP auth params are present, returns JSON array with shortened id on success.

http://site.com/?id=123
Redirects to id 123.

http://site.com/123
Redirects to id 123 if .htaccess is enabled in directories.

