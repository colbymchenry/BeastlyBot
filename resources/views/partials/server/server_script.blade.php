<script type="text/javascript">

    function refreshRoles() {
        var form = $("#refresh-roles-form");
        form.submit();
    }

    function fillRecentPayments(store_id) {
        if((jQuery("#recent-transactions-table:contains('$')").length)) {
            $('#btn_recent-refresh').addClass('btn-primary').removeClass('btn-dark');
        }
        $('#recent-transactions-table').empty();
        var count = 0;
        var html_array = [];
        $('.loading-bg').removeAttr('hidden');
        $('#btn_recent-refresh').addClass('spinning').attr("disabled", true);

        $.ajax({
            url: `/get-latest-transactions`,
            type: 'GET',
            data: {
                store_id: store_id,
                _token: '{{ csrf_token() }}'
            },
        }).done(function (response) {
            $('#recent-transactions-table').empty();
            var guild_id = response['guild_id'];

            response['subscriptions'].forEach(subscription => {
                var timeDiff = response['timeDiffs'][subscription['id']];
                var username = response['usernames'][subscription['id']];
                var role_id = subscription['metadata']['role_id'];
                var amount = subscription['latest_invoice_amount'] / 100;
                var html = `
                <tr data-url="/slide-invoice?id=${subscription['latest_invoice_id']}&user_id=${subscription['user_id']}&guild_id=${guild_id}&role_id=${role_id}" data-toggle="slidePanel">
                `;

                if(timeDiff['hours'] < 1) {
                    html += `<td class="w-120 font-size-12 pl-20">${timeDiff['minutes']}  minutes ago.</td>`;
                } else {
                    html += `<td class="w-120 font-size-12 pl-20">${timeDiff['hours']}  hours ago.</td>`;
                }

                html += `
                <td class="content"><div>${username}</div></td>
                    <td class="green-600 w-80">+ $${amount}</td>
                </tr>
                `;

                $('#recent-transactions-table').append(html);
            });

            $('.loading-bg').attr('hidden', true);
            $('#btn_recent-refresh').removeClass('spinning').attr("disabled", false);
            if ($('#btn_recent-refresh').hasClass('btn-primary')){
                $('#btn_recent-refresh').addClass('btn-dark').removeClass('btn-primary');
            }

        });
    }
</script>
