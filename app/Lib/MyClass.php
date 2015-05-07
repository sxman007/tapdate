<?php
    class MyClass
    {
        public function checkMe()
        {
            
        $new = addslashes(htmlspecialchars("<a href='test'\~@$%^&*()_+|>Test</a>", ENT_QUOTES));
        echo $new;
        $new = html_entity_decode(stripslashes($new) , ENT_QUOTES);
        echo $new;

        }
    }
?>