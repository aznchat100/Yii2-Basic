Composer.json
=============

If you are trying to git clone from github the yii project you are working on.
The composer.json has to be modified in order to update the permissions of

CONFIGURATION
-------------

Edit the file `composer.json`:

```
"scripts": {
    "post-create-project-cmd": [
    "yii\\composer\\Installer::postCreateProject"
    ],
    "post-install-cmd": [
    "chmod 777 runtime",
    "chmod 777 web/assets",
    "chmod 755 yii"
    ]
},
```

before composer installs.

The composer.json only changes the permission on postCreateProject. You have to modify it to post-install-cmd or simply add it into your composer.json. The modified composer.json can be found here: 

https://github.com/aznchat100/Yii2-Basic/blob/master/composer.json

See also:https://adamcod.es/2013/03/07/composer-install-vs-composer-update.html
to get a better understanding of compser install and composer update difference.
