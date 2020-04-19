import xml.etree.ElementTree as ET
import urllib.request
import os
from html.parser import HTMLParser

class MyHTMLParser(HTMLParser):
  produtos = []
  item = False
  count = -1

  def exists(self,array,target):
    if len(array) == 0:
      return False
    if array[0][0] != 'class':
      return False
    if array[0][1] != target:
      return False
    return True

  def handle_starttag(self, tag, attrs):
    if tag == 'span' and (self.exists(attrs, 'a-size-medium a-color-base a-text-normal') or self.exists(attrs,'a-price-whole')):
      self.item = True
      #self.produtos[self.count].append(attrs[0][1])
    elif tag == 'img':
      self.produtos.append([attrs[0][1]])
      self.count += 1

  def handle_endtag(self, tag):
    pass
  
  def handle_data(self, data):
    if self.item is True:
      self.item = False
      self.produtos[self.count].append(data)
  
  def return_produtos(self):
    return self.produtos

arquivo = open("orig.html", "r")
dados = arquivo.read()

parser = MyHTMLParser()
parser.feed(dados)

produtos = parser.return_produtos()

f = open("sql.sql","w")
contador = 1960
categoria = 10
sql = 'insert into anuncios (user_id,categoria_id,descricao,preco,titulo,imagem,validade,created,modified) values '
for produto in produtos:
  try:
    preco = produto[2].replace('.','')
  except:
    preco = 0

  try:
    imagem = "%d.jpg" % contador
    contador += 1
    if os.path.exists("reader_img/%s" % imagem) is False:
      urllib.request.urlretrieve(produto[0], "reader_img/%s" % imagem)
  except:
    imagem = 'no_image.jpg'

  values = "(1,{},'{}','{}','{}','{}','2020-01-01',CURRENT_TIMESTAMP,CURRENT_TIMESTAMP);".format(categoria,produto[1],preco,produto[1],imagem)
  print(sql  + values)
  f.write("{}\r\n".format((sql + values)))
f.close()