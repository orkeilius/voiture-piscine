# how to setup virtual server in xampp

open "C:\xampp\apache\conf\extra\httpd-vhosts.conf" and add :
```
<VirtualHost *:80>
   DocumentRoot "C:\xampp\htdocs\voiture-piscine\site dynamique"
   ServerName vp-enterprise
</VirtualHost>

```

open "C:\Windows\System32\drivers\etc\hosts" and add
```
127.0.0.1 vp-enterprise.local
```
[source](https://stackoverflow.com/questions/42810242/how-to-run-two-local-web-development-projects-in-xampp)