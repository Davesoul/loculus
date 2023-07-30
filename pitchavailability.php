<?php
  $pagename="pitch availability";
?>

  <!-- 
    - #HEADER
  -->
  
<?php
  include("assets/include/header.php");
?>

      <!-- 
        - #HERO
      -->

      <section class="hero1" id="home">
        <div class="container">

          <h2 class="h1 hero-title">Pitch Availability</h2>

          <p class="hero-text">
            Check the availability of our pitches and make a reservation
          </p>

          <div class="btn-group">
            <button class="btn btn-primary">Select a date</button>
          </div>

        </div>
      </section>



<!-- 
  - pitch_availability.html
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

        <button type="submit" class="btn btn-secondary">Reserve</button>

      </form>

    </div>
  </section>


<!-- AVAILABILITY -->

<section class="package" id="package">
  <div class="container">

    <p class="section-subtitle">Popular Packages</p>

    <h2 class="h2 section-title">Camping Pitches</h2>

    <p class="section-text">
      Choose from our range of camping pitches in beautiful locations. Enjoy the great outdoors and experience nature at its best.
    </p>

    <ul class="package-list">

      <?php
      $query = "SELECT pitch_type, availability, unavailability_duration, pitch_picture, pitch_price FROM CampingPitches;";
      $result = $conn->query($query);

      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
      ?>
          <li>
            <div class="package-card">

              <figure class="card-banner">
                <img src="./assets/images/<?php echo $row["pitch_picture"]; ?>" alt="<?php echo $row["pitch_type"]; ?>" loading="lazy">
              </figure>

              <div class="card-content">

                <h3 class="h3 card-title"><?php echo $row["pitch_type"]; ?></h3>

                <?php if ($row["availability"]) { ?>
                  <p class="card-text">Available</p>
                <?php } else { ?>
                  <p class="card-text">Unavailable for <?php echo $row["unavailability_duration"]; ?> days</p>
                <?php } ?>

                <ul class="card-meta-list">

                  <li class="card-meta-item">
                    <div class="meta-box">
                      <ion-icon name="money"></ion-icon>
                      <p class="text">$<?php echo $row["pitch_price"]; ?></p>
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
      
          <button class="btn btn-secondary">Contact Us!</button>
      
        </div>
      </section>
      
      </article>
      </main>
      
      
      <!-- 
      - #FOOTER
      -->
      
<?php
  include("assets/include/footer.php");
?>        
  

</body>

</html>