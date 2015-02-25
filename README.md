# Skivdiv-chunks


## SHORTCODES

#### Skiv-Divs
Use:
````
[$tag id="" class="" style="" title="" func="" param="" echoes=""]
````
#### $tag (required)
Division name. Accepted values:
	- 'fullwidth',
	- 'one_full',
	- 'one_half', 'one_half_last',
	- 'one_third', 'one_third_last',
	- 'two_third', 'two_third_last',
	- 'one_fourth', 'one_fourth_last',
	- 'three_fourth', 'three_fourth_last',
	- 'one_fifth', 'one_fifth_last',
	- 'two_fifth', 'two_fifth_last',
	- 'three_fifth', 'three_fifth_last',
	- 'four_fifth', 'four_fifth_last',
	- 'one_sixth','one_sixth_last',
	- 'five_sixth', 'five_sixth_last'

#### Attributes
- id - Adds an ID to it. I know, right?
- class - Passes into the container div's classes. Any CSS class(es). Space seperate.
- style - Add as normal in the " style='' " attribute. any inline CSS.
- title - Renders either H2 (one full) or H3 (on all else) just before the "div.skivdiv-content" & addes a sanitized CSS class to the overall wrapper
	// Function attributes - Deals with turning the SkivDiv into a functional area.
- func - name of function to be called, works with $param. i.e. $func($param);
- param - Comma seperated string in order of parameters. CANNOT PASS AN ARRAY!
- echoes - If the function echoes content, $echoes should equal '1', else default = '0'. Shortcodes must return a value.

-----

##### Lorem ipsum - in inc/lib/skivvy_toolbox.php
````
[lorem words="75"]
````


----
##### Bloginfo - equivalent to the bloginfo function of WordPress - in inc/lib/skivvy_toolbox.php
````
[bloginfo key="name"]
````

##### Newsfeed - pulls the blogposts
````
[newsfeed show="5" length="55" category=""  tag="" class="" morelink="Read More" alllink="See All Posts" title="News"]
````
