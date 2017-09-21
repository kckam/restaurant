## Simple Restaurant

<p align="center">
<img src="https://i.imgur.com/BG9ATSp.png" alt="screenshot 1">
<img src="https://i.imgur.com/5w8Ys2B.png" alt="screenshot 2">
<img src="https://i.imgur.com/WDunndP.png" alt="screenshot 3">
</p>

## Installation Guide

- git clone https://github.com/kckam/restaurant.git
- go to **restaurant** folder and run **composer install** using cmd
- create .env file from .env.example on root folder. You can type **copy .env.example .env** if using command prompt Windows or **cp .env.example .env** if using terminal Ubuntu
copy .env.example .env
- open .env file and change the database name to **restaurants**, username (DB_USERNAME) and password (DB_PASSWORD) field correspond to your configuration. 
- import **restaurant.sql**(located in the sql folder) into database.
- Run **php artisan key:generate**


