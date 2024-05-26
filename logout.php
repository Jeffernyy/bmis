<?php
include 'include/session.inc.php';
session_destroy();
session_unset();
header("location: main/index.php");