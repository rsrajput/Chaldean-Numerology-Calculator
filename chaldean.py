# Prints name value based on 1. Alphabets positional value 2. Chaldean numerology name number

alphabets = {' ':0, "a":1, "b": 2,"c": 3,"d": 4,"e": 5,"f": 6,"g": 7,"h": 8,"i": 9,"j": 10,"k": 11,"l": 12,"m": 13,"n": 14,"o": 15,"p": 16,"q": 17,"r": 18,"s": 19,"t": 20,"u": 21,"v": 22,"w": 23,"x": 24,"y": 25,"z": 26}
chaldean = {' ':0, "a":1, "b": 2,"c": 3,"d": 4,"e": 5,"f": 8,"g": 3,"h": 5,"i": 1,"j": 1,"k": 2,"l": 3,"m": 4,"n": 5,"o": 7,"p": 8,"q": 1,"r": 2,"s": 3,"t": 4,"u": 6,"v": 6,"w": 6,"x": 5,"y": 1,"z": 7}

name = list(input("Please enter your name:  "))
sum = 0
for x in range(len(name)):
	sum = sum + alphabets[name[x]]

sum_c = 0
for y in range(len(name)):
	sum_c = sum_c + chaldean[name[y]]

print('Positional Sum: ', sum)
print('Chaldean Numerology: ', sum_c)
