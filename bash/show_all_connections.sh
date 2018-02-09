lsof -i

# pipe it throught grep for single informations

lsof -i grep -E "(LISTEN|ESTABLISHED)"
