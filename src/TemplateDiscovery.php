<?php 

 namespace WidgetSupport;

 class TemplateDiscovery {

    // --------------------------------------------------------------------

    public static function find_templates($folder_path, $ext = "twig", $include_default = true) {

        $files = [];

        if ($include_default){
            array_push($files, ['name' => 'Default Template', 'path' => '']);
        }

        if (file_exists($folder_path)){

            // find all files in that dir
            $template_paths = array_diff(scandir($folder_path), ['..', '.']);

            foreach($template_paths as $template){

                if (!TemplateDiscovery::ends_with($template, $ext)) {
                    continue;
                }

                array_push($files,[
                    'name' => $template,
                    'path' => $template
                ]);

            }
        }

        return $files;

    }

    // --------------------------------------------------------------------

    private static function ends_with($haystack, $needle) {
        $length = strlen($needle);
        return $length === 0 || (substr($haystack, -$length) === $needle);
    }

    // --------------------------------------------------------------------











 }







?>