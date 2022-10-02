<?php
  function is_empty($field){
    return !isset($field) || trim($field) === '';
  }

  function has_length($field, $min, $max){
    return !is_empty($field) && strlen($field) <= $max && strlen($field) >= $min;
  }

  function is_float_really($field){
    $float_regex = "/[+-]?([0-9]*[.])?[0-9]+/";
    return preg_match($float_regex, $field) === 1;
  }

  function validate_conf($conf){
    $errors = [];
    
    if(is_empty($conf['date'])){
      $errors[] = "Fill in date field";
    }

    if(!has_length($conf['title'], 2, 255)){
      $errors[] = "Name must have length between 2 and 40";
    }

    if(is_empty($conf['country'])){
      $errors[] = "Fill in country field";
    }
    // print_r(file('../private/countries.txt'));
    // print_r($conf['country']);
    // print_r(!in_array($conf['country'], file('../private/countries.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES)));
    if (!in_array(trim($conf['country']), file('../private/countries.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES))){
      $errors[] = "Country should be from the list";
    }

    if ((!is_empty($conf['lng']) || !is_empty($conf['lat'])) && !(is_float_really($conf['lng']) && is_float_really($conf['lat']))){
      $errors[] = "Lontitude and latitude should be floating point numbers";
    }

    return $errors;
  }

?>