<?php

namespace App\Components\GoogleTasks;

use App\Events\GoogleTasks\DiversifiedTasksFetched;
use App\Events\GoogleTasks\ServiceBureauTasksFetched;
use Carbon\Carbon;
use DateTime;
use Illuminate\Console\Command;
use BobFridley\GoogleTasks\Tasks;
use BobFridley\GoogleTasks\TaskLists;

class FetchGoogleTasks extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'dashboard:task';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch Google Tasks.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $tasklists = $this->getTaskLists();

        foreach ($tasklists as $tasklist) {
            if (starts_with($tasklist['title'], 'Diversified')) {
                $this->getDiversifiedTasks($tasklist['id']);
            }

            if (starts_with($tasklist['title'], 'ServiceBureau')) {
                $this->getDiversifiedTasks($tasklist['id']);
            }
        }
    }

    /**
     * [getTaskLists description]
     * 
     * @return [type] [description]
     */
    public function getTaskLists()
    {
        return $this->makeListsRequest();
    }

    /**
     * [getDiversifiedTasks description]
     * 
     * @param  [type] $taskListId [description]
     * @return [type]             [description]
     */
    public function getDiversifiedTasks($taskListId)
    {
        $tasks = $this->makeTaskRequest($taskListId);

        event(new DiversifiedTasksFetched($tasks));
    }

    /**
     * [getServiceBureauTasks description]
     * 
     * @param  [type] $taskListId [description]
     * @return [type]             [description]
     */
    public function getServiceBureauTasks($taskListId)
    {
        $tasks = $this->makeTaskRequest($taskListId);

        event(new ServiceBureauTasksFetched($tasks));
    }

    /**
     * [makeTaskRequest description]
     * 
     * @param  [type] $taskListId [description]
     * @return [type]             [description]
     */
    public function makeTaskRequest($taskListId)
    {
        $dueDate = Carbon::now();
        $dueDate->setTimezone($dueDate->getTimezone());

        $tasks = collect(Tasks::get($dueDate, [], $taskListId))
            ->reject(function (Tasks $tasks) {
                return is_null($tasks->due);
            })
            ->map(function (Tasks $tasks) {
                $tasks->updated->setTimezone($tasks->updated->getTimezone());
                $tasks->due->setTimezone($tasks->due->getTimezone());

                return [
                    'id'       => $tasks->id,
                    'parent'   => $tasks->parent,
                    'position' => $tasks->position,
                    'title'    => $tasks->title,
                    'notes'    => $tasks->notes,
                    'status'   => $tasks->status,
                    'updated'  => Carbon::createFromFormat('Y-m-d H:i:s', $tasks->updated)->format(DateTime::ATOM),
                    'due'      => Carbon::createFromFormat('Y-m-d H:i:s', $tasks->due)->format(DateTime::ATOM)
                ];
            })
            ->toArray();

        return $tasks;
    }

    /**
     * [makeListsRequest description]
     * 
     * @return [type] [description]
     */
    public function makeListsRequest()
    {
        $tasklists = collect(TaskLists::get())
            ->map(function (TaskLists $tasklists) {
                $tasklists->updated->setTimezone($tasklists->updated->getTimezone());

                return [
                    'kind'     => $tasklists->kind,
                    'id'       => $tasklists->id,
                    'title'    => $tasklists->title,
                    'updated'  => Carbon::createFromFormat('Y-m-d H:i:s', $tasklists->updated)->format(DateTime::ATOM),
                    'selfLink' => $tasklists->selfLink
                ];
            })
            ->toArray();

        return $tasklists;
    }
}
