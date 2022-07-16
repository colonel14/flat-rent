<?php
  include "Templates/head.php"

?>

    <main class="root">
      <aside class="root_aside">
          <h1 class="logo">
            Perfect <span color="main-color">Flat</span>
          </h1>
      </aside>
      <section class="landing">
        <div class="strip strip1">
          <div class="overlay">
            <h2>Home</h2>
            <a href="home.php">
              Home Page
              <i class="fas fa-long-arrow-alt-right"></i>
            </a>
            <p>
              Lorem ipsum dolor sit amet, consectetur adipisicing elit. A veniam
              voluptatum quibusdam voluptates sunt quisquam vero excepturi amet
              soluta ducimus. Cupiditate rerum delectus dolores at quidem!
            </p>
          </div>
        </div>
        <div class="strip strip2">
          <div class="overlay">
            <h2>About</h2>
            <a href="about.php">
              About Page
              <i class="fas fa-long-arrow-alt-right"></i>
            </a>
            <p>
              Lorem ipsum dolor sit amet, consectetur adipisicing elit. A veniam
              voluptatum quibusdam voluptates sunt quisquam vero excepturi amet
              soluta ducimus. Cupiditate rerum delectus dolores at quidem!
            </p>
          </div>
        </div>
        <div class="strip strip3">
          <div class="overlay">
            <h2>Flats</h2>
            <a href="flats.php">
              Flats Page
              <i class="fas fa-long-arrow-alt-right"></i>
            </a>
            <p>
              Lorem ipsum dolor sit amet, consectetur adipisicing elit. A veniam
              voluptatum quibusdam voluptates sunt quisquam vero excepturi amet
              soluta ducimus. Cupiditate rerum delectus dolores at quidem!
            </p>
          </div>
        </div>
      </section>
    </main>
    <script>
      let strips = document.querySelectorAll(".strip");
      window.onload = function () {
        strips.forEach((strip) => {
          strip.classList.add("fadeIn");
        });
      };
      console.log(strips);
    </script>
  </body>
</html>