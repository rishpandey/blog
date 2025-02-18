---
extends: _layouts.post
section: content
title: How to implement preference based notifications in laravel?
date: 2021-04-19
cover_image: https://images.unsplash.com/photo-1592495994946-52ba21a70bdd?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=2172&q=80
categories: [laravel]
keywords: laravel, notifications, preference based notifications, laravel notifications
---

A few days back, I was asked to implement a pretty awesome notification system on one of my client's laravel application, we are calling it, **Granular Preference for Notifications**.

So the user story goes,

A user can select if they wish to receive a notification via email, broadcast, both or neither. We have a bunch of notifications like newletter, maintenance, invitations, messages etc. Some of these are important to some users, essential for others and outright annoying to some. So, this is a pretty useful and much needed feature.

### How I approached this problem?

There is actually an existing [laravel package](https://github.com/williamcruzme/laravel-notification-settings) which does something similar and looks promising. I looked at the package and was going use it but instead wanted to have something custom-made for our specific use case.

I figured what we need at most is some way to edit the `via()` method to return the appropriate channels based on what user has set in their profile.

The documentation shows something like this as well,

```php
/**
 * Get the notification's delivery channels.
 *
 * @param  mixed  $notifiable
 * @return array
 */
public function via($notifiable)
{
    return $notifiable->prefers_sms ? ['nexmo'] : ['mail', 'database'];
}
```

## How I solved this?

I created a new abstract class classed `PreferenceBasedNotification`.

```php
<?php

namespace App\Notifications;

abstract class PreferenceBasedNotification extends Notification{
    final public function via($notifiable){}
    abstract public function toMail($notifiable);
    abstract public function toBroadcast($notifiable);
}
```

Every notification where a user can set a preference will inherit this abstract class and will have to implement `toMail()` and `toBroadcast()` and can't implement `via()` to fulfill the contract.

Why `toMail()` and `toBroadcast()` are abstract? It is to make sure that if a user is opting for both mail and broadcast then the notification has to provide it. For `via()` being final, I decided that individual notifications can not edit the logic to check user's channel preference.

### Database Setup

I used two tables to achieve this, one keeps tracks of all the notifications where user can set a preference.

- **preference_based_notifications**
```
| event_text  | description | notification_class     |
|-------------|-------------|------------------------|
| New Message | ...         | NewMessageNotification |
| New Event   | ...         | NewEventNotification   |

```

- **user_notification_preferences**
```
| notification_id | user_id | receive_email | receive_notification |
|-----------------|---------|---------------|----------------------|
| 1               | 1       | true          | false                |
| 2               | 1       | true          | true                 |
```

### Implementing the **via()** method

Now the only thing left to do is to implement `via()`. This method has to check for user preference and based on that return appropriate channel.

```php
final public function via($notifiable)
{
    $viaChannels = [];
    $preference = $this->getPreference($notifiable->user_id);

    if ($preference->receive_email) {
        $viaChannels[] = 'mail';
    }
    if ($preference->receive_notification) {
        $viaChannels[] = 'broadcast';
    }

    return $viaChannels;
}
```

We can implement a method to check user's preference like this,

```php
private function getPreference($userID)
{
    // get_class returns the class name with namespace
    // we need to get extract class name

    $currentClass = Arr::last(explode('\\', get_class($this)));

    $event = DB::table('notification_events')
        ->where('notification_class', $currentClass)->first();

    if (!$event) {
        return null;
    }

    return DB::table('user_notification_preferences')
        ->where('user_id', $userID)
        ->where('notification_event_id', $event->id)
        ->first();
}
```

And that's it. We can now look into the user_notification_preferences table and send notifications based on the user's choice.

You can checkout the gist [here](https://gist.github.com/rishpandey/2689c481cc9e3209223cbf2e47d17449).