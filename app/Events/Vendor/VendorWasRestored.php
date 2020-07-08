<?php
/**
 * Invoice Ninja (https://invoiceninja.com)
 *
 * @link https://github.com/invoiceninja/invoiceninja source repository
 *
 * @copyright Copyright (c) 2020. Invoice Ninja LLC (https://invoiceninja.com)
 *
 * @license https://opensource.org/licenses/AAL
 */

namespace App\Events\Vendor;

use App\Models\Company;
use App\Models\Vendor;
use Illuminate\Queue\SerializesModels;

/**
 * Class VendorWasRestored.
 */
class VendorWasRestored
{
    use SerializesModels;

    /**
     * @var Vendor
     */
    public $vendor;

    public $company;

    public $event_vars;
    /**
     * Create a new event instance.
     *
     * @param Vendor $vendor
     */
    public function __construct(Vendor $vendor, Company $company, array $event_vars)
    {
        $this->vendor = $vendor;
        $this->company = $company;
        $this->event_vars = $event_vars;
    }
    
}
