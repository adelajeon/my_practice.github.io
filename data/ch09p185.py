# d1 = '40˚'
# m1 = "46'"
# s1 = '52.837'
# u1 = 'N'

# d2 ='73˚'
# m2 = '58'
# s2 = '26.302"'
# u2 = 'W'

# coords = '☆'.join([d1, m1, s1, u1, d2, m2, s2, u2])
# print(coords)

multi_str = """Guard : What? Ridden on a horse?
King Arthur : Yes!
Guard : You're using coconuts!
King Arthur : Waht?
Guard : You've got ... coconut[s] and you're bangin' ' em together.
"""

# print(multi_str)
multi_str_split = multi_str.splitlines()
# print(multi_str_split)

guard = multi_str_split[::2]
# print(guard)

guard = multi_str.replace("Guard : ", "").splitlines()[::2]
# print(guard)

# var = 'flesh wound'
# s = "It's just a {}!"
# print(s.format(var))

# print(s.format('scratch'))

# s = """Black Knight: 'Tis but a {0}.
# King Arthur: A {0}? Your arm's off!
# """
# print(s.format('scratch'))



# print('Some digits of pi: {}'.format(3.14159265359))
# print("In 2005, Lu Chao of China recited {:,} digits of pi".format(67890))

# print("I remeber {0:.4} or {0:.4%} of what Lu Chao recited".format(7/67890))

# print("My ID number is {0:05d}".format(42))

# s = 'I only know %d digits of pi' %7
# print(s)

# print('Some digits of %(cont)s : %(value).2f' %{'cont':'e', 'value':2.718})

var = 'flesh wound'
s = f"It's just a {var}!"
print(s)

lat = '40.7815˚N'
lon = '73.9733˚W'
s = f'Hayden Planetarium Coordinates: {lat}, {lon}'
print(s)