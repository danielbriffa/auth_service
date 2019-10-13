<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Requests\UserData\UserDataShowRequest;
use App\Http\Requests\UserData\UserDataShowAllRequest;
use App\Http\Requests\UserData\UserDataUpdateRequest;
use App\Http\Requests\UserData\UserDataDeleteRequest;
use App\Http\Controllers\Controller;
use App\Managers\UsersManager;

class UserDataController extends Controller
{    

    protected $usersManager;

    public function __construct() 
    {
        $this->usersManager = new UsersManager();
    }

    /**
     * Returns all UserData objects of user
     *
     * @param
     * @return \Illuminate\Http\Response
     */
    public function showAll(UserDataShowAllRequest $request)
    {       
        $response = $this->usersManager->getUserDataAll($request->user()->id);

        return response()
                ->json($response, 200);
    }

    /**
     * Returns UserData of key passed, belonging to user
     *
     * @param   string  key - Key of UserData Object
     * @return  \Illuminate\Http\Response
     */
    public function show(UserDataShowRequest $request)
    {
        $response = $this->usersManager->getUserDataByKey($request->user()->id, $request->key);
       
        return response()
               ->json($response, 200);
    }
    
    /**
     * Add the specified resource in specified object in storage.
     *
     * @param   string  key - Key of UserData Object
     * @param   string  value - Value of UserData Object to be inserted
     * @return \Illuminate\Http\Response
     */
    public function addValue(UserDataUpdateRequest $request)
    {
        return ($this->usersManager->insertUserDataValueByKey($request->user()->id, $request->key, $request->value) === true) 
            ? response(null, 201)
            : response(null, 400);       
    }

    /**
     * Removes the specified resource in specified object from storage.
     *
     * @param   string  key - Key of UserData Object
     * @param   string  value - Value of UserData Object to be deleted
     * @return \Illuminate\Http\Response
     */
    public function deleteValue(UserDataUpdateRequest $request)
    {
        return ($this->usersManager->removeUserDataValueByKey($request->user()->id, $request->key, $request->value) === true) 
        ? response(null, 200)
        : response(null, 400); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param   string  key - Key of UserData Object
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserDataDeleteRequest $request)
    {
        return ($this->usersManager->removeUserDataByKey($request->user()->id, $request->key) === true) 
        ? response(null, 200)
        : response(null, 400); 
    }
}
