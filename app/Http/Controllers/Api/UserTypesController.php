<?php

namespace App\Http\Controllers\Api;

use App\Models\UserTypes;
use Illuminate\Http\Request;
use App\Http\Tools\LimitGenerator;
use App\Http\Controllers\Controller;
use App\Http\Tools\EloquentGenerator;
use App\Http\Tools\SortingListGenerator;
use App\Http\Resources\UserTypesResource;
use App\Http\Tools\RelationshipGenerator;
use App\Http\Resources\UserTypesCollection;
use App\Http\Requests\StoreUserTypesRequest;
use App\Http\Requests\UpdateUserTypesRequest;

class UserTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = new UserTypes();
        $data = $data->where("is_deleted", false);
        $data = RelationshipGenerator::addRelationship("permissionsData", $data);
        $data = RelationshipGenerator::hasRelationshipInRequest($request, "users", $data);
        $data = $this->sorting($request, $data);
        $data = LimitGenerator::generateLimitAndPaginate($request, $data);
        $pagination = $data["pagination"];
        $data = $data["data"];
        $data = new UserTypesCollection($data);
        $response = [
            "data" => $data,
            "pagination" => $pagination
        ];
        return $response;
    }

    public function sorting($request, $data)
    {
        if ($request->sorting) {
            $sortingNames = [
                'no09',
                'no90',
                "nameAZ",
                "nameZA",
                "slugAZ",
                "slugZA",
                "permissionsAZ",
                "permissionsZA"
            ];
            $sortingList = SortingListGenerator::sortingListGenerate($sortingNames);
            $data = EloquentGenerator::orderByWithSortingList($request, $data, $sortingList);
        }
        return $data;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUserTypesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserTypesRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserTypes  $userTypes
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $no = $request->user_type;
        $data = new UserTypes();
        $data = $data->where(["is_deleted" => false, "no" => $no]);
        $data = RelationshipGenerator::addRelationship("permissionsData", $data);
        $data = RelationshipGenerator::hasRelationshipInRequest($request, "users", $data);
        $data = $data->first();
        $data = new UserTypesResource($data);
        return $data;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserTypesRequest  $request
     * @param  \App\Models\UserTypes  $userTypes
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserTypesRequest $request, UserTypes $userTypes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserTypes  $userTypes
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserTypes $userTypes)
    {
        //
    }
}
