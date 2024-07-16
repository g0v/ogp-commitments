from reportlab.pdfgen import canvas
from reportlab.platypus import Paragraph, Frame
from reportlab.pdfbase import pdfmetrics
from reportlab.pdfbase.ttfonts import TTFont
from reportlab.lib.styles import getSampleStyleSheet

import json, qrcode

pdfmetrics.registerFont(TTFont('NotoSansTC', 'NotoSansTC-Regular.ttf'))

styles = getSampleStyleSheet()
styleN = styles['Normal']
styleN.fontName = 'NotoSansTC'
styleN.fontSize = 12
styleN.leading = 18
styleN.wordWrap = 'break'

with open('open_parliament_0703翻譯.json', 'r', encoding='utf-8') as f:
  data = json.load(f)

file_path = 'hello.pdf'

c = canvas.Canvas(file_path, pagesize=(595, 420))

for index, id in enumerate(data['data']):
  cur_data = data['data'][id]
  qr = qrcode.QRCode(
      version=1,
      error_correction=qrcode.constants.ERROR_CORRECT_L,
      box_size=10,
      border=4,
  )
  qr.add_data(cur_data['URL'])
  qr.make(fit=True)
  img = qr.make_image(fill_color="black", back_color="white")
  img_path = f'qrcode/qrcode_{id}.png'
  img.save(img_path)
  
  c.setFont("NotoSansTC", 14)
  c.drawString(50, 330, cur_data['Short Title 中文'])
  c.drawString(50, 310, cur_data['Short Title'])
  c.drawString(50, 360, 
               "國家/地區：" + cur_data['Country/Locality'] + "  |  id：" + id
               )
  c.drawImage(img_path, 520, 350, width=50, height=50)
  
  text = cur_data['Full Text 中文'][:400] + '...'
  para = Paragraph(text, styleN)

  frame = Frame(50, 50, 500, 250, showBoundary=1)
  frame.addFromList([para], c)
  c.showPage()
c.save()
  
