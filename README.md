## Experimental MVC shell

This is just an outline of an MVC website. There are no composer dependencies,
nothing to build. The only setup needed is to cp the website/config.example.php 
to config.php and set the username and password to match the user created in the
docker-compose file.

Clone the repo, run docker-compose up -d and navigate to http://localhost:8000 
(adminer is at http://localhost:8080), You can change the ports in the 
docker-compose.yaml file if you want.

The user tale in the database isn't there. It is called by the blog controller
on the /blog route.

Eerything is pretty self explanitory. I have not documented anything, but if you
have ever used Laravel or CodeIgniter (or pretty much any other framework) this
should be pretty familiar. 

This should get you most of the way there if you are looking for protptype a site.

Contact me with any question and PLEASE feel free to tinker and issue pulls if you want.
I would like to see this become something many people might like to use.
