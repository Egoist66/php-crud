<?php
function title(?string $title = ''): string
{
    if(empty($_GET['page'])){
        return 'Home';
    }
    else if(!empty($_GET['page'])){
        return ucfirst($_GET['page']);
    }
    else {
        return $title;
    }


}