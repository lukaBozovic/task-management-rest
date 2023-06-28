<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStatusRequest;
use App\Http\Requests\UpdateStatusRequest;
use App\Models\Status;

class StatusController extends Controller
{
    public function index()
    {
        return Status::query()->get();
    }

    public function store(StoreStatusRequest $request)
    {
        return Status::query()->create($request->validated());
    }

    public function update(UpdateStatusRequest $request, Status $status)
    {
        $status->update($request->validated());
        return $status;
    }

    public function destroy(Status $status)
    {
        if ($status->tasks()->exists())
            return response(['message' => 'status-has-tasks'], 403);
        $status->delete();
        return response('Successfully deleted');
    }



}
