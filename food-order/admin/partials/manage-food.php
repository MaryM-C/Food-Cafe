<?php 

function manageFoodMessages(){
   if(isset($_SESSION['add2'])) {
      echo $_SESSION['add2'];
      unset($_SESSION['add2']);
  }
  if(isset($_SESSION['delete'])) {
     echo $_SESSION['delete'];
     unset($_SESSION['delete']);
  }
  if(isset($_SESSION['upload'])) {
     echo $_SESSION['upload'];
     unset($_SESSION['upload']);
  }
  if(isset($_SESSION['update'])) {
     echo $_SESSION['update'];
     unset($_SESSION['update']);
   }

}
?>