<?php

if ($dashboard) {
    $fetch_earn = fetch_data("earnings", "=", "id", "1");
    $count_earnings  = $fetch_earn['total_amount'];
    $count_sales = count_e("sales");
    $count_invoices = count_e("invoices");
    $count_products = mysqli_num_rows(fetch_data_while("products"));
    $count_categories = mysqli_num_rows(fetch_data_while("categories"));

?>
    <div class="container" style="padding: 3%;background-color: white;border-radius:20px;">

        <?php
        if (isset($_SESSION['super_admin'])) {
        ?>
            <section class="section">
                <div class="row">

                    <div class="col-lg-4 col-md-3 col-sm-12">
                        <a style="text-decoration: none;" href="index.php?page=sales&type=view">
                            <div class="card card-statistic-2">
                                <div class="card-chart">
                                    <canvas id="balance-chart" height="80"></canvas>
                                </div>
                                <div class="card-icon shadow-primary bg-success text-white">
                                    <i class="fa-solid fa-check"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>Sales</h4>
                                    </div>
                                    <div class="card-body">
                                        &nbsp;<?= $count_sales ?>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-md-3 col-sm-12">
                        <a style="text-decoration: none;" href="index.php?page=invoice&type=view">
                            <div class="card card-statistic-2">
                                <div class="card-chart">
                                    <canvas id="sales-chart" height="80"></canvas>
                                </div>
                                <div class="card-icon shadow-primary bg-dark text-white">
                                    <i class="fa-solid fa-receipt"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>invoices</h4>
                                    </div>
                                    <div class="card-body">
                                        <?= $count_invoices ?>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-md-3 col-sm-12">
                        <div class="card card-statistic-2">
                            <div class="card-chart">
                                <canvas id="sales-chart2" height="80"></canvas>
                            </div>
                            <div class="card-icon shadow-primary bg-warning text-white">
                                <i class="fa-solid fa-sack-dollar"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>earning</h4>
                                </div>
                                <div class="card-body">
                                    Rs.<?= number_format($count_earnings) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <canvas id="myChart" style="display:none;" height="158"></canvas>



            </section>
        <?php } ?>
        <style>
            .circle-btn {
                width: 100%;
                height: auto;
                border-radius: 4%;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                font-size: 16px;
                text-align: center;
                padding: 10px;

            }

            .btn-01 {
                background-color: #040404;
                border-color: #156ef1;
            }

            .btn-02 {
                background-color: #00a305e3;
                border-color: #156ef1;
            }

            .btn-03 {
                background-color: #cf7b00;
                border-color: #156ef1;
            }

            .circle-btn i {
                font-size: 50px;
                margin-bottom: 5px;
            }

            .circle-btn span {
                font-size: 12px;
            }
        </style>
        <section class="section mb-5">
            <h1 class="text-white bg-dark w-100 mb-3 mt-3 p-3 text-center">Dashboard</h1>
            <div class="row">
                <div class="col-lg-4">
                    <button onclick="gen_inv()" class="circle-btn btn btn-primary btn-01">
                        <i class="fa-solid fa-receipt"></i>
                        <span>Generate Invoice</span>
                    </button>
                </div>
                <div class="col-lg-4">
                    <button onclick="add_products()" class="circle-btn btn btn-primary btn-02">
                        <i class="fa-brands fa-product-hunt"></i>
                        <span>Add Products</span>
                    </button>
                </div>
                <div class="col-lg-4">
                    <button onclick="add_categories()" class="circle-btn btn btn-primary btn-03">
                        <i class="fa-solid fa-layer-group"></i>
                        <span>Add Categories</span>
                    </button>
                </div>
            </div>
        </section>
        <section class="section">
            <div class="row">


                <div class="col-lg-6 col-md-3 col-sm-12">
                    <div class="card card-statistic-2 bg-dark text-white">

                        <div class="card-icon shadow-primary bg-primary">
                            <i class="fa-brands fa-product-hunt text-white"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header text-white">
                                <h4>Products</h4>
                            </div>
                            <div class="card-body text-white">
                                <?= $count_products ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-3 col-sm-12">
                    <div class="card card-statistic-2 bg-dark">

                        <div class="card-icon shadow-primary bg-primary">
                            <i class="fa-sharp-duotone fa-solid fa-layer-group text-white"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header text-white">
                                <h4>Categories</h4>
                            </div>
                            <div class="card-body text-white">
                                <?= $count_categories ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>





        </section>
    </div>
<?php }


if ($inventory) {
?>

    <div class="container" style="padding: 3%;background-color: white;border-radius:20px;">
        <h5 class="text-center bg-dark p-3 mt-3 mb-3 text-white">Inventory</h5>
        <form action="" method="post">
            <div class="row mb-3 mt-3">
                <div class="col-lg-12">
                    <input id="serial_number" type="text" placeholder="search by serial number" class="form-control">

                </div>
            </div>
        </form>

        <table class="table table-responsive table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th id="sel" style="display: none;">Select</th>
                    <th>Product Name</th>
                    <th>Product Serial_No</th>

                    <th>Quantity</th>
                    <th>Price</th>

                    <th>Category</th>
                    <th>Image 1</th>
                    <th>Action</th>


                </tr>
            </thead>
            <tbody id="product_details" style="display: none;"></tbody>
            <tbody id="pro">
                <?php
                $i = 1;
                $categories = [];
                while ($row_pro = mysqli_fetch_assoc($products_page)) {

                    $categories[] = $row_pro['cat_id'];
                    foreach ($categories as $category_id) {
                        $category_n = fetch_data("categories", "=", "id", $category_id);
                        $category_name = $category_n['category_name'];
                    }
                ?>

                    <tr>
                        <td><?= $i ?></td>
                        <td><?= $row_pro['product_name'] ?></td>
                        <td>#<?= $row_pro['serial_no'] ?></td>

                        <td><?= $row_pro['qty'] ?></td>
                        <td><?= $row_pro['price'] ?></td>


                        <td><?= $category_name ?></td>
                        <td><img src="<?= $row_pro['image_1'] ?>" width="90px" height="90px" alt=""></td>
                        <td>
                            <a class="btn btn-primary" href="index.php?page=inventory&type=edit&id=<?= $row_pro['id'] ?>"><i class="fa-regular fa-pen-to-square"></i></a>
                            <a class="btn btn-success" href="index.php?page=invoice&type=gen&id=<?= $row_pro['id'] ?>"><i class="fa-solid fa-file-invoice-dollar"></i></a>


                            <a class="btn btn-danger" href="index.php?page=inventory&type=delete&id=<?= $row_pro['id'] ?>"><i class="fa-solid fa-trash"></i></a>
                        </td>

                    </tr>
                <?php
                    $i++;
                }

                ?>


            </tbody>
        </table>

    </div>
<?php
}
if ($add_products) {
    $serial_number = serial_number();
?>

    <div class="container" style="padding: 3%;background-color: white;border-radius:20px;">
        <h5 class="text-center text-white bg-dark p-3 mt-3 mb-3">Inventory Add Items</h5>

        <form method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-lg-4">
                    <label>Product Name</label>
                    <input name="product_name" required type="text" class="form-control" />

                </div>
                <div class="col-4">
                    <label>Serial Number</label>
                    <input name="serial_no" disabled value="#<?= $serial_number ?>" required type="text" class="form-control" />
                    <input name="serial_no" value="<?= $serial_number ?>" required type="hidden" class="form-control" />

                </div>
                <div class="col-lg-4">
                    <label>Category</label>
                    <select name="category_id" required class="form-control text-dark" id="">
                        <option selected disabled value="-">---Select---</option>
                        <?php
                        $cat = fetch_data_while("categories");
                        while ($row_cat = mysqli_fetch_assoc($cat)) {
                        ?>

                            <option value="<?= $row_cat['id'] ?>"><?= $row_cat['category_name'] ?></option>


                        <?php
                        }

                        ?>

                    </select>

                </div>
            </div>

            <div class="row mt-4">

                <div class="col-3 col-md-6 co-sm-12 ">
                    <label>Stock Quantity</label>
                    <input name="qty" required type="number" class="form-control" />

                </div>
                <div class="col-3 col-md-6 co-sm-12">
                    <label>Retail Price</label>
                    <input name="price" required type="number" class="form-control" />

                </div>
                <div class="col-3 col-md-6 co-sm-12 mt-3">
                    <label>Whole Sale Price</label>
                    <input name="w_sale_price" type="number" required class="form-control" />


                </div>
                <div class="col-3 col-md-6 co-sm-12 mt-3">
                    <label>Image 1</label>
                    <input name="pro_img1" required type="file" class="form-control" />


                </div>


            </div>

            <button class="btn btn-primary mt-5" name="add_product" type="submit">Add Product</button>
        </form>



    </div>



<?php
}

if ($category_add) {
?>

    <div class="container" style="padding: 3%;background-color: white;border-radius:20px;">
        <h5 class="text-center text-white bg-dark p-3 mt-3 mb-3">Categories</h5>

        <form method="post">
            <div class="row">
                <div class="col-lg-6">
                    <label>Category Name</label>
                    <input name="category_name" required type="text" class="form-control" />
                    <p class="help-block">Type Category Name here</p>
                </div>
                <div class="col-lg-6">
                    <label>Category Description</label>
                    <textarea name="category_desc" required class="form-control"></textarea>

                    <p class="help-block">Type Category Description here</p>
                </div>
            </div>


            <button class="btn btn-primary" name="add_category" type="submit">Add Category</button>
        </form>



    </div>




<?php
}

if ($del_product && isset($_GET['id'])) {
    $id = $_GET['id'];
    $del = delete_data("products", "=", "id", $id);
    if ($del) {
        echo '<script>window.history.back()</script>';
    }
}

if ($edit_product && isset($_GET['id'])) {
    $id = $_GET['id'];
    $row_edit = fetch_data("products", "=", "id", $id);
?>

    <div class="container" style="padding: 3%;background-color: white;border-radius:20px;">
        <h5 class="text-center bg-dark p-3 mt-3 mb-3 text-white">Inventory Update Items</h5>

        <form method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $row_edit['id'] ?>">
            <div class="row">
                <div class="col-lg-4">
                    <label>Product Name</label>
                    <input name="product_name" required type="text" value="<?= $row_edit['product_name'] ?>" class="form-control" />

                </div>
                <div class="col-lg-4">
                    <label>Serial Number</label>
                    <input name="-" value="#<?= $row_edit['serial_no'] ?>" disabled required class="form-control">

                </div>
                <div class="col-lg-4">
                    <label>Category</label>
                    <select name="category_id" required class="form-control selectric text-dark" id="">
                        <option selected disabled value="-">---Select---</option>
                        <?php
                        $cat = fetch_data_while("categories");
                        while ($row_cat = mysqli_fetch_assoc($cat)) {
                            if ($row_edit['cat_id'] == $row_cat['id']) {
                                $selected = "selected";
                            } else {
                                $selected = "";
                            }
                        ?>

                            <option <?= $selected ?> value="<?= $row_cat['id'] ?>"><?= $row_cat['category_name'] ?></option>


                        <?php
                        }

                        ?>

                    </select>

                </div>
            </div>

            <div class="row mt-3 mb-4">
                <div class="col-3 col-md-6 col-sm-12">
                    <label>Stock Quantity</label>
                    <input name="qty" value="<?= $row_edit['qty'] ?>" type="text" class="form-control" />
                </div>
                <div class="col-3 col-md-6 col-sm-12">
                    <label>Price</label>
                    <input name="price" value="<?= $row_edit['price'] ?>" type="text" class="form-control" />
                </div>
                <div class="col-3 col-md-6 co-sm-12 mt-3">
                    <label>Whole Sale Price</label>
                    <input value="<?= $row_edit['w_sale_price'] ?>" name="w_sale_price" type="number" required class="form-control" />


                </div>
                <div class="col-3 col-md-6 col-sm-12">
                    <label>Image 1</label>
                    <input name="pro_img1" type="file" class="form-control" />
                    <img src="<?= $row_edit['image_1'] ?>" width="100px" height="100px" alt="">

                </div>

            </div>

            <button class="btn btn-primary mt-3 mb-3" name="update_products" type="submit">Update Product</button>

        </form>



    </div>

<?php
}

if ($category) {
?>

    <div class="container" style="padding: 3%;background-color: white;border-radius:20px;">
        <h5 class="text-center bg-dark p-3 mt-3 mb-3 text-white">Inventory Categories <a style="margin-left: 30px;text-decoration: none;color:white;background-color: greenyellow;padding:5px;" href="index.php?page=category&type=add"><i class="fa fa-solid fa-plus"></i></a></h5>
        <table class="table table-responsive table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Category Name</th>

                    <th>Action</th>


                </tr>
            </thead>
            <tbody>
                <?php
                $categories = fetch_data_while("categories");
                $i = 1;
                while ($row_cat = mysqli_fetch_assoc($categories)) {
                ?>
                    <tr>
                        <td><?= $i ?></td>
                        <td><?= $row_cat['category_name'] ?></td>
                        <td>
                            <a class="btn btn-primary" href="index.php?page=category&type=edit&id=<?= $row_cat['id'] ?>"><i class="fa-solid fa-pen-to-square"></i></a>
                            <a class="btn btn-danger" href="index.php?page=category&type=delete&id=<?= $row_cat['id'] ?>"><i class="fa-solid fa-trash"></i></a>
                        </td>

                    </tr>
                <?php
                    $i++;
                }

                ?>


            </tbody>
        </table>

    </div>

<?php
}








if ($del_invoice && isset($_GET['id'])) {
    $id = $_GET['id'];
    $sales = fetch_data("sales");
    $invoice_call = fetch_data("invoices", "=", "id", $id);
    $pro_call = fetch_data("products", "=", "id", $invoice_call['pro_id']);
    $new_qty_p = $pro_call['quantity'] + $invoice_call['qty'];
    $new_sales = $sales['sales'] - $invoice_call['qty'];
    $new_earning = $sales['earning'] - $invoice_call['total'];
    $process_1 =  update("products", ['quantity'], [$new_qty_p], "=", "id", $invoice_call['pro_id']);
    $process_2 =  update("sales", ['sales', 'earning'], [$new_sales, $new_earning], "=", "id", "1");



    if ($process_1 && $process_2) {
        delete_data("invoices", "=", "id", $id);
        echo '
        
        
        <script>
        
        
        window.location.href="index.php?page=invoice&type=view"</script>';
    }
}


if ($category_edit && isset($_GET['id'])) {
    $id = $_GET['id'];
    $category = fetch_data("categories", "=", "id", $id);
?>
    <div class="container" style="padding:3%;background-color: white;border-radius: 20px;">
        <h1 class="text-center text-white p-3 mt-3 mb-3 bg-dark">Edit Category</h1>
        <form method="post">
            <input type="hidden" value="<?= $id ?>" name="id">
            <div class="row">
                <div class="col-lg-6">
                    <label class="form-label">Category Name</label>
                    <input type="text" class="form-control" name="category_name" value="<?= $category['category_name'] ?>" required>
                </div>
                <div class="col-lg-6">
                    <label class="form-label">Category Description</label>
                    <textarea name="category_desc" required class="form-control" id=""><?= $category['category_desc'] ?></textarea>
                </div>

            </div>

            <button class="btn btn-success mt-4" type="submit" name="update_category">Update Category</button>



        </form>





    </div>

<?php
}

if ($config) {
    $config = fetch_data("website");
?>

    <div style="padding: 3%; background-color: white; border-radius: 20px;" class="container">
        <h1 class="bg-dark text-white text-center mb-3 p-3">Website Config</h1>
        <form action="" method="post" enctype="multipart/form-data">

            <div class="row">
                <div class="col-lg-6">
                    <label for="" class="form-label">Website Name</label>
                    <input type="text" name="website_name" value="<?= $config['website_name'] ?>" required class="form-control">

                </div>
                <div class="col-lg-6">
                    <label for="" class="form-label">Website Mode</label>
                    <select class="form-control" name="website_mode" id="">
                        <?php

                        $selected_1 = "";
                        $selected_2 = "";


                        if ($config['website_mode'] == 1) {
                            $selected_1 = "selected";
                        } elseif ($config['website_mode'] == 0) {
                            $selected_2 = "selected";
                        }
                        ?>
                        <option <?= $selected_1 ?> value="1">Maintenance Mode</option>
                        <option <?= $selected_2 ?> value="0">Active</option>
                    </select>
                </div>

            </div>

            <div class="row mt-4">
                <div class="col-lg-6">
                    <label for="" class="form-label">Contact Email</label>
                    <input type="email" name="contact_email" required value="<?= $config['contact_email'] ?>" class="form-control">
                </div>
                <div class="col-lg-6">
                    <label for="" class="form-label">Contact Phone</label>
                    <input type="number" name="contact_phone" required value="<?= $config['contact_phone'] ?>" class="form-control">
                </div>


            </div>

            <button class="btn btn-dark mt-3 mb-3" name="update_config" type="submit">Update</button>


        </form>




    </div>




<?php
}


if ($gen_inv && isset($_GET['id'])) {
    $id = $_GET['id'];
    $row_in = fetch_data("products", "=", "id", $id);
?>

    <div style="padding: 3%; border-radius:20px; background-color:white;" class="container">
        <h1 class="text-white text-center bg-dark p-3 mb-3 ">Invoice System</h1>


        <form id="inv_form" method="post">
            <div class="row">
                <div class="col-lg-4">
                    <label for="" class="form-label">Product Name</label>
                    <input type="text" value="<?= $row_in['product_name'] ?>" disabled name="pro_name" required class="form-control">
                    <input type="hidden" value="<?= $row_in['product_name'] ?>" name="pro_name">
                </div>
                <div class="col-lg-4">
                    <label for="" class="form-label">Product Serial Number</label>
                    <input type="text" value="<?= $row_in['serial_no'] ?>" disabled name="pro_serial" required class="form-control">
                    <input type="hidden" value="<?= $row_in['serial_no'] ?>" name="pro_serial">
                </div>
                <div class="col-lg-4">
                    <label for="" class="form-label">Invoice ID</label>
                    <input type="text" id="inva_id" value="#INV<?= serial_number() ?>" disabled required class="form-control">
                </div>
            </div>
            <div class="row mt-4 mb-4">
                <div class="col-lg-3">
                    <label for="" class="form-label">Product Quantity</label>
                    <input type="number" id="inv_qty" value="1" name="pro_qty" required class="form-control">
                </div>
                <div class="col-lg-3">
                    <label for="" class="form-label">Product Price</label>
                    <input type="text" id="inv_price" disabled value="<?= $row_in['price'] ?>" name="pro_price" required class="form-control">
                    <input type="hidden" id="inv_price_original" value="<?= $row_in['price'] ?>" name="pro_price">
                </div>
                <div class="col-lg-3">
                    <label for="" class="form-label">Customer Price</label>
                    <input class="form-control" type="number" id="customer_price" value="" name="c_price">
                </div>
                <div class="col-lg-3">
                    <label for="" class="form-label">Invoice Current Date</label>
                    <input type="text" disabled value="<?= date('d-m-y') ?>" required class="form-control">
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-lg-8">
                    <label for="" class="form-label">Product Image</label>
                    <br>
                    <img src="<?= $row_in['image_1'] ?>" width="90px" height="90px" alt="">
                </div>
                <div class="col-lg-4">
                    <button type="button" onclick="submitForm()" name="gen_inv" class="btn btn-success mt-5">Generate Bill</button>
                </div>
            </div>
        </form>

        <div class="row mt-3">
            <div class="col-lg-8 mt-5">
                <h2 class="mt-5 bg-dark text-white p-3">Bill Reciept <b style="float: right;">-></b></h2>
            </div>
            <div class="col-lg-4" id="printableReceipt">
                <style>
                    .receipt {
                        font-family: Arial, sans-serif;
                        width: 80mm;
                        margin: 0;
                        padding: 0;
                    }

                    .receipt {
                        padding: 10px;
                        border: 1px solid #000;
                    }

                    .receipt h1 {
                        text-align: center;
                        font-size: 24px;
                        margin: 0;
                    }

                    .receipt p {
                        margin: 0;
                        font-size: 14px;
                        line-height: 1.5;
                    }

                    .receipt .store-details,
                    .receipt .customer-details,
                    .receipt .items,
                    .receipt .total,
                    .receipt .footer {
                        margin-bottom: 10px;
                    }

                    .receipt .items table {
                        width: 100%;
                        border-collapse: collapse;
                    }

                    .receipt .items th,
                    .receipt .items td {
                        text-align: left;
                        font-size: 14px;
                        padding: 5px 0;
                        width: 20px;

                    }

                    .receipt .items th {
                        border-bottom: 1px solid #000;
                    }

                    .receipt .total p {
                        text-align: right;
                        font-weight: bold;
                    }

                    .receipt .footer {
                        text-align: center;
                        font-size: 12px;
                    }


                    @media print {
                        #printableReceipt {
                            width: 80mm;
                            /* Typical width for thermal printer paper */
                            font-size: 12px;
                            /* Adjust the font size for readability */
                            margin: 0;
                            padding: 10px;
                        }

                        #printableReceipt h1 {
                            font-size: 18px;
                            /* Adjust header size */
                            margin-bottom: 5px;
                            text-align: center;
                        }

                        #printableReceipt p,
                        #printableReceipt td {
                            font-size: 12px;
                            /* Standardize text size */
                        }

                        #printableReceipt .items th,
                        #printableReceipt .items td {
                            padding: 5px;
                            text-align: left;
                        }

                        #printableReceipt .total p {
                            font-size: 14px;
                            text-align: right;
                        }

                        #printableReceipt .footer {
                            text-align: center;
                            margin-top: 20px;
                            font-size: 12px;
                        }
                    }
                </style>

                <div class="receipt">
                    <h1><?= $website['website_name'] ?></h1>
                    <p class="store-details">
                        Shop #M-140 Floor Mezzanine Rashid <br>
                        Minhas Road Millinium Mall , Karachi<br>
                        Phone: 0333-6615905
                    </p>
                    <div id="flexis" style="display: flex; justify-content: space-between;">
                        <p class="customer-details">
                            Date: <?= date('d-m-y') ?><br>
                            Invoice: <b id="inv_id"></b>
                        </p>
                        <img src="al-asif-qr.PNG" id="qr-code" width="70px" height="70px" alt="">
                    </div>
                    <div class="items">
                        <table>
                            <thead>
                                <tr>
                                    <th>Description</th>
                                    <th>Qty</th>
                                    <th>Price</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td id="item_description"><?= $row_in['product_name'] ?></td>
                                    <td id="recipt_qty"></td>
                                    <td id="total_re"></td>
                                    <td id="reciept_total">Rs. </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="total">
                        <p id="inner_sub_total_re"></p>
                        <p>Tax (0%): Rs. 0</p>
                        <p id="inner_total_re"></p>
                    </div>
                    <div class="footer">
                        <p>Thank you for Shopping</p>
                        <p>Developer Marcode Solutions</p>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        function submitForm() {
            var userConfirmed = confirm("Are you sure you want to continue?");
            if (userConfirmed) {
                var invoice_id = $('#inva_id').val();
                console.log(invoice_id);
                var form = document.getElementById("inv_form");
                var formData = new FormData(form);
                formData.append('gen_inv', true);
                formData.append('invoice_id', invoice_id); // Append the invoice_id to the FormData

                $.ajax({
                    url: 'functions/brain.php',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        console.log('Raw server response:', response);

                        printReceipt();
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error:', status, error);
                        console.error('Response text:', xhr.responseText);
                    }
                });
            } else {
                alert("Operation canceled.");
            }
        }



        function printReceipt() {
            var printContents = document.getElementById('printableReceipt').innerHTML;
            var printWindow = window.open('', '', 'height=400,width=300'); // Adjusted window size to simulate thermal printer

            printWindow.document.write('<html><head><title>Print Receipt</title>');
            printWindow.document.write('<style>@media print {' +
                '#printableReceipt { width: 80mm; font-size: 12px; margin: 0; padding: 10px; }' +
                '#printableReceipt h1 { font-size: 18px; margin-bottom: 5px; text-align: center; }' +
                '#printableReceipt p, #printableReceipt td { font-size: 12px; }' +
                '#printableReceipt .items th, #printableReceipt .items td { padding: 5px; text-align: left; }' +
                '#printableReceipt .total p { font-size: 14px; text-align: right; }' +
                '#printableReceipt .footer { text-align: center; margin-top: 20px; font-size: 12px; }' +
                '}</style>');
            printWindow.document.write('</head><body>');
            printWindow.document.write(printContents);
            printWindow.document.write('</body></html>');

            printWindow.document.close();

            // Wait for images to load before printing
            printWindow.onload = function() {
                var qrCodeImg = printWindow.document.getElementById('qr-code');
                if (qrCodeImg && !qrCodeImg.complete) {
                    qrCodeImg.onload = function() {
                        printWindow.print();
                    };
                } else {
                    printWindow.print();
                }
            };

            // After printing, redirect
            printWindow.onafterprint = function() {


                printWindow.close();
                window.location.href = "index.php?page=invoice&type=view";



            };
        }
    </script>
<?php
}

if ($view_invoices) {
    $fetch_inva = fetch_data_while("invoices");
?>

    <div class="container" style="padding: 3%; background-color:white; border-radius:20px;">
        <h1 class="text-center text-white bg-dark p-3 mt-3 mb-4">Invoices</h1>
        <form action="" method="post">
            <div class="row mb-3 mt-3">
                <div class="col-lg-12">
                    <input id="invoice_ids" name="invoice_ids" type="text" placeholder="search by Invoice id" class="form-control">

                </div>
            </div>
        </form>
        <div
            class="table-responsive">
            <table
                class="table table-dark ">
                <thead>
                    <tr>
                        <th scope="col">SNO.</th>
                        <th scope="col">Invoice ID</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Product Quantity</th>
                        <th scope="col">Product Serials</th>



                        <th scope="col">Actual Invoice Price</th>
                        <th scope="col">Selled at</th>

                        <th scope="col">Date Sale</th>
                        <th scope="col">Actions</th>



                    </tr>
                </thead>
                <tbody id="searched_invoices" style="display: none;"></tbody>
                <tbody id="default_invoices">
                    <?php

                    $i = 1;
                    while ($row_invoices = mysqli_fetch_assoc($fetch_inva)) {
                    ?>

                        <tr class="">
                            <td scope="row"><?= $i; ?></td>
                            <td>#<?= $row_invoices['invoice_id'] ?></td>
                            <td><?= $row_invoices['product_name'] ?></td>
                            <td><?= $row_invoices['qty'] ?></td>
                            <td><?= $row_invoices['pro_serial'] ?></td>


                            <td><?= $row_invoices['price'] ?></td>
                            <td><?= $row_invoices['c_price'] ?></td>

                            <td><?= $row_invoices['date'] ?></td>
                            <?php
                            if (isset($_SESSION['super_admin'])) {
                            ?>
                                <td>

                                    <a class="btn btn-danger" href="index.php?page=invoices&type=del&id=<?= $row_invoices['id'] ?>"><i class="fa-solid fa-trash"></i></a>
                                </td>
                            <?php
                            } else {
                                echo '<td><i disabled class="fa-solid fa-ban text-danger" style="font-size: 23px;"></i></td>';
                            }
                            ?>


                        </tr>
                    <?php
                        $i++;
                    }

                    ?>


                </tbody>
            </table>
        </div>



    </div>



<?php
}
if ($delete_invoice && isset($_GET['id'])) {
    $id = $_GET['id'];
    $pro_serial1 = [];
    $qtys1 = [];

    $fetch_inv_del = fetch_data("invoices", "=", "id", $id);
    $invoice_id = isset($fetch_inv_del['invoice_id']) ? $fetch_inv_del['invoice_id'] : '';

    if ($fetch_inv_del) {
        $pro_serials1 = isset($fetch_inv_del['pro_serial']) ? explode(',', $fetch_inv_del['pro_serial']) : [];
        $qtys1 = isset($fetch_inv_del['pro_qty']) ? explode(',', $fetch_inv_del['pro_qty']) : [];



        foreach ($pro_serials1 as $index => $pro_serial) {
            $pro_serial1 = trim($pro_serial);
            $qty1 = isset($qtys1[$index]) ? (int) trim($qtys1[$index]) : 0;



            $pro_fetch = fetch_data("products", "=", "serial_no", $pro_serial1);

            if ($pro_fetch) {
                $old_qty = $pro_fetch['qty'];
                $new_qty = $old_qty + $qty1;


                $fetch_earning = fetch_data("earnings", "=", "id", "1");
            }
        }
        if ($fetch_earning) {
            $price1 = abs((float)$fetch_inv_del['c_price']);
            $old_earning = abs((float)$fetch_earning['total_amount']);
            $new_earning =   $old_earning - $price1;

            update("products", ['qty'], [$new_qty], "=", "serial_no", $pro_serial1);


            update("earnings", ['total_amount'], [$new_earning], "=", "id", "1");
        }

        delete_data("sales", "=", "invoice_id", $invoice_id);
        if (delete_data("invoices", "=", "id", $id)) {
            if ($price1 < 0) {
                echo "Warning: Price1 is negative. Value: $price1<br>";
            }

            if ($old_earning < 0) {
                echo "Warning: Old Earning is negative. Value: $old_earning<br>";
            }
            echo '<script>window.history.back()</script>';
        }
    } else {

        echo '<script>alert("Invoice not found."); window.history.back();</script>';
    }
}



if ($select_product_to_gen_inv) {
?>
    <div class="container" style="padding: 3%;background-color: white;border-radius:20px;">
        <h5 class="text-center bg-dark p-3 mt-3 mb-3 text-white">Select Product to Generate Invoice</h5>
        <form action="" method="post">
            <div class="row mb-3 mt-3">
                <div class="col-lg-12">
                    <input id="serial_number" type="text" placeholder="search by serial number" class="form-control">

                </div>

            </div>
            <div class="row mb-3 mt-3">
                <div class="col-lg-12">
                    <input class="form-control" type="text" id="category-search" placeholder="Search by category name...">
                </div>
            </div>
        </form>
        <form id="invoice_form" method="post">
            <table class="table table-responsive table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Select</th>
                        <th>Product Name</th>
                        <th>Product Serial_no</th>

                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Category</th>
                        <th>Image 1</th>
                        <th>Action</th>

                    </tr>
                </thead>
                <tbody id="product_details" style="display: none;"></tbody>
                <tbody id="product-results"></tbody>
            </table>
            <button type="submit" name="gen_inv_selected" class="btn btn-success">Generate Invoice for Selected Products</button>
        </form>

    </div>

<?php
}

if ($manage_acc) {
    $fetch_users_all = fetch_data_while("users");
?>
    <div class="container" style="padding: 3%;background-color: white;border-radius:20px;">
        <h5 class="text-center bg-dark p-3 mt-3 mb-3 text-white">Users</h5>

        <div class="table-responsive">
            <table class="table table-striped  table-bordered table-hover w-100">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Fullname</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Action</th>


                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    while ($row_users = mysqli_fetch_assoc($fetch_users_all)) {
                    ?>
                        <tr>
                            <td><?= $i; ?></td>
                            <td><?= $row_users['fullname'] ?></td>
                            <td><?= $row_users['email'] ?></td>
                            <td><?php if ($row_users['role'] === "775") {
                                    echo 'Super Admin';
                                } else {
                                    echo 'Seller';
                                } ?></td>
                            <td>
                                <?php
                                if (isset($_SESSION['super_admin'])) {
                                    echo '
                            <a href="index.php?page=manage_acc&type=edit&id=' . $row_users['id'] . '" class="btn btn-primary"><i class="fa-solid fa-pen-to-square"></i></a>';
                                }
                                ?>
                            </td>

                        </tr>
                    <?php
                    }

                    ?>


                </tbody>

            </table>
        </div>
    </div>




<?php
}

if ($invoice_for_selected && isset($_SESSION['get_selected_pro'])) {
    $ids = $_SESSION['get_selected_pro'];
    foreach ($ids as $id) {
        $row_in = fetch_data("products", "=", "id", $id);
        $serial[] = $row_in['serial_no'];
        $product_name[] = $row_in['product_name'];
        $images[] = $row_in['image_1'];
        $price[] = $row_in['price'];
    }
?>

    <div style="padding: 3%; border-radius:20px; background-color:white;" class="container">
        <h1 class="text-white text-center bg-dark p-3 mb-3 ">Invoice System</h1>

        <form id="invoice_form" method="post">
            <div class="row">
                <div class="col-lg-4">
                    <label for="" class="form-label">Product Names</label>
                    <?php
                    foreach ($product_name as $name) {
                        echo '<input type="hidden" value="' . $name . '" name="pro_name[]">';
                    }
                    ?>
                    <input type="text" value="<?php echo implode(' / ', $product_name); ?>" disabled class="form-control">
                </div>
                <div class="col-lg-4">
                    <label for="" class="form-label">Products Serial Number</label>
                    <?php
                    foreach ($serial as $ser) {
                        echo '<input type="hidden" value="' . $ser . '" name="pro_serial[]">';
                    }
                    ?>
                    <input type="text" value="<?php echo implode(' / ', $serial); ?>" disabled class="form-control">
                </div>
                <div class="col-lg-4">
                    <label for="" class="form-label">Invoice ID</label>
                    <input type="text" id="invoice_id_display" value="INV<?= serial_number() ?>" disabled required class="form-control">

                </div>
            </div>
            <div class="row mt-4 mb-4">
                <div class="col-lg-3">
                    <?php
                    $i = 1;
                    foreach ($price as $index => $pri_ce) {
                        echo '
                     
                <label for="" class="form-label">Product ' . $i . ' Customer Price</label>
                
                <input type="text" id="customer_price_' . $i . '"   name="pro_c_prices[]" required class="form-control mb-3">
                ';
                        $i++;
                    }
                    ?>
                </div>
                <div class="col-lg-3">
                    <?php
                    $i = 1;
                    foreach ($product_name as $index => $p_qty) {
                        echo '
                <label for="" class="form-label">Product ' . $i . ' Quantity</label>
                <input type="number" id="quantity_' . $i . '" value="0" name="pro_qty[]" required class="form-control mb-3">
                ';
                        $i++;
                    }
                    ?>
                </div>
                <div class="col-lg-3">
                    <?php
                    $i = 1;
                    foreach ($price as $index => $pri_ce) {
                        echo '
                <label for="" class="form-label">Product ' . $i . ' Price</label>
                <input type="hidden" id="hidden_price_' . $i . '" value="' . $pri_ce . '" name="pro_price[]">
                <input type="text" id="price_' . $i . '" data-original-price="' . $pri_ce . '" disabled value="' . $pri_ce . '" name="pro_price[]" required class="form-control mb-3">
                ';
                        $i++;
                    }
                    ?>
                </div>

                <div class="col-lg-3">
                    <label for="" class="form-label">Invoice Current Date</label>
                    <input type="text" disabled value="<?= date('d-m-y') ?>" required class="form-control">
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-lg-8">
                    <label for="" class="form-label">Product Images</label>
                    <br>
                    <?php
                    foreach ($images as $image) {
                        echo '
                <img src="' . $image . '" width="90px" height="90px" alt="">&nbsp;&nbsp;
                ';
                    }
                    ?>
                </div>
                <div class="col-lg-4">
                    <button type="button" onclick="submitForm()" name="gen_inv_bulk" class="btn btn-success mt-5">Generate Bill</button>
                </div>
            </div>
        </form>



        <div class="row mt-3">
            <div class="col-lg-8 mt-5">
                <h2 class="mt-5 bg-dark text-white p-3">Bill Receipt <b style="float: right;">-></b></h2>
            </div>
            <div class="col-lg-4" id="printableReceipt">
                <style>
                    .receipt {
                        font-family: Arial, sans-serif;
                        width: 80mm;
                        margin: 0;
                        padding: 0;
                    }

                    .receipt {
                        padding: 10px;
                        border: 1px solid #000;
                    }

                    .receipt h1 {
                        text-align: center;
                        font-size: 24px;
                        margin: 0;
                    }

                    .receipt p {
                        margin: 0;
                        font-size: 14px;
                        line-height: 1.5;
                    }

                    .receipt .store-details,
                    .receipt .customer-details,
                    .receipt .items,
                    .receipt .total,
                    .receipt .footer {
                        margin-bottom: 10px;
                    }

                    .receipt .items table {
                        width: 100%;
                        border-collapse: collapse;
                    }

                    .receipt .items th,
                    .receipt .items td {
                        text-align: left;
                        font-size: 14px;
                        padding: 5px 0;
                        width: 20px;

                    }

                    .receipt .items th {
                        border-bottom: 1px solid #000;
                    }

                    .receipt .total p {
                        text-align: right;
                        font-weight: bold;
                    }

                    .receipt .footer {
                        text-align: center;
                        font-size: 12px;
                    }


                    @media print {
                        #printableReceipt {
                            width: 80mm;
                            /* Typical width for thermal printer paper */
                            font-size: 12px;
                            /* Adjust the font size for readability */
                            margin: 0;
                            padding: 10px;
                        }

                        #printableReceipt h1 {
                            font-size: 18px;
                            /* Adjust header size */
                            margin-bottom: 5px;
                            text-align: center;
                        }

                        #printableReceipt p,
                        #printableReceipt td {
                            font-size: 12px;
                            /* Standardize text size */
                        }

                        #printableReceipt .items th,
                        #printableReceipt .items td {
                            padding: 5px;
                            text-align: left;
                        }

                        #printableReceipt .total p {
                            font-size: 14px;
                            text-align: right;
                        }

                        #printableReceipt .footer {
                            text-align: center;
                            margin-top: 20px;
                            font-size: 12px;
                        }
                    }
                </style>


                <div class="receipt">
                    <h1><?= $website['website_name'] ?></h1>
                    <p class="store-details">
                        Shop #M-140 Floor Mezzanine Rashid <br>
                        Minhas Road Millinium Mall, Karachi<br>
                        Phone: 0333-6615905
                    </p>
                    <div id="flexis" style="display: flex; justify-content: space-between;">
                        <p class="customer-details">
                            Date: <?= date('d-m-y') ?><br>
                            Invoice: <b id="receipt_invoice_id"></b>
                        </p>
                        <img id="qr-code" src="al-asif-qr.PNG" width="70px" height="70px" alt="">
                    </div>
                    <div class="items">
                        <table>
                            <thead>
                                <tr>
                                    <th>Description</th>
                                    <th>Qty</th>
                                    <th>Price</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                foreach ($product_name as $re_pr) {
                                    echo '
                    <tr>
                        <td>' . $re_pr . '</td>
                        <td id="receipt_qty_' . $i . '"></td>
                        <td id="receipt_price_' . $i . '">Rs.  </td>
                        <td id="receipt_total_' . $i . '">Rs. </td>
                    </tr>';
                                    $i++;
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="total">
                        <p id="subtotal_receipt"></p>
                        <p>Tax (0%): Rs. 0</p>
                        <p id="total_receipt"></p>
                    </div>

                    <div class="footer">
                        <p>Thank you for Shopping</p>
                        <p>Developed by Marcode Solutions</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function submitForm() {
            var userConfirmed = confirm("Are you sure you want to continue?");
            if (userConfirmed) {
                var invoice_id = $('#invoice_id_display').val();
                console.log(invoice_id);
                var form = document.getElementById("invoice_form");
                var formData = new FormData(form);
                formData.append('gen_inv_bulk', true);
                formData.append('invoice_id', invoice_id); // Append the invoice_id to the FormData

                $.ajax({
                    url: 'functions/brain.php',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        console.log('Raw server response:', response);

                        printReceipt();
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error:', status, error);
                        console.error('Response text:', xhr.responseText);
                    }
                });
            } else {
                alert("Operation canceled.");
            }
        }

        function printReceipt() {
            var printContents = document.getElementById('printableReceipt').innerHTML;
            var printWindow = window.open('', '', 'height=400,width=300'); // Adjusted window size to simulate thermal printer

            printWindow.document.write('<html><head><title>Print Receipt</title>');
            printWindow.document.write('<style>@media print {' +
                '#printableReceipt { width: 80mm; font-size: 12px; margin: 0; padding: 10px; }' +
                '#printableReceipt h1 { font-size: 18px; margin-bottom: 5px; text-align: center; }' +
                '#printableReceipt p, #printableReceipt td { font-size: 12px; }' +
                '#printableReceipt .items th, #printableReceipt .items td { padding: 5px; text-align: left; }' +
                '#printableReceipt .total p { font-size: 14px; text-align: right; }' +
                '#printableReceipt .footer { text-align: center; margin-top: 20px; font-size: 12px; }' +
                '}</style>');
            printWindow.document.write('</head><body>');
            printWindow.document.write(printContents);
            printWindow.document.write('</body></html>');

            printWindow.document.close();

            // Wait for images to load before printing
            printWindow.onload = function() {
                var qrCodeImg = printWindow.document.getElementById('qr-code');
                if (qrCodeImg && !qrCodeImg.complete) {
                    qrCodeImg.onload = function() {
                        printWindow.print();
                    };
                } else {
                    printWindow.print();
                }
            };

            // After printing, redirect
            printWindow.onafterprint = function() {


                printWindow.close();
                window.location.href = "index.php?page=invoice&type=view";



            };
        }
    </script>


<?php
}


if ($sales_page) {


    $query = "
SELECT 
    sales.id AS sales_id, 
    sales.invoice_id, 
    sales.date_saled, 
    invoices.product_name, 
    invoices.qty, 
    invoices.pro_serial, 
    invoices.price,
    invoices.c_price, 

    invoices.date AS invoice_date
FROM 
    sales
JOIN 
    invoices 
ON 
    sales.invoice_id = invoices.invoice_id
";
    $result = $con->query($query);

    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    $count_sales = count_e("sales");
    $con->close();


    $data_json = json_encode($data);

?>
    <style>
        /* Responsive container for the chart */
        .chart-container {
            position: relative;
            width: 100%;
            height: 400px;
            /* Adjust as needed */
        }

        @media (max-width: 600px) {
            .chart-container {
                height: 300px;
                /* Smaller height for mobile screens */
            }
        }

        @media (min-width: 1200px) {
            .chart-container {
                height: 500px;
                /* Larger height for wide screens */
            }
        }
    </style>
    <div class="container" style="padding: 3%; background-color:white; border-radius:20px;">
        <h1 class="text-white bg-dark text-center w-100 p-3 mb-3">Sales Analytics</h1>

        <div class="row mt-5">
            <div class="col-lg-4 col-md-6 col-sm-12">

                <div class="card card-statistic-2 bg-dark text-white">

                    <div class="card-icon shadow-primary bg-success">
                        <i class="fa-solid fa-check text-white"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header text-white">
                            <h4>Sales</h4>
                        </div>
                        <div class="card-body text-white">
                            <?= $count_sales ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-5">

                <div class="chart-container">
                    <canvas id="salesChart"></canvas>
                </div>
            </div>

        </div>



    </div>

    <script src="fonts/charts.js"></script>
    <script>
        // Get the PHP data into JavaScript
        var data = <?php echo $data_json; ?>;

        // Extract data for the chart
        var invoiceIds = [];
        var quantities = [];
        var prices = [];
        var productNames = [];
        var actual_prices = [];


        data.forEach(function(item) {
            invoiceIds.push(item.invoice_id);
            quantities.push(item.qty);
            prices.push(item.c_price);
            actual_prices.push(item.price);

            productNames.push(item.product_name);
        });

        // Create the chart
        var ctx = document.getElementById('salesChart').getContext('2d');
        var salesChart = new Chart(ctx, {
            type: 'bar', // or 'line', 'pie', etc.
            data: {
                labels: invoiceIds,
                datasets: [{
                        label: 'Selled Price',
                        data: prices,
                        backgroundColor: '#fb1d27bf',
                        borderColor: 'rgba(153, 102, 255, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Actual Price',
                        data: actual_prices,
                        backgroundColor: '#08e908b0',
                        borderColor: 'rgba(153, 102, 255, 1)',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

<?php
}

if ($edit_users && isset($_GET['id'])) {
    $id = $_GET['id'];
    $row_user = fetch_data("users", "=", "id", $id);
?>
    <div class="container" style="padding: 3%; background-color:white;border-radius:20px;">

        <h1 class="text-center text-white bg-dark p-3 mb-3">Manage Accounts</h1>

        <form action="" method="post">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <label for="" class="form-label">User Email</label>
                    <input type="email" value="<?= $row_user['email'] ?>" name="user_email" class="form-control" required>
                    <input type="hidden" name="user_old_email" value="<?= $row_user['email'] ?>">
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <label for="" class="form-label">Password</label>
                    <input type="password" placeholder="Enter the new Password" value="" name="user_password" class="form-control" required>

                </div>
            </div>

            <button class="btn btn-success mt-5 mb-5" type="submit" name="update_user">Update Account</button>




        </form>




    </div>

<?php
}

if ($notification_settings) {
    $fetch_notify = fetch_data("notifications_config", "=", "id", "1");
?>

    <div class="container" style="padding: 3%; border-radius:20px; background-color:white;">
        <h1 class="text-center text-white bg-dark mb-4 text-center p-3">Notifications Settings</h1>

        <form method="post">

            <div class="row">
                <div class="col-lg-4">
                    <label for="" class="form-label">Your Email</label>
                    <input type="email" value="<?= $fetch_notify['email'] ?>" required name="notify_email" class="form-control">
                </div>
                <div class="col-lg-4">
                    <label for="" class="form-label">Your Password</label>
                    <input type="password" value="<?= $fetch_notify['password'] ?>" required name="notify_password" class="form-control">
                </div>
                <div class="col-lg-4">
                    <label for="" class="form-label">Recieving Email</label>
                    <input type="email" value="<?= $fetch_notify['reciever_email'] ?>" required name="reciever_email" class="form-control">
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-lg-6">
                    <label for="" class="form-label">Status</label>
                    <select class="form-control" name="status_notify" id="">
                        <option value="-" disabled>--Select--</option>

                        <?php
                        if ($fetch_notify['status'] === "1") {
                            echo '
    <option value="1" selected>Allow Notifications</option>
    <option value="0" >Block Notifications</option>

    
    
    ';
                        } else {
                            echo '
                            <option value="1" >Allow Notifications</option>
                            <option value="0" selected>Block Notifications</option>
                        
                            
                            
                            ';
                        }

                        ?>
                    </select>

                </div>
                <div class="col-lg-6 mt-2">
                    <button class="btn btn-dark mt-4" type="submit" name="update_notify">update</button>

                </div>
            </div>



        </form>







    </div>


<?php
}

if ($del_category && isset($_GET['id'])) {
    $id = $_GET['id'];
    $del = delete_data("categories", "=", "id", $id);
    if ($del) {
        echo '<script>window.location.href="index.php?page=category&type=view"</script>';
    }
}
?>