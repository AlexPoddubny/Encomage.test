<?php
    
    
    namespace App;
    
    
    class View
    {
        
        use GettersSetters;
        
        public function render($template, $layout)
        {
            ob_start();
            foreach ($this->data as $prop => $value) {
                $$prop = $value;
            }
            if ($layout) {
                include __DIR__ . '/Views/layout/header.php';
            }
            include $template;
            if ($layout) {
                include __DIR__ . '/Views/layout/footer.php';
            }
            $content = ob_get_contents();
            ob_end_clean();
            return $content;
        }
        
        public function display($template, $layout = true)
        {
            echo $this->render($template, $layout);
        }
        
    }