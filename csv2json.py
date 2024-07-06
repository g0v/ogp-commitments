import csv, json

with open('open_parliament_0703.csv', 'r', encoding="utf-8") as file:
  csv_reader = csv.DictReader(file)
  data = {}
  for row in csv_reader:
    data[row['Commitment Unique Identifier']] = row
  
with open('open_parliament_0703.json', 'w', encoding="utf-8") as file:
  json.dump({
    "source": "https://docs.google.com/spreadsheets/d/1ZoiJY9zL52dEOFJnHWSFcAmJx_KxK0xAWzHQbX2iGPo/", 
    "data": data
    }, file, ensure_ascii=False, indent=2)