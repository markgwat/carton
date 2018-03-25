<pre>
Carton Cloud Test API

Working File/Paths
Class files: BearClaw/Warehousing/
Vue Componenet: resources/assets/js/components/ExampleComponent.vue
Route: routes/web.php

Configure paths:
    sudo chgrp -R www-data public
    sudo chmod -R 777 storage
    sudo chown -R www-data:www-data bootstrap/cache
    sudo chown -R www-data:www-data storage
 
Run PHP unit Tests:
    vendor/bin/phpunit

Run Test on TotalsCalculator:
    php artisan tinker
    $test = new BearClaw\Warehousing\TotalsCalculator;
    $test->generateReport([2344, 2345, 2346]);
    output: 
    Product Type 1 has total of 41.5
    Product Type 2 has total of 13.8
    Product Type 3 has total of 25
 </pre>