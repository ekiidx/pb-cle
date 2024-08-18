<?php

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

function getResetNotifications()
{
  if(request()->routeIs('notifications.*')) {
    return 0;
  }
}
