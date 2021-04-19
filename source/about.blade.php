---
title: About
description: A little bit about the site
---
@extends('_layouts.master')

@section('body')
    <h1>About</h1>

    <img src="/assets/images/rish-square-md.png"
         alt="About image"
         class="flex rounded-full h-64 w-64 bg-contain mx-auto md:float-right my-6 md:ml-10">

    <p>Hey, I am <strong>Rishabh Pandey</strong>.</p>

    <p>A software <strong>consultant</strong> who works with startups and companies to turn their ideas into web
        applications.</p>

    <p>I’ve been a full-stack developer and trainer since 2014. I have built some neat applications in the SAAS space
        and other industries. I’ve been fortunate enough to work with some great people and built amazing
        relationships.</p>

    <p>As an engineer, I enjoy implementing complex ideas in a simple way. My programming style emphasizes on
        cleanliness and maintainability.

    <p>I specialize in the following languages and frameworks:</p>
    <ul>
        <li>Laravel / PHP</li>
        <li>Vue.js / Node.js / Electron.js / Javascript</li>
        <li>SQL databases</li>
    </ul>

    <p>When I’m not coding the next great thing, I’m busy making music and learning new stuff.</p>

    <p><a href="/contact">Get in touch</a> today if you’d like to work together!</p>

@endsection
