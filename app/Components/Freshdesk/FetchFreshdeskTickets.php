<?php

namespace App\Components\Freshdesk;

use App\Events\Freshdesk\FreshdeskTicketsFetched;
use Illuminate\Console\Command;
use Carbon\Carbon;
use DateTime;
use App\Components\Freshdesk\Exceptions\BadResponse;
    
class FetchFreshdeskTickets extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'dashboard:freshdesk';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch current Freshdesk tickets.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $freshdesk = new Freshdesk(config('freshdesk.apiKey'), config('freshdesk.password'), config('freshdesk.domain'));

        $tickets = $freshdesk->getTicketsSinceYesterday();

        if (!isset($tickets)) {
            throw BadResponse::create($freshdesk);
        }

        if (!count($tickets)) {
            return false;
        };

		foreach ($tickets as $ticket => $value) {
// dd('tickets', $tickets);
            if (is_null($value['company_id'])) {
                $company_name = '';
            } else {
                $company = $freshdesk->getCompany($value['company_id']);

                $company_name = $company['name'];
            }

            $agent = $freshdesk->getAgent($value['responder_id']);
// dd('responder_id', $value['responder_id'], 'requester_id', $value['requester_id']);
// dd('agent', $agent, $agent['contact']['name']);
            if ($value['responder_id'] === $value['requester_id']) {
                // dd('responder_id', $value['responder_id'], 'requester_id', $value['requester_id']);
                $requester_name = $agent['contact']['name'];
            } else {
                $requester = $freshdesk->getRequester($value['requester_id']);
                $requester_name = $requester['name'];
            }
            
            if (is_null($value['group_id'])) {
                $group_name = $value['description_text'];
                $group_description = $group_name;
            } else {
                $group = $freshdesk->getGroup($value['group_id']);

                $group_name = $group['name'];
                $group_description = $group['description'];
            }

            switch ($value['status']) {
                case '2':
                    $status = 'Open';
                    break;
                case '3':
                    $status = 'Pending';
                    break;
                case '4':
                    $status = 'Resolved';
                    break;
                case '5':
                    $status = 'Closed';
                    break;
            }

            switch ($value['priority']) {
                case '1':
                    $priority = 'Low';
                    break;
                case '2':
                    $priority = 'Medium';
                    break;
                case '3':
                    $priority = 'High';
                    break;
                case '4':
                    $priority = 'Urgent';
                    break;
            }

            $ticketInfo[] = array(
                'group_id'          => $value['group_id'],
                'ticket_id'         => $value['id'],
                'requester_id'      => $value['requester_id'],
                'responder_id'      => $value['responder_id'],
                'company_id'        => $value['company_id'],
                'subject'           => $value['subject'],
                'type'              => $value['type'],
                'subject'           => $value['subject'],
                'updated_at'        => $value['updated_at'],
                'status'            => $status,
                'priority'          => $priority,
                'company_name'      => $company_name,
                'requester_name'    => $requester_name,
                'agent_name'        => $agent['contact']['name'],
                'group_name'        => $group_name,
                'group_description' => $group_description,
            );
        }

        event(new FreshdeskTicketsFetched($ticketInfo));
    }
}
