@include('inc-top')
<!doctype html>
<html lang="fr">
	<head>
		@include('inc-meta')
		<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
		<meta http-equiv="Pragma" content="no-cache" />
		<meta http-equiv="Expires" content="0" />
		<title>Soutien</title>
	</head>

	<body>

		<div id="app">

			<nav class="navbar navbar-expand-md navbar-light">
				<div class="container">
					<div>
						<div class="pl-4"><a href="{{ url('/') }}"><img src="{{ asset('img/mon-oral.png') }}" width="40" /></a></div>
						<div class="pl-4 text-monospace text-center" style="color:#c5c7c9;margin-top:4px;width=40px;font-size:70%;">soutien</div>
					</div>
				</div>
			</nav>

			<div class="container">

				<div class="row mt-4 mb-3">

                    <div class="col-md-4 offset-md-4">
                        <div class="text-center text-monospace mb-2">SOUTENIR LE PROJET</div>
                        <div class="text-monospace text-muted" style="text-align:justify">Si ce site vous est utile vous pouvez soutenir le projet en choisissant une des options ci-dessous. Le seul but est de couvrir les frais d'hébergement et de renouvellement du nom de domaine.</div>
                    </div>

                </div><!-- /row -->

                <div class="row">    

					<div class="col-md-2 offset-md-5">
                        <div id="smart-button-container">
                            <div class="text-center">
                                <select id="item-options" class="form-control form-control-sm">
                                    <option value="1" price="20">20 &euro;</option>
                                    <option value="2" price="40">40 &euro;</option>
                                    <option value="3" price="60">60 &euro;</option>
                                    <option value="4" price="80">80 &euro;</option>
                                    <option value="5" price="100">100 &euro;</option>
                                </select>
                                <select style="visibility: hidden" id="quantitySelect"></select>
                                <div id="paypal-button-container"></div>
                            </div>
                        </div>
					</div>

				</div><!-- /row -->

			</div><!-- /container -->

		</div><!-- /app -->

        <script src="https://www.paypal.com/sdk/js?client-id=AaixkBWUt8O6O0ZG8jPMjlx6KPkYy1yQ30ZLpeCeO3FKCEk19tVuIfLQmahHmCgbEPMA5PN9XocjaMwe&enable-funding=venmo&currency=EUR" data-sdk-integration-source="button-factory"></script>
        <script>
        function initPayPalButton() {
            var shipping = 0;
            var itemOptions = document.querySelector("#smart-button-container #item-options");
        var quantity = parseInt();
        var quantitySelect = document.querySelector("#smart-button-container #quantitySelect");
        if (!isNaN(quantity)) {
        quantitySelect.style.visibility = "visible";
        }
        var orderDescription = 'Soutenir le projet';
        if(orderDescription === '') {
        orderDescription = 'Item';
        }
        paypal.Buttons({
        style: {
            shape: 'rect',
            color: 'black',
            layout: 'horizontal',
            label: 'paypal',
            
        },
        createOrder: function(data, actions) {
            var selectedItemDescription = itemOptions.options[itemOptions.selectedIndex].value;
            var selectedItemPrice = parseFloat(itemOptions.options[itemOptions.selectedIndex].getAttribute("price"));
            var tax = (0 === 0 || false) ? 0 : (selectedItemPrice * (parseFloat(0)/100));
            if(quantitySelect.options.length > 0) {
            quantity = parseInt(quantitySelect.options[quantitySelect.selectedIndex].value);
            } else {
            quantity = 1;
            }

            tax *= quantity;
            tax = Math.round(tax * 100) / 100;
            var priceTotal = quantity * selectedItemPrice + parseFloat(shipping) + tax;
            priceTotal = Math.round(priceTotal * 100) / 100;
            var itemTotalValue = Math.round((selectedItemPrice * quantity) * 100) / 100;

            return actions.order.create({
            purchase_units: [{
                description: orderDescription,
                amount: {
                currency_code: 'EUR',
                value: priceTotal,
                breakdown: {
                    item_total: {
                    currency_code: 'EUR',
                    value: itemTotalValue,
                    },
                    shipping: {
                    currency_code: 'EUR',
                    value: shipping,
                    },
                    tax_total: {
                    currency_code: 'EUR',
                    value: tax,
                    }
                }
                },
                items: [{
                name: selectedItemDescription,
                unit_amount: {
                    currency_code: 'EUR',
                    value: selectedItemPrice,
                },
                quantity: quantity
                }]
            }]
            });
        },
        onApprove: function(data, actions) {
            return actions.order.capture().then(function(orderData) {
            
            // Full available details
            console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));

            // Show a success message within this page, e.g.
            const element = document.getElementById('paypal-button-container');
            element.innerHTML = '';
            element.innerHTML = '<h3>Merci!</h3>';

            // Or go to another URL:  actions.redirect('thank_you.html');

            });
        },
        onError: function(err) {
            console.log(err);
        },
        }).render('#paypal-button-container');
        }
        initPayPalButton();
        </script>
 
	</body>
</html>
