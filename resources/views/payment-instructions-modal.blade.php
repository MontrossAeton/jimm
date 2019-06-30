<div class="modal" id="payment-instructions" tabindex="-1" role="dialog" aria-labelledby="payment-instructions-label" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="payment-instructions-label">Payment Instructions</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h3>Hello, {{ auth()->user()->name }}!</h3>
                <p>We are the Jimboy Team and we want you to follow these steps in paying a subscription</p>
                <p>Step 1. - Find the nearest bank to your establishment</p>
                <p>Step 2. - Get a "Cash Transaction Slip"</p>
                <p>Step 3. - Fill up the important details</p>
                <p>Step 4. - Put on the Account name <strong class="font-weight-bold">"Jimboy"</strong></p>
                <p>Step 5. - Put on the Account number <strong class="font-weight-bold">"00800045570"</strong></p>
                <p>Step 6. - Put the price that you have chosen on our website.</p>
                <p>Step 7. - After the transaction email us in <strong class="font-weight-bold">jimmboylocator@gmail.com</strong> for the proof and send attachments for the validation of your payment.</p>
                <p class="text-danger font-weight-bold">Note</p>
                <p>For Customer:</p>
                <p>The price for a monthly subscription is <strong class="font-weight-bold">Php 160.00</strong></p>
                <p>For an annual subscription: <strong class="font-weight-bold">Php 1920.00</strong></p>
                <br>
                <p>For Gym Provider:</p>
                <p>The price for a monthly subscription is <strong class="font-weight-bold">Php 801.3</strong></p>
                <p>For an annual subscription: <strong class="font-weight-bold">Php 9,615.6</strong></p>
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
