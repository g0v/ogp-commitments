import csv, json

with open('zrypUtQH - 承諾事項.csv', 'r', encoding="utf-8") as file:
  csv_reader = csv.DictReader(file)
  data = {}
  for row in csv_reader:
    data[row['Card Name'].split(' ')[0]] = row
    
print(data)
    
with open('open_parliament_0703.json', 'r', encoding="utf-8") as file:
  json_data = json.load(file)

for id in json_data['data']:
  if id in data:
    json_data['data'][id]['trello_category'] = data[id]['List Name']
    
with open('open_parliament_0703_merge.json', 'w', encoding="utf-8") as file:
  json.dump(json_data, file, ensure_ascii=False, indent=2)
