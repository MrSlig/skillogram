<?php

var_dump($_POST);
var_dump($_FILES);


if (filesize($_FILES['image']['tmp_name']) >= filesize($_FILES['image2']['tmp_name'])) {
    move_uploaded_file($_FILES['image']['tmp_name'], './files/' . $_FILES['image']['name']);
} else {
    move_uploaded_file($_FILES['image2']['tmp_name'], './files/' . $_FILES['image']['name']);
};