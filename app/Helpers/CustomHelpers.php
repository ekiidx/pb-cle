<?php



use Illuminate\Http\Request;
use App\Models\Event;
// app/Helpers/CustomHelpers.php

// function getNavigationColor()
// {
// //    if (auth()->check()){
// //        return 'bg-color-black';
// //    }else{
// //        return 'bg-color-blue';
// //    }

//   // will match URL /companies/999 or /companies/create
//   if (request()->routeIs('communities.*')) 
//   {
//     // will match routes which name starts with companies.
//     return 'communities';
//   } else if(request()->routeIs('events.*')) {
//     return 'events';
//   } else if (request()->routeIs('ravers.*')) {
//     return 'ravers';
//   }
// }

function getNotificationReset()
{
  if(request()->routeIs('notifications.*')) {
    return 0;
  }
}

function getEventPreview()
{

    $slug = explode("/", parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH));

    if(empty($slug)) {
      $array = [];
      return $array;

    }else{

    $event = Event::where('slug', $slug[2])->firstOrFail();
    $image = $event->flyer_front_upload;
    $content = $event->content;

    $array = [];
    array_push($array, $image);
    array_push($array, $content);

    return $array;
  }
}
