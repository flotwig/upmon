upmon
=====
A simple, easy to use PHP-based uptime monitor with grouped HTML, PNG and JSON output options.
Installing
-----
Installing is easy.

1. Create a database and database user for upmon.
2. Copy config.example.php to config.php and edit in the correct values.
3. Visit install.php in your web browser.
4. Edit the database and add in servers and groups and ports to check.
5. Put check.php in a cron job.

Specials
-----
Specials are special PHP files used to process certain kinds of servers which require more in-depth information. Configure them in config.php. If you want to write one, use specials/minecraft.php as an example.