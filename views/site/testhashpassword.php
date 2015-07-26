<?php
	use Yii;

	$password = "test";
	$hash = Yii::$app->getSecurity()->generatePasswordHash($password);
	// ...save $hash in database...
	echo "$hash";
	// during login, validate if the password entered is correct using $hash fetched from database
	if (Yii::$app->getSecurity()->validatePassword($password, $hash)) {
    echo "Password good";
	} else {
    echo "Bad Password";
}
?>