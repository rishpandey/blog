---
extends: _layouts.post
section: content
title: 'How to add approx read time on posts in Jigsaw?'
description: 'Jigsaw is a framework for rapidly building static sites using the same modern tooling that powers your web applications. One thing I very much needed is to show read time on each article. This is how I accomplished it.'
keywords: 'jigsaw, read time, blog, static site, php'
date: 2021-01-12
featured: false
---

My current blog is developed using [Jigsaw](https://jigsaw.tighten.co/) and their [awesome template](https://github.com/tighten/jigsaw-blog-template).

Jigsaw is a framework for rapidly building static sites using the same modern tooling that powers your web applications.

I absolutely love the design and made little to no changes on it. One thing I very much needed is to show read time on each article. This is how I accomplished it.

- Add a new helper in `config.php`.

```php
'getReadTime' => function ($page, $wpm = 150) {
        $content = strip_tags($page->getContent());
        $word_count = str_word_count($content);
        return ceil($word_count / $wpm);
    }
```

- Use the helper in `post-preview-inline.blade.php`.
  In blog template this file is used to give an inline preview of posts.

```
 <a
    href="{{ $post->getUrl() }}"
    title="Read more - {{ $post->title }}"
    class="uppercase font-semibold tracking-wide mb-2"
    >
    {{ $post->getReadTime() }}  Minutes Read
</a>
```
