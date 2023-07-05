<?php
namespace App\Repositories;

use App\User;
use App\Task;

class TaskRepository
{    
    /**
     * Get all of the tasks for a given user.
     *
     * @param  User  $user
     * @return Collection
     */
    public function forUser(User $user)
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', env('API_URL').'get-tasks?user_id='.$user->id);
        return $response->getBody()->getContents(); 
    }

    /**
     * Create task for a given user.
     *
     * @param  requestParam, User 
     * @return Collection
     */
    public function create($requestParam, User $user)
    {   
        $requestParam['user_id'] = $user->id;
        $client = new \GuzzleHttp\Client();
        return $client->request('POST', env('API_URL').'create-task', ['json' => $requestParam]);
    }

    /**
     * Create task for a given user.
     *
     * @param  User 
     * @return Collection
     */
    public function delete($taskId)
    {   
        $client = new \GuzzleHttp\Client();
        return $client->request('DELETE', env('API_URL').'delete-task?id='.$taskId);
    }
}
