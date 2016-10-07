<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['name', 'description'];

    /**
     * The user that belongs to the task.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    /**
     * The projects that belong to the task.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function projects()
    {
        return $this->belongsToMany(Project::class);
    }


    /**
     * Check if the task has specific project.
     * @param $category
     *
     * @return bool
     */
    public function hasJob($project)
    {
        $project_id = (is_int($project)) ? $project: $project->id;
        foreach ($this->projects as $project) {
            if ($project_id === $project->id){
                return true;
            }
        }
        return false;
    }

}
