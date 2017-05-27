<?php

function old( $key ) {
  return isset($_REQUEST[$key]) ? htmlspecialchars($_REQUEST[$key]) : '';
}
