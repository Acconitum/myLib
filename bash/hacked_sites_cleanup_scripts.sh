grep -PrHn "(\\$\w{1,15}\[\d{1,3}](;?)\.){5,}" | tee -a /tmp/script_output_marc.txt
grep -PrHn "(\\$\w{1,15}\[.*?\]\[\d{1,3}](;?)\.){5,}" | tee -a /tmp/script_output_marc.txt
find wp-content/uploads -type f -name "*.php" -delete | tee -a /tmp/script_output_marc.txt
grep -nrl "adsformarket" | tee -a /tmp/script_output_marc.txt
grep -nrl "@include" | tee -a /tmp/script_output_marc.txt


for f in $(grep -rl "var gfjfgjk"); do awk 'BEGIN {flag=0;i=0} /var gfjfgjk/ {flag=1;i=0} {if(flag == 0) {print}} {if(i==6){flag=0; gsub("^}","",$0); print $0}} {i++;}' $f > $f.new; mv $f.new $f; done
