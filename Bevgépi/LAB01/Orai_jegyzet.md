## Idősor

1. Folytonos​
2. Periodikus

## Hibák adatgyüjtésnél

- nem figyelünk az átmenetre
  - rosz metrikákat addhat
- nem figyeljük elég hosszan a jelenséget
  - nem teljes a kép
  - idővel új változók jelenhetnek meg: pl cukor betegség élet
- Frencvencia változás.​
- nem egységes formátum
  - sokszor inkonszisztens súly, vagy dátum formátum

## Konvertálás

- Timestamp-ből datetime​

```python
timestamp = 1545730073 ​
dt_object = datetime.fromtimestamp(timestamp)​
```

- Datetime-ból timestamp​

```python
now = datetime.now() ​
timestamp = datetime.timestamp(now)
```

- string idő átalakitás

```python
import time ​
import datetime ​
s = "01/12/2011" ​
time.mktime(datetime.datetime.strptime(s, "%d/%m/%Y").timetuple())
timestamp = 1553367060​
dt_obj =datetime.fromtimestamp(timestamp).strftime('%d-%m-%y’)

```

## Eltelt idő számolás

```python
datetime.datetime.fromtimestamp(idok[i])-datetime.datetime.fromtimestamp(idok[i-1])​
(datetime.datetime.fromtimestamp(idok[i])-datetime.datetime.fromtimestamp(idok[i-1])).total_seconds()
```

## Tesztelés

- train test split-el probléma: ha random vesszük az adatokat a tendenciára nem tud rátanulni, ezért a splittelésnél ne random szeparáljuk az adatokat
- Ha elválasszuk teszt adatokra akkor első 80% tanitsunk a maradék 20% tesztelés.

## Adat átalakítás​

- Rekurens háloknál 3 dimenzios​
- Gépi tanulásnál 2 dimenzious​
- Konvolucius hálonál 3 dimenzios

## Képfeldolgozás​

- milyen képek
  - augmentálás: túl tudd tanulni ha sok variáció (megforditva stb) van a képből
- csoportositás
  - nehézz kivenni az adatokat ha rosz
- OpenCV
  - ​gray = cv2.cvtColor(img, cv2.COLOR_BGR2GRAY)
  - az OpenCV NEM rgb-t használ hanem BGR-t

### Data augmentation​

- Tensorflowba beépitet.​
- Lehet forgatni.​
- Scalelni.​
- Más transformáciokat végre hajtani.
- vigyázni kell a túltanulás miatt

### Beolvasási technikák​

- Megszokot módon.​
- Miért kell image generation: - összes kép nem férne be memóriába
  Image generator:​

1. .flow(x, y)​
2. .flow_from_directory(directory)​
3. .flow_from_dataframe​
