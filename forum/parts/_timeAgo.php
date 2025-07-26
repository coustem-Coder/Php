<?php
date_default_timezone_set('Asia/Kolkata'); // Set to your local timezone

function timeAgo($datetime, $full = false)
{
  $now = new DateTime;
  $ago = new DateTime($datetime);
  $diff = $now->diff($ago);

  $units = [
    'year' => $diff->y,
    'month' => $diff->m,
    'day' => $diff->d,
    'hour' => $diff->h,
    'minute' => $diff->i,
    'second' => $diff->s,
  ];

  $result = [];

  foreach ($units as $unit => $value) {
    if ($value > 0) {
      $result[] = $value . ' ' . $unit . ($value > 1 ? 's' : '');
    }
  }

  if (!$result) {
    return 'just now';
  }

  return $full ? implode(', ', $result) . ' ago' : $result[0] . ' ago';
}
?>