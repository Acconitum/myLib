nslookup shop.tegum.ch | tail -n 2 | whois $(grep -Po '([0-9]{1,3}\.){3}[0-9]{1,3}')
