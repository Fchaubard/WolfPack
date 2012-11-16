<?php
if (!isset($_SESSION['userName'])) {
			
			header('Location: http://stanford.edu/~rerich/cgi-bin/CS147/login.php');
}

?>