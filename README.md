# Matcha

### This project is about creating a dating website.

A user will then be able to register, connect, fill his/her profile, search and look into
the profile of other users, like them, chat with those that “liked” back.

**Please find subject with full description :point_right: [here](matcha.en.pdf) :point_left:.**

## Used technologies:

:point_right: Slim framework

:point_right: Sockets (Realtime chat, notifications)

:point_right: Custom search

:point_right: User managment (create user, send confirmation email, edit profile, upload files, authorization)

:point_right: Bootstrap with custom design

<img src="/screenshots/match_sceen_1.png" alt="project screenshot" title="project screenshot 1" width="700">
<img src="/screenshots/matcha_presentation.gif" alt="project screenshot" title="project screenshot 1" width="700">
<img src="/screenshots/matcha_swipe.gif" alt="project screenshot" title="project screenshot 1" width="700">
<img src="/screenshots/it's_a_match.jpg" alt="project screenshot" title="project screenshot 1" width="700">
<img src="/screenshots/matcha_screen_2.png" alt="project screenshot" title="project screenshot 1" width="700">

## Launch and Test:

First you need to have MAMP enviroment.

1) Clone the project:

```
git clone https://github.com/Navalag/matcha_42.git
```

2) In phpMyAdmin create new database "matcha".
Then import database with demo data wich is at the root of repository.

Then update src/conf/settings.php and src/connect/dbkey.php with your database configs.

3) Set up MAMP configs:
In src/matcha.conf provide your path to src/public directory.
In MAMP configs provide path to src/matcha.conf.

**Thats it!** :ok_hand: you can now restart a server and open project in browser.

#### Enjoy :joy:
