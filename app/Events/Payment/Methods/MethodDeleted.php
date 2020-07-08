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

namespace App\Events\Payment\Methods;

use App\Models\ClientGatewayToken;
use App\Models\Company;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MethodDeleted
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var ClientGatewayToken
     */
    private $payment_method;

    public $company;
    
    public $event_vars;
    /**
     * Create a new event instance.
     *
     * @param ClientGatewayToken $payment_method
     */
    public function __construct(ClientGatewayToken $payment_method, Company $company, array $event_vars)
    {
        $this->payment_method = $payment_method;
        $this->company = $company;
        $this->event_vars  = $event_vars;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
