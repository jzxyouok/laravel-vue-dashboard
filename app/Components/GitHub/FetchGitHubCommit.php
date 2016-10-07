<?php

namespace App\Components\GitHub;

use App\Events\GitHub\CommitFetched;
use GitHub;
use Illuminate\Console\Command;

class FetchGitHubCommit extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'dashboard:githubcommit';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch Latest GitHub Commit.';

    public function handle()
    {
        $organization = env('GITHUB_ORGANIZATION');
        $repo = env('GITHUB_REPO');

        $commits = collect(GitHub::repos()->commits()->show("{$organization}", "{$repo}", 'master'));

        $commitFiles = collect($commits['files'])
            ->map(function ($fileInfo) {
                return [
                    'filename' => $fileInfo['filename'],
                    'status'   => $fileInfo['status']
                ];
            })
            ->toArray();

        $commitInfo = [
            'committer'  => $commits['commit']['committer']['name'],
            'date'       => $commits['commit']['committer']['date'],
            'message'    => $commits['commit']['message'],
            'files'      => $commitFiles
        ];

        event(new CommitFetched($commitInfo));
    }
}
