$(document).ready(function(){
    $('#userModal').on('show.bs.modal', function (event) {
        console.log("this loaded");
            var button = $(event.relatedTarget);
            var recipient = button.data('id');
            var modal = $(this);
            modal.find('.modal-body input#UserID').val(recipient);
            $.ajax({
                type: 'POST',
                url: 'database_ajax.php',
                data: {UserID: recipient},
                dataType: "JSON",
                success: function (data) {
                    $('#Username').val(data.user.name);
                    $('#Email').val(data.user.email);
                },
                error: function() {
                    console.log('Error: ' + data);
                }
            });
        });
});


// $(document).ready(function(){
//     $('#editProductModal').on('show.bs.modal', function (event) {
//               var button = $(event.relatedTarget);
//               var recipient = button.data('id');
//               var modal = $(this);
             
//               modal.find('.modal-body input#product_id').val(recipient);
            
    
//             $.ajax({
//                 type: 'POST',
//                 url: 'database_ajax.php',
//                 data: {productid: recipient},
//                 dataType: "JSON",
//                 success: function (data) {
//                     $('#nameEditModal').val(data.product.name);
//                     $('#currentPriceEditModal').val(data.product.currentprice);
//                     $('#quantityEditModal').val(data.product.qtyonhand);
//                     $('#descriptionEditModal').val(data.product.description);
//                     $('#pictureEditModal').val(data.product.picture);
//                 },
//                 error: function() {
//                     console.log('Error: ' + data);
//                 }
//             });
    
//         });
//     });