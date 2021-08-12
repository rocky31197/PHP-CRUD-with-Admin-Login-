<link rel="stylesheet" href="style1.css"> 
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


<?php
session_start();
?>
<html>
<head>
<title>User Login</title>
</head>
<body class="sidebar-wide" style=" background-color: whitesmoke;">
<div class="page-container">

		<?php //include('sidebar.php'); ?>

 		<div class="page-content">

<?php
if($_SESSION["name"]) {
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
            <a class="navbar-brand" href="#">CRUD</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-item nav-link active" href="index.php">Products</a>
                    <a href="logout.php" class="nav-item nav-link active" style="margin-left: 1080px;">Logout.</a>
                </div>
            </div>
        </nav>
<div class="container1 mt-auto" ><br>
<h2 class="mb-0">Welcome <?php echo $_SESSION["name"]; ?></h2><br>
<a class="btn btn-sm btn-success mb-2" href="add.php">Add Product</a>
  <table class="table" style="
    text-align: center;
">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Product Image</th>
      <th scope="col">Product Name</th>
      <th scope="col">Category</th>
      <th scope="col">Sub Category</th>
      <th scope="col">Short Description</th>
      <th scope="col">Price</th>
      <th scope="col">Discounted Price</th>
      <th scope="col">Quantity</th>
      <th scope="col">Created</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
    <?php
      include ('conn.php');
      $display = "SELECT * FROM shop_products";
      $qdisplay = mysqli_query($conn,$display);
      $res= mysqli_num_rows($qdisplay)>0;
      $x=1;
      if($res)
      {
        while($result = mysqli_fetch_assoc($qdisplay))
        {
    ?>        
        <tbody>
            <tr>
                <th scope="row"><?php echo $x++; ?></th>
                <td><img src="<?php echo 'upload/'. $result['img_name']; ?>" class="card-img-top p-3" style="height:150px; width:150px; " ></td>
                <td><?php echo $result['product_name']; ?></td>
                <td><?php echo $result['product_category']; ?></td>
                <td><?php echo $result['product_sub_category']; ?></td>
                <td><?php echo $result['product_short_desc']; ?></td>
                <td><?php echo $result['product_price']; ?></td>
                <td><?php echo $result['discounted_price']; ?></td>
                <td><?php echo $result['product_quantity']; ?></td>
                <td><?php echo date('d-m-Y', strtotime($result['created'])); ?></td>
                <td><a href="/Login/add.php?id=<?php echo $result['id']; ?>" class="btn"><i class="fa fa-pencil" style="margin-left:3px; " ></i></a>
                  <a href="/Login/delete.php?id=<?php echo $result['id']; ?>" class="btn" onclick="return confirm('Are you sure you want to delete?');"><i class="fa fa-trash" ></i></a></td>
            </tr>
            
          <?php
        }
       }else{
        echo "No data found";
      }
      ?>   

<?php
}else{
    echo "<h1>Please login first .</h1>";
    header("Location:login.php");
} 
?>
</body>
</html>