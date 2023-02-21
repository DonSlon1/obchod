<?php

    header('Content-type:image/*');
    print_r($_FILES);
    move_uploaded_file($_FILES["file"]["tmp_name"],'./images/'.$_FILES["file"]["name"]);