<?php

function is_empty_data(mixed $data): bool{
    if(is_array($data) && count($data) > 0){
        foreach ($data as $key => $value) {
            if(empty($value)){
                return true;
            }
            return  false;
        }
    }

    return is_string() && empty($data);

}