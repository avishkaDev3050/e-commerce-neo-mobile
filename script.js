function singleProduct(id) {
    window.location = 'singleProduct.php?id=' + id;
}


function signIn() {

    var uname = document.getElementById('uname').value;
    var pass  = document.getElementById('pass').value;
    var check = document.getElementById('check').checked;

    var form = new FormData();
    form.append('uname', uname);
    form.append('pass', pass);
    form.append('check', check);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if (request.status == 200 && request.readyState == 4) {
            if (request.responseText == 'success') {
                window.location = 'index.php';
            } else {
                document.getElementById('err').innerHTML = request.responseText;
                document.getElementById('msg').className = "d-block";
                document.getElementById('msg').className = "bg-danger p-3";
            }
        }
    };
    request.open('POST', 'signInProccess.php', true);
    request.send(form);

}

function signUp() {
    
    var f = document.getElementById('f').value;
    var l = document.getElementById('l').value;
    var m = document.getElementById('m').value;
    var e = document.getElementById('e').value;
    var p = document.getElementById('p').value;

    var form = new FormData();
    form.append('f', f);
    form.append('l', l);
    form.append('m', m);
    form.append('e', e);
    form.append('p', p);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if (request.status == 200 && request.readyState == 4) {
            // alert(request.responseText);
            if (request.responseText == 'success') {
                window.location = 'signIn.php';
            } else {
                document.getElementById('err').innerHTML = request.responseText;
                document.getElementById('msg').className = "d-block";
                document.getElementById('msg').className = "bg-danger p-3";
            }
        }
    };
    request.open('POST', 'signUpProcces.php', true);
    request.send(form);

}


var fpm;

function forgotPassword() {

    var e = document.getElementById('uname').value;
    
    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Success") {
                alert("Verification code has sent to your email. Please check your inbox");
                var m = document.getElementById("forgotPasswordModal");
                fpm = new bootstrap.Modal(m);
                fpm.show();
            } else {
                alert(t);
            }
        }
    };

    r.open("GET", "forgotPasswordProcess.php?e=" + e, true);
    r.send();


}



function ShowPassword() {

    var i = document.getElementById("npi");
    var eye = document.getElementById("e1");

    if (i.type == "password") {
        i.type = "text";
        eye.className = "bi bi-eye-fill";
    } else {
        i.type = "password";
        eye.className = "bi bi-eye-slash-fill";
    }

}

function ShowPassword2() {

    var i = document.getElementById("rnp");
    var eye = document.getElementById("e2");

    if (i.type == "password") {
        i.type = "text";
        eye.className = "bi bi-eye-fill";
    } else {
        i.type = "password";
        eye.className = "bi bi-eye-slash-fill";
    }

}

function resetpw() {

    var email = document.getElementById("uname");
    var np = document.getElementById("npi");
    var rnp = document.getElementById("rnp");
    var vcode = document.getElementById("vc");

    var f = new FormData();
    f.append("e", email.value);
    f.append("n", np.value);
    f.append("r", rnp.value);
    f.append("v", vcode.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {

                fpm.hide();
                alert("Password reset success");

            } else {
                alert(t);
            }

        }
    };

    r.open("POST", "resetPassword.php", true);
    r.send(f);

}


function addToCart(id) {

    var qty = document.getElementById('qty').value;
    var clr = document.getElementById('color').value;
    
    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if (request.status == 200 && request.readyState == 4) {
            if (request.responseText == 'error') {
                window.location = 'signIn.php';
            } else {
                if (request.responseText == 'success') {
                    var m  = document.getElementById('msg-modal');
                    document.getElementById('msg-body').innerHTML = 'Succesfuly aded cart.';
                    var bm = new bootstrap.Modal(m);
                    bm.show();
                } else {
                    var m  = document.getElementById('msg-modal');
                    document.getElementById('msg-body').innerHTML = request.responseText;
                    var bm = new bootstrap.Modal(m);
                    bm.show();
                }
            }
        }
    };
    request.open('GET', 'cartProccess.php?id=' + id + '&qty=' + qty + '&clr=' + clr, true);
    request.send();

}


function addToWishList(id) {

    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if (request.status == 200 && request.readyState == 4) {
            if (request.responseText == 'success') {
                var m  = document.getElementById('msg-modal');
                document.getElementById('msg-body').innerHTML = 'Succesfuly aded wish list.';
                var bm = new bootstrap.Modal(m);
                bm.show();
            } else if(request.responseText == 'update'){
                var m  = document.getElementById('msg-modal');
                document.getElementById('msg-body').innerHTML = 'All ready have aded.';
                var bm = new bootstrap.Modal(m);
                bm.show();
            } else {
                window.location = 'signIn.php';
            }
        }
    };
    request.open('GET', 'addToWishList.php?id=' + id, true);
    request.send();

}


function buyNow(id) {
    
    var qty = document.getElementById('qty').value;
    
    var form = new FormData();
    form.append('id', id);
    form.append('qty', qty);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if (request.status == 200 && request.readyState == 4) {
            $obj = JSON.parse(request.responseText);
            // Payment completed. It can be a successful failure.
            payhere.onCompleted = function onCompleted(orderId) {
                console.log("Payment completed. OrderID:" + orderId);
                // Note: validate the payment and show success or failure page to the customer
            };

            // Payment window closed
            payhere.onDismissed = function onDismissed() {
                // Note: Prompt user to pay again or show an error page
                console.log("Payment dismissed");
            };

            // Error occurred
            payhere.onError = function onError(error) {
                // Note: show an error page
                console.log("Error:"  + error);
            };

            // Put the payment variables here
            var payment = {
                "sandbox": true,
                "merchant_id": "1226423",    // Replace your Merchant ID
                "return_url": "http://localhost/NEO/singleProduct.php?id=1012345",     // Important
                "cancel_url": "http://localhost/NEO/singleProduct.php?id=1012345",     // Important
                "notify_url": "http://sample.com/notify",
                "order_id": $obj.order_id,
                "items": $obj.item,
                "amount": $obj.amount,
                "currency": $obj.currency,
                "hash": $obj.hash, // *Replace with generated hash retrieved from backend
                "first_name": $obj.fname,
                "last_name": $obj.lname,
                "email": $obj.email,
                "phone": $obj.phone,
                "address": $obj.addres,
                "city": $obj.city,
                "country": $obj.country,
                "delivery_address": $obj.addres,
                "delivery_city": $obj.city,
                "delivery_country": $obj.country,
                "custom_1": "",
                "custom_2": ""
            };
            
            payhere.startPayment(payment);

            // Show the payhere.js popup, when "PayHere Pay" is clicked
            document.getElementById('payhere-payment').onclick = function (e) {
                payhere.startPayment(payment);
            };
        }
    };
    request.open('POST', 'paymentProccess.php?id=', true);
    request.send(form);

}

function cartChekOut() {
    alert();
}