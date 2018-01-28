local args = {...}
local filename = "";

for key, arg in pairs(args) do
    if key == 1 then
        filename = arg;
    end
end

if filename == "" then
    print("no filename")
    return
end

file = io.open(filename, 'r');

functionFound = false;
os.execute('mkdir luaOutput');

for line in file:lines() do
    if line:find(' {') then
        functionFound = true;
        exportFile = io.open('luaOutput/' .. line:sub( 1, #line - 4 ), 'w');
    end

    if functionFound then
        exportFile:write(line .. '\n');
    end

    if line:find('}$') then
        functionFound = false;
        exportFile:close();
    end
end

file:close()