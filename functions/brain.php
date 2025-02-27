<?php
session_start();
//$con = mysqli_connect("sql308.infinityfree.com", "if0_36802615", "9bJEFRnUuWvE", "if0_36802615_al_asif");
$con = mysqli_connect("localhost", "root", "", "al-asif");
//$con = mysqli_connect("localhost", "urbawuri_rootas", "2N%@Cm?3HG,W", "urbawuri_urban34");
$ip = $_SERVER['REMOTE_ADDR'];

include 'mail.php';


date_default_timezone_set('Asia/Karachi');




function alert($message)
{
    $alert = '
    <style>
/* Styles for the alert box */
.alert {
    padding: 20px;
    background-color: #f44336; /* Red background */
    color: white;
    position: fixed;
    top: 20px;
    right: 20px;
    border-radius: 5px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    z-index: 1000;
    opacity: 1;
    transition: opacity 0.5s ease-out;
}

.alert-message {
    font-size: 16px;
}

.closebtn {
    position: absolute;
    top: 10px;
    right: 15px;
    font-size: 20px;
    font-weight: bold;
    cursor: pointer;
    transition: color 0.3s ease;
}

.closebtn:hover {
    color: black;
}

/* Hidden class for hiding the alert */
.alert.hidden {
    opacity: 0;
    visibility: hidden;
}

    </style>
  <div id="alert" class="alert">
        <span class="alert-message">' . $message . '</span>
        <span class="closebtn" onclick="closeAlert()">&times;</span>
    </div>
    
    <script>
    function closeAlert() {
    var alertBox = document.getElementById("alert");
    alertBox.classList.add("hidden");
}

// Automatically close the alert after 5 seconds
window.onload = function() {
    setTimeout(function() {
        closeAlert();
    }, 5000); // Adjust the time (in milliseconds) as needed
};
    
    </script>
    
    ';

    return $alert;
}


function count_e($table, $clause = Null)

{
    global $con;
    if ($clause == null) {
        $select = mysqli_query($con, "SELECT * FROM $table ");
        $count = mysqli_num_rows($select);
        return $count;
    } else {
        $select = mysqli_query($con, "SELECT * FROM $table WHERE $clause");
        $count = mysqli_num_rows($select);
        return $count;
    }
}


function upload_file($path, $filename)
{

    $file_tmp_name = $filename['tmp_name'];
    $file_name = basename($filename['name']);

    $upload_directory = $path;

    $target_path = $upload_directory . $file_name;

    if (move_uploaded_file($file_tmp_name, $target_path)) {

        return $target_path;
    } else {

        return false;
    }
}
function fetch_data_join(
    $table1,
    $table2,
    $join_condition1,
    $table3 = null,
    $join_condition2,
    $select_columns = '*',
    $keyword,
    $clause = null,
    $entity = null,
    $entity_value = null,
    $clause2 = null,
    $entity2 = null,
    $entity_value2 = null
) {
    global $con;
    $query = "SELECT $select_columns FROM $table1
LEFT JOIN $table2 ON $join_condition1";


    if ($table3 !== null) {
        $query .= " LEFT JOIN $table3 ON $join_condition2";
    }


    if ($clause !== null && $entity !== null && $entity_value !== null) {
        $query .= " $keyword $entity $clause '$entity_value'";
    }

    if ($clause2 !== null && $entity2 !== null && $entity_value2 !== null) {
        $query .= " $clause2 $entity2 '$entity_value2'";
    }

    $result = mysqli_query($con, $query);
    return $result;
}



function fetch_data(
    $table,
    $clause = null,
    $entity = null,
    $entity_value = null,
    $clause2 = null,
    $entity2 = null,
    $entity_value2 = null
) {
    global $con;
    $query = "SELECT * FROM $table";
    if ($clause !== null) {
        $query .= " WHERE $entity $clause '$entity_value'";
    }
    if ($clause2 !== null) {
        $query .= " $clause2 $entity2 $clause $entity_value2";
    }
    $result = mysqli_query($con, $query);

    return mysqli_fetch_assoc($result);
}

function fetch_data_while($table, $clause = null, $entity = null, $entity_value = null, $clause2 = null, $entity2 =
null, $entity_value2 = null)
{
    global $con;
    $query = "SELECT * FROM $table";
    if ($clause !== null) {
        $query .= " WHERE $entity $clause '$entity_value'";
    }
    if ($clause2 !== null) {
        $query .= " $clause2 $entity2 '$entity_value2'";
    }
    $result = mysqli_query($con, $query);

    return $result;
}
function delete_data(
    $table,
    $clause = null,
    $entity = null,
    $entity_value = null,
    $clause2 = null,
    $entity2 = null,
    $entity_value2 = null,
    $clause3 = null,
    $entity3 = null,
    $entity_value3 = null
) {
    global $con;
    $query = "DELETE FROM $table";
    if ($clause !== null && $entity !== null && $entity_value !== null) {
        if (is_numeric($entity_value)) {
            $query .= " WHERE $entity $clause $entity_value";
        } else {
            $query .= " WHERE $entity $clause '$entity_value'";
        }
    }
    if ($clause2 !== null && $entity2 !== null && $entity_value2 !== null) {
        if (is_numeric($entity_value2)) {
            $query .= " $clause2 $entity2 $entity_value2";
        } else {
            $query .= " $clause2 $entity2 '$entity_value2'";
        }
    }
    if ($clause3 !== null && $entity3 !== null && $entity_value3 !== null) {
        if (is_numeric($entity_value3)) {
            $query .= " $clause3 $entity3 $entity_value3";
        } else {
            $query .= " $clause3 $entity3 '$entity_value3'";
        }
    }
    $result = mysqli_query($con, $query);

    return $result;
}




function insert($table, $fields_name = [], $fields_value = [])
{
    global $con;
    if (count($fields_name) !== count($fields_value)) {
        die("Number of fields and values do not match");
    }

    $escapedFieldsName = array_map(function ($field) use ($con) {
        return "`" . $con->real_escape_string($field) . "`";
    }, $fields_name);

    $escapedFieldsValue = array_map(function ($value) use ($con) {
        return "'" . $con->real_escape_string($value) . "'";
    }, $fields_value);

    $sql = "INSERT INTO `$table` (" . implode(', ', $escapedFieldsName) . ") VALUES (" . implode(', ', $escapedFieldsValue)
        . ")";

    if ($con->query($sql) === TRUE) {
        $session_id = $con->insert_id;
        return $session_id;
    } else {

        echo "Error: " . $sql . "<br>" . $con->error;
    }
}


function update(
    $table = null,
    $entitys = [],
    $entitys_value = [],
    $clause = null,
    $clause_entity = null,
    $clause_entity_value = null
) {
    global $con;
    if (count($entitys) !== count($entitys_value)) {
        die("Number of entity and values do not match");
    }

    $updates = [];
    foreach ($entitys as $key => $value) {
        $updates[] = "`" . $con->real_escape_string($value) . "`='" . $con->real_escape_string($entitys_value[$key]) . "'";
    }

    $sql = "UPDATE `$table` SET " . implode(', ', $updates) . " WHERE `$clause_entity` $clause '$clause_entity_value'";

    if ($con->query($sql) === TRUE) {
        return true;
    } else {
        echo "Error: " . $sql . "<br>" . $con->error;
    }
}

function generate_rand_id()
{

    $uniqueID = uniqid() . mt_rand(100000, 999999);


    $uniqueID = substr($uniqueID, -6);

    return $uniqueID;
}

function login($email, $password)
{
    global $ip;

    $hashed_password = getPasswordFromDatabase($email);

    if ($hashed_password !== null) {

        $proceed = password_verify($password, $hashed_password);

        if ($proceed) {
            $check_role = fetch_data("users", "=", "email", $email);
            if ($check_role['role'] == "775") {
                $_SESSION['super_admin'] = "super";
            } else {
                $_SESSION['admin'] = "seller";
            }


            $_SESSION['user'] = $email;

            echo '<script>
            window.location.href = "index.php?page=dashboard&type=view"
            </script>';
            return true;
        }
    } else {

        echo '<script>
        window.location.href = "index.php?page=auth&type=login?incorrect"
        </script>';
        return false;
    }
}





function getPasswordFromDatabase($email)
{

    $user_data = fetch_data('users', '=', 'email', $email);


    if ($user_data !== null) {

        return $user_data['password'];
    } else {

        return null;
    }
}
function count_views($platform)
{
    global $con;

    // Correct the platform map to match your database schema
    $platformMap = [
        'android' => 'andoid',  // Assuming 'andoid' is the correct column name
        'ios' => 'iphone',
        'windows' => 'windows'
    ];

    if (!array_key_exists($platform, $platformMap)) {
        die("Invalid platform specified. Valid options are: 'android', 'ios', 'windows'.");
    }

    $platformColumn = $platformMap[$platform];

    // Query to count non-null views based on the platform
    $sql = "
        SELECT
            COUNT($platformColumn) AS {$platform}_count
        FROM views
        WHERE $platformColumn IS NOT NULL
    ";

    $result = $con->query($sql);

    if ($result && $result->num_rows > 0) {
        $counts = $result->fetch_assoc();
        return $counts["{$platform}_count"];
    } else {
        return 0;
    }
}

function generateRandomInvoiceId()
{

    $prefix = "INV#";


    $randomNumber = mt_rand(100000, 999999);



    $invoiceId = $prefix . $randomNumber;


    return $invoiceId;
}


if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    if (login($email, $password)) {
        $log_e_msg = 'success';
    } else {
        $log_e_msg = 'error';
    }
}
function serial_number()
{
    return str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);
}
if (isset($_POST['register'])) {
    extract($_POST);
    $register = register($email, $password);
    if ($register == "success") {
        $_SESSION['user'] = $email;
        echo '<script>window.location.href="index.php?page=dashboard&type=view"</script>';
    } elseif ($register == "exists") {
        echo '<script>window.location.href="index.php?page=auth&type=register?exists"</script>';
    } else {
        echo '<script>window.location.href="index.php?page=auth&type=register?error"</script>';
    }
}


if (isset($_SESSION['user'])) {
    $user_id = $_SESSION['user'];
    $row_user = fetch_data('users', '=', 'email', $user_id);
    $user_id = $row_user['id'];
}

if (isset($_GET['logout'])) {
    session_destroy();
    echo '<script>
window.location.href = "index.php?login"
</script>';
}

function register($email, $pwd)
{
    global $con;
    $hashed_password = password_hash($pwd, PASSWORD_DEFAULT);
    $check = count_e("users", "email");
    if ($check > 0) {
        return "exists";
    } else {
        $insert_user = insert("users", ["email", "password", "role", "status"], [$email, $hashed_password, "2", "1"]);
        if ($insert_user) {
            return "success";
        } else {
            return "failed";
        }
    }
}


$website = fetch_data("website");
if (isset($_SESSION['user'])) {
    $user = fetch_data("users", "=", "email", $_SESSION['user']);
}
$products_page = fetch_data_while("products");


if (isset($_POST['add_category'])) {
    extract($_POST);
    insert("categories", ['category_name', 'category_desc', 'status'], [$category_name, $category_desc, 'active']);
}

if (isset($_POST['add_product'])) {
    extract($_POST);
    $img1 = $_FILES['pro_img1'];


    $transfer_img_1  = upload_file("images/products/", $img1);


    if ($transfer_img_1) {
        insert("products", ['cat_id', 'serial_no', 'product_name',  'image_1', 'qty', 'price', 'w_sale_price'], [$category_id, $serial_no, $product_name, $transfer_img_1, $qty, $price, $w_sale_price]);
    }
}



if (isset($_POST['update_category'])) {
    extract($_POST);
    update("categories", ['category_name', 'category_desc'], [$category_name, $category_desc], "=", "id", $id);
    echo '<script>window.location.href="index.php?page=category&type=view"</script>';
}




if (isset($_POST['update_config'])) {
    extract($_POST);
    update("website", ['website_name', 'website_mode', 'contact_email', 'contact_phone'], [$website_name, $website_mode, $contact_email, $contact_phone], "=", "id", "1");
}




if (isset($_POST['update_products'])) {
    extract($_POST);
    $image1 = $_FILES['pro_img1'];

    $transfer_1 = upload_file("images/products/", $image1);


    if ($transfer_1) {
        update("products", ['cat_id', 'product_name',  'image_1', 'qty', 'price', 'w_sale_price'], [$category_id, $product_name, $transfer_1, $qty, $price, $w_sale_price], "=", "id", $id);
    } else {
        update("products", ['cat_id', 'product_name',   'qty', 'price', 'w_sale_price'], [$category_id, $product_name, $qty, $price, $w_sale_price], "=", "id", $id);
    }
}



if (isset($_POST['gen_inv'])) {

    extract($_POST);
    $invoice_id = $_POST['invoice_id'];
    $actual_price = $pro_qty * $pro_price;

    $new_price = $pro_qty * $c_price;
    $in = insert("invoices", ['invoice_id', 'product_name', 'qty', 'pro_serial', 'price', 'c_price'], [$invoice_id, $pro_name, $pro_qty, $pro_serial, $actual_price, $c_price]);
    $in_2 = insert("temp_mail", ['session_id', 'invoice_id', 'product_names', 'qty', 'serial_no', 'price'], [$in, $invoice_id, $pro_name, $pro_qty, $pro_serial, $new_price]);


    $fetch_pro = fetch_data("products", "=", "serial_no", $pro_serial);
    $fetch_earnings = fetch_data("earnings");
    $old_earning = $fetch_earnings['total_amount'];
    $old_qty = $fetch_pro['qty'];
    $new_qty = $old_qty - $pro_qty;

    $new_earning  = $old_earning + $new_price;
    if ($in) {
        update("products", ['qty'], [$new_qty], "=", "serial_no", $pro_serial);
        insert("sales", ['invoice_id'], [$invoice_id]);
        update("earnings", ['total_amount'], [$new_earning], "=", "id", "1");

        $result1 = [
            'status' => 'success',
            'message' => 'Data processed successfully',
            's1' => "$in",
            's2' => "$in_2",
            's1_n' => "$in",
            's2_n' => "$in_2"
        ];

        header('Content-Type: application/json');
        echo json_encode($result1);
        exit();

        echo '<script>window.location.href="index.php?page=invoice&type=view"</script>';
    }
}


//ajax code get product wala


//if (isset($_POST['serial_number'])) {
//    $serial_number = $con->real_escape_string($_POST['serial_number']);

//    $sql = "SELECT * FROM products WHERE serial_no LIKE '%$serial_number%'";
//    $result = $con->query($sql);

//    $output = '';

//    if ($result->num_rows > 0) {
//        $i = 1;
//        while ($row = $result->fetch_assoc()) {
//            $category_id = $row['cat_id'];
//            $category_n = fetch_data("categories", "=", "id", $category_id);
//            $category_name = $category_n['category_name'];

//            $output .= '
//                <tr>
//                    <td>' . $i . '</td>
//                    <td>' . $row['product_name'] . '</td>
//                    <td>' . $row['qty'] . '</td>
//                    <td>' . $row['price'] . '</td>
//                    <td>' . $category_name . '</td>
//                    <td><img src="' . $row['image_1'] . '" width="90px" height="90px" alt=""></td>
//                    <td>
//                   <a class="btn btn-primary" href="index.php?page=inventory&type=edit&id=' . $row['id'] . '"><i class="fa-regular fa-pen-to-square"></i></a>
//                            <a class="btn btn-success" href="index.php?page=invoice&type=gen&id=' . $row['id'] . '"><i class="fa-solid fa-file-invoice-dollar"></i></a>


//                            <a class="btn btn-danger" href="index.php?page=inventory&type=delete&id=' . $row['id'] . '"><i class="fa-solid fa-trash"></i></a> </td>
//                </tr>';
//            $i++;
//        }
//    } else {
//        $output = '<tr><td colspan="7" class="text-center">No products found.</td></tr>';
//    }

//    echo $output;
//}


if (isset($_POST['serial_number'])) {
    $serial_number = $con->real_escape_string($_POST['serial_number']);

    $sql = "SELECT * FROM products WHERE serial_no LIKE '%$serial_number%' OR  product_name LIKE '%$serial_number%'";
    $result = $con->query($sql);

    $output = '';

    if ($result->num_rows > 0) {
        $i = 1;
        while ($row = $result->fetch_assoc()) {
            $category_id = $row['cat_id'];
            $category_n = fetch_data("categories", "=", "id", $category_id);
            $category_name = $category_n['category_name'];

            $output .= '
                <tr>
                   
                   
                <td>' . $i . '</td>
                 <td><input type="checkbox" name="products[]" value="' . $row['id'] . '"></td>
                   <td>' . $row['product_name'] . '</td>
                   <td>' . $row['serial_no'] . '</td>

                    <td>' . $row['qty'] . '</td>
                    <td>' . $row['price'] . '</td>
                   <td>' . $category_name . '</td>
                   <td><img src="' . $row['image_1'] . '" width="90px" height="90px" alt=""></td>
                    <td>
                   <a class="btn btn-primary" href="index.php?page=inventory&type=edit&id=' . $row['id'] . '"><i class="fa-regular fa-pen-to-square"></i></a>
                           <a class="btn btn-success" href="index.php?page=invoice&type=gen&id=' . $row['id'] . '"><i class="fa-solid fa-file-invoice-dollar"></i></a>


                           <a class="btn btn-danger" href="index.php?page=inventory&type=delete&id=' . $row['id'] . '"><i class="fa-solid fa-trash"></i></a> </td> </tr>';
            $i++;
        }
    } else {
        $output = '<tr><td colspan="7" class="text-center">No products found.</td></tr>';
    }

    echo $output;
}



if (isset($_POST['gen_inv_selected'])) {
    $products = $_POST['products'];


    $_SESSION['get_selected_pro'] = $products;

    echo '<script>window.location.href="index.php?page=invoice&type=gen_selected"</script>';
}


///////////////////////
if (isset($_POST['gen_inv_bulk'])) {

    // Initialize variables from $_POST
    $pro_name = isset($_POST['pro_name']) ? $_POST['pro_name'] : [];
    $pro_qty = isset($_POST['pro_qty']) ? $_POST['pro_qty'] : [];
    $pro_price = isset($_POST['pro_price']) ? $_POST['pro_price'] : [];
    $pro_serial = isset($_POST['pro_serial']) ? $_POST['pro_serial'] : [];
    $pro_c_price = isset($_POST['pro_c_prices']) ? $_POST['pro_c_prices'] : [];
    $invoice_id = isset($_POST['invoice_id']) ? $_POST['invoice_id'] : null;

    if ($invoice_id === null) {
        error_log("Invoice ID is missing.");
        echo '<script>alert("Error: Invoice ID is missing.");</script>';
        exit;
    }

    // Initialize other variables
    $total_price = 0;
    $new_c_price = 0;
    $product_names = [];
    $product_qtys = [];
    $product_serials = [];

    // Count the number of elements in each array
    $pro_name_count = count($pro_name);
    $pro_qty_count = count($pro_qty);
    $pro_price_count = count($pro_price);
    $pro_serial_count = count($pro_serial);
    $pro_c_price_count = count($pro_c_price);

    // Check if all counts match
    if ($pro_name_count === $pro_qty_count && $pro_name_count === $pro_price_count && $pro_name_count === $pro_serial_count && $pro_name_count === $pro_c_price_count) {

        foreach ($pro_name as $key => $name) {
            $qty = isset($pro_qty[$key]) ? $pro_qty[$key] : 0;
            $price = isset($pro_price[$key]) ? $pro_price[$key] : 0;
            $c_1_price = isset($pro_c_price[$key]) ? $pro_c_price[$key] : 0;
            $serial = isset($pro_serial[$key]) ? $pro_serial[$key] : '';

            if (is_numeric($qty) && is_numeric($price) && is_numeric($c_1_price)) {
                $new_price = $qty * $price;
                $total_price += $new_price;
                $pro_c_price_value = $qty * $c_1_price;
                $new_c_price += $pro_c_price_value;

                $product_names[] = $name;
                $product_qtys[] = $qty;
                $product_serials[] = $serial;

                $fetch_pro = fetch_data("products", "=", "serial_no", $serial);
                if ($fetch_pro) {
                    $old_qty = $fetch_pro['qty'];
                    $new_qty = $old_qty - $qty;
                    $update_result = update("products", ['qty'], [$new_qty], "=", "serial_no", $serial);
                    if (!$update_result) {
                        error_log("Error updating product quantity for serial: $serial");
                    }
                } else {
                    error_log("Product not found for serial: $serial");
                }
            } else {
                error_log("Invalid data for product at index: $key");
            }
        }

        $product_names_str = implode(', ', $product_names);
        $product_qtys_str = implode(', ', $product_qtys);
        $product_serials_str = implode(', ', $product_serials);

        error_log("Product Names: $product_names_str");
        error_log("Product Quantities: $product_qtys_str");
        error_log("Product Serial Numbers: $product_serials_str");
        error_log("Total Price: $total_price");

        // Insert invoice data
        $in = insert("invoices", ['invoice_id', 'product_name', 'qty', 'pro_serial', 'price', 'c_price'], [$invoice_id, $product_names_str, $product_qtys_str, $product_serials_str, $total_price, $new_c_price]);

        if (!$in) {
            error_log("Error inserting invoice: " . mysqli_error($con));
            echo '<script>alert("Error inserting invoice.");</script>';
        } else {
            // Insert into temp_mail table
            $in_2 = insert("temp_mail", ['session_id', 'invoice_id', 'product_names', 'qty', 'serial_no', 'price'], [$in, $invoice_id, $product_names_str, $product_qtys_str, $product_serials_str, $total_price]);

            // Update earnings
            $fetch_earnings = fetch_data("earnings");
            if ($fetch_earnings) {
                $old_earning = $fetch_earnings['total_amount'];
                $new_earning = $old_earning + $new_c_price;
                $update_earning_result = update("earnings", ['total_amount'], [$new_earning], "=", "id", "1");
                if (!$update_earning_result) {
                    error_log("Error updating earnings.");
                }
            } else {
                error_log("Earnings data not found.");
            }

            // Respond with JSON
            header('Content-Type: application/json'); // Set the content type to JSON

            $result = [
                'status' => 'success',
                'message' => 'Data processed successfully',
                's1' => $in,
                's2' => $in_2,
                's1_n' => $in,
                's2_n' => $in_2
            ];

            // Insert sales record
            $temp_pwd = "wgpigaxkaktcxvgl";
            $sales_result = insert("sales", ['invoice_id'], [$invoice_id]);

            if (!$sales_result) {
                error_log("Error inserting sales record.");
            }

            echo json_encode($result);
            exit;
        }
    } else {
        error_log("Array length mismatch in POST data.");
        echo '<script>alert("Error: Mismatch in data lengths.");</script>';
    }
}







if (isset($_POST['update_user'])) {
    extract($_POST);
    $fetch = fetch_data("users", "=", "email", $user_old_email);
    if ($fetch) {
        $new_password = password_hash($user_password, PASSWORD_DEFAULT);
        update("users", ['email', 'password'], [$user_email, $new_password], "=", "email", $user_old_email);
    }
}




if (isset($_POST['invoice_ids'])) {
    $invoice_ids = $con->real_escape_string($_POST['invoice_ids']);

    $sql = "SELECT * FROM invoices WHERE invoice_id LIKE '%$invoice_ids%'";
    $result = $con->query($sql);

    $output = '';

    if ($result->num_rows > 0) {
        $i = 1;
        while ($row = $result->fetch_assoc()) {
            $permission = "";
            if (isset($_SESSION['super_admin'])) {
                $permission = '<a class="btn btn-danger" href="index.php?page=invoices&type=del&id=' . $row['id'] . '"><i class="fa-solid fa-trash"></i></a>';
            } else {
                $permission = '<i disabled class="fa-solid fa-ban text-danger" style="font-size: 23px;"></i>';
            }

            $output .= '
                <tr>
                   
                   
                <td>' . $i . '</td>
                   <td>' . $row['invoice_id'] . '</td>
                    <td>' . $row['product_name'] . '</td>
                    <td>' . $row['qty'] . '</td>
                   <td>' . $row['pro_serial'] . '</td>
                   <td>' . $row['price'] . '</td>
                   <td>' . $row['c_price'] . '</td>
                   <td>' . $row['date'] . '</td>
                    <td>' . $permission . ' </td> </tr>';
            $i++;
        }
    } else {
        $output = '<tr><td colspan="7" class="text-center">No Invoices found.</td></tr>';
    }

    echo $output;
}



if (isset($_POST['update_notify'])) {
    extract($_POST);
    update("notifications_config", ['email', 'password', 'reciever_email', 'status'], [$notify_email, $notify_password, $reciever_email, $status_notify], "=", "id", "1");
}






if (isset($_POST['subject']) && isset($_POST['in']) && isset($_POST['in_2'])) {
    $n_subject = $_POST['subject'];
    $n_in = $_POST['in'];
    $n_in_2 = $_POST['in_2'];


    if (function_exists('send_notification')) {
        $notificationStatus = send_notification($n_subject, $n_in, $n_in_2);
        if ($notificationStatus) {
            $response = [
                'status' => 'success',
                'message' => 'Notification sent successfully',
                'data1' => $n_in,
                'data2' => $n_in_2
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Failed to send notification'
            ];
        }
    } else {
        $response = [
            'status' => 'error',
            'message' => 'send_notification function not found'
        ];
    }
} else {
    $response = [
        'status' => 'error',
        'message' => 'Missing required parameters'
    ];
}



if (isset($_POST['query'])) {
    $query = $con->real_escape_string($_POST['query']);

    $sql = "SELECT products.id AS product_id, categories.id AS category_id, products.product_name, products.serial_no, 
                   products.qty, products.price, products.image_1, categories.category_name 
            FROM products 
            JOIN categories ON products.cat_id = categories.id 
            WHERE categories.category_name LIKE '%" . $query . "%'";

    $result = $con->query($sql);
    $output = '';

    if ($result->num_rows > 0) {
        $i = 1;
        while ($row = $result->fetch_assoc()) {
            $output .= '
                <tr>
                    <td>' . $i . '</td>
                    <td><input type="checkbox" name="products[]" value="' . $row['product_id'] . '"></td>
                    <td>' . $row['product_name'] . '</td>
                    <td>' . $row['serial_no'] . '</td>
                    <td>' . $row['qty'] . '</td>
                    <td>' . $row['price'] . '</td>
                    <td>' . $row['category_name'] . '</td>
                    <td><img src="' . $row['image_1'] . '" width="90px" height="90px" alt=""></td>
                    <td>
                        <a class="btn btn-primary" href="index.php?page=inventory&type=edit&id=' . $row['product_id'] . '">
                            <i class="fa-regular fa-pen-to-square"></i>
                        </a>
                        <a class="btn btn-success" href="index.php?page=invoice&type=gen&id=' . $row['product_id'] . '">
                            <i class="fa-solid fa-file-invoice-dollar"></i>
                        </a>
                        <a class="btn btn-danger" href="index.php?page=inventory&type=delete&id=' . $row['product_id'] . '">
                            <i class="fa-solid fa-trash"></i>
                        </a>
                    </td>
                </tr>';
            $i++;
        }
    } else {
        echo '<p>No products found.</p>';
    }
    echo $output;
}
