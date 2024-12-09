<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Webhook Test</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h1>Test Webhook</h1>
    <form id="webhookForm">
        <textarea id="jsonData" rows="20" cols="80">
{
    "transaction_time": "2024-12-03 21:04:03",
    "transaction_status": "capture",
    "transaction_id": "4a04d4b9-b791-4b11-83fd-66c44875ad14",
    "status_message": "midtrans payment notification",
    "status_code": "200",
    "signature_key": "ca43eb45f925944bf0309115dba129f4a006e6d6010a50eccea4df6575e6d9d36e3f43be6567b7d7bf0eb04be5c4a88fa585d5c0c098e652c240b880ec9cbcf7",
    "payment_type": "credit_card",
    "order_id": "ORDER-2b5f23a8-4fff-43a2-92ed-d921c6a8080e",
    "metadata": {},
    "merchant_id": "G660469192",
    "masked_card": "48111111-1114",
    "gross_amount": "450000.00",
    "fraud_status": "accept",
    "expiry_time": "2024-12-11 21:04:03",
    "currency": "IDR",
    "channel_response_message": "Approved",
    "channel_response_code": "00",
    "card_type": "credit",
    "bank": "cimb",
    "approval_code": "1733234644512"
}
        </textarea>
        <br><br>
        <button type="button" id="sendWebhook">Send Webhook</button>
    </form>

    <div id="response" style="margin-top: 20px;">
        <h2>Response:</h2>
        <pre id="responseText"></pre>
    </div>

    <script>
        $(document).ready(function () {
            $('#sendWebhook').click(function () {
                const jsonData = $('#jsonData').val();

                try {
                    const parsedData = JSON.parse(jsonData);

                    $.ajax({
                        url: '/webhook', // Sesuaikan dengan route Anda
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        data: JSON.stringify(parsedData),
                        success: function (response) {
                            $('#responseText').text(JSON.stringify(response, null, 4));
                        },
                        error: function (error) {
                            $('#responseText').text(JSON.stringify(error.responseJSON, null, 4));
                        }
                    });
                } catch (e) {
                    alert('Invalid JSON format');
                }
            });
        });
    </script>
</body>
</html>
