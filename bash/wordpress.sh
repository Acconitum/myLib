#finds unchanged WooCommerce files in theme and removes them need to be executed inside woocommerce/templates directory
pathToPlugin=../../../plugins/woocommerce/templates/; for file in **/*.*; do isDifferent=$(diff <(tr -d ' \n' < $file) <(tr -d ' \n' < $pathToPlugin$file)); if [ ! "$isDifferent" ]; then rm "$file"; fi done
