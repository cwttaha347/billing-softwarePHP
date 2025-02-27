        <!-- Start app Footer part -->
        <footer class="main-footer">
            <div class="footer-left">
                <div class="bullet"></div> <a href="#"><?= $website['website_name'] ?> Management</a>
            </div>
            <div class="footer-right">

            </div>
        </footer>
        </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <!-- General JS Scripts -->
        <script src="assets/bundles/lib.vendor.bundle.js"></script>
        <script src="js/CodiePie.js"></script>
        <script>
            $(document).ready(function() {
                $('#serial_number').on('keyup', function() {
                    var serialNumber = $(this).val();

                    if (serialNumber === '') {
                        $('#product_details').html(''); // Clear the product details if the input is empty
                        $('#pro').show(); // Show the all-products tbody
                        $('#sel').hide();
                        return;
                    }

                    if (serialNumber.length > 0) {
                        $('#pro').hide(); // Hide the all-products tbody
                        $('#product_details').show(); // Show the search-results tbody
                        $('#sel').show();
                    } else {
                        $('#pro').show(); // Show the all-products tbody
                        $('#product_details').hide(); // Hide the search-results tbody
                        $('#sel').hide();
                    }

                    $.ajax({
                        url: 'functions/brain.php',
                        type: 'POST',
                        data: {
                            serial_number: serialNumber,
                            get_product: true
                        },
                        success: function(response) {
                            try {
                                var data = JSON.parse(response);
                                if (data.error) {
                                    $('#product_details').html('<tr><td colspan="7" class="text-center">' + data.error + '</td></tr>');
                                } else {
                                    $('#product_details').html(data.html);
                                }
                            } catch (e) {
                                $('#product_details').html(response); // Assuming the response is HTML if not JSON
                            }
                        },
                        error: function() {
                            $('#product_details').html('<tr><td colspan="7" class="text-center">An error occurred while fetching data.</td></tr>');
                        }
                    });
                });
            });

            $(document).ready(function() {
                // Function to update receipt details
                function updateReceipt() {
                    var inv_qty = parseInt($('#inv_qty').val());
                    var inv_price = parseFloat($('#inv_price_original').val());
                    var c_price = parseFloat($('#customer_price').val());

                    if (isNaN(inv_qty) || isNaN(inv_price) || isNaN(c_price)) {
                        return;
                    }

                    var new_price = inv_price * inv_qty;
                    var new_c_price = c_price * inv_qty;

                    $('#recipt_qty').text(inv_qty);
                    $('#total_re').text("Rs." + c_price.toFixed(2));
                    $('#reciept_total').text("Rs." + new_c_price.toFixed(2));
                    $('#inv_id').text($('#inva_id').val());
                    $('#inner_sub_total_re').text("Subtotal: Rs." + new_c_price.toFixed(2));
                    $('#inner_total_re').text("Total: Rs." + new_c_price.toFixed(2));
                }

                // Initial call to set up values
                updateReceipt();

                // Event listeners
                $('#inv_qty, #customer_price').on('keyup', updateReceipt);
            });

            let inv_1 = $('#invoice_id_display').val();
            $('#receipt_invoice_id').text(inv_1);

            $(document).ready(function() {
                // Set initial values and calculate total for all products
                $('[id^=quantity_]').each(function() {
                    let idSuffix = $(this).attr('id').split('_')[1];
                    calculateReceipt(idSuffix);
                });

                // Bind event listener to quantity input fields
                $('[id^=quantity_]').on('keyup', function() {
                    let idSuffix = $(this).attr('id').split('_')[1];
                    calculateReceipt(idSuffix);
                });

                // Bind event listener to customer price input fields
                $('[id^=customer_price_]').on('keyup', function() {
                    let idSuffix = $(this).attr('id').split('_')[1];
                    calculateReceipt(idSuffix);
                });

                function calculateReceipt(idSuffix) {
                    let priceElement = $('#price_' + idSuffix);
                    let originalPrice = parseFloat(priceElement.data('original-price'));
                    let quantity = parseInt($('#quantity_' + idSuffix).val()) || 1;
                    let customerPrice = parseFloat($('#customer_price_' + idSuffix).val());

                    if (!isNaN(originalPrice) && !isNaN(quantity) && !isNaN(customerPrice)) {
                        let totalPrice = customerPrice * quantity;
                        $('#receipt_qty_' + idSuffix).text(quantity);
                        $('#receipt_total_' + idSuffix).text('Rs. ' + totalPrice);
                        $('#receipt_price_' + idSuffix).text('Rs. ' + totalPrice);

                        updateTotal();
                    }
                }

                function updateTotal() {
                    let subtotal = 0;
                    $('[id^=receipt_total_]').each(function() {
                        subtotal += parseFloat($(this).text().replace('Rs. ', '')) || 0;
                    });
                    $('#subtotal_receipt').text('Subtotal: Rs. ' + subtotal);
                    $('#total_receipt').text('Total: Rs. ' + subtotal);
                }
            });


            function gen_inv() {
                window.location.href = "index.php?page=invoice&type=select";
            }

            function add_products() {
                window.location.href = "index.php?page=inventory&type=add";
            }

            function add_categories() {
                window.location.href = "index.php?page=category&type=add";
            }


            $(document).ready(function() {
                $('#invoice_ids').on('keyup', function() {
                    var invoice_ids = $(this).val();

                    if (invoice_ids === '') {
                        $('#searched_invoices').html(''); // Clear the product details if the input is empty
                        $('#default_invoices').show(); // Show the all-products tbody
                        return;
                    }

                    if (invoice_ids.length > 0) {
                        $('#default_invoices').hide(); // Hide the all-products tbody
                        $('#searched_invoices').show(); // Show the search-results tbody
                    } else {
                        $('#default_invoices').show(); // Show the all-products tbody
                        $('#searched_invoices').hide(); // Hide the search-results tbody
                    }

                    $.ajax({
                        url: 'functions/brain.php',
                        type: 'POST',
                        data: {
                            invoice_ids: invoice_ids,
                            get_product: true
                        },
                        success: function(response) {
                            try {
                                var data = JSON.parse(response);
                                if (data.error) {
                                    $('#searched_invoices').html('<tr><td colspan="7" class="text-center">' + data.error + '</td></tr>');
                                } else {
                                    $('#searched_invoices').html(data.html);
                                }
                            } catch (e) {
                                $('#searched_invoices').html(response); // Assuming the response is HTML if not JSON
                            }
                        },
                        error: function() {
                            $('#searched_invoices').html('<tr><td colspan="7" class="text-center">An error occurred while fetching data.</td></tr>');
                        }
                    });
                });
            });
        </script>

        <script>
            $(document).ready(function() {
                $('#category-search').keyup(function() {
                    var query = $(this).val();
                    if (query != '') {
                        $.ajax({
                            url: "functions/brain.php",
                            method: "POST",
                            data: {
                                query: query
                            },
                            success: function(data) {
                                $('#product-results').html(data);
                            }
                        });
                    } else {
                        $('#product-results').html('');
                    }
                });
            });
        </script>

        <!-- JS Libraies -->
        <script src="assets/modules/jquery.sparkline.min.js"></script>
        <script src="assets/modules/chart.min.js"></script>
        <script src="assets/modules/owlcarousel2/dist/owl.carousel.min.js"></script>
        <script src="assets/modules/summernote/summernote-bs4.js"></script>
        <script src="assets/modules/chocolat/dist/js/jquery.chocolat.min.js"></script>

        <!-- Page Specific JS File -->
        <script src="js/page/index.js"></script>

        <!-- Template JS File -->
        <script src="js/scripts.js"></script>
        <script src="js/custom.js"></script>
        </body>

        <!--   Tue, 07 Jan 2020 03:35:12 GMT -->

        </html>