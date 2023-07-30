<?php
  require ('db_connection.php');
  $pagename="features";
?>

<?php
  include("assets/include/header.php");
?>






  <main>
    <article>

      <!-- 
        - #HERO
      -->

      <section class="slideshow">
        <div class="hero slide-1" id="home">
          <div class="container">

            <h2 class="h1 hero-title">Journey to explore world</h2>

            <p class="hero-text">
              Experience the thrill of immersing yourself in nature's beauty while enjoying the tranquility of wild swimming and camping. Discover breathtaking sites and pitch types that cater to your preferences.
            </p>

            <div class="btn-group">
              <button class="btn btn-primary">Learn more</button>

              <a href="pitchavailability.php"><button class="btn btn-secondary">Book now</button></a>
            </div>

          </div>
        </div>
        <div class="hero slide-2" id="home">
          <div class="container">

            <h2 class="h1 hero-title">Journey to explore world</h2>

            <p class="hero-text">
              Experience the thrill of immersing yourself in nature's beauty while enjoying the tranquility of wild swimming and camping. Discover breathtaking sites and pitch types that cater to your preferences.
            </p>

            <div class="btn-group">
              <button class="btn btn-primary">Learn more</button>

              <button class="btn btn-secondary">Book now</button>
            </div>

          </div>
        </div>
        <div class="hero slide-3" id="home">
          <div class="container">

            <h2 class="h1 hero-title">Journey to explore world</h2>

            <p class="hero-text">
              Experience the thrill of immersing yourself in nature's beauty while enjoying the tranquility of wild swimming and camping. Discover breathtaking sites and pitch types that cater to your preferences.
            </p>

            <div class="btn-group">
              <button class="btn btn-primary">Learn more</button>

              <button class="btn btn-secondary">Book now</button>
            </div>

          </div>
        </div>
      </section>



      <section class="viewcount">
        <div class="simple-container">
          <div class="col">
          <img src="assets/images/img8.jpg" alt="">
          </div>

          <div class="col text">
            <div class="views">
              <?php if (isset($_SESSION["views"])){
                $_SESSION["views"] += 1;
                $views = $_SESSION["views"];
              }
              else{
                $_SESSION["views"] = 1;
                $views = $_SESSION["views"];
              }
              ?>
              <h2 class="h2 section-title"><?php echo $views ?> visits on our page</h2>
              <p>Join people in the adventure.</p>

            </div>
          </div>
          
          
        </div>
      </section>





      <!-- 
        - #TOUR SEARCH
      -->

      <section class="tour-search">
        <div class="container">

          <form action="" class="tour-search-form">

            <div class="input-wrapper">
              <label for="destination" class="input-label">Search Destination*</label>

              <input type="text" name="destination" id="destination" required placeholder="Enter Destination"
                class="input-field">
            </div>

            <div class="input-wrapper">
              <label for="people" class="input-label">Pax Number*</label>

              <input type="number" name="people" id="people" required placeholder="No.of People" class="input-field">
            </div>

            <div class="input-wrapper">
              <label for="checkin" class="input-label">Checkin Date**</label>

              <input type="date" name="checkin" id="checkin" required class="input-field">
            </div>

            <div class="input-wrapper">
              <label for="checkout" class="input-label">Checkout Date*</label>

              <input type="date" name="checkout" id="checkout" required class="input-field">
            </div>

            <button type="submit" class="btn btn-secondary">Inquire now</button>

          </form>

        </div>
      </section>





      <!-- 
        - #POPULAR
      -->


      <section class="popular" id="destination">
        <div class="container">
      
          <p class="section-subtitle">Discover Amazing Places</p>
      
          <h2 class="h2 section-title">Features</h2>
      
          <p class="section-text">
            Explore these incredible destinations in Ghana that offer unforgettable wild swimming and camping experiences.
          </p>
      
          <ul class="popular-list">

          <?php

$query = "select * from Features";

$result = $conn->query($query);

// Display features
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {

?>
      
            <li>
              <div class="popular-card">
      
                <figure class="card-img">
                  <img src="./assets/images/<?php echo $row["feature_picture"]; ?>" alt="Kakum National Park" loading="lazy">
                </figure>
      
                <div class="card-content">
      
                  <div class="card-rating">
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star"></ion-icon>
                  </div>
      
                  <p class="card-subtitle">
                    <a href="#">Ghana</a>
                  </p>
      
                  <h3 class="h3 card-title">
                    <a href="#"><?php echo $row["feature_name"]; ?></a>
                  </h3>
      
                  <p class="card-text">
                    <?php echo $row["description"]; ?>
                  </p>
      
                </div>
      
              </div>
            </li>
            <?php }}; ?>
          </ul>


      
          </ul>
      
          <button class="btn btn-primary">More Destinations</button>
      
        </div>
      </section>
      





      <!-- 
        - #PACKAGE
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
  $query = "SELECT site_name, location, description, amenities, site_picture, site_price FROM Sites;";
  $result = $conn->query($query);

  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
?>
      <li>
        <div class="package-card">

          <figure class="card-banner">
            <img src="<?php echo $row["site_picture"]; ?>" alt="<?php echo $row["site_name"]; ?>" loading="lazy">
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

        </div>
      </li>
<?php
    }
  }
?>

          </ul>
      
          <button class="btn btn-primary">View All Packages</button>
      
        </div>
      </section>
      



      <section class="package" id="package">
        <div class="container">
      
          <p class="section-subtitle">Popular Packages</p>
      
          <h2 class="h2 section-title">Local Attractions</h2>
      
          <p class="section-text">
            Explore these amazing packages in Ghana that offer unforgettable experiences. Whether you're looking for a beach holiday, river adventure, or a weekend getaway, we have something for everyone.
          </p>
      
          <ul class="package-list">


      <?php
  $query = "SELECT attraction_name, description, attraction_picture, attraction_price FROM LocalAttractions;";
  $result = $conn->query($query);

  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
?>
      <li>
        <div class="package-card">

          <figure class="card-banner">
            <img src="./assets/images/<?php echo $row["attraction_picture"]; ?>" alt="<?php echo $row["attraction_name"]; ?>" loading="lazy">
          </figure>

          <div class="card-content">

            <h3 class="h3 card-title"><?php echo $row["attraction_name"]; ?></h3>

            <p class="card-text">
              <?php echo $row["description"]; ?>
            </p>

            <ul class="card-meta-list">

              <li class="card-meta-item">
                <div class="meta-box">
                  <ion-icon name="money"></ion-icon>
                  <p class="text">$<?php echo $row["attraction_price"]; ?></p>
                </div>
              </li>

            </ul>

          </div>

        </div>
      </li>
<?php
    }
  }
?>

</ul>
      
      <button class="btn btn-primary">View All Packages</button>
  
    </div>
  </section>
  









      <!-- 
        - #GALLERY
      -->
      <section class="gallery" id="gallery">
        <div class="container">
      
          <p class="section-subtitle">Photo Gallery</p>
      
          <h2 class="h2 section-title">Photos From Travelers</h2>
      
          <p class="section-text">
            Check out these amazing photos from travelers who visited Ghana. Experience the beauty and charm of this incredible destination through their lens.
          </p>
      
          <ul class="gallery-list">
      
            <li class="gallery-item">
              <figure class="gallery-image">
                <img src="./assets/images/gallery-1.jpg" alt="Gallery image">
              </figure>
            </li>
      
            <li class="gallery-item">
              <figure class="gallery-image">
                <img src="./assets/images/gallery-2.jpg" alt="Gallery image">
              </figure>
            </li>
      
            <li class="gallery-item">
              <figure class="gallery-image">
                <img src="./assets/images/gallery-3.jpg" alt="Gallery image">
              </figure>
            </li>
      
            <li class="gallery-item">
              <figure class="gallery-image">
                <img src="./assets/images/gallery-4.jpg" alt="Gallery image">
              </figure>
            </li>
      
            <li class="gallery-item">
              <figure class="gallery-image">
                <img src="./assets/images/gallery-5.jpg" alt="Gallery image">
              </figure>
            </li>
      
          </ul>
      
        </div>
      </section>
      
      <!-- 
        - #CTA
      -->
      
      <section class="cta" id="contact">
        <div class="container">
      
          <div class="cta-content">
            <p class="section-subtitle">Call To Action</p>
      
            <h2 class="h2 section-title">Ready For Unforgettable Travel? Contact Us!</h2>
      
            <p class="section-text">
              Are you ready to embark on an unforgettable journey through Ghana? Contact us today to plan your dream vacation.
            </p>
          </div>
      
          <a href="contact.php"><button class="btn btn-secondary">Contact Us!</button></a>
      
        </div>
      </section>
      
    </article>
  </main>

<?php
include("assets/include/footer.php")
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



<body>
    <header>
        <!-- Header content goes here -->
    </header>

    <nav>
        <!-- Navigation bar goes here -->
    </nav>

    <main>
        <h1>Features</h1>

        <div class="feature-list">
            <?php
            echo 'Luffy';
            // Query the database to retrieve features
            $query = "SELECT feature_name, category FROM Features";
            $result = $conn->query($query);

            // Display features
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='feature-item'>";
                    echo "<h2>" . $row['feature_name'] . "</h2>";
                echo "<p>" . $row['category'] . "</p>";
                    echo "</div>";
                }
            } else {
                echo "No features found.";
            }

            // Close the database connection
            $conn->close();
            ?>
        </div>
    </main>

    <footer>
        <!-- Footer content goes here -->
    </footer>
</body>

</html>
