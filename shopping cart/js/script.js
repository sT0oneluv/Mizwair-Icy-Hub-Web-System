let menu = document.querySelector('#menu-btn');
let navbar = document.querySelector('.header .navbar');

//make the menu rotate / move
menu.onclick = () => {
    menu.classList.toggle('fa-times');
    navbar.classList.toggle('active');
};

window.onscroll = () => {
    menu.classList.remove('fa-times');
    navbar.classList.remove('active');
};

// edit product action
document.querySelector('#close-edit').onclick = () => {
    // Close the edit form container
    document.querySelector('.edit-form-container').style.display = 'none';

    // Open the main file (admin.php)
    window.location.href = 'admin.php';
};


//JavaScript for modal functionality and AJAX requests
// Function to show order details modal
function showOrderDetails(orderId) {
    var modal = document.getElementById("orderDetailsModal");

    // AJAX request to fetch order details
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("orderDetailsContent").innerHTML = this.responseText;
            modal.style.display = "block";
        }
    };
    xhttp.open("GET", "get_order_details.php?id=" + orderId, true);
    xhttp.send();
}

// Function to close order details modal
function closeOrderDetailsModal() {
    var modal = document.getElementById("orderDetailsModal");
    modal.style.display = "none";
}

// Function to update order status
function ChangeOrderStatus(orderId) {
    $.ajax({
        url: "update_order_status.php",
        method: "post",
        data: {
            record: orderId
        },
        success: function (data) {
            alert('Order Status updated successfully');
            // Update the button text directly in the UI
            if (data.newOrderStatus == 0) {
                $('#orderStatusButton_' + orderId).text('Pending');
            } else {
                $('#orderStatusButton_' + orderId).text('Delivered');
            }
        }
    })
}

// Function to update payment status
function ChangePay(orderId) {
    $.ajax({
        url: "update_payment_status.php",
        method: "post",
        data: {
            record: orderId
        },
        success: function (data) {
            alert('Payment Status updated successfully');
            // Update the button text directly in the UI
            if (data.newPaymentStatus == 0) {
                $('#paymentStatusButton_' + orderId).text('Unpaid');
            } else {
                $('#paymentStatusButton_' + orderId).text('Paid');
            }
        }
    })
}