<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="https://fonts.googleapis.com/css?family=Roboto:400,700,900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  
  <link rel="stylesheet" href="fonts/icomoon/style.css">


  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="css/bootstrap.min.css">

  <!-- Style -->
  <link rel="stylesheet" href="css/style.css">

  <title>Welcome</title>
</head>

<body>
<?php if (isset($_SESSION['message'])):  ?>
    <div class="alert alert-<?=$_SESSION['msg_type'] ?>">
      <?php
            echo $_SESSION['message'];
            unset ($_SESSION['message']);
        ?>
      </div>
      <?php endif ?>
  <div class="content">
    <div class="container">
    
      <div class="row align-items-stretch no-gutters contact-wrap">
        <div class="col-md-12">
          <div class="form h-100">
            <h3>Job Details</h3>
            <a href="logout.php"><h5 style="text-align: right;">Log Out</h5></a>
                <?php
                include 'process.php';
                  ?>
            <form class="mb-5" method="POST" action="process.php">
              <div class="row">
                <div class="col-md-6 form-group mb-3">
                  <label for="" class="col-form-label">Company Name</label>
                  <input type="text" class="form-control" name="Cname" value="<?php echo $name; ?>" placeholder="Company name">
                </div>
                <div class="col-md-6 form-group mb-3">
                  <label for="" class="col-form-label">Comapany Email </label>
                  <input type="text" class="form-control" name="Cemail"  value="<?php echo $email; ?>" placeholder="Company email">
                </div>
              </div>
        <input type="hidden" name="id" value="<?php echo $id; ?>">
              <div class="row">
                <div class="col-md-12 form-group mb-3">
                  <label for="budget" class="col-form-label">Job Found Location</label>
                  <select class="custom-select" name="JFL">
                    <option ><?php echo $JFL; ?></option>
                    <option value="Linkedin">Linkedin</option>
                    <option value="FacebookGroup">Facebook Group</option>
                    <option value="Glassdoor">Glassdoor</option>
                    <option value="Recomended">Recomended</option>
                  </select>
                </div>
              </div>

              <div class="row">
                <div class="col-md-12 form-group mb-3">
                  <label for="message" class="col-form-label">Job Requirement</label>
                  <input class="form-control" name="Crequirement" value="<?php echo $requ; ?>" 
                    placeholder="Write the job requirement"></input>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 form-group mb-3">
                  <label for="" class="col-form-label">Submit Date </label>
                  <input type="date" class="form-control" name="Cdate" value="<?php echo $date; ?>" placeholder="Submit Date">
                </div>
              </div>
              <div class="row">
                <div class="col-md-12 form-group">
                <?php if ($update==true) {
                   ?>
                <input type="submit" value="Update JOB Details" class="btn btn-primary rounded-0 py-2 px-4" name="update">
                <?php } else{ ?>
                  <input type="submit" value="Save JOB Details" class="btn btn-primary rounded-0 py-2 px-4" name="submit">
                  <?php } ?>
                  <span class="submitting"></span>
                  
                </div>
              </div>
            </form>
                          <?php 
                              $conn = new mysqli('localhost','root','','jdp') or die(mysqli_error($conn));
                              $result = $conn->query("SELECT * FROM jobdetails") or die(mysqli_error($conn));
                          ?>
            <table class="table table-striped">
              <thead>
                <th scope="col">name</th>
                <th scope="col">email</th>
                <th scope="col">location</th>
                <th scope="col">requirement</th>
                <th scope="col">Date</th>
                <th scope="col"> Action</th>
              </thead>
              <tbody>
                <?php while($row=$result->fetch_assoc()):
                  
                 ?>
                <tr>
                  <td scope="row" style="height:100px;width:100px"><?php echo $row['Cname'] ?></td>
                  <td scope="row" style="height:100px;width:100px"><?php echo $row['Cemail'] ?></td>
                  <td scope="row" style="height:100px;width:100px"><?php echo $row['JFL'] ?></td>
                  <td scope="row" style="height:100px;width:100px"><?php echo $row['Crequirement'] ?></td>
                  <td scope="row" style="height:100px;width:100px"><?php echo $row['date'] ?></td>
                  <td scope="row" style="height:100px;width:100px"><a href="index.php?edit=<?php echo $row['id']; ?>"><i class="fas fa-edit"></i></a><br>
                  <a href="process.php?delete=<?php echo $row['id']; ?>"><i class="fa-solid fa-trash"></a></i></td>
                </tr>
                <?php endwhile ?>
              </tbody>
            </table>
            <div id="form-message-warning mt-4"></div>
            <div id="form-message-success">
              Your Job Details has been sent, thank you!
            </div>

          </div>
        </div>
      </div>
    </div>

  </div>



  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.validate.min.js"></script>
  <script src="js/main.js"></script>

</body>

</html>