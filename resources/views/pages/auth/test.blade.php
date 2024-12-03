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
    "transaction_time": "2024-12-03 18:37:10",
    "transaction_status": "capture",
    "transaction_id": "f1a36f35-a1a9-4b55-a614-5481e1ef59d4",
    "status_message": "midtrans payment notification",
    "status_code": "200",
    "signature_key": "3f827ae97a0ec80c308603a2af03a12a2d6b5de550c59125b9e29c6f88d814e9170c0efdf71dffb2c6b0e3f3e6b20bf9a13fd7ed7a5870c76546694ceef869be",
    "payment_type": "credit_card",
    "order_id": "ORDER-644b4775-c7dd-499c-bc46-913c5bb4332c",
    "metadata": {},
    "merchant_id": "G660469192",
    "masked_card": "48111111-1114",
    "gross_amount": "250000.00",
    "fraud_status": "accept",
    "expiry_time": "2024-12-11 18:37:10",
    "currency": "IDR",
    "channel_response_message": "Approved",
    "channel_response_code": "00",
    "card_type": "credit",
    "bank": "cimb",
    "approval_code": "1733225831436"
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
