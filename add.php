<?php 

include('conn.php');

if( isset($_POST['submit'])){
    // print_r($_POST); die('end');
    $id = $_POST['id'];
    $name = $_POST['pname'];
    $code = $_POST['code'];
    $category = $_POST['category'];
    $subcategory = $_POST['subcategory'];
    $filename = $_FILES['image']['name'];
    $short_desc = $_POST['short_description'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $discountprice = $_POST['discount_price'];
    $quantity = $_POST['quantity'];

    $imageFileType = strtolower(pathinfo($filename,PATHINFO_EXTENSION));
	
	$extensions_arr = array("jpg","jpeg","png","gif");

    if( in_array($imageFileType,$extensions_arr) ){
	    // Upload files and store in database
	    if(move_uploaded_file($_FILES["image"]["tmp_name"],'upload/'.$filename)){
            if(!empty($id)){
                $sql= "UPDATE `shop_products` SET 
                `product_name`='".$name."',
                `product_code`='".$code."',
                `product_category`='".$category."',
                `product_sub_category`='".$subcategory."',
                `img_name`='".$filename."',
                `product_short_desc`='".$short_desc."',
                `product_description`='".$description."',
                `product_price`='".$price."',
                `discounted_price`='".$discountprice."',
                `product_quantity`='".$quantity."' 
                WHERE `id` ='" .$id. "' ";
                // print_r($sql); die('end');
            }
            else
            {
                $sql = "INSERT INTO `shop_products`(`product_name`, `product_code`, `product_category`, `product_sub_category`, `img_name`, `product_short_desc`, `product_description`, `product_price`, `discounted_price`, `product_quantity`) VALUES ('$name','$code','$category','$subcategory','$filename','$short_desc','$description','$price', '$discountprice', '$quantity')";
                // print_r($sql); die('end');
            }
            if(!mysqli_query($conn, $sql)){
                echo 'not inserted';
            }
            else {
                echo 'inserted';
                header('Location:/Login/index.php');
            }
        }
    }
}



if (isset($_GET['id']) && $_GET['id'] != '') {
  $id = $_GET['id'];
  $query = "SELECT * FROM `shop_products` WHERE id='" . $id . "'";
  $res = mysqli_query($conn, $query);
  $results = mysqli_fetch_row($res);
  $name = $results[1];
  $code = $results[2];
  $category = $results[3];
  $sub_category = $results[4];
  $filename = $results[5];
  $short_desc = $results[6];
  $description = $results[7];
  $price = $results[8];
  $discountprice = $results[9];
  $quantity = $results[10];
  $button = "Update";
  $btnClass = "btn btn-success";

} else {
    $id = "";
  $name = "";
  $code = "";
  $category = "";
  $sub_category = "";
  $filename = "";
  $short_desc = "";
  $description = "";
  $price = "";
  $discountprice = "";
  $quantity = "";
  $button = "Add";
  $btnClass = "btn btn-primary";

}
?>






<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </head>
    <body >
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

        <div class="container">
            <form role="form" action = "" method = "post" enctype='multipart/form-data'>
            <div class="panel panel-default">
					<div class="panel-heading">
						<h6 class="panel-title"><i class="icon-library"></i> Product Details</h6>
					</div>
					<div class="panel-body">
						<div class="form-group">
							<div class="row">
								<div class="col-sm-<?php echo isset($_GET['edit'])?"3":"3";?>">
									<label>Product Name</label>
                                    <input type="name" class="form-control" name = "pname" id="name" placeholder="product name" value="<?php echo $name; ?>" required>
                                </div>

                                <div class="col-sm-<?php echo isset($_GET['edit'])?"3":"3";?>">
									<label>Product Code</label>
                                    <input type="name" class="form-control" name = "code" id="code" placeholder="product code" value="<?php echo $code; ?>" required>
                                </div>

                                <div class="col-sm-3">
									<label>Category</label>
									<select name="category"  class="form-control" id="category" onchange = "getval(this.value)" required>
                                        <option selected="true" disabled="disabled">Select</option>
                                        <option value= "Electronics" <?php if ($category == 'Electronics') echo ' selected="selected"'; ?>>Electronics</option>
                                        <option value= "Clothing" <?php if ($category == 'Clothing') echo ' selected="selected"'; ?>>Clothing</option>
                                        <option value= "Appliances" <?php if ($category == 'Appliances') echo ' selected="selected"'; ?>>Appliances</option>
									</select>
								</div>

								<div class="col-sm-3">
									<label>Sub Category Type</label>
									<select class="form-control" id="subcategory" name="subcategory" required>
                                        <option selected="true" disabled="disabled">Select</option>
                                    </select>
                                </div>
                            </div>
                        </div><br>
                        <div class="form-group">
							<div class="row">
								
							        <div class="col-sm-3">
								        <label>Short Description</label>
									    <textarea name="short_description"  class="form-control" rows="5"><?php echo $short_desc; ?></textarea>
							        </div>
								    <div class="col-sm-3">
									    <label>Product Description</label>
									    <textarea name="description"  class="form-control" rows="5"><?php echo $description; ?></textarea>
								    </div>
                                    <div class="col-sm-3">
									    <label>Main Product Image</label>
									    <input type="file" class="form-control" name="image"value="<?php echo $filename; ?>"  id="" data-image-index="0" /><br>
								    
									    <label>Available Quantity</label>
									    <input type="number" min="0" class="form-control" name="quantity" value="<?php echo $quantity; ?>" />
								    </div>

                                    <div class="col-sm-3">
									    <label>Price</label>
									    <input type="number" min="1" class="form-control"  name="price" value="<?php echo $price; ?>" /><br>
								    
									    <label>Discounted Price</label>
									    <input type="nummber" min="0" class="form-control" name="discount_price" value="<?php echo $discountprice; ?>" />
								    </div>
								
							</div>
						</div><br>
                        
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <button type="submit" name="submit" class ="<?php echo $btnClass; ?>" value="ADD products" style="float: right;" ><?php echo $button; ?></button>
                    </div>
                </div>
            </form>
        </div>
    <script>

            var url_string= window.location.href
            var url = new URL(url_string);
            var id = url.searchParams.get("id");

            function getval(data){

            const xhr = new XMLHttpRequest()
            xhr.open('GET','http://localhost/Login/itemval.php?selectvalue=' +data,'TRUE')
            xhr.send()

            xhr.onreadystatechange = function(){
                if(xhr.readyState == 4 && xhr.status == 200){
                    document.getElementById('subcategory').innerHTML = xhr.responseText
                }
            }
        }

        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
        
        if(id!= ''){
            var cat= document.getElementById("category").value
            getval(cat)
        }
    </script>
    </body>
</html>
<style>
.card-form{
    height: 575px;
    width: 300px;
    background: honeydew;
}

</style>

