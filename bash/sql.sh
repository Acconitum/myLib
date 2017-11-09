# get databasedump
mysqldump -hhost -uusername -ppassword database > path/to/sqlfile.sql

# Import SQL-File
mysql -uusername -ppassword -hhost database < sql-file.sql

# Execute mysql command from comandline
mysql -uusername -ppaswword -hhost -e 'CREATE DATABASE databasename;'