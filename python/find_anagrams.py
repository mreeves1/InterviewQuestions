"""
Create a function that searches a list of words and returns any words that are anagrams of other words in the list

e.g.  input1: ["abcd", 'acbd', "kabc", 'cdba', "dog", "cadt"]
      output1: ['abcd', 'acbd', 'cdba']

      input2: ["xywz", "aaa", "bbb"]
      output2: None # NOTE: IMO an empty list is more appropriate
"""


def find_anagrams(words: list):
    result = []
    for i in range(0, len(words)):
        word1_found = False
        word1 = words[i]
        word1_haystack = list(word1)
        word1_haystack.sort()
        if word1 in result:  # Don't add the original word more than once
            break
        for j in range(i + 1, len(words)):  # Compare needle words after the initial haystack word
            word2 = words[j]
            word2_needle = list(word2)
            word2_needle.sort()
            # print(f"i:{i}, j: {j}, word 1: {word1}, word 2: {word2}")  # debugging
            # print(f"{word1_haystack} matches {word2_needle}?")
            if word1_haystack == word2_needle:
                if not word1_found:
                    result.append(word1)
                    word1_found = True
                result.append(word2)

    return result if result else None  # if no anagrams found return None


print(find_anagrams(["abcd", 'acbd', "kabc", 'cdba', "dog", "cadt"]))
print(find_anagrams(["xywz", 'aaa', "bbb"]))