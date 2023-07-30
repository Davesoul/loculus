<?php
echo "hi";
echo exec('pwd');
include("assets/include/header.php");


// Check if the search query is submitted
if (isset($_GET['search_query'])) {
    // Sanitize and store the search query
    $search_query = trim($_GET['search_query']);
    echo $search_query;
  
    // Perform the search query in the database
    // Assuming you have already established a database connection, adjust the SQL query accordingly
    // This is a basic example, you should use prepared statements for security
    $sql = "SELECT * FROM Sites WHERE site_name LIKE '%$search_query%'";
    echo $sql;
    $result = $conn->query($sql);
    ?>

    <section class="package">
        <div class="container">
    <ul class="package-list">

    <?php
      $query = "SELECT * FROM Sites WHERE site_name LIKE '%$search_query%'";
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
              
              <iframe class="map" frameborder="0" src="https://www.openstreetmap.org/export/embed.html?bbox=<?php echo $row["longitude"]; ?>%2C<?php echo $row["longitude"]; ?>%2C-0.8514404296875%2C10.409481792727005&amp;layer=mapnik&amp;marker=<?php echo $row["longitude"]; ?>%2C<?php echo $row["latitude"]; ?>"></iframe><br/>
            </div>
          </li>
    <?php
        }
      }
    ?>

  </ul>
<?php } ?>
    </div>
</section>

<style>body{background: rgba(0,0,0,0.5)}</style>
