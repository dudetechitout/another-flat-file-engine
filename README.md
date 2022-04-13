# Another Flat File Engine

A repository dedicated to a flat file engine I'd made to serve my blog.

## What is this?

This is a repository hosting a flat file engine for blogging. You just need a host that allows PHP to be ran, upload this git and you're ready to go!

## How to update 'me'?

You edit the 'you' file to include the blog title (line 1), a quick summary of you (line 2) and your profile picture location (line 3).

    Dude Tech it Out
    Hey, my name is James! This is just a simple place to jot down some thoughts n post some stuffs.
    /img/me.jpg

## How to write a post?

Simply go into the 'posts' folder and make a new file without an extension - e.g. My First Blog Post would be my-first-blog-post - with the following content:

    Hello world! This is my first post!

    |title$My First Blog Post
    |date$April 13, 2022
    |summary$Come view my first ever blog post! Keep in mind, I can always leave this blank, but it isn't recommended on short blog posts.
    |image$img/banner-laptop.jpg

Content is going to be in [BBCode markup](https://www.phpbb.com/community/help/bbcode). You can read more on the available BBcode below.

## BBCode? What's that?

BBcode is a special implementation of HTML. Basically instead of `<b>` it'll be `[b]`. Here are the available BBCode for this engine:

* Font strong: `[strong]`
* Headers: `[h1]` through `[h6]`
* Emphasized text: `[em]`
* Make text italic: `[i]`
* Do a quote: `[quote]`
* Font size: `[size]`
* Slash text: `[s]`
* Center Text: `[center]`
* List e-mail: `[email=james@selfo.io][/email]` or `[email]james@selfo.io[/email]`
* Make URL: `[url=https://dudetechitout.com]My Blog[/url]`
* Image: `[img]The image to show[/img]`
* List: `[list=1][*]This will be numbered[/list]` and `[list]Will not be numbered[/list]`
* Video: `[youtube]https://www.youtube.com/watch?v=O91DT1pR1ew[/youtube]`
