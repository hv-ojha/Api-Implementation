# Alexa Ranking

- [`Alexa.com`](https://www.alexa.com) is a website that provides all the matrix for your searched domain.
- It provides all relavant information like World Ranking of Website, country where this website exist, and also ranking in that country.
- Following files are required to use alexa
	- alexa.php
- Steps are given below
	1. Import [`alexa.php`](alexa.php).
	2. Create object for the class `Alexa`.
	3. Call `get_rank()` and pass website url as a parameter without `http:\\` or `https:\\`;
	4. Use result array to retrieve your desired value.