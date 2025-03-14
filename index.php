<!DOCTYPE html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sweet Shop</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/styles/styles.css">
    <style>
        body {
            font-family: 'Tajawal', sans-serif;
        }
        #menu h2 {
            color: #5A3825; 
        }
        .form-control {
            max-width: 400px;
            margin: 0 auto;
        }
        .form-select {
            max-width: 400px;
            margin: 0 auto;
        }
        .btn-primary {
            background-color: #D2B48C !important;
            border-color: #D2B48C !important;
            color: #5A3825 !important;
        }

        .invalid {
            border: 2px solid #f00;
        }

        .success, .errorMsg {
            display: none;
        }

    </style>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
    
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">Sweet Shop</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#about">About Us</a></li>
                    <li class="nav-item"><a class="nav-link" href="#menu">Our Menu</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">Contact Us</a></li>
                </ul>
            </div>
        </div>
    </nav>
    
   
    <header class="hero text-white text-center py-5" style="background-color: #7B4B26;">
        <div class="container">
            <img src="assets/images/cake.png" alt="Chocolate Cake" class="img-fluid" style="max-width: 100%; height: auto;">
            <h1>Welcome to Sweet Shop</h1>
            <p>The most delicious baked goods made with love</p>
        </div>
    </header>
    
   
    <section id="about" class="py-5">
        <div class="container text-center">
            <h2>About Us</h2>
            <p>We specialize in providing fresh and delicious sweets made from high-quality ingredients.</p>
        </div>
    </section>
    
    
    <section id="menu" class="bg-light py-5">
        <div class="container text-center">
            <h2>Our Menu</h2>
            <div class="row mt-4">
                <div class="col-md-4">
                    <div class="card">
                        <img src="assets/images/cake.jpg" class="card-img-top" alt="Cake">
                        <div class="card-body">
                            <h5 class="card-title">Chocolate Cake</h5>
                            <p class="card-text">Rich and creamy irresistible taste.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <img src="assets/images/croissant.jpg" class="card-img-top" alt="Croissant">
                        <div class="card-body">
                            <h5 class="card-title">Croissant</h5>
                            <p class="card-text">Crispy, buttery, and delicious.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <img src="assets/images/macaron.jpg" class="card-img-top" alt="Macaron">
                        <div class="card-body">
                            <h5 class="card-title">Macaron</h5>
                            <p class="card-text">Delicate and delicious French dessert.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    

    <section id="contact" class="py-5">
        <div class="container text-center">
            <h2>Contact Us</h2>
            <p>Email: contact@patisserie.com | Phone: +201113049943</p>
            <form class="mainForm_form mt-4" id="mainForm_form" action="submit.php" method="post" onsubmit="return false;">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name">
                    <!-- error message -->
                    <div class="error errorMessage" style="display: none;">Please enter your name</div>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email">
                    <div class="error errorMessage" style="display: none;">Please enter a valid email</div>
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Phone Number</label>
                    <input type="tel" class="form-control" id="phone" name="phone">
                    <div class="error errorMessage" style="display: none;">Please enter a valid phone number</div>
                </div>
                <div class="mb-3">
                    <label for="order" class="form-label">Order Selection</label>
                    <select class="form-select" id="order_name" name="order_name">
                        <option value="">Choose your order</option>
                        <option value="cake">Chocolate Cake</option>
                        <option value="croissant">Croissant</option>
                        <option value="macaron">Macaron</option>
                    </select>
                    <div class="error errorMessage" style="display: none;">Please choose an order</div>
                </div>
                <button type="submit" class="btn btn-primary form-control d-flex justify-content-center align-items-center submit-btn">
                    <span class="loader" style="display: none !important"></span>    
                    <span class="submit-txt">Submit Order</span>
                </button>

                <p class="success mt-1">Thank you! We will contact you soon</p>
                <p class="errorMsg mt-1">An error occurred, please try again</p>
            </form>
            
        </div>
    </section>
    
  
    <footer class="text-white text-center py-3" style="background-color: #5A3825;">
        <p>&copy; 2025 Sweet Shop. All rights reserved.</p>
    </footer>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/jquery-3.7.1.min.js"></script>

    <script>
        $('form.mainForm_form').on('submit', function(){

            var reg                   = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;

            var name                  = $('#name').val();

            var email                 = $('#email').val();

            var phone                 = $('#phone').val();

            var order_name            = $('#order_name').val();

            $('.error').hide();
            $('input, select').removeClass('invalid');

            // Validation

            if (name.trim() === '') {

                    $('#name').addClass('invalid');
                    $('#name~.errorMessage').fadeIn();

                    return false;

            }

            else if (email.trim() === '') {

                    $('#email').addClass('invalid');
                    $('#email~.errorMessage').fadeIn();

                    return false;

            }

            else if (email.trim() != '' && !reg.test(email)) {

                    $('#email').addClass('invalid');
                    $('#email~.errorMessage').fadeIn();

                    return false;

            }
            
            else if (phone.trim() === '') {

                    $('#phone').addClass('invalid');
                    $('#phone~.errorMessage').fadeIn();

                    return false;

            }
            else if (phone.trim().length < 11) {

                    $('#phone').addClass('invalid');
                    $('#phone~.errorMessage').fadeIn();

                    return false;

            }
            else if (order_name.trim() === '') {

                    $('#order_name').addClass('invalid');
                    $('#order_name~.errorMessage').fadeIn();

                    return false;

            }

            else {
                $('.error').hide();
                
                $('.loader').fadeIn();

                $('.submit-txt').hide();
                
                $('.submit-btn').prop('disabled', true);
                

                var that = $(this),

                url  = that.attr('action'), // action link

                type = that.attr('method'),

                data = {}; // to hold the user commming data

                that.find('[name]').each(function(index,value){ // will fetch each input with attribute name

                    var that = $(this),

                            name  = that.attr('name'),

                            value = that.val();

                    data[name] = value; // store the data in the data object to be sent over the php file without reloading

                });

                $.ajax({
                    

                    url: url,

                    type: type,

                    data: data,

                    success: function(response){
                        
                        $('.error').hide();
                        $('input, select').removeClass('invalid');
                        $('.loader').fadeOut();
                        $('.submit-txt').fadeIn();

                        $('.submit-btn').prop('disabled', false);

                        if (response.search("Thanks!") != -1) {
                            $('.success').fadeIn();
                            document.getElementById("mainForm_form").reset();

                        }else if (response.search("Error!") != -1) {
                            $('.errorMsg').fadeIn();
                        }else{
                            $('.errorMsg').fadeIn();
                        }

                    }

                });

                return false;

            }
        });
    </script>
</body>
</html>