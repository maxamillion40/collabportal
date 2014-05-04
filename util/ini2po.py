lang = "en"

langcode = ""
fullname = ""
translations = []

print("Opening input file ../locale/" + lang + ".ini")
input = open("../locale/" + lang + ".ini", "r")
print("Converting to .po")
#Read and parse lines
for line in input:
	if line != "[meta]" and line != "[translations]":
		#Do this for x = y lines
		pair = line.split("=")
		#Cut whitespaces
		pair[0] = pair[0].strip()
		#Different behaviour for different lines
		if pair[0] == "langcode":
			print("Language code found!")
			langcode = pair[1].strip()
		elif pair[0] == "fullname":
			print("Language name found!")
			fullname = pair[1].strip()
		else:
			if len(pair) == 2:
				translations.append([pair[0], pair[1].strip()])
input.close()
#Create .po
outputStr = """#ScratchHub translation file for language """ + langcode + """ (""" + fullname + """)
"""
for translation in translations:
	outputStr = outputStr + """
msgid \"{0}\"
msgstr \"{1}\"	
""".format(translation[0], translation[1])

output = open("../locale/" + lang +".po", "w")
output.write(outputStr)
output.close()

print("Converting successful! Press <ENTER> to finish")
raw_input()