<?php
function limit_text($text, $limit, $link) {
      if (str_word_count($text, 0) > $limit) {
          $words = str_word_count($text, 2);
          $pos = array_keys($words);
          $text = substr($text, 0, $pos[$limit]).'...'.'<a href = '.$link.' style = "text-decoration:none; font-size:17px;font-family:times new roman;">read more</a>';
      }
      return $text;
    }
?>
