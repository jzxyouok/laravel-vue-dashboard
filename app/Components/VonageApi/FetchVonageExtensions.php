<?php

namespace App\Components\VonageApi;

use Illuminate\Console\Command;
use BobFridley\Vonage\Facades\Vonage;
use App\Events\VonageApi\VonageExtensions;
use App\Components\VonageApi\Exceptions\BadResponse;
use App\Components\Freshdesk\Freshdesk;

class FetchVonageExtensions extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'dashboard:vonage';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch all Vonage extensions.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $vonage = new VonageApi('main');

        $extensions = $vonage->getExtensions();

        if (!isset($extensions['extensions'])) {
            throw BadResponse::create($vonage);
        }

        if (!count($extensions['extensions'])) {
            return false;
        };
//dd($extensions['extensions']);
		foreach ($extensions['extensions'] as $extension => $value) {
            if (strlen(trim($value['name'])) > 0) {
                switch ($value['status']) {
                    case 'available':
                        $callIcon = 'fa-phone';
                        break;
                    case 'busy':
                        $callIcon = 'fa-volume-control-phone';
                        break;
                    default:
                        $callIcon = 'fa-times';
                        break;
                }

                $loginName = $value['loginName'];
                $callDirection = '';
                $onCallWith = '';
                $onCallWithName = '';
                $directionIcon = '';

                if ($value['status'] == 'busy') {
                    $callDetails = $vonage->getCallDetails($extension);
                    $callDetails = $callDetails['details']['presence'];
//dd($callDetails);
                    if (count($callDetails) > 0) {
                        $callDirection = $callDetails['direction'];

                        switch ($callDirection) {
                            case 'inbound':
                                $directionIcon = 'fa-long-arrow-left';
                                break;
                            case 'outbound':
                                $directionIcon = 'fa-long-arrow-right';
                                break;
                            default:
                                $directionIcon = '';
                                break;
                        }
                        $onCallWithName = $callDetails['onCallWithName'];

                        // remove 1st digit = 1
                        $onCallWith = substr($callDetails['onCallWith'], 1, 10);

                        // get Freshdesk company
                        $company = Freshdesk::getCompanyByPhone($onCallWith);
//dd($company);
                        $onCallWith = (count($company) == 0) ? $onCallWithName : $company[0]['company'];
                    }
                }

                $extensionInfo[] = array(
                    'extension'     => $extension,
                    'name'          => $value['name'],
                    'status'        => $value['status'],
                    'callIcon'      => $callIcon,
                    'directionIcon' => $directionIcon,
                    'company'       => $onCallWith,
                    'callerId'      => $onCallWithName
                );
            }
        }
//dd($extensionInfo);
        usort($extensionInfo, function($a, $b) {
            return $a['status'] < $b['status'];
        });

        event(new VonageExtensions($extensionInfo));
    }
}
