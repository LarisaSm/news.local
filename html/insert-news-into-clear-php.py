import re
news = []
title = ""
for line in open("news.txt").readlines():
	line = line.strip("\n\r\t ")
	if line:
		if not title:
			title = line
		else:
			news.append((title,line))
			title = ""

php = open("_clear.php.bak").read()

php = re.sub(r"VALUES \('(\d+)', '([^']+)', '([^']+)'",
	lambda mo: "VALUES ('"+mo.group(1)+"', '%s', '%s'"%news[int(mo.group(1))],
	php)

open("_clear.php","w").write(php)
