<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="./bootstrap/css/bootstrap.css" />
        <title>Titre</title>
    </head>

    <body>
    	<p> <b>Sign in</b> </p>

    <form action="createUser.php" method="post">
<p>
    <label>Pseudo</label><input type="text" name="pseudo" />
</br>
    <label>Password</label><input type="password" name="passwd" />
</br>
    <label>First name</label><input type="text" name="firstName" />
</br>
    <label>Last name</label><input type="text" name="lastName" />
</br>
    <label>Email</label><input type="text" name="email" />
</br>
    <label>Date of birth</label><input type="text" name="birth" />
</br>

    <input type="submit" value="Valider" />

</p>
</form>
    </body>
</html>