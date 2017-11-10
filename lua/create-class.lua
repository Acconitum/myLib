-- name the file LuaClass and let it in the rootdirectory of the script which calls the class
LuaClass = {}

function LuaClass.init(var1, var2)
	LuaClass.value = var1
	LuaClass.otherValue = var2
end 

function LuaClass.doStuff(param)
	-- Do stuff...
end

return LuaClass

-- call luaClass = require(LuaClass) in mainscript
--then initialize with luaClass.init(21, 'sting')