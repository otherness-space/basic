source 'https://rubygems.org'

group :development do

  # Sass, Compass and extensions.
  gem 'sass'                    # Sass.
  gem 'sass-globbing'           # Import Sass files based on globbing pattern.
  gem 'bourbon'                 # Import Bourbon SASS framework.
  gem 'neat'                    # Import Bourbon Neat grid framework

  # Guard
  gem 'guard'                   # Guard event handler.
  gem 'guard-sass'              # SASS support.
  gem 'guard-shell'             # Run shell commands.
  gem 'guard-livereload'        # Browser reload.
  gem 'yajl-ruby'               # Faster JSON with LiveReload in the browser.

  # Dependency to prevent polling. Setup for multiple OS environments.
  # Optionally remove the lines not specific to your OS.
  # https://github.com/guard/guard#efficient-filesystem-handling
  gem 'rb-inotify', '~> 0.9', :require => false      # Linux
  gem 'rb-fsevent', :require => false                # Mac OSX
  gem 'rb-fchange', :require => false                # Windows

end