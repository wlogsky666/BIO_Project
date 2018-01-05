
with open('d2018.bin', 'rb') as f :
	with open('mesh.db', 'w', encoding = 'utf8') as of:
		for line in f:
			line = line.decode("utf-8").strip() 

			if line.startswith('MH = '):
				of.write('\n')
				print(line, file=of)
			elif line.startswith('MS = '):
				line = line.replace('’', '\'')
				line = line.replace('”', '\"')
				line = line.replace('“', '\"')
				print(line, file=of)
			elif line.startswith('UI = '):
				print(line, file=of)
			elif line.startswith('MR = '):	# Revision
				print(line, file=of)
			elif line.startswith('DX = '):	# Established
				print(line, file=of)
				