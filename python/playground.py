# varianle declarations
isCool = True
isBoring = False
string = "Hello world"
integer = 1
decimal = 12.2
array = [1,2,3,4]


# if statement
if isCool:
    print("Cool")

# for loop
for value in range(1 ,5): # times for
    print(value)

# while loop
isBoring = True
while isBoring:
    if integer > 2:
        print('NO MORE boring')
        break
    
    print('boring')
    integer += 1

# function definition
def printMyStuff(toPrint):
    print(toPrint)

# function call
printMyStuff('Yeah')

# string handling
day ='samstag'

# print parts of an array or string
print(day[0:])
print(day[2:5])
print(day[4:])

# find first occurance of pattern and returns index from starting postion
start = day.find('a')
end = day.find('t')
print(day[start:end])

# find second occurence of a pattern
startSecond = day.find('a', 2)

# 120 times the captial letter A
longString = "A" * 120
print(longString)

# play with ascci
print(ord('A'))
print(chr(65))

# handy stuff
import string
print(string.ascii_letters)
print(string.ascii_lowercase)
print(string.ascii_uppercase)
print(string.digits)
print(string.punctuation)

# sum of all
print(string.printable)
