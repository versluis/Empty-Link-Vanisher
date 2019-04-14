# Empty Link Vanisher
WordPress Plugin that removes empty links from the DOM

### Usage
Once activated, links that have an empty href attribute (a href='') will be removed from a post or page using jQuery.
Users have the option to target links with a class or ID. 
Multiple classes should work when separated by a space (like .class1 .class2 #your-id etc). 

### Notes
John and I were discussing [this code](https://gist.github.com/versluis/1b7d6012cc3e6bae2cb5c4f836a40796?fbclid=IwAR1zkh5TQNHr68lY-DkWLW3D0yB5qfq2pE52O2n_blLiYA4W1s8wdSSA9tc), which makes the parent object for empty links disappear using jQuery. This can be useful if clikckable buttons are presented in WordPress that are not properly populated. Rather than creating dummy links, the button can hence be remoevd with ease if no link is present. The code could be exapnded to make links to default URLs disappear too.

The challence was to wrap this functionality into a standalone WordPress plugin. I had done something similar before when I wrote the [P2 Header Ad plugin](https://github.com/versluis/P2-Header-Ad), which required a block of text to be inserted into the DOM and positioned correctly using jQyery.

This time however, I had to exchange data between PHP and JavaScript, something I hadn't done before. Thanks to the wp_localize_script() function, it's a breeze. This plugin illustrates how to do it.
