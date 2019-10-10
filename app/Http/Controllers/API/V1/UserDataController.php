<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Requests\UserData\UserDataShowRequest;
use App\Http\Requests\UserData\UserDataShowAllRequest;
use App\Http\Requests\UserData\UserDataUpdateRequest;
use App\Http\Requests\UserData\UserDataDeleteRequest;
use App\Http\Controllers\Controller;
use App\UserData;

class UserDataController extends Controller
{    

    public function showAll(UserDataShowAllRequest $request)
    {
        //get fields of user        
        $user_data = UserData::where('user_id', $request->user()->id)->first();
        $response = $user_data->data ?: null;
       
        return response()
                ->json($response, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(UserDataShowRequest $request)
    {
        //get fields of user        
        $user_data = UserData::where('user_id', $request->user()->id)->first();
        $response = $user_data->data ?: null;
       
        if ($response !== null)
        {
            $response = isset($response[$request->key]) ? $response[$request->key] : null;
        }
       
        return response()
               ->json($response, 200);
    }
    
    /**
     * Add the specified resource in specified object in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function addValue(UserDataUpdateRequest $request)
    {
        //get fields of user        
        $user_data = UserData::where('user_id', $request->user()->id)->first();
        $response = $user_data->data ?: null;
       
        if ($response !== null)
        {
            //if key does not exist, create it
            if (!isset($response[$request->key]))
            {
                $response[$request->key] = [];
            }
            
            //insert value only if it does not exist
            if (!array_search($request->value, $response[$request->key]))
            {
                array_push($response[$request->key], $request->value); 
            }

            $user_data->data = $response;
            $user_data->save();

            return response(null, 201);
        }

        return response(null, 400);
       
    }

    /**
     * Add the specified resource in specified object in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteValue(UserDataUpdateRequest $request)
    {
        //get fields of user        
        $user_data = UserData::where('user_id', $request->user()->id)->first();
        $response = $user_data->data ?: null;
       
        if ($response !== null)
        {            
            if (($key = array_search($request->value, $response[$request->key])) !== false) {
                unset($response[$request->key][$key]);
            }
     
            $user_data->data = $response;
            $user_data->save();

            return response(null, 200);
        }

        return response(null, 400);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserDataDeleteRequest $request)
    {
        //get fields of user        
        $user_data = UserData::where('user_id', $request->user()->id)->first();
        $response = $user_data->data ?: null;
       
        if ($response !== null)
        {
            //if key does not exist, create it
            if (isset($response[$request->key]))
            {
                $response[$request->key] = [];

                $user_data->data = $response;
                $user_data->save();

                return response(null, 200);
            }
        }

        return response(null, 400);
    }
}
