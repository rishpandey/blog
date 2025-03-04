---
title: Contact
description: Get in touch
---
@extends('_layouts.master')

@section('body')
    <h1>Contact</h1>

    <p class="mb-8">
        I am a web developer specializing in building and designing exceptional digital experiences. If you have any
        questions, projects, or just want to say hi, feel free to reach out using the form below.
    </p>
    {{-- <p class="mb-8"> --}}
    {{--    You can find me on twitter. --}}
    {{-- </p> --}}

    <form action="/message-sent" method="post" id="contact-form" class="mb-12" data-netlify="true">
        <div class="flex flex-wrap mb-6 -mx-3">
            <div class="w-full md:w-1/2 mb-6 md:mb-0 px-3">
                <label class="block mb-2 text-gray-800 text-sm font-semibold" for="contact-name">
                    Name
                </label>

                <input type="text" id="contact-name" placeholder="Jane Doe" name="name"
                    class="block w-full border shadow rounded-lg outline-none mb-2 px-4 py-3" required>
            </div>

            <div class="w-full px-3 md:w-1/2">
                <label class="block text-gray-800 text-sm font-semibold mb-2" for="contact-email">
                    Email Address
                </label>

                <input type="email" id="contact-email" placeholder="email@domain.com" name="email"
                    class="block w-full border shadow rounded-lg outline-none mb-2 px-4 py-3" required>
            </div>
        </div>

        <div class="w-full mb-12">
            <label class="block text-gray-800 text-sm font-semibold mb-2" for="contact-message">
                Message
            </label>

            <textarea id="contact-message" rows="4" name="message"
                class="block w-full border shadow rounded-lg outline-none appearance-none mb-2 px-4 py-3"
                placeholder="A lovely message here." required></textarea>
        </div>

        <div class="flex justify-end w-full">
            <input type="submit" value="Submit"
                class="block bg-blue-500 hover:bg-blue-600 text-white text-sm font-semibold leading-snug tracking-wide uppercase shadow rounded-lg cursor-pointer px-6 py-3">
        </div>
    </form>
@stop
