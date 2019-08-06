import sys
from sridentify import Sridentify
# from epsg_ident import EpsgIdent

data = sys.argv[1]

# print (data)
ident = Sridentify()
ident.from_file(data)
print(ident.get_epsg())
