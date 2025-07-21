document.addEventListener('DOMContentLoaded', function () {
    if (!stripeKey) return;

    const stripe = Stripe(stripeKey);
    const elements = stripe.elements();

    const cardElement = elements.create('card', {
        style: {
            base: {
                color: '#32325d',
                fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                fontSize: '16px',
                fontSmoothing: 'antialiased',
                '::placeholder': {
                    color: '#aab7c4'
                }
            },
            invalid: {
                color: '#fa755a',
                iconColor: '#fa755a'
            }
        }
    });

    cardElement.mount('#card-element');

    const cardHolderName = document.getElementById('card-holder-name');
    const cardButton = document.getElementById('card-button');
    const clientSecret = cardButton?.dataset.secret;
    const form = document.getElementById('card-form');
    const cardError = document.getElementById('card-error');
    const errorList = document.getElementById('error-list');

    if (!clientSecret || !form || !cardButton) return;

    cardError.style.display = 'none';

    cardButton.addEventListener('click', async function (e) {
        e.preventDefault();

        errorList.innerHTML = '';
        cardError.style.display = 'none';

        if (!cardHolderName.value.trim()) {
            cardError.style.display = 'block';
            const li = document.createElement('li');
            li.textContent = 'カード名義人の入力は必須です。';
            errorList.appendChild(li);
            return;
        }

        const { setupIntent, error } = await stripe.confirmCardSetup(clientSecret, {
            payment_method: {
                card: cardElement,
                billing_details: {
                    name: cardHolderName.value,
                },
            },
        });

        if (error) {
            cardError.style.display = 'block';
            const li = document.createElement('li');
            li.textContent = error.message;
            errorList.appendChild(li);
            return;
        }

        const hiddenInput = document.createElement('input');
        hiddenInput.type = 'hidden';
        hiddenInput.name = 'paymentMethodId';
        hiddenInput.value = setupIntent.payment_method;
        form.appendChild(hiddenInput);
        form.submit();
    });
});
