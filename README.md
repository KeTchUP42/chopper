# File Chopper
 ![GitHub search hit counter](https://img.shields.io/github/search/bwormguy/chopper/class)
### Commands:
* bin/console d `[url]` `[new_file_name]` - downloads file or page to the `MAIN_RESOURCES`.
* bin/console f `[url|file_name]` `[filter_factory_alias]` `[new_file_name]` - downloads file or page and filters it with a filter which was made in filter factory. Result saves in the `templates_dir`.
* bin/console m `[mix_type_alias]` `[new_file_name]`- command mixes templates and generates a new file. Result saves in the `result_dir`.