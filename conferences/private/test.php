<?php
$r = file('../private/countries.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
print_r(in_array("Ukraine", $r));
?>