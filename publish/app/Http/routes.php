<?php
/*Route::any('{all}', function(){
    return view('errors.302');
})->where('all', '.*');*/

Route::auth();

Route::group(['prefix' => 'message'], function (){
    Route::any('/', ['middleware' => 'auth','as' => 'massage', 'uses' => 'MessageController@index']);
});

Route::group(['prefix' => 'group/'], function (){
    Route::any('list/{user}', ['middleware' => 'auth','as' => 'group.list', 'uses' => 'GroupController@listGroup']);
    Route::any('create', ['middleware' => 'auth','as' => 'group.create', 'uses' => 'GroupController@create']);
    Route::any('store', ['middleware' => 'auth','as' => 'group.store', 'uses' => 'GroupController@store']);
    Route::any('destroy/{group}', ['middleware' => 'auth','as' => 'group.destroy', 'uses' => 'GroupController@destroy']);
    Route::any('{group}', ['middleware' => 'auth','as' => 'group', 'uses' => 'GroupController@show']);
});

Route::group(['prefix' => 'twit/'], function (){
    Route::post('create', ['middleware' => 'auth','as' => 'create.twit', 'uses' => 'TwitsController@create']);
    Route::any('delete/{twit}', ['middleware' => 'auth','as' => 'delete.twit', 'uses' => 'TwitsController@delete']);

    Route::any('repost/{twit}', ['middleware' => 'auth','as' => 'twit.share', 'uses' => 'TwitsController@repost']);
    Route::any('like/{twit}', ['middleware' => 'auth','as' => 'twit.like', 'uses' => 'TwitsController@likes']);
    Route::any('like-remove/{twit}', ['middleware' => 'auth','as' => 'twit.like-remove', 'uses' => 'TwitsController@likesRemove']);
    Route::any('comment/{twit}', ['middleware' => 'auth','as' => 'twit.comment', 'uses' => 'CommentController@add']);
    Route::any('comment/like/{comment}', ['middleware' => 'auth','as' => 'twit.comment.like', 'uses' => 'CommentController@like']);
    Route::any('comment/delete/{comment}', ['middleware' => 'auth','as' => 'twit.comment.delete', 'uses' => 'CommentController@delete']);
    Route::any('paginate/{user}', ['middleware' => 'auth','as' => 'twit.paginate', 'uses' => 'UserController@getTwitsPaginate']);
    Route::any('show/{twit}', ['middleware' => 'auth','as' => 'twit.show', 'uses' => 'TwitsController@show']);
    Route::any('', ['middleware' => 'auth','as' => 'twit', 'uses' => 'TwitsController@index']);
});



Route::group(['prefix' => 'profile/'], function (){
    Route::any('update', ['middleware' => 'auth', 'as' => 'profile.update', 'uses' => 'UserController@update']);
    Route::any('notice', ['middleware' => 'auth', 'as' => 'profile.notice', 'uses' => 'UserController@getNotice']);
    Route::any('{user}', ['middleware' => 'auth', 'as' => 'profile', 'uses' => 'UserController@index']);
    Route::any('friends/{user}', 'UserController@getFriends');
    Route::any('subscriber/{user}', 'UserController@getSubscriber');
    Route::any('friends/add/{user}', 'UserController@add');
    Route::any('friends/delete/{user}', 'UserController@delete');
    Route::any('delete/photo/{user}', ['as' => 'profile.photo.delete', 'uses' => 'UserController@deletePhoto']);
    Route::any('update/change-password', ['middleware' => 'auth', 'as' => 'profile.change-password', 'uses' => 'UserController@changePassword']);
    Route::any('update/change-password-form', ['middleware' => 'auth', 'as' => 'profile.change-password-form', 'uses' => 'UserController@changePasswordForm']);
    Route::any('update/change-nickname', ['middleware' => 'auth', 'as' => 'profile.change-nickname', 'uses' => 'UserController@changeNickname']);
    Route::any('update/change-nickname-form', ['middleware' => 'auth', 'as' => 'profile.change-nickname-form', 'uses' => 'UserController@changeNicknameForm']);
});


Route::group(['prefix' => 'search/'], function (){
    Route::any('', ['as' => 'search', 'uses' => 'SearchController@index']);
    Route::any('twits', ['as' => 'search.twits', 'uses' => 'SearchController@getTwitByHashTag']);
});
