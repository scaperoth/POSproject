CREATE USER 'posuser'@'%'
IDENTIFIED BY 'P0S_u$s3r';

GRANT SELECT, INSERT, UPDATE, EXECUTE, DELETE, SHOW VIEW ON pos.* TO 'posuser'@'%';