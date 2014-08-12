# Compass configuration file.

# We also support plugins and frameworks, please read the docs http://docs.mixture.io/preprocessors#compass

project_path =File.expand_path("..",File.dirname(__FILE__))

# Important! change the paths below to match your project setup
css_dir = "wp-content/themes/boilerplate/assets/css" # update to the path of your css files.
sass_dir = "wp-content/themes/boilerplate/assets/sass" # update to the path of your sass files.
images_dir = "wp-content/themes/boilerplate/assets/img" # update to the path of your image files.
javascripts_dir = "wp-content/themes/boilerplate/assets/js" # update to the path of your script files.

line_comments = false # if debugging (using chrome extension - set this to true)
cache = true
color_output = false # required for Mixture

# Save Style to theme root

require 'fileutils'
on_stylesheet_saved do |file|
  if File.exists?(file) && File.basename(file) == "style.css"
    puts "Moving: #{file}"
    FileUtils.mv(file, File.dirname(file) + "/../../" + File.basename(file))
  end
end