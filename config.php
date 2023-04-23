<?php

putenv('DATABASE_URL=mysql://root:@localhost:3306/muruu?schema=myschema');

// DATABASE_URL ашиглан шинэ mysqli холболт үүсгэнэ
$conn = mysqli_init();
mysqli_options($conn, MYSQLI_OPT_CONNECT_TIMEOUT, 2);
mysqli_real_connect($conn, parse_url(getenv("DATABASE_URL"))['host'], parse_url(getenv("DATABASE_URL"))['user'], parse_url(getenv("DATABASE_URL"))['pass'], substr(parse_url(getenv("DATABASE_URL"))['path'], 1));

// Холболт амжилттай болсон эсэхийг шалгана уу
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
