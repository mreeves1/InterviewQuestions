# Print out unique numbers found in a list of numbers

numbers = [1, 5, 7, 5, 6]
numbers.sort()  # sort in place

result = []

previous = False
for number in numbers:
    if number == previous:
        previous = number
        continue
    else:
        previous = number
        result.append(number)

print(result)
