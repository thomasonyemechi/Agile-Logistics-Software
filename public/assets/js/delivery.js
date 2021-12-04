$(function() {

    $('body').on('click', '.manageOrder', function() {
        data = $(this).data('data');
        message_strings = JSON.parse(data.message);

        $('#manageDeliveryModal').modal('show');
        modal = document.querySelector('#manageDeliveryModal');

        modal.querySelector('input[name="delivery_id"]').value = data.id;
        $('#titleModal').html(`Manage Delivery (${data.freight.bill_number})`)
        action = modal.querySelector('select[name="action"]');
        msg = modal.querySelector('textarea[name="message"]');





        if (data.status == 2) {
            action.disabled = true;
            msg.disabled = true;
        }



        $('#displayMsg').html(``);
        if (message_strings != null) {
            console.log(message_strings);

            message_strings.map((rep) => {
                $('#displayMsg').append(`
                    <tr>
                        <td colspan="12" >${rep.message}</td>
                    </tr>
                `)
            })
        }



        // son.innerHTML = inner;


        // console.log(message_string)

        // if (data.status == 0) {
        //     console.log() //.addAttributes('disabled', 'disabled');
        // }

        // console.log(action, msg);
    })
})