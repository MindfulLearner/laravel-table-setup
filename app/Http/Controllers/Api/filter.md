# filter api

numero di stanze:
/api/apartments/filter?rooms=2

letti:
/api/apartments/filter?beds=2

bagni:
/api/apartments/filter?bathrooms=2

metri quadrati:
/api/apartments/filter?square_meters=2

prezzo minimo:
/api/apartments/filter?price_min=2

prezzo massimo:
/api/apartments/filter?price_max=2


## come fare una combinazione di filtri?
- questo link filtra per 2 stanze, 2 letti, 2 bagni, 2 metri quadrati, prezzo minimo 2 e prezzo massimo 2
/api/apartments/filter?rooms=2&beds=2&bathrooms=2&square_meters=2&price_min=2&price_max=2

- questo link filtra per 2 letti, 1 bagno, prezzo minimo 500
/api/apartments/filter?beds=2&bathrooms=1&price_min=500