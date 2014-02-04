[PHPoole](http://github.com/Narno/PHPoole/) Gallery plugin.

Installation
------------

Add this to your PHPoole ```composer.json``` file:

    {
      "require": {
        "phpoole/plugin-gallery": "master-dev"
      },
      "repositories": [
        {
          "type": "vcs",
          "url": "https://github.com/PHPoole/Plugin-Gallery"
        }
      ]
    }

Usage
-----

### Front matter

Add a ```gallery``` entry to the front matter of a page:

```gallery = "local/path/to/images/dir"```

### Layout samples

#### Galleries list

    {% extends "page.html" %}
    {% block pagefooter %}
    {% for item in site.pages('galeries') %}
    <ul>
    	<li><a href="{{ site.base_url }}/{{ item.path }}">{{ item.title }}</a></li>
    </ul>
    {% endfor %}
    {% endblock pagefooter %}

#### Gallery page

    {% extends "page.html" %}
    {% block pagefooter %}
    {% for image in page.gallery %}
    <p><img src="{{ site.base_url }}/{{ page.path }}/{{ image.name }}" class="img-responsive" /></p>
    {% endfor %}
    {% endblock pagefooter %}
