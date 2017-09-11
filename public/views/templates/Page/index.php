<div><h1>Welcome to Twitter.</h1></div>
<div class="logPassArea">
    Connect with your friends — and other fascinating people.<br />
    Get in-the-moment updates on the things that interest you.<br />
    And watch events unfold, in real time, from every angle.
</div>
<div class="logPassArea">
    <form action="login.php" method="post">
        <input type="text" name="userName" placeholder="please insert here your login" /><br />
        <input id="regPass" type="password" name="password" placeholder="please insert your password" /><br />
        <input id="logSubmit" type="submit" value="Sign in" /> 
    </form>
</div>
<h3><p>If, you dont be registered then you can get new account in 30 sec!!</p></h2>
<?php 
    if (isset($_SESSION['loginSuccess'])) {
        echo '<span class="success">'.$_SESSION['loginSuccess'].'</span>';
        unset($_SESSION['loginSuccess']);
    }
    
    if (isset($_SESSION['loginError'])) { 
        echo '<span class="error">'.$_SESSION['loginError'].'</span>';
        unset($_SESSION['loginError']);
    }
    
    if (isset($_SESSION['registerError'])) { 
        echo '<span class="error">'.$_SESSION['registerError'].'</span>';
        unset($_SESSION['registerError']);
    }

    if (isset($_SESSION['registerSuccess'])) {
        echo '<span class="success">'.$_SESSION['registerSuccess'].'</span>';
        unset($_SESSION['registerSuccess']);
    }
?>
<div>
    <form action="register.php" name="register" method="post">
        <input style= float:left; type="text" name="userName" placeholder="login" /><br />
        <img id="img" src="views/img/twit.jpeg" alt=""/>
        <input style= clear:both; type="text" name="email" placeholder="email" /><br />
        <input style= clear:both; type="password" name="password" placeholder="insert your password" /><br />
        <input type="password" name="password2" placeholder="insert again your password" /><br /><br />
        <input id="regSubmit" type="submit" value="sign up for Twitter" /> 
    </form>
</div>
