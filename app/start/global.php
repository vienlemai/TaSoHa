<?php

/*
  |--------------------------------------------------------------------------
  | Register The Laravel Class Loader
  |--------------------------------------------------------------------------
  |
  | In addition to using Composer, you may use the Laravel class loader to
  | load your controllers and models. This is useful for keeping all of
  | your classes in the "global" namespace without Composer updating.
  |
 */

ClassLoader::addDirectories(array(
    app_path() . '/commands',
    app_path() . '/controllers',
    app_path() . '/controllers/Frontend',
    app_path() . '/models',
    app_path() . '/database/seeds',
    app_path() . '/helpers',
));

/*
  |--------------------------------------------------------------------------
  | Application Error Logger
  |--------------------------------------------------------------------------
  |
  | Here we will configure the error logger setup for the application which
  | is built on top of the wonderful Monolog library. By default we will
  | build a basic log file setup which creates a single file for logs.
  |
 */

Log::useFiles(storage_path() . '/logs/laravel.log');

/*
  |--------------------------------------------------------------------------
  | Application Error Handler
  |--------------------------------------------------------------------------
  |
  | Here you may handle any errors that occur in your application, including
  | logging them or displaying custom views for specific errors. You may
  | even register several error handlers to handle different types of
  | exceptions. If nothing is returned, the default error view is
  | shown, which includes a detailed stack trace during debug.
  |
 */

App::error(function(Exception $exception, $code) {
    Log::error($exception);
});

/*
  |--------------------------------------------------------------------------
  | Maintenance Mode Handler
  |--------------------------------------------------------------------------
  |
  | The "down" Artisan command gives you the ability to put an application
  | into maintenance mode. Here, you will define what is displayed back
  | to the user if maintenance mode is in effect for the application.
  |
 */

App::down(function() {
    return Response::make("Be right back!", 503);
});

/*
  |--------------------------------------------------------------------------
  | Require The Filters File
  |--------------------------------------------------------------------------
  |
  | Next we will load the filters file for the application. This gives us
  | a nice separate location to store our route and application filter
  | definitions instead of putting them all in the main routes file.
  |
 */

require app_path() . '/filters.php';
require app_path() . '/helpers/global.php';
Validator::extend('passmembercheck', function ($attribute, $value, $parameters) {
    if (!empty($parameters[0])) {
        $member = Member::where('id', $parameters[0])
            ->first(array('password'));
        return Hash::check($value, $member->password);
    }
    return Hash::check($value, Auth::member()->get()->password);
});
Event::listen('member.update.score', function($member, $score) {
    Log::info('Fire event update member score: ' . $score);
    //update score for member
    $member->score = $member->score + $score;
    //check score for promotion
    $sunMember = SunMember::with('children')->where('member_id', $member->id)
        ->remember(60)
        ->first();
    if ($sunMember->children->count() >= 4 && $member->score >= Member::$scoreForPromotion[Member::CAP_CHUYEN_VIEN]) {
        $scoreToCheckMember = $member->score + ($member->children_score * 40 / 100);
        $memberRegency = Member::getRegencyByScore($scoreToCheckMember);
    } else {
        $scoreToCheckMember = $member->score;
        $memberRegency = Member::getRegencyByScore($scoreToCheckMember);
        if ($scoreToCheckMember >= Member::$scoreForPromotion[Member::CAP_CHUYEN_VIEN]) {
            $memberRegency = Member::CAP_CHUYEN_VIEN;
        }
    }
    $member->regency = $memberRegency;
    Log::info('Update for member: ' . $member->full_name . ' children: ' . $sunMember->children->count() . 'score to check ' . $scoreToCheckMember . ' new regency : ' . $memberRegency);
    $member->save();
    if (!empty($sunMember->parent_id)) {
        $siblings = SunMember::where('parent_id', $member->parent_id)
            ->get();
        $sunParent = SunMember::where('id', $sunMember->parent_id)
            ->remember(60)
            ->first();
        $parentMember = Member::where('id', $sunParent->member_id)
            ->remember(60)
            ->first();
        $parentMember->children_score = $parentMember->children_score + $score;
        if ($siblings->count() >= 4 && $parentMember->score >= Member::$scoreForPromotion[Member::CAP_CHUYEN_VIEN]) {
            $scoreToCheckParent = $parentMember->score + $parentMember->children_score;
            $parentRegency = Member::getRegencyByScore($scoreToCheckParent);
            $parentMember->regency = $parentRegency;
            Log::info('Update for parent member: ' . $parentMember->full_name . $score . 'new regency : ' . $parentRegency);
        }
        $parentMember->save();
    }
});
