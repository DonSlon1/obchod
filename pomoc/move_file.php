<?php

    header('Content-type:image/*');
    echo(move_uploaded_file($_FILES["file"]["tmp_name"], '../images/' . $_FILES["file"]["name"]));
