# iTEC 2017 - Responciability
Repository for iTEC 2017 code of "$team = ' Just code it'" . The project name is "Responciability" and it acts a "Social Responsibility Portal".  

## Contributors:
[Mihai Pirvulet](https://bitbucket.org/mitapirvuet/)  
[Popescu Ionut](https://bitbucket.org/IonutPopescuRO/)  

## Useful commands:

* watch -n1 -x command
* Run server.php WS  

## 1st time setup (php7.0 and mysql required)
- clone
- composer install
- php artisan key:generate
- create db itec in mysql
- setup .env DB credentials ( mail server creds not included in repo )
- php artisan migrate
- php artisan db:seed
- php artisan server ( starts main site on localhost:8000 )  

## start websocket 
- cd ws-server
- php server.php ( no message should be shown )

## start background archiving :  
- watch -n30 -x php artisan archive:issues  

- site live on localhost:8000, change role to 2 from db to have admin rights, enjoy