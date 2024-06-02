<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
  <link rel="stylesheet" href="css/index.css">
  <title>Home</title>
  <style>
    main {
      padding: 20px;
      font-family: 'DUBAI-LIGHT', sans-serif;
      font-size: 20px;
    }
    #Category {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      grid-gap: 20px;
      margin-top: 10px;
    }
    section {
      border: 2px solid black;
      padding: 10px;
    }
    section:hover {
      transform: scale(1.05);
    }
    .view {
      color: blue;
      text-decoration: none;
    }
    .view:hover {
      text-shadow: 0px 0px 3px blue;
    }
  </style>
</head>
<body>
<?php
    session_start();
    require 'header.php';
    include 'conn.php';
    $active = 'home';
    require 'menu.php';
  ?>
  <main style="padding-inline: 50px;">
   
    <div id="Category">
   
    </div>
    <h1 style="font-size: 60px; text-align: center; padding-top: 40px;">WELCOME TO DIGITAL PAINTING </h1>
    
    <div id="Category">
</body>
</html>
