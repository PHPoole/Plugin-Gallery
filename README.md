[PHPoole](http://github.com/Narno/PHPoole/) Gallery plugin.

Installation
------------

Add this to your PHPoole ```composer.json``` file:

    {
      "require": {
        "PHPoole/Plugin-Gallery": "master-dev"
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

#### Gallery page

    {% extends "default.html" %}
    {% block pageheader %}{% endblock %}
    {% block pagefooter %}
    {% for image in page.gallery %}
    <p><img src="{{ site.base_url }}/{{ page.path }}/{{ image.name }}" class="img-responsive" /></p>
    {% endfor %}
    {% endblock pagefooter %}

#### Galleries list

    {% extends "default.html" %}
    {% block pageheader %}{% endblock %}
    {% block pagefooter %}
    {% for item in site.pages('galeries') %}
    <ul>
      <li><a href="{{ item.url }}">{{ item.title }}</a></li>
    </ul>
    {% endfor %}
    {% endblock pagefooter %}
