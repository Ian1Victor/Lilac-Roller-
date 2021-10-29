<?php
function setLinkActiveClass(string $link) {
  $actualPageURI = explode('.', $_SERVER['REQUEST_URI'])[0];
  $actualPage = $actualPageURI === '/' ? 'home' : substr($actualPageURI, 1, strlen($actualPageURI)+1);  
  return $actualPage === $link ? 'active' : '';
}