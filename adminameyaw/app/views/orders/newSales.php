<?php extract($data); ?>

<style>
    .btn-xs {
        padding: 3px 9px;
        font-size: 12px;
    }
</style>

<div class="card card-custom mt-6">
    <div class="card-body">
        <table class="table table-sm table-separate table-head-custom table-checkable" id="resultTable">
            <thead>
                <tr>
                    <th class="th-col-10">No.</th>
                    <th class="th-col-20">Order Id</th>
                    <th class="th-col-20">Client Name</th>
                    <th class="th-col-20">Amount Paid</th>
                    <th class="th-col-20">Payment Method</th>
                    <th class="th-col-20">Payment Period</th>
                    <th class="th-col-10">Action</th>
                </tr>
            </thead>
        </table> 
    </div>
</div>
<div id="pageActions"></div>


<script>

    var oTableNew = $('#resultTable').DataTable({
        stateSave: true,
        "bLengthChange": false,
        'processing': true,
        'serverSide': true,
        'serverMethod': 'post',
        'ajax': {
            'url' : `${urlroot}/paginations/invoicepayments`,
            'error': function (xhr, error, code) {
                console.log("Error: ", error);
            }
        },
        'columns': [
            { data: 'number' },
            { data: 'orderId' },
            { data: 'clientName' },
            { data: 'amountPaid' },
            { data: 'paymentMethod' },
            { data: 'paymentPeriod' },
            { data: 'action' },
        ],
        "language": {
            "info": "Showing _START_ to _END_ of _TOTAL_ entries",
            "infoEmpty": "Showing 0 to 0 of 0 entries",
            "infoFiltered": "(filtered from _MAX_ total entries)",
            "lengthMenu": "Show _MENU_ entries"
        }
    });

    
    $('#resultTable_filter').html(`
        <div class="input-icon">
            <input type="text" id="resultTable_search" class="form-control" placeholder="Search...">
            <span>
                <i class="flaticon2-search-1 text-muted"></i>
            </span>
        </div>
    `);


    $('#resultTable_search').on('keyup', function () {
        oTableNew.search($(this).val()).draw();
    });


    $(document).on('click', '.paymentReceipt', function () {
        var dbid = $(this).attr('dbid'); 
        var dataToSend = { dbid };
        $('html, body').animate({
            scrollTop: $("#pageActions").offset().top
        }, 500);
        $.post(`${urlroot}/orders/paymentReceipt`, dataToSend, function (response) {
            $('#pageActions').html(response); 
        });
    });


    // Pure JavaScript SHA-256
    function sha256(str) {
        const utf8 = new TextEncoder().encode(str);
        return cryptoHash(utf8);
    }

    function cryptoHash(buffer) {
        let h0 = 0x6a09e667,
            h1 = 0xbb67ae85,
            h2 = 0x3c6ef372,
            h3 = 0xa54ff53a,
            h4 = 0x510e527f,
            h5 = 0x9b05688c,
            h6 = 0x1f83d9ab,
            h7 = 0x5be0cd19;

        let k = [
            0x428a2f98, 0x71374491, 0xb5c0fbcf, 0xe9b5dba5, 0x3956c25b, 0x59f111f1, 0x923f82a4, 0xab1c5ed5,
            0xd807aa98, 0x12835b01, 0x243185be, 0x550c7dc3, 0x72be5d74, 0x80deb1fe, 0x9bdc06a7, 0xc19bf174,
            0xe49b69c1, 0xefbe4786, 0x0fc19dc6, 0x240ca1cc, 0x2de92c6f, 0x4a7484aa, 0x5cb0a9dc, 0x76f988da,
            0x983e5152, 0xa831c66d, 0xb00327c8, 0xbf597fc7, 0xc6e00bf3, 0xd5a79147, 0x06ca6351, 0x14292967,
            0x27b70a85, 0x2e1b2138, 0x4d2c6dfc, 0x53380d13, 0x650a7354, 0x766a0abb, 0x81c2c92e, 0x92722c85,
            0xa2bfe8a1, 0xa81a664b, 0xc24b8b70, 0xc76c51a3, 0xd192e819, 0xd6990624, 0xf40e3585, 0x106aa070,
            0x19a4c116, 0x1e376c08, 0x2748774c, 0x34b0bcb5, 0x391c0cb3, 0x4ed8aa4a, 0x5b9cca4f, 0x682e6ff3,
            0x748f82ee, 0x78a5636f, 0x84c87814, 0x8cc70208, 0x90befffa, 0xa4506ceb, 0xbef9a3f7, 0xc67178f2
        ];

        let l = buffer.length * 8;
        let w = new Uint32Array(64);
        let m = new Uint8Array(((l + 64 >> 9) << 4) + 15 << 2);
        m.set(buffer);
        m[l >> 3] |= 128;
        m.set(new Uint32Array([l >>> 29, l << 3]), m.length - 8);

        for (let i = 0; i < m.length; i += 64) {
            for (let j = 0; j < 16; j++) w[j] = (m[i + (j << 2)] << 24) | (m[i + (j << 2) + 1] << 16) | (m[i + (j << 2) + 2] << 8) | m[i + (j << 2) + 3];

            for (let j = 16; j < 64; j++) {
                let s0 = (w[j - 15] >>> 7 | w[j - 15] << 25) ^ (w[j - 15] >>> 18 | w[j - 15] << 14) ^ (w[j - 15] >>> 3);
                let s1 = (w[j - 2] >>> 17 | w[j - 2] << 15) ^ (w[j - 2] >>> 19 | w[j - 2] << 13) ^ (w[j - 2] >>> 10);
                w[j] = (w[j - 16] + s0 | 0) + (w[j - 7] + s1 | 0) | 0;
            }

            let a = h0, b = h1, c = h2, d = h3, e = h4, f = h5, g = h6, h = h7;
            for (let j = 0; j < 64; j++) {
                let s1 = (e >>> 6 | e << 26) ^ (e >>> 11 | e << 21) ^ (e >>> 25 | e << 7);
                let ch = e & f ^ ~e & g;
                let temp1 = h + s1 + ch + k[j] + w[j] | 0;
                let s0 = (a >>> 2 | a << 30) ^ (a >>> 13 | a << 19) ^ (a >>> 22 | a << 10);
                let maj = a & b ^ a & c ^ b & c;
                let temp2 = s0 + maj | 0;
                h = g, g = f, f = e, e = d + temp1 | 0, d = c, c = b, b = a, a = temp1 + temp2 | 0;
            }

            h0 += a, h1 += b, h2 += c, h3 += d, h4 += e, h5 += f, h6 += g, h7 += h;
        }

        return [h0, h1, h2, h3, h4, h5, h6, h7].map(h => ('00000000' + h.toString(16)).slice(-8)).join('');
    }

    // Function to hash and append dbid
    async function hashAndAppendDbid(dbid) {
        const hash = await sha256(dbid);
        return hash + ":" + dbid;
    }

    // Attach event listener
    $(document).on('click', '.printReceipt', async function () {
        var dbid = $(this).attr('dbid');
        var obfuscatedUuid = await hashAndAppendDbid(dbid);
        const checkoutUrl = `/orders/getReceipt?uuid=${encodeURIComponent(obfuscatedUuid)}`;
        window.location.href = checkoutUrl;
    });

</script>    