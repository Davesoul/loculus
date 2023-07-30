<?php
  $pagename="information";
?>

<?php
  include("assets/include/header.php");
?>
  <!-- 
        - #HERO
      -->

      <section class="hero1" id="home">
        <div class="container">

          <h2 class="h1 hero-title">Discover Ghana</h2>

          <p class="hero-text">
            Ghana is a beautiful country located in West Africa. It is known for its rich history, vibrant culture, and breathtaking natural landscapes. At Tourly, we are passionate about showcasing the beauty of Ghana and providing unforgettable travel experiences.
          </p>

          <div class="btn-group">
            <button class="btn btn-primary">Available</button>

            <button class="btn btn-secondary">Book now</button>
          </div>

        </div>
      </section>


        <!-- 
        - #POPULAR
      -->
      <section class="package" id="package">
        <div class="container">
      
          <p class="section-subtitle">Popular Packages</p>
      
          <h2 class="h2 section-title">Sites</h2>
      
          <p class="section-text">
            Explore these amazing packages in Ghana that offer unforgettable experiences. Whether you're looking for a beach holiday, river adventure, or a weekend getaway, we have something for everyone.
          </p>
      
          <ul class="package-list">

            <?php
              $query = "SELECT * FROM Sites";
              $result = $conn->query($query);

              if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
            ?>
                  <li>
                    <div class="package-card">

                      <figure class="card-banner">
                        <img src="./assets/images/<?php echo $row["site_picture"]; ?>" alt="<?php echo $row["site_name"]; ?>" loading="lazy">
                      </figure>

                      <div class="card-content">

                        <h3 class="h3 card-title"><?php echo $row["site_name"]; ?></h3>

                        <p class="card-text">
                          <?php echo $row["description"]; ?>
                        </p>

                        <ul class="card-meta-list">

                          <li class="card-meta-item">
                            <div class="meta-box">
                              <ion-icon name="location"></ion-icon>
                              <p class="text"><?php echo $row["location"]; ?></p>
                            </div>
                          </li>

                          <li class="card-meta-item">
                            <div class="meta-box">
                              <ion-icon name="money"></ion-icon>
                              <p class="text">$<?php echo $row["site_price"]; ?></p>
                            </div>
                          </li>

                        </ul>

                      </div>
                      <iframe width="425" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.openstreetmap.org/export/embed.html?bbox=<?php echo $row["latitude"]-0.25; ?>%2C<?php echo $row["longitude"]-0.25; ?>%2C<?php echo $row["latitude"]+0.25; ?>%2C<?php echo $row["longitude"]+0.25; ?>&amp;layer=mapnik&amp;marker=<?php echo $row["longitude"]; ?>%2C<?php echo $row["latitude"]; ?>"></iframe><br/><small><a href="https://www.openstreetmap.org/?mlat=5.10701&amp;mlon=-1.24340#map=17/5.10701/-1.24340&amp;layers=N">View Larger Map</a></small>
                    </div>
                  </li>
            <?php
                }
              }
            ?>

          </ul>
</div>
      </section>
      
      <!-- 
      - #FOOTER
      -->

<?php
  include("assets/include/footer.php");
?>  



  <!-- 
    - #GO TO TOP
  -->

  <a href="#top" class="go-top" data-go-top>
    <ion-icon name="chevron-up-outline"></ion-icon>
  </a>





  <!-- 
    - custom js link
  -->
  <script src="./assets/js/script.js"></script>

  <!-- 
    - ionicon link
  -->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>

</html>