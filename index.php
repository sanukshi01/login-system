<?php
include_once 'header.php';
?>

    <section class="intro">
        <?php 
        if( isset($_SESSION["username"])) {
            echo "<p>Hello there " . $_SESSION["username"] . "</p>";
        }
         ?>
      <div class="wrapper">
        <h1>This Is An Introduction</h1>
        <p>Here is an important paragraph that explains the purpose of the website and why you are here!</p>
      </div>
    </section>

    <section class="categories">
      <div class="wrapper">
        <h2>Some Basic Categories</h2>
        <div class="category-grid">
          <div class="category-box">Fun Stuff</div>
          <div class="category-box">Serious Stuff</div>
          <div class="category-box">Exciting Stuff</div>
          <div class="category-box">Boring Stuff</div>
        </div>
      </div>
    </section>

    <?php
include_once 'footer.php';
?>
 