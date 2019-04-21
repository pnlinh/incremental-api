<?php

Route::group([
    'prefix' => 'v1',
    'as' => 'api.',
], function () {
    Route::resource('lessons', 'LessonController');
});
