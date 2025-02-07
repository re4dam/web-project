document.addEventListener('DOMContentLoaded', function () {
    if(window.pageName === 'pembayaran'){
        const transferRadio = document.getElementById('transfer');
        const qrisRadio = document.getElementById('qris');
        const bankOptions = document.getElementById('bank-options');

        transferRadio.addEventListener('change', function () {
            if (transferRadio.checked) {
                bankOptions.style.display = 'block';
                bankOptions.classList.add('show'); // Directly add class
            }
        });

        qrisRadio.addEventListener('change', function () {
            if (qrisRadio.checked) {
                bankOptions.classList.remove('show'); // Remove class first
                bankOptions.style.display = 'none'; // Then hide
            }
        });

        document.querySelectorAll('input[name="payment_method"]').forEach(function (radio) {
            if (radio.id !== 'transfer' && radio.id !== 'qris') {
                radio.addEventListener('change', function () {
                    bankOptions.classList.remove('show');
                    bankOptions.style.display = 'none';
                });
            }
        });
    }
});



document.addEventListener('DOMContentLoaded', function () {
    console.log('DOM fully loaded and parsed');
    function setFormAction(status) {
        if (window.pageName === 'detail') {
            var form = document.getElementById('routeForm');
            var Url = window.pembayaranUrl;
            var input = document.createElement("input");

            // Remove any previous "state" input if it exists
            var existingInput = document.querySelector('input[name="state"]');
            if (existingInput) {
                existingInput.remove();
            }

            if (status === 'paying') {
                Url = window.bayarUrl;
                input.setAttribute("type", "hidden");
                input.setAttribute("name", "state");
                input.setAttribute("value", 2);
                form.appendChild(input);
            } else if(status === 'pending'){
                form.action = Url;
                form.submit();
            }

            form.action = Url;
            form.style.display = 'block';
            form.submit();
        }

    }

    window.setFormAction = setFormAction;
});