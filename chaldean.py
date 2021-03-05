# Prints your Chaldean numerology name number & also Cheiro/Linda Goodman name number.
from collections import defaultdict

chaldean = {' ':0, "a":1, "b": 2,"c": 3,"d": 4,"e": 5,"f": 8,"g": 3,"h": 5,"i": 1,"j": 1,"k": 2,"l": 3,"m": 4,"n": 5,"o": 7,"p": 8,"q": 1,"r": 2,"s": 3,"t": 4,"u": 6,"v": 6,"w": 6,"x": 5,"y": 1,"z": 7}
chaldean = defaultdict(lambda: 0, chaldean)

name_input = input("Please enter your name:  ")
name_input = name_input.lower()
split_name = []
name_split = name_input.split()
for i in name_split:
	split_name.append(i)

indiv = []
indiv_chiero =[]

for j in split_name:
	name = list(j)
	sum_c = 0
	for y in range(len(name)):
		sum_c = sum_c + chaldean[name[y]]

	indiv.append(sum_c)

	if (sum_c == 11) or (sum_c == 22):
		indiv_chiero.append(sum_c)
	else: 
		indiv_chiero.append(sum(map(int, str(sum_c))))


total  = sum(indiv)
total_chiero  = sum(indiv_chiero)

print('Chaldean Numerology: {} & {} for {}'.format(indiv, total, name_input.title()))
print('ChieroLG Numerology: {} & {} for {}'.format(indiv_chiero, total_chiero, name_input.title()))
