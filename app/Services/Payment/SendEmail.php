<?php
/**
 * Invoice Ninja (https://invoiceninja.com).
 *
 * @link https://github.com/invoiceninja/invoiceninja source repository
 *
 * @copyright Copyright (c) 2020. Invoice Ninja LLC (https://invoiceninja.com)
 *
 * @license https://opensource.org/licenses/AAL
 */

namespace App\Services\Payment;

use App\Helpers\Email\PaymentEmail;
use App\Jobs\Payment\EmailPayment;

class SendEmail
{
    public $payment;

    public $contact;

    public function __construct($payment, $contact)
    {
        $this->payment = $payment;

        $this->contact = $contact;
    }

    /**
     * Builds the correct template to send.
     * @return void
     */
    public function run()
    {
        $email_builder = (new PaymentEmail())->build($this->payment, $this->contact);

        $this->payment->client->contacts->each(function ($contact) use ($email_builder) {
            if ($contact->send && $contact->email) {
                EmailPayment::dispatchNow($this->payment, $email_builder, $contact, $this->payment->company);
            }
        });
    }
}