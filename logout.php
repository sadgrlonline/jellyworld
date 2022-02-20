<?php
session_start();

session_destroy();

header('location: /jellyworld/login/');