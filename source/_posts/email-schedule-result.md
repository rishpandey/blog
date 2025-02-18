---
extends: _layouts.post
section: content
title: "Laravel Tip #1: Check if scheduled jobs are running successfully"
date: 2021-04-18
cover_image: https://i.imgur.com/vRbr9AM.png
featured: false
categories: [laravel]
keywords: laravel, scheduled jobs, cron jobs, laravel schedule, laravel schedule output
---

Like always you can also log these into files.

```
$schedule->command('emails:send')
         ->daily()
         ->sendOutputTo($filePath);


$schedule->command('emails:send')
         ->daily()
         ->appendOutputTo($filePath);
```

