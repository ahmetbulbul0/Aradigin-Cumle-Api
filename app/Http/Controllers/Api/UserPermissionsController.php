<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\UserPermissions;
use App\Http\Controllers\Controller;
use App\Http\Tools\RelationshipGenerator;
use App\Http\Resources\UserPermissionsResource;
use App\Http\Resources\UserPermissionsCollection;
use App\Http\Requests\StoreUserPermissionsRequest;
use App\Http\Requests\UpdateUserPermissionsRequest;

class UserPermissionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = new UserPermissions();
        $data = $data->where("is_deleted", false);
        $data = RelationshipGenerator::addRelationship("userData", $data);
        $data = $data->paginate();
        $data = new UserPermissionsCollection($data);
        return $data;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUserPermissionsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserPermissionsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserPermissions  $userPermissions
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $no = $request->user_permission;
        $userPermission = UserPermissions::where(["is_deleted" => false, "no" => $no])->with("userData")->first();
        return new UserPermissionsResource($userPermission);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserPermissionsRequest  $request
     * @param  \App\Models\UserPermissions  $userPermissions
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserPermissionsRequest $request, UserPermissions $userPermissions)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserPermissions  $userPermissions
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserPermissions $userPermissions)
    {
        //
    }
}
