<script type="text/javascript">
        function changeClass() {
            $('#RBbtn').removeClass('d-none');
            $('#ABbtn').addClass('d-none');
        }

        window.onload = function () {
            // document.getElementById("ABbtn").addEventListener('click', changeClass);
        }

        function deleteCoupon(id) {
            Swal.fire({
                title: 'Are you sure?',
                html: "<p>You won't be able to revert this!</p><br><p>Deleting a coupon does not affect any customers who have already applied the coupon; it means that new customers can’t redeem the coupon.</p>",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Nope, never mind.'
            }).then((result) => {
                if (result.value) {

                    Toast.fire({
                        title: 'Deleting...',
                        // type: 'info',
                        showCancelButton: false,
                        showConfirmButton: false,
                        allowOutsideClick: false
                    });

                    Toast.showLoading();

                    $.ajax({
                        url: `/promotions-delete-coupon/${id}`,
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                    }).done(function (msg) {
                        if (msg['success']) {
                            Toast.fire({
                                title: 'Success!',
                                text: 'Coupon deleted!',
                                type: 'success',
                                showCancelButton: false
                            });

                            $('#promotion_' + msg['msg']).remove();
                        } else {
                            Swal.fire({
                                title: 'Oops!',
                                text: msg['msg'],
                                type: 'warning',
                                showCancelButton: false
                            });
                        }
                    });
                }
            });
        }
    </script>
