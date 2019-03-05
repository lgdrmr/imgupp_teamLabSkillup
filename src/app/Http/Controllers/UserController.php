<?php

return view('/user', [
  'is_loggedin' => $is_loggedin,
  'name' => Users::where('id', $uid)->value('github_id'),
  'avater' => Users::where('id', $uid)->value('avaterfile'),
  'userposts' => $userposts,
]);
