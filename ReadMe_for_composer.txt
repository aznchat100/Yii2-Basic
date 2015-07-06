If you are trying to git clone from github the yii project you are working on.
The composer.json has to be modified inorder to update the permissions of

chmod 777 runtime
chmod 777 web/asset
chmod 755 yii

before composer install.

The composer.json only changes the permission on postCreateProject. You have to modify it to post-install-cmd or simply add it into your composer.json. The modified composer.json can be found here: 

https://github.com/aznchat100/basic/blob/master/composer.json

See also:https://adamcod.es/2013/03/07/composer-install-vs-composer-update.html
to get a better understanding of compser install and composer update difference.
